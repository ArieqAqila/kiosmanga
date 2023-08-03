<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pembelian;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class CallbackHandler extends Controller
{

    /**
     * Callback after Creating Virtual Account.
     */
    public function callbackVirtualAccount(Request $request)
    {
        $data = $request->all();
        $id_va = $data['id'];
        $external_id = $data['external_id'];

        if ($data['status'] === 'INACTIVE') {
            Transaksi::where('external_id', $external_id)->delete();
        }

        return response()->json($data);
    }


    /**
     * Callback if payment was paid.
     */
    public function callbackPembayaran(Request $request)
    {
        $data = $request->all();
        $external_id = $data['external_id'];
        $payment_id = $data['payment_id'];
        
        Transaksi::where('external_id', $external_id)->update([
            'status_transaksi' => 'SUKSES',
            'id_va' => $payment_id,
        ]);

        $transaksi = Transaksi::where('external_id', $external_id)->first();
        $listItems = Keranjang::where('id_user', $transaksi->user->id_user)->where('status', 'ON HOLD')->where('id_transaksi', $transaksi->id_transaksi)->get();
        foreach ($listItems as $item) { 
            $item->id_transaksi = $transaksi->id_transaksi;           
            $item->status = 'PURCHASED';
            $item->save();

            $pembelian = new Pembelian([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_user' => $transaksi->user->id_user,
                'id_vol' => $item->id_vol,
                'tgl_pembelian' => date('Y-m-d')
            ]);
            $pembelian->save();
        }


        return response()->json($data);
    }
}
