@extends('layouts.app')
@section('title','Create Data Guru')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-12 col-lg-12 ">
            <div class="card">
                <div class="card-body">
                    <div action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label " for="image">Avatar</label>
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
                        
                        <div class="row">
                            <div class="col-md-12 col-12 col-lg-12">
                                <div class="form-group position-relative error-l-50">
                                    <label>Nama Lengkap</label>
                                    <input type="nama" class="form-control" required id="nama" name="nama" value="{{ old('nama') }}" >
                                    
                                    @error('nama')
                                    <span style="color:red" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative error-l-50">
                            <label>NIP</label>
                            <input type="text" required  class="form-control"  value="{{ old('nip') }}" onblur="duplicateNip(this)" name="nip" id="nip">
                            <span id="error_nip"></span>
                            @error('nip')
                            <span style="color:red" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6 col-lg-6">
                                <div class="form-group position-relative error-l-50">
                                    <label>Username</label>
                                    <input type="text" required  class="form-control"  value="{{ old('username') }}" onblur="duplicateUsername(this)" name="username" id="username">
                                    <span id="error_username"></span>
                                    @error('username')
                                    <span style="color:red" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-6 col-lg-6">
                                <div class="form-group position-relative error-l-50">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="{{ old('email') }}" required name="email" id="email" onblur="duplicateEmail(this)" >
                                    <span id="error_email"></span>
                                    @error('email')
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
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <span id="error_username"></span>
                                    @error('username')
                                    <span style="color:red" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-6 col-lg-6">
                                <div class="form-group position-relative error-l-50">
                                    <label>Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6 col-lg-6">
                                <div class="form-group position-relative error-l-50">
                                    <label>Hp/Telepon</label>
                                    <input type="tel" class="form-control phone" required id="telepon" name="telepon" value="{{ old('telepon') }}">
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
                                        <option value="L" @if(old('jk') == 'L') selected @endif>Laki-Laki</option>
                                        <option value="P" @if(old('jk') == 'P') selected @endif>Perempuan</option>
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
                                    <input type="text" class="form-control" required id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
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
                                    <input name="tgl_lahir" id="tgl_lahir" class="form-control datepicker" placeholder="25-04-2002" required value="{{ date('d-m-Y',strtotime(old('tgl_lahir'))) }}">
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
                            <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="10">{!! old('alamat') !!}</textarea>
                            @error('alamat')
                            <span style="color:red" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        
                        <button type="submit" id="simpan" name="simpan" class="btn btn-primary mb-0 float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/cleave.min.js') }}"></script>
<script src="{{ asset('js/cleave-phone.id.js') }}"></script>
<script>
    var cleavePN = new Cleave('.phone', {
        phone: true,
        phoneRegionCode: 'id'
    });
    $(".datepicker").datepicker({
        autoclose: true,
        format:'dd-mm-yyyy',
        templates: {
            leftArrow: '<i class="simple-icon-arrow-left"></i>',
            rightArrow: '<i class="simple-icon-arrow-right"></i>'
        }
    });
    var route_prefix = "/filemanager";
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    $('#lfm').filemanager('image', {prefix: route_prefix});
    function duplicateEmail(element){
        var email = $(element).val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!filter.test(email))
        {    
            $('#error_email').html('<label class="text-danger">Invalid Format Email</label>');
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
                        $('#simpan').attr('disabled', true);
                    }else{
                        $('#error_email').html('');
                        $('#simpan').attr('disabled', false);
                    }
                },
                error: function (jqXHR, exception) {
                    
                }
            });
        }
    }
    function duplicateUsername(element){
        var username = $(element).val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url:"{{ route('siswa.username.cek') }}",
            data:{username:username, _token:_token},
            dataType: "json",
            success: function(res) {
                if(res.exists){
                    $('#error_username').html('<label class="text-danger">Username telah digunakan</label>');
                    $('#simpan').attr('disabled', true);
                }else{
                    $('#error_username').html('');
                    $('#simpan').attr('disabled', false);
                }
            },
            error: function (jqXHR, exception) {
                
            }
        });
    }
    function duplicateNip(element){
        var nip = $(element).val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url:"{{ route('guru.nip.cek') }}",
            data:{nip:nip, _token:_token},
            dataType: "json",
            success: function(res) {
                if(res.exists){
                    $('#error_nip').html('<label class="text-danger">Nip telah terdaftar</label>');
                    $('#simpan').attr('disabled', true);
                }else{
                    $('#error_nip').html('');
                    $('#simpan').attr('disabled', false);
                }
            },
            error: function (jqXHR, exception) {
                
            }
        });
    }
</script>
@endsection