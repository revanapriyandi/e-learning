@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            
            <h1>Dashboard</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
            
            
        </div>
        <div class="col-lg-12 col-xl-12">
            
            @if (auth()->user()->role == 'guru')
            <div class="icon-cards-row">
                <div class="glide dashboard-numbers">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <li class="glide__slide">
                                <a href="#" class="card">
                                    <div class="card-body text-center">
                                        <i class="simple-icon-user"></i>
                                        <p class="card-text mb-0">Siswa</p>
                                        <p class="lead text-center">{{ $siswa }}</p>
                                    </div>
                                </a>
                            </li>
                            <li class="glide__slide">
                                <a href="#" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsminds-female-2"></i>
                                        <p class="card-text mb-0">Guru</p>
                                        <p class="lead text-center">{{ $guru }}</p>
                                    </div>
                                </a>
                            </li>
                            <li class="glide__slide">
                                <a href="#" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsminds-arrow-refresh"></i>
                                        <p class="card-text mb-0">Modul</p>
                                        <p class="lead text-center">{{ $modul }}</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card" style="width:100%;">
                <div class="card-body">
                    <h2 class="card-title" style="color: black;">Tambah Materi?</h2>
                    <hr>
                    <p class="card-text">Klik tombol dibawah untuk menambah materi . Materi yang
                        ditambahkan, akan langsung terupload di database Learnify. Dan para siswa bisa
                        segera belajar! </p>
                        <a href="{{ route('modul.create') }}" class="btn btn-primary">Tambah Materi/Tugas ?</a>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-5">
                    <div class="card">
                        <div class="card-body text-center">
                            @php
                            date_default_timezone_set("Asia/Jakarta");
                            
                            $b = time();
                            $hour = date("G",$b);
                            
                            if ($hour>=0 && $hour<=11)
                            {
                                echo '<h5 class="card-title"> Selamat Pagi '.auth()->user()->nama .'</h5>';
                            }
                            elseif ($hour >=12 && $hour<=14)
                            {
                                echo '<h5 class="card-title"> Selamat Siang '.auth()->user()->nama .'</h5>';
                            }
                            elseif ($hour >=15 && $hour<=17)
                            {
                                echo '<h5 class="card-title"> Selamat Sore '.auth()->user()->nama .'</h5>';
                            }
                            elseif ($hour >=17 && $hour<=18)
                            {
                                echo '<h5 class="card-title"> Selamat Petang '.auth()->user()->nama .'</h5>';
                            }
                            elseif ($hour >=19 && $hour<=23)
                            {
                                echo '<h5 class="card-title"> Selamat Malam '.auth()->user()->nama .'</h5>';
                            }
                            @endphp
                            @if (date('D') == 'Sun')
                            <div class="alert alert-info" role="alert">
                                Karna Hari Minggu , kamu ga perlu absen deh <br>
                                Istirahat aja dirumah, Jangan kelayapan :)
                            </div>
                            @else
                                @if ($hour >= 8 && $hour < 10)
                                    @empty($cek)
                                    <p class="mb-0">
                                            @php
                                            $ket = 'hadir';
                                            @endphp
                                            <form action="{{ route('absen.submit',$ket) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-primary mb-1" name="submit" > Hadir</button>
                                            </form>
                                            <button class="btn btn-warning mb-1" type="button" data-toggle="collapse"
                                            data-target="#terlambat" aria-expanded="false"
                                            aria-controls="terlambat">
                                            Terlambat</button>
                                            <button class="btn btn-danger mb-1" type="button" data-toggle="collapse"
                                            data-target="#tidakhadir" aria-expanded="false"
                                            aria-controls="tidakhadir">
                                            Tidak Hadir</button>
                                        </p>
                                    @else
                                    @if (date('Y-m-d',strtotime($cek->created_at)) == date('Y-m-d'))
                                    <div class="alert alert-info" role="alert">
                                        Kamu udah absen hari ini, Tinggal tunggu Konfirmasi dari Guru aja :)
                                    </div>
                                    @else
                                    <p class="mb-0">
                                            @php
                                            $ket = 'hadir';
                                            @endphp
                                            <form action="{{ route('absen.submit',$ket) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-primary mb-1" name="submit" > Hadir</button>
                                            </form>
                                            <button class="btn btn-warning mb-1" type="button" data-toggle="collapse"
                                            data-target="#terlambat" aria-expanded="false"
                                            aria-controls="terlambat">
                                            Terlambat</button>
                                            <button class="btn btn-danger mb-1" type="button" data-toggle="collapse"
                                            data-target="#tidakhadir" aria-expanded="false"
                                            aria-controls="tidakhadir">
                                            Tidak Hadir</button>
                                        </p>
                                    @endif
                                    @endempty
                                    
                                @else
                                <div class="alert alert-primary" role="alert">
                                    Hanya dapat melakukan absen direntang jam 8 sampai jam 10,
                                    Jangan lupa, biar absenmu gak alpha
                                </div>
                                @endif
                            @endif
                            
                            <div class="collapse" id="terlambat">
                                <div class="p-4 border mt-4">
                                    <p class="mb-0">
                                        @php
                                        $ket = 'terlambat'
                                        @endphp
                                        <form action="{{ route('absen.submit',$ket) }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan</label>
                                                <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control" required></textarea>
                                            </div>
                                            <button class="btn btn-primary float-right" type="submit" name="submit">Submit</button>
                                        </form>
                                    </p>
                                </div>
                            </div>
                            <div class="collapse" id="tidakhadir">
                                <div class="p-4 border mt-4">
                                    @php
                                    $ket = 'tidakhadir';
                                    @endphp
                                    <form action="{{ route('absen.submit',$ket) }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control" required></textarea>
                                        </div>
                                        <button class="btn btn-primary float-right" type="submit" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-12 col-md-7 col-lg-7">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="jumbotron">
                                    <h1 class="display-4">Hello, {{ auth()->user()->nama}}</h1>
                                    <p class="">E-Learning adalah suatu cara untuk mengatasi solusi Ketika para siswa sedang prakerin,dan di kondisi lain.
                                        
                                        Dapat memperoleh informasi secara tepat dan cepat..
                                        
                                        Meminalisir waktu dan efisiensi dalam pengajaran</p>
                                        <hr class="my-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endsection
            