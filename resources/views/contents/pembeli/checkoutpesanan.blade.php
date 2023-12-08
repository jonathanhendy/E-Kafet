@extends('layouts.pembeli')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Checkout Pesanan</title>
    <style>

    </style>
</head>
<body>

<div class="container">
        <!-- Button trigger modal -->
        {{ alertbs_form($errors) }}
        <div class="card card-rounded mt-2">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title pt-2">Checkout Pesanan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                </div>
                <div class="table-responsive mt-3">  
                    <table class="table table-bordered"style="text-align: center;" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Keterangan</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
								<th>Total</th>
                            </tr>
                            @php $no =1;@endphp
                            @foreach($checkout as $checkout)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$checkout->produk}}</td>
                                <td>{{$checkout->keterangan}}</td>
                                <td>{{$checkout->harga}}</td>
                                <td>{{$checkout->jumlah}}</td>
                                <td>{{$checkout->total}}</td>
                            </tr>
                            @php $no++;@endphp
                            @endforeach
                    	</td>
                    </table>
                    <br>
                    <hr style="height:2px;color:black;">
                    <div class="table-responsive ml-auto">  
                    <table class="table table-striped table-bordered "style="width: 20%;text-align: left;margin-left: 80%;" id="example1">
                        <thead>
                        <tr>
                                <td>Saldo Anda</td>
                                <td>Rp. {{$saldo}}</td>
                            </tr>
                            <tr>
                                <td>Total Pembayaran</td>
                                <td>Rp. {{$total}}</td>
                            </tr>
                    	</td>
                    </table>

	<div class="card-body text-center pt-4">
        @if($saldo < $total)
        <a href="/saldo" target="_blank" class="btn btn-success btn-lg mt-2"
            onclick="javascript:return confirm(`Saldo Anda Kurang, Apakah Anda Ingin Top Up Saldo ?`);" >
           Bayar Pesanan
        </a>
        @else
        <form action="/bayar" method="POST">
        @csrf
        <button type="submit" class="btn btn-success btn-lg mt-2">
        Bayar Pesanan </button>
        </form>
        @endif
    	</div>
    </div>
</div>
</body>
</html>
@endsection