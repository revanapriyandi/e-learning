<!DOCTYPE html>
<html lang="en">
<head>
    @section('title','Masuk')
    @include('layouts.include.head')
    @notifyCss
</head>
<body class="background show-spinner no-footer">
    @php
    foreach ($errors->all() as $error){
        notify()->error($error);
    }
    @endphp
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-sm-8 col-md-10 mx-auto my-auto">
                    <div class="card index-card">
                        <div class="card-body text-center form-side">
                            <form action="{{ route('register') }}" method="POST" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-6 col-lg-6">
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
                                    <div class="col-md-6 col-6 col-lg-6">
                                        
                                        <div class="form-group position-relative error-l-50">
                                            <label>NIS</label>
                                            <input type="text" required  class="form-control"  value="{{ old('nis') }}" onblur="duplicateNis(this)" name="nis" id="nis">
                                            <span id="error_nis"></span>
                                            @error('nis')
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
                                            @error('password')
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
                                
                                <div class="form-group position-relative error-l-50">
                                    <label>Kelas</label>
                                    <select required class="form-control select2" name="kelas_id" id="kelas_id" data-width="100%">
                                        @foreach ($kelas as $kelas)
                                        <option value="{{ $kelas->id }}" @if(old('kelas_id') == $kelas->id) selected @endif>{{ $kelas->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                    <span style="color:red" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
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
                                
                                <button type="submit" id="simpan" name="simpan" class="btn btn-primary mb-0 float-right">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('notify::messages')
    @notifyJs
    @include('layouts.include.script')
    
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
            
        });
        var route_prefix = "/filemanager";
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
        $('#lfm').filemanager('image', {prefix: route_prefix});
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
        function duplicateNis(element){
            var nis = $(element).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url:"{{ route('siswa.nis.cek') }}",
                data:{nis:nis, _token:_token},
                dataType: "json",
                success: function(res) {
                    if(res.exists){
                        $('#error_nis').html('<label class="text-danger">Nis telah terdaftar</label>');
                        $('#simpan').attr('disabled', true);
                    }else{
                        $('#error_nis').html('');
                        $('#simpan').attr('disabled', false);
                    }
                },
                error: function (jqXHR, exception) {
                    
                }
            });
        }
    </script>
</body>
</html>