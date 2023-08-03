<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pembelian;
use App\Models\Keranjang;
use App\Models\VolManga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


use Carbon\Carbon;
use Xendit\Xendit;
use GuzzleHttp\Client;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::all();
        return view('Backend.Pages.transaksi', compact('transaksi'));
    }

    /**
     * Convert or Download to CSV extension.
     */
    public function downloadCSV(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['message' => 'Date Invalid']);
        }

        $startDate = Carbon::parse($request->startDate)->startOfDay();
        $endDate = Carbon::parse($request->endDate)->endOfDay();
        $transaksis = Transaksi::whereBetween('updated_at', [$startDate, $endDate])->get();

        if ($transaksis->isEmpty()) {
            return back()->withErrors(['message' => 'No data available']);
        }
    
        // Generate the CSV file content
        $csvData = $this->generateCsvData($transaksis);
    
        // Prepare the response with the CSV file
        $response = Response::make($csvData);
        $response->header('Content-Type', 'text/csv');
        $response->header('Content-Disposition', 'attachment; filename="DataTransaksi.csv"');
    
        return $response;
    }


    private function generateCsvData($transaksis)
    {
        $headers = [
            'No',
            'External ID',
            "ID Virtual Account",
            'Username Pengguna',
            'Metode Pembayaran',
            'Total Pembayaran',
            'Status Transaksi',
            'Tanggal Transaksi',
        ];

        $rows = [];
        $no = 1;

        // Add transaction data to each row
        foreach ($transaksis as $item) {
            $rowData = [
                $no++,
                $item->external_id,
                $item->id_va,
                $item->user->username,
                $item->metode_pembayaran,
                $item->total_harga,
                $item->status_transaksi,
                $item->updated_at
            ];

            $rows[] = implode(',', $rowData);
        }

        // Combine headers and rows
        $data = implode(',', $headers) . "\n" . implode("\n", $rows);

        return $data;
    }




    /* Handling Frontend */

    public function beliInstant(VolManga $volManga)
    {
        $namaRoute = Route::currentRouteName();
        $user = Auth::user();

        $mangaOnHold = Keranjang::where('id_vol', $volManga->id_vol)
            ->where('id_user', $user->id_user)
            ->where('status', 'ON HOLD')
            ->exists();

        if ($mangaOnHold) {
            abort(404);
        }

        $mangaExistsInCart = Keranjang::where('id_vol', $volManga->id_vol)
            ->where('id_user', $user->id_user)
            ->exists();

        if (!$mangaExistsInCart) {
            $addToCart = new Keranjang([
                'id_vol' => $volManga->id_vol,
                'id_user' => $user->id_user,
                'harga' => $volManga->harga,
                'status' => "NOT PURCHASED"
            ]);

            $addToCart->save();
        }

        $subtotal = Keranjang::where('id_user', $user->id_user)
            ->where('id_vol', $volManga->id_vol)
            ->sum('harga');

        $pajak = $subtotal * 0.2;
        $total = $subtotal + $pajak;

        return view('Frontend.Pages.konfirmasiPembayaran')
            ->with(compact('volManga', 'subtotal', 'pajak', 'total'))
            ->with('namaRoute', $namaRoute);
    }

    
    public function beliDariKeranjang()
    {
        $listItem = Keranjang::where('id_user', Auth::user()->id_user)
            ->where('status', 'NOT PURCHASED')
            ->get();

        if ($listItem->isEmpty()) {
            abort(404);
        }

        $subtotal = $listItem->sum('harga');
        $pajak = $subtotal * 0.2;
        $total = $subtotal + $pajak;

        return view('Frontend.Pages.konfirmasiPembayaran')
            ->with(compact('subtotal', 'pajak', 'total', 'listItem'))
            ->with('namaRoute', Route::currentRouteName());

    }



    /**
     * Display a list of user transaction.
     */
    public function daftarTransaksi()
    {
        $transaksi = Transaksi::where('id_user', Auth::user()->id_user)->get();

        $purchasedManga = Pembelian::where('id_user', Auth::user()->id_user)->count();
        $listTransaction = Transaksi::where('id_user', Auth::user()->id_user)->count();
        $listCart = Keranjang::where('id_user', Auth::user()->id_user)->where('status', 'NOT PURCHASED')->count();

        return view('Frontend.Pages.daftarTransaksi', compact('transaksi', 'purchasedManga', 'listTransaction', 'listCart'));
    }
    

    /**
     * Transaction from cart.
     */
    public function transaksiLewatKeranjang(Request $request)
    {
        $metodePembayaran = $request->metodePembayaran;
        if ($metodePembayaran === null || $metodePembayaran === "") {
            return back()->withErrors("Metode Pembayaran tidak valid.");
        }

        $tglSekarang = Carbon::now()->format('Y-m-d');
        
        $subtotal = Keranjang::where('id_user', Auth::user()->id_user)->where('status', 'NOT PURCHASED')->sum('harga');
        $pajak = $subtotal * 0.2;
        $total = $subtotal + $pajak;

        $transaksiTerakhir = Transaksi::orderBy('created_at', 'desc')->first();

        $transaksi = new Transaksi([
            'id_user' => Auth::user()->id_user,
            'total_harga'=> $total,
            'status_transaksi' => 'PENDING',
            'metode_pembayaran' => $metodePembayaran,            
        ]);

        if ($transaksiTerakhir && (substr($transaksiTerakhir->created_at, 0, -9) === $tglSekarang)) {
            $nomorTerakhir = intval(substr($transaksiTerakhir->external_id, 6, -9));
            $nomorTransaksi = $nomorTerakhir + 1;
        } else {
            $nomorTransaksi = 1;
        }

        switch ($metodePembayaran) {
            case "BNI":
                $transaksi->external_id = "BNI-VA" . $nomorTransaksi . Auth::user()->id_user . date('Ymd');
                $transaksi->save();
              break;
            case "BCA":
                $transaksi->external_id = "BCA-VA" . $nomorTransaksi . Auth::user()->id_user . date('Ymd');
                $transaksi->save();
              break;
            default:
              return redirect()->back()->withErrors('Metode pembayaran tidak valid');
        }
        $transaksi->save();                

        
        $listItems = Keranjang::where('id_user', Auth::user()->id_user)->where('status', 'NOT PURCHASED')->get();        
        foreach ($listItems as $item) { 
            $item->id_transaksi = $transaksi->id_transaksi;           
            $item->status = 'ON HOLD';
            $item->save();
        }        
        
        return redirect()->route('pembayaran', $transaksi->external_id);
    }


    /**
     * Instant transaction.
     */
    public function transaksiPembelianLangsung(Request $request, $idVol)
    {
        $volManga = Keranjang::where('id_user', Auth::user()->id_user)->where('id_vol', $idVol)->first();
        if ($volManga->status == 'ON HOLD') {
            abort(404);
        }

        $metodePembayaran = $request->metodePembayaran;
        if ($metodePembayaran == null || $metodePembayaran == "") {
            return back()->withErrors("Metode Pembayaran tidak valid.");
        }
        $tglSekarang = Carbon::now()->format('Y-m-d');
        


        $subtotal = Keranjang::where('id_user', Auth::user()->id_user)->where('id_vol', $idVol)->sum('harga');
        $pajak = $subtotal * 0.2;
        $total = $subtotal + $pajak;

        $transaksiTerakhir = Transaksi::orderBy('created_at', 'desc')->first();

        $transaksi = new Transaksi([
            'id_user' => Auth::user()->id_user,
            'total_harga'=> $total,
            'status_transaksi' => 'PENDING',
            'metode_pembayaran' => $metodePembayaran,            
        ]);

        if ($transaksiTerakhir && (substr($transaksiTerakhir->created_at, 0, -9) === $tglSekarang)) {
            $nomorTerakhir = intval(substr($transaksiTerakhir->external_id, 6, -9));
            $nomorTransaksi = $nomorTerakhir + 1;
        } else {
            $nomorTransaksi = 1;
        }

        switch ($metodePembayaran) {
            case "BNI":
                $transaksi->external_id = "BNI-VA" . $nomorTransaksi . Auth::user()->id_user . date('Ymd');
                $transaksi->save();
              break;
            case "BCA":
                $transaksi->external_id = "BCA-VA" . $nomorTransaksi . Auth::user()->id_user . date('Ymd');
                $transaksi->save();
              break;
            default:
              return redirect()->back()->withErrors('Metode pembayaran tidak valid');
        }
        $transaksi->save();    


        $item = Keranjang::where('id_user', Auth::user()->id_user)->where('id_vol', $idVol)->where('status', 'NOT PURCHASED')->first();
        $item->id_transaksi = $transaksi->id_transaksi;
        $item->status = 'ON HOLD';
        $item->save();

        return redirect()->route('pembayaran', $transaksi->external_id);
    }


    /**
     * Creating Virtual Account.
     */
    public function membuatVirtualAccount($external_id)
    {
        Xendit::setApiKey('xnd_development_nyGTycwXqrF67tyUS8E9UY2B7nS2gD7H3HLJkcDRyQR9WOVszChI0THc859ID');

        $transaksi = Transaksi::where('external_id', $external_id)->first();
        if (empty($transaksi) || $transaksi === null) {
            abort(404);
        }

        $params = [ 
            'external_id' => $external_id,
            'bank_code' => $transaksi->metode_pembayaran,
            'name' => Auth::user()->nama_user,
            'country' => 'ID',
            'currency' => 'IDR',
            'is_single_use' => true,
            'is_closed' => true,
            'expected_amount' => $transaksi->total_harga,
            'expiration_date' => Carbon::now()->addDay()->format('Y-m-d\TH:i:s\Z'),
        ];
      
        $createVA = \Xendit\VirtualAccounts::create($params);

        if ($transaksi->id_va === null) {
            Transaksi::where('external_id', $external_id)->update([
                'id_va' => $createVA['id'],
            ]);
        }

        return $createVA;
    }


    /**
     * Getting Virtual Account.
     */
    public function getVirtualAccount($external_id)
    {
        Xendit::setApiKey('xnd_development_nyGTycwXqrF67tyUS8E9UY2B7nS2gD7H3HLJkcDRyQR9WOVszChI0THc859ID');

        $transaksi = Transaksi::where('external_id', $external_id)->first();
        if (empty($transaksi) || $transaksi === null) {
            abort(404);
        }


        $id = $transaksi->id_va;
        $getVA = \Xendit\VirtualAccounts::retrieve($id);

        return $getVA;
    }

    /**
     * Getting Paid Virtual Account.
     */
    public function getPaidVirtualAccount($external_id)
    {
        Xendit::setApiKey('xnd_development_nyGTycwXqrF67tyUS8E9UY2B7nS2gD7H3HLJkcDRyQR9WOVszChI0THc859ID');

        $transaksi = Transaksi::where('external_id', $external_id)->first();
        if (empty($transaksi) || $transaksi === null) {
            abort(404);
        }


        $paymentID = $transaksi->id_va;
        $getFVAPayment = \Xendit\VirtualAccounts::getFVAPayment($paymentID);


        return $getFVAPayment;
    }


    /**
     * Display Payment Process.
     */
    public function prosesPembayaran($external_id)
    {
        $transaksi = Transaksi::where('external_id', $external_id)->where('id_user', Auth::user()->id_user)->first();
        $listItem = Keranjang::where('id_transaksi', $transaksi->id_transaksi)->where('id_user', Auth::user()->id_user)->get();
        if (empty($transaksi) || $transaksi === null) {
            abort(404);
        }

        if ($transaksi->id_va === null) {
            $this->membuatVirtualAccount($external_id);
            
        }

        if ($transaksi->status_transaksi === 'SUKSES') {
            $virtualAcc = $this->getPaidVirtualAccount($external_id);
            return view('Frontend.Pages.pembayaran', compact('virtualAcc', 'transaksi', 'listItem'));
        }

        $virtualAcc = $this->getVirtualAccount($external_id);
        return view('Frontend.Pages.pembayaran', compact('virtualAcc', 'transaksi', 'listItem'));
    }



    function halamanSimulasi($external_id){
        $transaksi = Transaksi::where('external_id', $external_id)->where('id_user', Auth::user()->id_user)->first();
        
        if ($transaksi->status_transaksi === 'SUKSES') {
            abort(404);
        }

        $virtualAcc = $this->getVirtualAccount($external_id);

        return view('Frontend.Pages.simulasiPembayaran', compact('virtualAcc', 'transaksi'));
    }


    function simulasiPembayaran(Request $request) {
        $externalId = $request->input('externalId');
        $amount = $request->input('amount');

        // Convert the "amount" data to raw JSON
        $jsonData = json_encode(['amount' => $amount]);

        $url = 'https://api.xendit.co/callback_virtual_accounts/external_id={' . $externalId . '}/simulate_payment';
        $url = str_replace('{' . $externalId . '}', $externalId, $url);

        $client = new Client();

        try {
            // Send the POST request with raw JSON data
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => '*/*',
                    'Connection' => 'keep-alive',
                    'Authorization' => 'Basic ' . base64_encode(env('XENDIT_API_KEY'). ':'),
                ],
                'body' => $jsonData
            ]);

            // Process the response as needed
            $statusCode = $response->getStatusCode();
            $responseData = json_decode($response->getBody(), true);

            // Return the response
            return response()->json($responseData, $statusCode);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the request
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

}
