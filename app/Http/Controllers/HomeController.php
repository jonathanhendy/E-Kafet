<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {

        $reqsearch = $request->get('search');  
        $produkdb = Produk::leftJoin('kategori','produk.id_kategori','=','kategori.id')
                    ->select('kategori.nama_kategori','produk.*');
        $data = [
            'title'     => 'E-Kafet UKDW',
            'kategori'  => Kategori::All(),
            'produk'    => $produkdb->paginate(8),
        ];
        $user = \Auth::user();
        return view('contents.frontend.home', compact('user'),$data);
    }
    public function kategori(Request $request, $id)
    {
        $edit = Kategori::findOrFail($id);
        $produkdb = Produk::leftJoin('kategori','produk.id_kategori','=','kategori.id')
                    ->select('kategori.nama_kategori','produk.*')->where('produk.id_kategori', $id);
        $data = [
            'title'     => $edit->nama_kategori,
            'kategori'  => Kategori::All(),
            'produk'    => $produkdb->latest()->paginate(8),
        ];
        return view('contents.frontend.kategori', $data);
    }

    public function search(Request $request)
    {
        $reqsearch = $request->get('keyword');  
        $produkdb = Produk::leftJoin('kategori','produk.id_kategori','=','kategori.id')
            ->select('kategori.nama_kategori','produk.*')
            ->when($reqsearch, function($query, $reqsearch){
                $search = '%'.$reqsearch.'%';
                return $query->whereRaw('nama_kategori like ? or nama_produk like ?', [
                        $search, $search
                    ]);
            });
        $data = [
            'title'     => 'Pencarian : '.$reqsearch,
            'kategori'  => Kategori::All(),
            'produk'    => $produkdb->latest()->paginate(8),
        ];
        return view('contents.frontend.kategori', $data);
    }

    public function produk(Request $request, $id)
    {
        $reqsearch = $request->get('keyword');  
        $produkdb = Produk::leftJoin('kategori','produk.id_kategori','=','kategori.id')
            ->select('kategori.nama_kategori','produk.*')
            ->where('produk.id', $id)->first();

        if(!$produkdb){ abort('404'); }
        $tokoId = Produk::where('id', $id)->first()->user_id;
        $title = User::where('id', $tokoId)->first()->name;

        $data = [
            'kategori'  => Kategori::All(),
            'edit'      => $produkdb,
        ];
        return view('contents.frontend.produk', $data,compact('title'));
    }


    public function redir_penjual(){
        return redirect('penjual');
    }

}
