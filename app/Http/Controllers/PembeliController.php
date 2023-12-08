<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Checkout;
use App\Models\User;
use App\Models\Saldo;
use App\Models\Pesanan;
use DB;

class PembeliController extends Controller
{
    public function keranjang(Request $request){
       $checkout=Checkout::where('user_id',auth()->user()->id)
       ->where('status', 0)->get();

        return view("contents.pembeli.keranjang",compact('checkout'));
    }

    public function bayar(Request $request){
        $saldoNow = Saldo::where('user_id',auth()->user()->id)->first()->saldo;
        $totalHarga =  Checkout::where('user_id',auth()->user()->id)->where('status', 0)->sum('total');
        $saldoUpdate = Saldo::where('user_id',auth()->user()->id)
        ->update([
            'saldo' => $saldoNow - $totalHarga
        ]);

        $tokoCode = Checkout::where('user_id',auth()->user()->id)->where('status', 0)->distinct()->pluck('toko_id');
        foreach($tokoCode as $toko){
            $total =  Checkout::where('user_id',auth()->user()->id)->where('status', 0)
            ->where('toko_id', $toko)->sum('total');
            $nota = Pesanan::create([
                'toko_id' => $toko,
                'user_id' => auth()->user()->id,
                'nama' => auth()->user()->name,
                'status_pesanan' => 0,
                'total' => $total
            ]);

            $notaId = $nota->id;
            $checkoutBarang = Checkout::where('toko_id', $toko)->where('status', 0)->pluck('id')->toArray();
            $notaCheckout = Checkout::whereIn('id', $checkoutBarang)
            ->update([
                'pesanan_id' => $notaId,
                'status' => 1
            ]);

            $tokoSaldo=Saldo::where('user_id', $toko)->first();
            if(!$tokoSaldo){
                Saldo::create([
                    'user_id' => $toko,
                    'saldo' => $nota->total
                ]);
            } else{
                $saldoToko=$tokoSaldo->saldo;
                $saldoNowToko=Saldo::where('user_id', $toko)->update([
                    'saldo'=>$saldoToko + $nota->total
                ]);
            }
        }
        
        return redirect()->to('/pesanansukses');
    }

    public function hapuspesanan(Request $request, $id)
    {
        $checkout = Checkout::findOrFail($id);
        $checkout->delete();
        return redirect()->back()->with("success"," Berhasil Batalkan Pesanan !");
    }

    public function checkoutpesanan(){
        $checkout=Checkout::where('user_id',auth()->user()->id)
        ->where('status', 0)->get();
        $total=Checkout::where('user_id',auth()->user()->id)
        ->where('status', 0)->sum('total');
        $saldo=saldo::where('user_id',auth()->user()->id)->first()->saldo;
        return view("contents.pembeli.checkoutpesanan",compact('checkout','total','saldo'));
    }

    public function viewProduk($id){
        $produk = Checkout::where('pesanan_id', $id)
        ->where('status', 1)->get();
        return view("contents.pembeli.detailpesanan",compact('produk'));
    }

    public function saldo(){
        $user = auth()->user()->id;
        $saldo = Saldo::where('user_id', $user)->get();
        return view("contents.pembeli.saldo", compact('saldo'));
    }

    public function addsaldo(Request $request){
        $saldonow = saldo::where('user_id',auth()->user()->id)->first()->saldo;
        $saldo = $request->saldo;
        $totalsaldo = ($saldonow + $saldo);
        saldo::where('user_id', auth()->user()->id)->update([
            'saldo' =>  $totalsaldo ,
        ]);
        return redirect()->back();
    }
    
    public function pesanansukses(){
        $nota=Pesanan::where('user_id',auth()->user()->id)
        ->leftJoin("users", "users.id", "=", "pesanan.toko_id")
        ->select("users.name","pesanan.created_at","pesanan.total","pesanan.id","pesanan.status_pesanan","pesanan.toko_id")
        ->get();
        return view("contents.pembeli.pesanansukses", compact('nota'));
    }

    public function addCart(Request $request){
        $data = [
            'user_id' => auth()->user()->id,
            'keterangan' => $request->keterangan,
            'toko_id' => $request->toko_id,
            'produk' => $request->namaproduk,
            'jumlah' => $request->jumlah,
            'harga' => $request->hargaproduk,
            'total' => $request->subtotal,
            'status' => 0
        ];

        Checkout::create($data);
        return redirect()->route('pembeli.keranjang');
    }

    public function purchase(Request $request){
        $total=Checkout::where('user_id',auth()->user()->id)
        ->where('status', 0)->sum('total');
        $saldo = saldo::where('user_id',auth()->user()->id)->first()->saldo;

        $saldonow = saldo::where('user_id',auth()->user()->id)
        ->update([
            'saldo' => $saldo - $total
        ]);

        
    
    }

}
