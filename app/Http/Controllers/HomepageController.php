<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produk;
use App\Models\Layanan;
use App\Models\Kendaraan;
use App\Models\Order;
use App\Models\Transaksi;


class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraan = Kendaraan::where('status', 1)->get();
        $layanan = Layanan::where('status', 1)->get();
        $order = Order::where('id_user', Auth::id())->orderBy('created_at', 'desc')->limit(4)->get();
        $produk = Produk::where('status', 1)->get();
        return view('homepage.index', compact(['kendaraan', 'layanan', 'order', 'produk']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_kendaraan' => 'required|integer',
            'nomor_mesin' => 'required',
            'nomor_polisi' => 'required',
            'seri_kendaraan' => 'required',
            'id_user' => 'required|integer',
            'nomor_telpon' => 'required',
            'tgl_booking' => 'required',
            'alamat' => 'required',
            'id_layanan' => 'required|integer',
        ],
        [
            'required' => 'data harus diisi',
            'integer' => 'data harus dipilih',
        ]);
        $input['id_kendaraan'] = $request->id_kendaraan;
        $input['nomor_mesin'] = $request->nomor_mesin;
        $input['nomor_polisi'] = $request->nomor_polisi;
        $input['seri_kendaraan'] = $request->seri_kendaraan;
        $input['id_user'] = $request->id_user;
        $input['nomor_telpon'] = $request->nomor_telpon;
        $input['tgl_booking'] = $request->tgl_booking;
        $input['alamat'] = $request->alamat;
        $input['id_layanan'] = $request->id_layanan;
        $order = Order::create($input);
        $order->save();
        return redirect('/#riwayat')->with('success', 'Permintaan telah dikirimkan, silahkan tunggu konfirmasi selanjutnya');
    }

    public function show(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('homepage.detail', compact(['transaksi']));
    }

    public function update(Request $request, string $id_order)
    {
        $request->validate([
            'id_kendaraan' => 'required|integer',
            'nomor_mesin' => 'required',
            'nomor_polisi' => 'required',
            'seri_kendaraan' => 'required',
            'id_user' => 'required|integer',
            'nomor_telpon' => 'required',
            'tgl_booking' => 'required',
            'alamat' => 'required',
            'id_layanan' => 'required|integer',
        ],
        [
            'required' => 'data harus diisi',
            'integer' => 'data harus dipilih',
        ]);

        $order = Order::findOrFail($id_order);
        $order->update([
            'id_kendaraan' => $request->id_kendaraan,
            'nomor_mesin' => $request->nomor_mesin,
            'nomor_polisi' => $request->nomor_polisi,
            'seri_kendaraan' => $request->seri_kendaraan,
            'id_user' => $request->id_user,
            'nomor_telpon' => $request->nomor_telpon,
            'tgl_booking' => $request->tgl_booking,
            'alamat' => $request->alamat,
            'id_layanan' => $request->id_layanan,
        ]);
        
        return redirect('/#riwayat')->with('success', 'Permintaan telah diubah, silahkan tunggu konfirmasi selanjutnya');
    }

    public function batal(Request $request, string $id_order)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $order = Order::findOrFail($id_order);
        $order->update([
            'status' => $request->status,
        ]);
        return redirect('/#riwayat')->with('success', 'Reservasi telah dibatalkan');
    }

    public function transaksi(Request $request)
    {
        $request->validate([
            'total_harga' => 'required|numeric',
            'id_order' => 'required|numeric',
            'id_produk' => 'nullable|array',
            'id_produk.*' => 'exists:produks,id_produk',
        ],
        [
            'required' => 'data harus diisi',
            'integer' => 'data harus angka',
        ]); 

        do {
            $kode_transaksi = 'ZEN-' . rand(10000000, 99999999);
        } while (Transaksi::where('kode_transaksi', $kode_transaksi)->exists());

        $input['kode_transaksi'] = $kode_transaksi;
        $input['id_order'] = $request->id_order;
        $input['total_harga'] = $request->total_harga;
        $transaksi = Transaksi::create($input);
        $transaksi->order->produk()->attach($request->id_produk);
        $transaksi->save();

        $nomor_telpon = Order::where('id_order', $request->id_order)->value('nomor_telpon');
        $user = Auth::user();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaksi->id,
                'gross_amount' => $transaksi->total_harga,
            ),
            'customer_details' => array(
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $nomor_telpon,
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('homepage.detail', compact(['snapToken', 'transaksi']))->with('success', 'Konfimasi transaksi berhasil, Silahkan lanjut pembayaran');
    }
    
    public function afterpayment(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $transaksi = Transaksi::find($request->order_id);
                $transaksi->update(['status' => 1]);
                $idOrder = $transaksi->id_order;
                $order = Order::find($idOrder);

                if ($order) {
                    $order->update(['status' => 'diterima']);
                }
            }
        }
    }
}
