<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keranjang = Keranjang::with('volManga')->get();
        return view('Backend.Pages.keranjang', compact('keranjang'));
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
        $keranjangs = Keranjang::whereBetween('created_at', [$startDate, $endDate])->get();

        if ($keranjangs->isEmpty()) {
            return back()->withErrors(['message' => 'No data available']);
        }
    
        // Generate the CSV file content
        $csvData = $this->generateCsvData($keranjangs);
    
        // Prepare the response with the CSV file
        $response = Response::make($csvData);
        $response->header('Content-Type', 'text/csv');
        $response->header('Content-Disposition', 'attachment; filename="DataKeranjang.csv"');
    
        return $response;
    }


    private function generateCsvData($keranjangs)
    {
        $headers = [
            'No',
            'Manga',
            'Volume ke',
            'Username Pengguna',
            'Status Item',
            'Created at'
        ];

        $rows = [];
        $no = 1;

        // Add transaction data to each row
        foreach ($keranjangs as $cart) {
            $rowData = [
                $no++,
                $cart->volManga->manga->judul_manga,
                $cart->volManga->vol_ke,
                $cart->user->username,
                $cart->status,
                $cart->created_at
            ];

            $rows[] = implode(',', $rowData);
        }

        // Combine headers and rows
        $data = implode(',', $headers) . "\n" . implode("\n", $rows);

        return $data;
    }
}
