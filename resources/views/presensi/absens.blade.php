@extends('layouts.app')
@section('title','Absensi')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>@yield('title')</h1>
            <div class="top-right-button-container">
                <h1 class="jam" id="jam"></h1> <h1>Wib</h1>
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Absensi Siswa</a>
                    </li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
        <div class="col-lg-12 col-xl-6">
            <div class="row">
                <div class="col-md-12 mb-4">
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
            </div>
            <div class="icon-cards-row">
                <div class="glide dashboard-numbers">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <li class="glide__slide">
                                <a href="#" class="card">
                                    <div class="card-body text-center">
                                        <i class="simple-icon-check"></i>
                                        <p class="card-text mb-0">Hadir</p>
                                        <p class="lead text-center">{{ $hadir }}</p>
                                    </div>
                                </a>
                            </li>
                            <li class="glide__slide">
                                <a href="#" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsminds-letter-open"></i>
                                        <p class="card-text mb-0">Izin</p>
                                        <p class="lead text-center">{{ $izin }}</p>
                                    </div>
                                </a>
                            </li>
                            <li class="glide__slide">
                                <a href="#" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsminds-first-aid"></i>
                                        <p class="card-text mb-0">Sakit</p>
                                        <p class="lead text-center">{{ $sakit }}</p>
                                    </div>
                                </a>
                            </li>
                            <li class="glide__slide">
                                <a href="#" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsminds-close"></i>
                                        <p class="card-text mb-0">Alpha</p>
                                        <p class="lead text-center">{{ $alpha }}</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Calendar</h5>
                    <div class="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/vendor/fullcalendar.min.css') }}" />
    @endsection
    @section('js')
    <script src="{{ asset('js/vendor/fullcalendar.min.js') }}"></script>
    <script>
        function startTime() {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('jam').innerHTML = h+":"+m+":"+s;
            var t = setTimeout(function(){startTime()},500);
        }
        
        function checkTime(i) {
            if (i<10) {i = "0" + i}; 
            return i;
        }
        
        var testEvent = new Date(new Date().setHours(new Date().getHours()));
        var day = testEvent.getDate();
        var month = testEvent.getMonth() + 1;
        $(".calendar").fullCalendar({
            themeSystem: "bootstrap4",
            weekends: true,
            height: "auto",
            isRTL: false,
            buttonText: {
                today: "Today",
                month: "Month",
                week: "Week",
                day: "Day",
                list: "List"
            },
            bootstrapFontAwesome: {
                prev: " simple-icon-arrow-left",
                next: " simple-icon-arrow-right",
                prevYear: " simple-icon-control-start",
                nextYear: " simple-icon-control-end"
            },
            events: [{
                title: "Account",
                start: "2018-05-18"
            },
            {
                title: "Delivery",
                start: "2019-07-22",
                end: "2019-07-24"
            },
            {
                title: "Conference",
                start: "2019-06-07",
                end: "2019-06-09"
            },
            {
                title: "Delivery",
                start: "2019-09-03",
                end: "2019-09-06"
            },
            {
                title: "Meeting",
                start: "2019-06-17",
                end: "2019-06-18"
            },
            {
                title: "Taxes",
                start: "2019-08-07",
                end: "2019-08-09"
            }
            ]
        });
    </script>
    @endsection
    