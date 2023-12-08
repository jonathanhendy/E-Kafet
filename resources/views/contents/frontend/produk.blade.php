@extends('layouts.frontend')
@section('content')

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.col1 {
  float: left;
  width: 70%;
  padding: 10px;
}

.col2 {
  float: left;
  width: 30%;
  padding: 10px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 60%;
  height: 80%;
  margin-top:18%;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
.plusminus {
    width: 179px;
}
.custom-input{
    width : 233px;
}
.subtotal{
    text-align:right;
}

</style>
</head>
<body>

<div class="row">
  <div class="col1" style="background-color:white;">
  <div class="container mt-5">
    <div class="row">
        <div class="col-sm-9 mx-auto">
            <!--product -->
            <div class="product">
                <h4 class="mb-4"><b>{{ $title }}</b></h4>
                <div class="row">
                    <div class="col-sm-4">
                        <img src="{{ url_images('gambar', $edit->gambar) }}" class="img-fluid w-100 mb-3">
                    </div>
                    <div class="col-sm-8 detail-produk">
                        <div class="row mt-3">
                            <div class="col-sm-4"><b>Kategori :</b></div>
                            <div class="col-sm-8">
                                <a class="text-produk" href="{{ url('kategori/'.$edit->id) }}">
                                    {{ $edit->nama_kategori }}
                                </a>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><b>Nama Produk: </b></div>
                            <div class="col-sm-8"><?= $edit->nama_produk;?></div>
                            <input type="hidden" class="produk" value="{{$edit->nama_produk}}">
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><b>Harga jual :</b></div>
                            <div class="col-sm-8 text-success"><h4><b>Rp<?= number_format($edit->harga_jual);?>,-</b></h4></div>
                            <input class="hargajual" type="hidden" value="{{$edit->harga_jual}}"/>
                            <input class="toko_id" type="hidden" value="{{$edit->user_id}}"/>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4" ><b>Deskripsi :</b></div>
                            <div class="col-sm-8"><?= $edit->deskripsi;?></div></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

  @guest
  <div class="col2" style="background-color:white;">
  <div class="card">
  <div class="container" style="margin-top:15px; margin-bottom:15px;">
    <h5 style ="text-align:center"><b>Atur Jumlah & Catatan</b></h5> 
    <br>
    <table>
        <tbody>
        <tr>
        <td>
          <form id='myform' method='POST' class='quantity' action='#'>
          <input type='button' value='-' class='qtyminus minus' field='quantity' />
          <input type='text' min="0" name='quantity' class='qty plusminus ' />
          <input type='button' value='+' class='qtyplus plus' field='quantity' />
          </form>
        </td>
        <tr>
        </tbody>
    </table>
    <br>
    <label>Tambah Catatan :</label>
    <input type="text" class="custom-input mb-3"placeholder="">
    <br>
    <table>
        <thead>
        <tr>
        <td>Subtotal :</td>
        <td class="subtotal" style="font-size:20px text-align:right"></td>
        </tr>
        </table>
        <br>
        @guest
        <div class="d-flex justify-content-center">
          <a href="/login" target="_blank" class="btn btn-success btn-md mt-2">
          <i class=></i>+ Keranjang
          </a> 
        </div>
    @else
    @if(auth()->user()->isPembeli == 1)
    <div class="d-flex justify-content-center">
    <a href="/keranjang" target="_blank" class="btn btn-success btn-md mt-2">
            <i class=></i>+ Keranjang
        	</a>
    </div>  
    @endif
    @endguest 
  </div>
</div>
</div>
</div>
@else
@if(auth()->user()->isPenjual == 1)
     <p></p>
    @endif
    @if(auth()->user()->isAdmin == 1)
     <p></p>
    @endif
    @if(auth()->user()->isPembeli == 1)
    <div class="col2" style="background-color:white;">
  <div class="card">
  <div class="container" style="margin-top:15px; margin-bottom:15px;">
    <h5 style ="text-align:center"><b>Atur Jumlah & Catatan</b></h5> 
    <br>
    <table>
        <tbody>
        <tr>
        <td>
          <form id='myform' class='quantity' action='#'>
          <input type='button' value='-' class='qtyminus minus' field='quantity' />
          <input type='text' min="0" name='quantity' class='qty plusminus ' />
          <input type='button' value='+' class='qtyplus plus' field='quantity' />
          </form>
        </td>
        <tr>
        </tbody>
    </table>
    <br>
<form method='POST' action='/addtoCart'>
  @csrf
    <label>Tambah Catatan :</label>
    <input type="text" name="keterangan" class="custom-input mb-3"placeholder="">
    <br>
    <table>
        <thead>
        <tr>
        <td>Subtotal :</td>
        <td class="subtotal" style="font-size:20px text-align:right"></td>
        <input type="hidden" name="subtotal" class="subtotalfinal" value=""/>
        <input type="hidden" name="jumlah" class="jumlahbarangs" value=""/>
        <input type="hidden" name="toko_id" class="toko" value=""/>
        <input type="hidden" name="namaproduk" class="namaproduk" value=""/>
        <input type="hidden" name="hargaproduk" class="hargaproduk" value=""/>
        </tr>
        </table>

        <br>
        @guest
    <div class="d-flex justify-content-center"> 
    <a href="/login" target="_blank" class="btn btn-success btn-md mt-2">
            <i class=></i>+ Keranjang
        	</a> 
    </div>  
    @else
    @if(auth()->user()->isPembeli == 1)
    <div class="d-flex justify-content-center">
    <button type="submit" class="btn btn-success btn-md mt-2">
            <i class=></i>+ Keranjang
    </button> 
    </div>
</form>
    @endif
    @endguest 
  </div>
</div>
  </div>
</div>
@endif
@endguest
<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
<!-- Your custom script here -->
<script type="text/babel">
jQuery(document).ready(($) => {
    var subtotal = $(".subtotal").text()
    var qty = $(".qty").val("0");
    var qtys = $(".qty").val()
    var toko = $(".toko_id").val()
    var produk = $(".produk").val()
    var hargajual = $(".hargajual").val()

        $('.quantity').on('click', '.plus', function(e) {
            let $input = $(this).prev('input.qty');
            let val = parseInt($input.val());
            $input.val( val+1 ).change();
            var qty = $(".qty").val();
            if(qty == 0){
        $(".subtotal").text("Rp.0")
        $(".subtotalfinal").val(qty*hargajual)
        $(".jumlahbarangs").val(qty)
       } else {
        $(".subtotal").text("Rp."+qty*hargajual)
        $(".subtotalfinal").val(qty*hargajual)
        $(".jumlahbarangs").val(qty)
       }
        });
 
        $('.quantity').on('click', '.minus', 
            function(e) {
            let $input = $(this).next('input.qty');
            var val = parseInt($input.val());
            if (val > 0) {
                $input.val( val-1 ).change();
            } 
            var qty = $(".qty").val();
            if(qty == 0){
        $(".subtotal").text("Rp.0")
        $(".subtotalfinal").val(qty*hargajual)
        $(".jumlahbarangs").val(qty)
       } else {
        $(".subtotal").text("Rp."+qty*hargajual)
        $(".subtotalfinal").val(qty*hargajual)
        $(".jumlahbarangs").val(qty)
       }
        });
        $(".toko").val(toko)
        $(".hargaproduk").val(hargajual)
        $(".namaproduk").val(produk)
    });
</script>
</body>
</html>


@endsection
@section('javascript')

@endsection