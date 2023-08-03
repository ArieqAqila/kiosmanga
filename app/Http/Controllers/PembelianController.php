<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelian = Pembelian::all();
        return view('Backend.Pages.pembelian', compact('pembelian'));
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
        $pembelians = Pembelian::whereBetween('tgl_pembelian', [$startDate, $endDate])->get();

        if ($pembelians->isEmpty()) {
            return back()->withErrors(['message' => 'No data available']);
        }
    
        // Generate the CSV file content
        $csvData = $this->generateCsvData($pembelians);
    
        // Prepare the response with the CSV file
        $response = Response::make($csvData);
        $response->header('Content-Type', 'text/csv');
        $response->header('Content-Disposition', 'attachment; filename="DataPembelian.csv"');
    
        return $response;
    }


    private function generateCsvData($pembelians)
    {
        $headers = [
            'No.',
            'Username Pengguna',
            'Judul Manga',
            'Volume ke',
            'Tanggal Pembelian',
        ];

        $rows = [];
        $no = 1;

        // Add transaction data to each row
        foreach ($pembelians as $item) {
            $rowData = [
                $no++,
                $item->user->username,
                $item->volManga->manga->judul_manga,
                $item->volManga->vol_ke,
                $item->tgl_pembelian,
            ];

            $rows[] = implode(',', $rowData);
        }

        // Combine headers and rows
        $data = implode(',', $headers) . "\n" . implode("\n", $rows);

        return $data;
    }
}
