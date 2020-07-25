@extends('layouts.app')
@section('title','Presensi Harian Siswa')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>@yield('title')</h1>
            {{--  <div class="top-right-button-container">
                <div class="btn-group">
                    <button class="btn btn-outline-success btn-lg dropdown-toggle" type="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    EXPORT
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="dataTablesCopy" href="#">Copy</a>
                    <a class="dropdown-item" id="dataTablesExcel" href="#">Excel</a>
                    <a class="dropdown-item" id="dataTablesCsv" href="#">Csv</a>
                    <a class="dropdown-item" id="dataTablesPdf" href="#">Pdf</a>
                    <a class="dropdown-item" id="dataTablesPrint" href="#">Pdf</a>
                </div>
            </div>  --}}
            
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
                    <label for="nis">Siswa</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="nis" required class="input-sm form-control" name="nis"
                            placeholder="Nis Siswa" data-toggle="modal" data-target="#myModal" readonly/>
                            <input type="hidden" name="id" id="id">
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="nama" data-toggle="modal" data-target="#myModal" required class="input-sm form-control" name="nama"
                            placeholder="Nama Siswa" readonly/>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="nis">Tanggal</label>
                    <div class="input-daterange input-group" id="datepicker">
                        <input type="text" id="start" autocomplete="off" required class="input-sm form-control" value="{{ date('Y-m-d') }}" name="start"
                        placeholder="Start" />
                        <span class="input-group-addon"></span>
                        <input type="text" autocomplete="off"  required class="input-sm form-control" id="end" value="{{ date('Y-m-d') }}" name="end"
                        placeholder="End" />
                    </div>
                </div>
                <button class="btn btn-primary btn-sm float-right" name="filter" id="filter" type="button">Search</button>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <table id="laporanHarianSiswa" class="text-center data-table responsive nowrap"
                data-order="[[ 1, &quot;desc&quot; ]]">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Time</th>
                        <th>Semester</th>
                        <th>Kelas</th>
                        <th>Hadir</th>
                        <th>Izin</th>
                        <th>Sakit</th>
                        <th>Alpha</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr style="background-color: lightblue">
                        <th colspan="5"><strong>Jumlah :</strong></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $siswa)
                        <tr class="pilih"data-id="{{ $siswa->id }}"  data-nis="{{ $siswa->nis }}" data-nama="{{ $siswa->nama}}" >
                            <td>{{$siswa->nis}}</td>
                            <td>{{$siswa->nama}}</td>
                            <td>{{$siswa->kelas->nama_kelas}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $(document).on('click', '.pilih', function (e) {
            document.getElementById("nis").value = $(this).attr('data-nis');
            document.getElementById("nama").value = $(this).attr('data-nama');
            document.getElementById("id").value = $(this).attr('data-id');
            $('#myModal').modal('hide');
        });
        
        $(function () {
            $("#lookup").dataTable();
        });
        
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
        //jalankan function load_data diawal agar data ter-load
        load_data();
        $('#filter').click(function () {
            var start = $('#start').val(); 
            var end = $('#end').val(); 
            var nis = $('#nis').val(); 
            var nama = $('#nama').val(); 
            var id = $('#id').val(); 
            if (start != '' && end != '' && id != '' && nis != '' && nama != '') {
                $('#laporanHarianSiswa').DataTable().destroy();
                load_data(start, end,id);
            } else {
                swal("Nis Siswa Tidak Boleh Kosong");
            }
        });
        function load_data(start = '', end = '',id='') {
            var dataTablePs;
            var $laporanHarianSiswa = $("#laporanHarianSiswa").DataTable({
                bLengthChange: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('absensi.harian') }}",
                    type: 'GET',
                    data:{start:start, end:end,id:id} 
                },
                columns: [
                { data: 'DT_RowIndex', name:'DT_RowIndex'},
                {data: 'tgl', name: 'tgl'},
                {data: 'time', name: 'time'},
                {data: 'semester', name: 'semester'},
                {data: 'kelas', name: 'kelas'},
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
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
                    
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                        i : 0;
                    };
                    
                    // Total over all pages
                    hadir = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    
                    $( api.column( 5 ).footer() ).html(
                    hadir
                    );
                    izin = api
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    
                    $( api.column( 6 ).footer() ).html(
                    izin
                    );
                    sakit = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    
                    $( api.column( 7 ).footer() ).html(
                    sakit
                    );
                    alpha = api
                    .column( 8 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    
                    $( api.column( 8 ).footer() ).html(
                    alpha
                    );
                }
            });
        }
    });
    
    
    
</script>
@endsection