@extends('layouts.admin')
@section('content')

<div class="container">
    <h4 style="font-weight:bold">Selamat Datang Admin</h4>
        <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modelIdPlus">
        <i class="fas fa-plus mr-1"></i> Registrasi Toko
        </button>
                       
        <!-- Button trigger modal -->
        {{ alertbs_form($errors) }}
        
        <div class="card card-rounded mt-3">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title pt-2"> <i class="fas fa-database me-1"></i> Data Toko</h5>
            </div>
            <div class="card-body">
            
                <div class="row">
                    <div class="col-sm-5 ms-auto">
                        <form method="get" action="">
                            <div class="input-group mb-3">
                                
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive mt-1">
                    <table class="table table-bordered" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>E-Mail Address</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @php $no =1;@endphp
                        @foreach($user as $item)
                        <tbody>
                                <td>{{$no}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                <a href="#modelIdPlus" data-bs-toggle="modal" data-bs-target="#modelIdPlus"
                                class="btn btn-success btn-sm ubah" title="Edit">
                                        <i class="fa fa-edit"></i>  
                                    </a>   
                                <a class="btn btn-danger btn-sm" 
                                        onclick="javascript:return confirm(`Data ingin dihapus ?`);" title="Delete">
                                        <i class="fa fa-times"></i> 
                                    </a>  
                                </td>
                        </tbody>
                        @php $no++;@endphp
                        @endforeach
                    </table>
                </div>
                <br>
                
            </div>
        </div>

        <div class="modal fade" id="modelIdPlus" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Registrasi Toko</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('admin.Buatakun') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                        
                            <div class="form-group mt-1">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" required  name="name"placeholder="">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">E-Mail Address</label>
                                <input type="email" class="form-control" required  name="email"placeholder="">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Password</label>
                                <input type="password" class="form-control" required  name="password"placeholder="">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control" required  name="password"placeholder="">
                            </div>
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Registrasi Toko</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal -->
    <!-- <div class="modal fade" id="modelIdPlus" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrasi Toko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                   
                <div class="card-body">

                <form method="post" action="{{ route('penjual.create_produk') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                 <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-8">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                </div>

                <div class="row mb-3">
                 <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-8">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                </div>

                <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-8">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                </div> -->

                <!-- <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-8">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                </div> -->
<!-- 
                <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                </form>

                </div>
                
                </div>
                
                </div>
                </div>
                </div>
                </div>
                </div>
                <div class="modal fade" id="modelIdEdit" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">        
                <div class="modal-content" id="edit-content">
            </div>
        </div>
    </div> -->

    
@endsection
@section('javascript')
<script>
    // Call the dataTables jQuery plugin
    $('#example1 tbody').on('click', '.ubah', function(){
        var id = $(this).attr('data-id');
        $('#modelIdEdit').modal('show');
        $.ajax({
          
            type: "POST",
            data: { "_token": "{{ csrf_token() }}","id" : id},
            timeout:60000,
            dataType : 'html',
            success:function(html){
                $("#edit-content").html(html);
            }
        });
    });
</script>
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"></script>
    @yield('javascript')

@endsection