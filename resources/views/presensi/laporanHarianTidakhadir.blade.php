@extends('layouts.app')
@section('title','Laporan Harian Data Siswa yang Tidak Hadir')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>@yield('title')</h1>
            
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
                    <label for="nis">Semester</label>
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
                <button class="btn btn-primary btn-sm float-right" name="filter" id="filter" type="button">Search</button>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <table id="tableDataSiswaTidakHadir" class="text-center data-table responsive nowrap"
                data-order="[[ 1, &quot;desc&quot; ]]">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tanggal</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Data</th>
                        <th>Hadir</th>
                        <th>Izin</th>
                        <th>Sakit</th>
                        <th>Alpha</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</div>
</div>

@endsection
@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    load_data();
    $('#filter').click(function () {
        var semester_id = $('#semester_id').val(); 
        var kelas_id = $('#kelas_id').val(); 
        if (semester_id != '' && kelas_id != ''  ) {
            $('#tableDataSiswaTidakHadir').DataTable().destroy();
            load_data(semester_id, kelas_id);
        } else {
            swal("Data Semester Tidak Boleh Kosong");
        }
    });
    function load_data(semester_id = '', kelas_id = '') {
        var dataTablePs;
        
        $("#tableDataSiswaTidakHadir").DataTable({
            bLengthChange: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('absensi.tidakhadir.harian') }}",
                type: 'GET',
                data:{semester_id:semester_id, kelas_id:kelas_id} 
            },
            columns: [
            { data: 'id', name:'id'},
            { data: 'tgl', name:'tgl'},
            {data: 'nis', name: 'nis'},
            {data: 'nama', name: 'nama'},
            {data: 'kelas', name: 'kelas'},
            {data: 'dataSiswa', name: 'dataSiswa'},
            {data: 'hadir', name: 'hadir'},
            {data: 'izin', name: 'izin'},
            {data: 'sakit', name: 'sakit'},
            {data: 'alpha', name: 'alpha'},
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
