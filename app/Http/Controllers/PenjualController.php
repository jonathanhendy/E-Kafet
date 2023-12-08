<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use App\Models\Saldo;
use App\Models\Pesanan;
use App\Models\Checkout;

class PenjualController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data = [
            'title' => 'penjual Toko'
        ];
        $saldo=Saldo::where('user_id',auth()->user()->id)->first()->saldo;
        $hitung = Pesanan::where('status_pesanan','0')->count();
        return view('contents.penjual.home', $data,compact('saldo','hitung'));
    }

    // produk
    public function produk(Request $request)
    {
        $user = auth()->user()->id;
        $reqsearch = $request->get('search');  
        $produkdb = Produk::where('user_id', $user)->leftJoin('kategori','produk.id_kategori','=','kategori.id')
            ->select('kategori.nama_kategori','produk.*')
            ->when($reqsearch, function($query, $reqsearch){
                $search = '%'.$reqsearch.'%';
                return $query->whereRaw('nama_kategori like ? or nama_produk like ?', [
                        $search, $search
                    ]);
            });
        $data = [

            'title'     => 'Data Produk',
            'kategori'  => Kategori::All(),
            'produk'    => $produkdb->latest()->paginate(5),
            'request'   => $request
        ];
        return view('contents.penjual.produk', $data);
    }

    public function edit_produk(Request $request)
    {
        $data = [
            'edit' => Produk::findOrFail($request->get('id')),
            'kategori' => Kategori::All(),
        ];
        return view('components.penjual.produk.edit', $data);
    }

    // data proses produk 
    public function create_produk(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "id_kategori"   => "required",
            "gambar"        => "required|image|max:10024",
            "nama_produk"   => "required",
           "deskripsi"     => "required",
            "harga_jual"    => "required",
        ]);

        if($validator->passes()){

            $image = $request->file('gambar');
            $input['imagename'] = 'produk_'.time().'.'.$image->getClientOriginalExtension();
    
            $destinationPath = storage_path('app/public/gambar');
            $image->move($destinationPath, $input['imagename']);
            $user=auth()->user()->id;
            Produk::insert([
                'id_kategori'   => $request->get("id_kategori"),
                'user_id'       => $user,
                'gambar'        => $input['imagename'],
                'nama_produk'   => $request->get("nama_produk"),
                'deskripsi'     => $request->get("deskripsi"),
                'harga_jual'    => $request->get("harga_jual"),
                'created_at'    => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with("success"," Berhasil Insert Data ! ");
        }
        else{
            return redirect()->back()->withErrors($validator)->with("failed"," Gagal Insert Data ! ");
        }
    }

    public function update_produk(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "id"            => "required",
            "id_kategori"   => "required",
            "nama_produk"   => "required",
            "deskripsi"     => "required",
            "harga_jual"    => "required",
        ]);

        if($validator->passes()){
            $produkdb = Produk::findorFail($request->get('id'));
            if($request->file('gambar')){
                $validator = \Validator::make($request->all(),[
                    "gambar" => "required|image|max:10024",
                ]);
                if($validator->passes()){
                    $image = $request->file('gambar');
                    $input['imagename'] = 'produk_'.time().'.'.$image->getClientOriginalExtension();
            
                    $destinationPath = storage_path('app/public/gambar');
                    $image->move($destinationPath, $input['imagename']);
                    $gambar = $input['imagename'];
                }
                else{
                    return redirect()->back()->withErrors($validator)->with("failed"," Gagal Update Data ! ");
                }
            }
            else{
                $gambar = $produkdb->gambar;
            }

            $produkdb->update([
                'id_kategori'   => $request->get("id_kategori"),
                'gambar'        => $gambar,
                'nama_produk'   => $request->get("nama_produk"),
                'deskripsi'     => $request->get("deskripsi"),
                'harga_jual'    => $request->get("harga_jual"),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);

            return redirect()->back()->with("success"," Berhasil Update Data Produk ".$request->get("nama_produk").' !');
        }
        else{
            return redirect()->back()->withErrors($validator)->with("failed"," Gagal Update Data ! ");
        }
    }

    public function delete_produk(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->back()->with("success"," Berhasil Delete Data Produk ! ");
    }

    // kategori
    public function kategori(Request $request)
    {
        if(!empty($request->get('id'))){
            $edit = Kategori::findOrFail($request->get('id'));
        }
        else{
            $edit = '';
        }

        $data = [
            'title'     => 'Data Kategori',
            'kategori'  => Kategori::paginate(5),
            'edit'      => $edit,
            'request'   => $request
        ];
        return view('contents.penjual.kategori', $data);
    }

    // data proses kategori
    public function create_kategori(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "nama_kategori" => "required",
        ]);
        if($validator->passes()) {
            Kategori::insert([
                'nama_kategori' => $request->get("nama_kategori"),
                'created_at'    => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with("success"," Berhasil Insert Data ! ");
        }
        else{
            return redirect()->back()->withErrors($validator)->with("failed"," Gagal Insert Data ! ");
        }
    }

    public function update_kategori(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "id"            => "required",
            "nama_kategori" => "required",
        ]);
        if($validator->passes()) {
            Kategori::findOrFail($request->get('id'))->update([
                'nama_kategori' => $request->get("nama_kategori"),
                'update_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with("success"," Berhasil Update Data ! ");
        }
        else{
            return redirect()->back()->withErrors($validator)->with("failed"," Gagal Update Data ! ");
        }
    }


    public function delete_kategori(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->back()->with("success"," Berhasil Delete Data ! ");
    }

    // profil
    public function profil(Request $request)
    {
        $data = [
            'title' => 'Data Produk',
            'edit' => User::findOrFail(auth()->user()->id),
            'request' => $request
        ];
        return view('contents.penjual.profil', $data);
    }

    // data proses profil
    public function update_profil(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            "name"                  => "required",
            "email"                 => "required",
            "password"              => "required|min:6",
            "password_confirmation" => "required|min:6",
        ]);

        if($validator->passes())
        {
            if($request->get("password") == $request->get("password_confirmation"))
            {
                User::findOrFail(auth()->user()->id)->update([
                    'name'          => $request->get("name"),
                    'email'         => $request->get("email"),
                    'phone'         => $request->get("phone"),
                    'address'       => $request->get("address"),
                    'password'      => Hash::make($request->get("password")),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ]);
                return redirect()->back()->with("success"," Berhasil Update Data ! ");
            }
            else{
                return redirect()->back()->with("failed","Confirm Password Tidak Sama !");
            }
        }
        else{
            return redirect()->back()->withErrors($validator)->with("failed"," Gagal Update Data ! ");
        }
    }

    public function pesanan(){
        $nota = Pesanan::where('toko_id',auth()->user()->id)
        ->where('status_pesanan',0)
        ->leftJoin("users", "users.id", "=", "pesanan.user_id")
        ->select("users.name","pesanan.created_at","pesanan.total","pesanan.id","pesanan.status_pesanan","pesanan.toko_id")
        ->get();
        return view("contents.penjual.pesanan",compact('nota'));
    }

    public function detailpesanan($id){
        $produk = Checkout::where('pesanan_id', $id)
        ->where('status', 1)->get();
        return view("contents.penjual.detailpesanan",compact('produk'));
    }

    public function pesananselesai($id){
        Pesanan::where('id',$id)->update([
            'status_pesanan'=> 1
        ]);
        return redirect()->back(); 
    }

    public function datapenjualan(){
        $nota=Pesanan::where('toko_id',auth()->user()->id)
        ->where('status_pesanan',1)
        ->leftJoin("users", "users.id", "=", "pesanan.user_id")
        ->select("users.name","pesanan.created_at","pesanan.total","pesanan.id","pesanan.status_pesanan","pesanan.toko_id")
        ->get();
        return view("contents.penjual.datapenjualan",compact('nota'));
    }

    public function detailpenjualan($id){
        $produk = Checkout::where('pesanan_id', $id)
        ->where('status', 1)->get();
        return view("contents.penjual.detailpenjualan",compact('produk'));
    }
}
