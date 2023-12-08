@extends('layouts.penjual')
@section('content')

<style>
.boxes {
  display: flex;
  flex-direction: column;
  gap: 25px;
  width: 100%;
}

.row {
  display: flex;
  align-items: center;
  width: 100%;
  height: 280px;
  gap: 30px;
  flex-direction: row;
  justify-content: center;
}

.box {
  border-radius: 20px;
  width: 320px;
  height: 280px;
  background-color: #0c4e68;
  z-index: 1;
}

.badge {
  background-color: red;
}
</style>

<h4 class="card-title" style = "text-align : center">
     Selamat Datang <b>{{ auth()->user()->name }}</b>
</h4>
<br>

<div class="boxes">
  <div class="row">
    <div class="box">
        <div class="card-body text-center text-white pt-3">
          <h3>Pesanan Masuk</h3>
        </div>
        <div class="card-body text-center text-white pt-1">
        <i class="fas fa-shopping-cart fa-7x"></i> 
        </div>
        <div class="card-body text-center text-white pt-1">
            <a href="{{ route('penjual.pesanan') }}" target="_blank" class="btn btn-success btn-lg mt-2">
            Lihat Data Pesanan
            <span class="badge">{{$hitung}}</span>
            </a> 
        </div>
    </div>

    <div class="box">
      <div class="card-body text-center text-white pt-3">
          <h3>Saldo Anda</h3>
        </div>
        <div class="card-body text-center text-white pt-1">
        <i class="fas fa-money-bill fa-7x"></i> 
        </div>
        <div class="card-body text-center text-white pt-1">
            <a class="btn btn-success btn-lg mt-2">
            Rp. {{$saldo}}
            </a>  
        </div>
    </div>

    <div class="box">
      <div class="card-body text-center text-white pt-3">
          <h3>Data Penjualan</h3>
        </div>
        <div class="card-body text-center text-white pt-1">
        <i class="fas fa-scale-balanced fa-7x"></i> 
        </div>
        <div class="card-body text-center text-white pt-1">
            <a href="{{ route('penjual.datapenjualan') }} " target="_blank"class="btn btn-success btn-lg mt-2">
               Lihat Data Penjualan
            </a> 
        </div>
    </div>
  </div>

  <div class="row">
    <div class="box">
     <div class="card-body text-center text-white pt-3">
        <h3>Data Kategori</h3>
      </div>
        <div class="card-body text-center text-white pt-1">
        <i class="fas fa-database fa-7x"></i> 
        </div>
        <div class="card-body text-center text-white pt-1">
            <a href="{{ route('penjual.kategori') }}" target="_blank" class="btn btn-success btn-lg mt-2">
               Lihat Data Kategori
            </a>  
        </div>
    </div>

    <div class="box">
    <div class="card-body text-center text-white pt-3">
          <h3>Data Menu</h3>
        </div>
        <div class="card-body text-center text-white pt-1">
        <i class="fas fa-database fa-7x"></i> 
        </div>
        <div class="card-body text-center text-white pt-1">
            <a href="{{ route('penjual.produk') }} " target="_blank"class="btn btn-success btn-lg mt-2">
               Lihat Data Menu
            </a> 
        </div>
    </div>

  </div>
</div>
    
@endsection








