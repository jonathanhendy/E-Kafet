@extends('layouts.pembeli')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Keranjang</title>
</head>
<body>

<div class="container">
        <!-- Button trigger modal -->
        {{ alertbs_form($errors) }}
        <div class="card card-rounded mt-2">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title pt-2">Keranjang</h5>
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
								<th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                            @php $no =1;@endphp
                            @foreach($checkout as $checkout)
                        <tbody> 
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$checkout->produk}}</td>
                                <td>{{$checkout->keterangan}}</td>
                                <td>{{$checkout->harga}}</td>
                                <td>{{$checkout->jumlah}}</td>
                                <td>{{$checkout->total}}</td>
                                <td>
                                <a href="{{url("hapuspesanan/$checkout->id")}}"
                                    class="btn btn-danger btn-sm" 
                                    onclick="javascript:return confirm(`Apakah Anda Ingin Batalkan Pesanan ?`);" 
                                    title="Delete">
                                    <i class="fa fa-times"></i> 
                                </a>
                                </td>
                            </tr>
                        </tbody>
                            @php $no++;@endphp
                            @endforeach
                    </table>
                </div>
	<div class="card-body text-center pt-6">
        <a href="{{ route('pembeli.checkoutpesanan') }}" target="_blank" class="btn btn-success btn-lg mt-2">
            Checkout Pesanan
        </a>  
    	</div>

    </div>
</div>
</body>
</html>
@endsection

