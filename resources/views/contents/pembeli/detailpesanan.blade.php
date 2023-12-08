@extends('layouts.pembeli')
@section('content')

<div class="container">
        <!-- Button trigger modal -->
        {{ alertbs_form($errors) }}
        <div class="card card-rounded mt-2">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title pt-2"></i>Detail Pesanan Anda</h5>
            </div>
            <div class="card-body">
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
                            @foreach($produk as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->produk}}</td>
                                <td>{{$item->keterangan}}</td>
                                <td>{{$item->harga}}</td>
                                <td>{{$item->jumlah}}</td>
                                <td>{{$item->total}}</td>
                            </tr>
                            @php $no++;@endphp
                            @endforeach
                       
                    	</td>
                    </table>
      </div>
@endsection