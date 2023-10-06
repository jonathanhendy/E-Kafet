@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="card bg-primary text-white card-rounded">
            <div class="card-body text-center pt-4">
                <h4 class="card-title">
                    <b><i class="fas fa-check me-1"></i></b> 
                    Selamat Datang Admin, <b>{{ auth()->user()->name }}</b>
                </h4>
                <a href="{{ route('home.index') }}" target="_blank" class="btn btn-success btn-lg mt-2">
                    <i class="fas fa-home me-2"></i> Lihat Website
                </a>  
            </div>
        </div>
         
    </div></p>



    
    <div class="container">
        <div class="card bg-primary text-white card-rounded">
            <div class="card-body text-center pt-4">
                <h4 class="card-title">
                    <b><i class="fas fa-check me-1"></i></b> 
                    Data Kategori
                </h4>
                <a href="{{ route('admin.kategori') }}" target="_blank" class="btn btn-success btn-lg mt-2">
                    <i class="fas fa-rocket me-2"></i> Lihat Data Kategori
                </a>  
            </div>
        </div>
         
    </div></p>

    <div class="container">
        <div class="card bg-primary text-white card-rounded">
            <div class="card-body text-center pt-4">
                <h4 class="card-title">
                    <b><i class="fas fa-check me-1"></i></b> 
                    Data Produk
                </h4>
                <a href="{{ route('admin.produk') }} " target="_blank"class="btn btn-success btn-lg mt-2">
                    <i class="fas fa-rocket me-2"></i> Lihat Data Produk
                </a>  
                

            </div>
        </div>
         
    </div>


    

    
@endsection








