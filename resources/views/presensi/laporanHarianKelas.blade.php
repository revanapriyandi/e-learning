@extends('layouts.app')
@section('title','Presensi Harian Kelas')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>@yield('title')</h1>
            <div class="top-right-button-container">
                <div class="btn-group">
                    
                    {{--  <div class="btn-group">
                        <button class="btn btn-outline-success btn-lg dropdown-toggle" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        EXPORT
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" id="dataTablesPrint" href="#">Print</a>
                        <a class="dropdown-item" id="dataTablesExcel" href="#">Excel</a>
                        <a class="dropdown-item" id="dataTablesPdf" href="#">Pdf</a>
                    </div>  --}}
                </div>
                
            </div>
        </div>
        
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb pt-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('absensi.index') }}">Presensi</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>
        
        <div class="separator mb-5"></div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="semester_id">Semester</label>
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control select2" name="semester_id" data-width="100%" id="semester_id" >
                                @foreach ($semester as $s)
                                <option value="{{ $s->id}}">Semester {{ $s->kode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control select2" name="kelas_id" data-width="100%" id="kelas_id">
                                @foreach ($kelas as $k)
                                <option value="{{ $k->id}}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="nis">Tanggal</label>
                    <div class="input-daterange input-group" id="datepicker">
                        <select class="form-control select2" name="range" data-width="100%" id="range">
                            <option value="day">Hari Ini</option>
                            <option value="week">Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
                            <option value="year">Tahun Ini</option>
                        </select>
                        {{--  <input type="text" id="start" autocomplete="off" required class="input-sm form-control" value="{{ date('Y-m-d') }}" name="start"
                        placeholder="Start" />  --}}
                        {{--  <span class="input-group-addon"></span>
                        <input type="text" autocomplete="off"  required class="input-sm form-control" id="end" value="{{ date('Y-m-d') }}" name="tgl_akhir"
                        placeholder="End" />  --}}
                    </div>
                </div>
                <button class="btn btn-primary btn-sm float-right" name="filter" id="filter" type="button">Search</button>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body" id="HarianKelas">
                <table id="laporanHarianKelas" class="text-center data-table responsive nowrap"
                data-order="[[ 1, &quot;desc&quot; ]]">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Hadir</th>
                        <th>Izin</th>
                        <th>Sakit</th>
                        <th>Alpha</th>
                        <th width="15%">Keterangan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>

@endsection
@section('js')
<script>
    $(".input-daterange").datepicker({
        autoclose: true,
        rtl: false,
        format: 'yyyy-mm-dd',
        templates: {
            leftArrow: '<i class="simple-icon-arrow-left"></i>',
            rightArrow: '<i class="simple-icon-arrow-right"></i>'
        }
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    load_data();
    $('#filter').click(function () {
        //var start = $('#start').val(); 
        //var end = $('#end').val(); 
        var range = $('#range').val();
        var semester_id = $('#semester_id').val(); 
        var kelas_id = $('#kelas_id').val(); 
        if (semester_id != '' && kelas_id != '' && range != '' ) {
            $('#laporanHarianSiswa').DataTable().destroy();
            load_data(semester_id, kelas_id,range);
        } else {
            swal("Data Semester Tidak Boleh Kosong");
        }
    });
    function load_data(semester_id = '', kelas_id = '',range='') {
        var dataTablePs;
        
        var $laporanHarianKelas = $("#laporanHarianKelas").DataTable({
            bLengthChange: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('absensi.kelas.harian') }}",
                type: 'GET',
                data:{semester_id:semester_id, kelas_id:kelas_id,range:range} 
            },
            columns: [
            { data: 'DT_RowIndex', name:'DT_RowIndex'},
            {data: 'tgl', name: 'tgl'},
            {data: 'nis', name: 'nis'},
            {data: 'nama', name: 'nama'},
            {data: 'hadir', name: 'hadir'},
            {data: 'izin', name: 'izin'},
            {data: 'sakit', name: 'sakit'},
            {data: 'alpha', name: 'alpha'},
            {data: 'note', name: 'note'},
            ],
            searching: true,
            scrollX: true,
            destroy: true,
            info: false,
            paging: false,
            sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
            responsive: !0,
            deferRender: !0,
            scrollY: "calc(100vh - 400px)",
            scrollCollapse: !0,
            "fnInitComplete": function () {
                dataTablePs = new PerfectScrollbar('.dataTables_scrollBody', {
                    suppressScrollX: true
                });
                dataTablePs.isRtl = false;
            },
            "fnDrawCallback": function (oSettings) {
                dataTablePs = new PerfectScrollbar('.dataTables_scrollBody', {
                    suppressScrollX: true
                });
                dataTablePs.isRtl = false;
            },
            
        });
    }
    
</script>
@endsection