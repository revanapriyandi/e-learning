@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-datepicker3.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vendor/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vendor/select2-bootstrap.min.css') }}" />
<style>
    .my-custom-scrollbar {
        position: relative;
        height: 200px;
        overflow: auto;
    }
    .table-wrapper-scroll-y {
        display: block;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">
        {{ $error }}
    </div>
    @endforeach
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                    aria-controls="first" aria-selected="true">Profile</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                    aria-controls="second" aria-selected="false">Edit Profile</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
                    aria-controls="third" aria-selected="false">Change Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="four-tab" data-toggle="tab" href="#four" role="tab"
                    aria-controls="four" aria-selected="false">Email</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                    <div class="row">
                        <div class="col-12 mb-5">
                            <img class="social-header card-img" style="height: 200px" src="https://d17ivq9b7rppb3.cloudfront.net/original/commons/academy-bg.jpg" />
                        </div>
                        <div class="col-12 col-lg-5 col-xl-4 col-left">
                            <a href="{{$data->avatar}}" target="__blank" class="lightbox">
                                <img alt="Profile" src="{{$data->avatar}}"
                                class="img-thumbnail card-img social-profile-img">
                            </a>
                            
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="text-center pt-4">
                                        <p class="list-item-heading pt-2">{{$data->nama}}</p>
                                    </div>
                                    <p class="text-muted text-small mb-2">Nis</p>
                                    <p class="mb-3">{{ $data->nis }}</p>
                                    <p class="text-muted text-small mb-2">Email</p>
                                    <p class="mb-3">{{ $data->email }}</p>
                                    @empty (!$data->kelas_id)
                                    <p class="text-muted text-small mb-2">Kelas</p>
                                    <p class="mb-3">{{ $data->kelas->nama_kelas }}</p>
                                    @endempty
                                    <p class="text-muted text-small mb-2">Tempat Lahir</p>
                                    <p class="mb-3">{{ $data->tempat_lahir }}</p>
                                    <p class="text-muted text-small mb-2">Hp/Telepon</p>
                                    <p class="mb-3">{{ $data->telepon }}</p>
                                    <p class="text-muted text-small mb-2">Tanggal Lahir</p>
                                    <p class="mb-3">{{ date('d F Y ',strtotime($data->tgl_lahir)) }}</p>
                                    @empty(!$data->alamat)
                                    <p class="text-muted text-small mb-2">Alamat</p>
                                    <p class="mb-3">{!! $data->alamat !!}</p>
                                    @endempty
                                    {{--  <p class="text-muted text-small mb-2">Responsibilities</p>
                                    <p class="text-muted text-small mb-2">Contact</p>
                                    <div class="social-icons">
                                        <ul class="list-unstyled list-inline">
                                            <li class="list-inline-item">
                                                <a href="#"><i class="simple-icon-social-facebook"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#"><i class="simple-icon-social-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#"><i class="simple-icon-social-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>  --}}
                                </div>
                            </div>
                            
                            {{--  <div class="card mb-4 d-none d-lg-block">
                                <div class="card-body">
                                    <h5 class="card-title"><span>Photos</span><a
                                        class="btn-link float-right text-small pt-1" href="#">View All</a>
                                    </h5>
                                    <div class="row social-image-row gallery">
                                        <div class="col-6">
                                            <a href="img/marble-cake.jpg">
                                                <img class="img-fluid border-radius"
                                                src="img/marble-cake-thumb.jpg" />
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="img/parkin.jpg">
                                                <img class="img-fluid border-radius"
                                                src="img/parkin-thumb.jpg" />
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="img/fruitcake.jpg">
                                                <img class="img-fluid border-radius"
                                                src="img/fruitcake-thumb.jpg" />
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="img/tea-loaf.jpg">
                                                <img class="img-fluid border-radius"
                                                src="img/tea-loaf-thumb.jpg" />
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="img/napoleonshat.jpg">
                                                <img class="img-fluid border-radius"
                                                src="img/napoleonshat-thumb.jpg" />
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="img/magdalena.jpg">
                                                <img class="img-fluid border-radius"
                                                src="img/magdalena-thumb.jpg" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>  --}}
                            
                        </div>
                        <div class="col-12 col-lg-7 col-xl-8 col-right">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 col-sm-3 col-6 mb-3">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="simple-icon-check"></i>
                                            <p class="card-text font-weight-semibold mb-0">Hadir</p>
                                            <p class="lead text-center">{{ $hadir }}</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-3 col-6 mb-3">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-letter-open"></i>
                                            <p class="card-text font-weight-semibold mb-0">Izin</p>
                                            <p class="lead text-center">{{ $izin }}</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-3 col-6 mb-3">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-first-aid"></i>
                                            <p class="card-text font-weight-semibold mb-0">Sakit</p>
                                            <p class="lead text-center">{{ $sakit }}</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-lg-3 col-sm-3 col-6 mb-3">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-close"></i>
                                            <p class="card-text font-weight-semibold mb-0">Alfa</p>
                                            <p class="lead text-center">{{ $alfa }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                        <table class="table table-light">
                                            <thead>
                                                <tr>
                                                    <th>Semester</th>
                                                    <th>Tanggal</th>
                                                    <th>Time in</th>
                                                    <th>Keterangan</th>
                                                    <th>Note</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data->absen as $a)
                                                <tr>
                                                    <td>{{ $a->semester->kode() }}</td>
                                                    <td>{{ date('d F Y ',strtotime($a->created_at)) }}</td>
                                                    <td>{{ date('H:m:s ',strtotime($a->time_in)) }}</td>
                                                    <td>{{ $a->keterangan() }}</td>
                                                    <td>{!! $data->note !!}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                    <div class="row">
                        <div class="col-md-12 col-12 col-lg-12 ">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('siswa.update',$data->username) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label class="control-label " for="image">Avatar</label>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img src="{{ $data->avatar }}" alt="img" class="img-fluid">
                                                </div>
                                                <div class="col-md-10">
                                                    Gambar Profile Anda sebaiknya memiliki rasio 1:1 dan berukuran tidak lebih dari 2MB.<br>
                                                    <div class="input-group mb-3">
                                                        <input readonly id="avatar" type="text" name="avatar" class="form-control" placeholder="" aria-label="">
                                                        <div class="input-group-append">
                                                            <a id="lfm" data-input="avatar" data-preview="holder" class="btn btn-primary" style="color: white">Choose</a>
                                                        </div>
                                                    </div>
                                                    @error('avatar')
                                                    <span style="color:red" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-6 col-lg-6">
                                                <div class="form-group position-relative error-l-50">
                                                    <label>Username</label>
                                                    <input type="text"   class="form-control-plaintext"  value="{{ $data->username }}" readonly>
                                                    <small>Username tidak dapat diubah lagi</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 col-lg-6">
                                                <div class="form-group position-relative error-l-50">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control-plaintext" readonly value="{{ $data->email }}"  >
                                                    <small>Untuk mengubah email silahkak ke tab email</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group position-relative error-l-50">
                                            <label>NIS</label>
                                            <input type="text" class="form-control"  value="{{ $data->nis }}" name="nis" id="nis">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-6 col-lg-6">
                                                <div class="form-group position-relative error-l-50">
                                                    <label>Nama Lengkap</label>
                                                    <input type="nama" class="form-control" required id="nama" name="nama" value="{{ $data->nama }}" >
                                                    
                                                    @error('nama')
                                                    <span style="color:red" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 col-lg-6">
                                                <div class="form-group position-relative error-l-50">
                                                    <label>Kelas</label>
                                                    <select required class="form-control select2" name="kelas_id" id="kelas_id" data-width="100%">
                                                        @foreach ($kelas as $kelas)
                                                        <option value="{{ $kelas->id }}" @if($data->kelas_id == $kelas->id) selected @endif>{{ $kelas->nama_kelas }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kelas_id')
                                                    <span style="color:red" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-6 col-lg-6">
                                                <div class="form-group position-relative error-l-50">
                                                    <label>Hp/Telepon</label>
                                                    <input type="tel" class="form-control phone" required id="telepon" name="telepon" value="{{ $data->telepon }}">
                                                    @error('telepon')
                                                    <span style="color:red" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 col-lg-6">
                                                <div class="form-group position-relative error-l-50">
                                                    <label>Jenis Kelamin</label>
                                                    <select name="jk" id="jk" class="form-control" required>
                                                        <option value="L" @if($data->jk == 'L') selected @endif>Laki-Laki</option>
                                                        <option value="P" @if($data->jk == 'P') selected @endif>Perempuan</option>
                                                    </select>
                                                    @error('jk')
                                                    <span style="color:red" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-6 col-lg-6">
                                                <div class="form-group position-relative error-l-50">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" class="form-control" required id="tempat_lahir" name="tempat_lahir" value="{{ $data->tempat_lahir }}">
                                                    @error('tempat_lahir')
                                                    <span style="color:red" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 col-lg-6">
                                                <div class="form-group position-relative error-l-50">
                                                    <label>Tanggal Lahir</label>
                                                    <input name="tgl_lahir" id="tgl_lahir" class="form-control datepicker" placeholder="25-04-2002" required value="{{ date('d-m-Y',strtotime($data->tgl_lahir)) }}">
                                                    @error('tgl_lahir')
                                                    <span style="color:red" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="10">{!! $data->alamat !!}</textarea>
                                            @error('alamat')
                                            <span style="color:red" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-0 float-right">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Change Password</h4>
                            <hr>
                            <form class="needs-validation"  action="{{ route('siswa.changePassword',$data->username) }}" method="post">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="email">Current Password</label>
                                    <input id="current_password" type="password" class="form-control" name="current_password" tabindex="1" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                                    name="password" tabindex="2" required>
                                    <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input id="confirm-password" type="password" class="form-control" name="confirm-password"
                                    tabindex="2" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Change Password
                                    </button>
                                </div>                           
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="four" role="tabpanel" aria-labelledby="four-tab">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Pengaturan Email</h4>
                            <hr>
                            <form class="needs-validation" novalidate="" action="{{ route('siswa.changeEmail',$data->username) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label" for="">Email Baru</label>
                                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" value="{{ old('email') }}" onblur="duplicateEmail(this)" id="email" required placeholder="Alamat Email">
                                    <span id="error_email"></span>
                                    @error('email')
                                    <span style="color:red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <small class="form-text text-muted"> Ketika Anda mengirim permintaan untuk mengubah Email Anda, {{ config('app.name') }} akan mengirim email verifikasi untuk memvalidasi bahwa Email yang Anda masukkan di atas adalah benar milik Anda. </small>
                                    <small class="form-text text-muted"> Email Anda baru akan berubah ketika Anda sudah menekan link verifikasi yang terdapat di email verifikasi tersebut. </small>
                                </div>
                                <div class="form-group"> 
                                    <button type="submit" id="change" class="btn btn-md btn-primary"> <span> <i class="fa fa-envelope"></i> Ubah Email </span> 
                                    </button> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/vendor/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/vendor/select2.full.js') }}"></script>
<script src="{{ asset('js/cleave.min.js') }}"></script>
<script src="{{ asset('js/cleave-phone.id.js') }}"></script>
<script>
    
    var cleavePN = new Cleave('.phone', {
        phone: true,
        phoneRegionCode: 'id'
    });
    function duplicateEmail(element){
        var email = $(element).val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!filter.test(email))
        {    
            $('#error_email').html('<label class="text-danger">Invalid Email</label>');
            $('#email').addClass('is-invalid');
            $('#simpan').attr('disabled', 'disabled');
        }else{
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url:"{{ route('siswa.email.cek') }}",
                data:{email:email, _token:_token},
                dataType: "json",
                success: function(res) {
                    if(res.exists){
                        $('#error_email').html('<label class="text-danger">Email telah digunakan</label>');
                        $('#change').attr('disabled', true);
                    }else{
                        $('#error_email').html('<label class="text-success">Email dapat digunakan</label>');
                        $('#change').attr('disabled', false);
                    }
                },
                error: function (jqXHR, exception) {
                    
                }
            });
        }
    }
    $(".select2").select2({
        theme: "bootstrap",
        placeholder: "",
    });
    
    var route_prefix = "/filemanager";
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    $('#lfm').filemanager('image', {prefix: route_prefix});
    
    $(".datepicker").datepicker({
        autoclose: true,
        format:'dd-mm-yyyy',
        templates: {
            leftArrow: '<i class="simple-icon-arrow-left"></i>',
            rightArrow: '<i class="simple-icon-arrow-right"></i>'
        }
    });
</script>

@endsection