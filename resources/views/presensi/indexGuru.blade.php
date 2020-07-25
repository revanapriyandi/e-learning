@extends('layouts.app')
@section('title','Presensi Harian')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>@yield('title')</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Presensi</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
        <div class="col-lg-12 col-xl-12 ">
            <div class="icon-cards-row">
                <div class="glide dashboard-numbers">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <li class="glide__slide">
                                <a href="{{ route('absensi.harian') }}" class="card">
                                    <div class="card-body text-center">
                                        <i class="simple-icon-user-following"></i>
                                        <p class="card-text mb-0">Laporan Presensi Harian Siswa</p>
                                    </div>
                                </a>
                            </li>
                            <li class="glide__slide">
                                <a href="{{ route('absensi.kelas.harian') }}" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsminds-check"></i>
                                        <p class="card-text mb-0">Laporan Presensi Harian per Kelas</p>
                                    </div>
                                </a>
                            </li>
                            <li class="glide__slide">
                                <a href="{{ route('absensi.tidakhadir.harian') }}" class="card">
                                    <div class="card-body text-center">
                                        <i class="simple-icon-user-unfollow"></i>
                                        <p class="card-text mb-0">Laporan Harian Data Siswa yang Tidak Hadir</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12 col-12 mb-4 data-table-rows data-tables-hide-filter">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data  Absensi Siswa Default {{ auth()->user()->kelasku->nama_kelas }}</h5>
                    <div class="col-md-4 col-xl-4 col-4 float-right m-md-4">
                        <form action="{{ route('absensi.index') }}" method="get">
                            <div class="row">
                                <div class="col-md-8 col-8">
                                    <select name="kelas" data-placeholder="{{ auth()->user()->kelasku->nama_kelas }}" id="kelas" class="form-control kelas" data-width="100%">
                                        <option value=""></option>
                                        @foreach ($kelas as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 col-4">
                                    <button type="submit" value="cari" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-light  data-table  "
                        data-order="[[ 1, &quot;desc&quot; ]]" id="absensiSiswa">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Nama</td>
                                <td>Kelas</td>
                                <td>Keterangan</td>
                                <td>Alasan</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($data as $data)
                            @if (date('Y-m-d',strtotime($data->created_at)) == date('Y-m-d'))
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->user->nama }}</td>
                                <td>{{ $data->kelas->nama_kelas }}</td>
                                <td><a href="#" class="keterangan" data-type="select" data-pk="{{ $data->id }}" data-url="{{ route('absensiPending.edit',$data->id) }}" data-title="Keterangan" ></a></td>
                                <td>{{ $data->note }}</td>
                                <td>
                                    <form id="data-{{ $data->id }}" action="{{ route('absenPending.konfirmasi',$data->id) }}"   method="post">
                                        @csrf</form>
                                        <button onclick="KonfirmasiA({{ $data->id }})" class="btn btn-primary btn-sm">
                                            Konfirmasi</button>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="ket" id="ket" value="{{ $data->keterangan}}"
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('css')
    <link href="{{ asset('vendor/bootstrap4-editable/css/bootstrap-editable.css') }}" rel="stylesheet">
    @endsection
    @section('js')
    <script src="{{ asset('vendor/bootstrap4-editable/js/bootstrap-editable.js') }}"></script>
    <script src="{{ asset('js/vendor/glide.min.js') }}"></script>
    <script>
        function KonfirmasiA(id) {
            swal({
                title: "Warning",
                text: "Konfirmasi absen siswa ini ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            },
            function(konfirm){
                if (konfirm) {
                    $('#data-'+id).submit();
                } else {
                    swal("Cancelled Successfully");
                }
            });
        }
        
        $(function(){
            $('.kelas').select2({
                theme: "bootstrap",
            });
            $('.keterangan').editable({
                value: $('#ket').val(), 
                source: [
                {value: 1, text: 'Hadir'},
                {value: 2, text: 'Izin'},
                {value: 3, text: 'Sakit'},
                {value: 4, text: 'Tanpa Keterangan'},
                ]
            });
        });
        $(document).ready(function () {
            $("#absensiSiswa").dataTable({
                scrollX: true,
                destroy: true,
                info: false,
                sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
                pageLength: 10,
                language: {
                    paginate: {
                        previous: "<i class='simple-icon-arrow-left'></i>",
                        next: "<i class='simple-icon-arrow-right'></i>"
                    }
                },
            });
        })
    </script>
    @endsection