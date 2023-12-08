@extends('layouts.pembeli')
@section('content')

<div class="container">
        <!-- Button trigger modal -->
        {{ alertbs_form($errors) }}
        <div class="card card-rounded mt-2">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title pt-2"></i>Pesanan Anda</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-3">  
                    <table class="table table-bordered"style="text-align: center;" id="example1">
                    @php $no =1;@endphp
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Toko</th>
                                <th>Detail Pesanan</th>
                                <th>Total</th>
                                <th>Waktu</th>
                                <th>Status Pesanan</th>
                            </tr>
                            @php $no =1;@endphp
                            @foreach($nota as $item)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                <a href="/viewproduk/{{$item->id}}" class="btn btn-primary btn-sm">
                                     Lihat
                                </a>
                                <td>Rp. {{$item->total}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    @if($item->status_pesanan == 0)
                                    Pesanan Sedang diproses
                                    @else
                                    Pesanan Selesai Siap Diambil
                                    @endif
                                </td>
                            </tr>
                            @php $no++;@endphp
                            @endforeach
                    </table>
                </div>
                <br>
            </div>
        </div>

        <!-- Modal -->

@endsection