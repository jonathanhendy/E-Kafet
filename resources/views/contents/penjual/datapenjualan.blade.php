@extends('layouts.penjual')
@section('content')

    <div class="container">
        <!-- Button trigger modal -->
        {{ alertbs_form($errors) }}
        <div class="card card-rounded mt-2">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title pt-2"><i class="fas fa-database me-1"></i> Data Penjualan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-3">  
                    <table class="table table-bordered"style="text-align: center;" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pemesan</th>
                                <th>Detail Pesanan</th>
                                <th>Harga</th>
                                <th>Tanggal</th>
                            </tr>
                            @php $no =1;@endphp
                            @foreach($nota as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->name}}</td>
                                <td><a href="/penjual/datapenjualan/detailpenjualan/{{$item->id}}" class="btn btn-primary btn-sm">
                                     Lihat
                                    </a>
                                </td>
                                <td>{{$item->total}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr>
                            @php $no++;@endphp
                            @endforeach
                    </td>
                    </table>
                </div>
                <br>
            </div>
        </div>

@endsection
@section('javascript')
@endsection