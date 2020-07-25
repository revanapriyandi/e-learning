@extends('layouts.app')
@section('title','Data Guru')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>@yield('title')</h1>
            
            <div class="top-right-button-container">
                <div class="btn-group">
                    <button class="btn btn-outline-success btn-lg dropdown-toggle" type="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    EXPORT
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" id="dataTablesExcel" href="#">Excel</a>
                    <a class="dropdown-item" id="dataTablesPrint" href="#">Print</a>
                    <a class="dropdown-item" id="dataTablesPdf" href="#">Pdf</a>
                </div>
                <div class="top-right-button-container">
                    <a href="{{ route('guru.create') }}" class="btn btn-outline-primary btn-lg">
                        TAMBAH DATA</a>
                    </div>
                </div>
                
            </div>
            
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Data Master</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Guru</li>
                </ol>
            </nav>
            <div class="mb-2">
                <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                role="button" aria-expanded="true" aria-controls="displayOptions">
                Display Options
                <i class="simple-icon-arrow-down align-middle"></i>
            </a>
            <div class="collapse dont-collapse-sm" id="displayOptions">
                <div class="d-block d-md-inline-block">
                    <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                        <input class="form-control" placeholder="Search Table" id="searchDatatable">
                    </div>
                </div>
                <div class="float-md-right dropdown-as-select" id="pageCountDatatable">
                    <span class="text-muted text-small">Displaying 1-10 of 40 items </span>
                    <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    10
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">5</a>
                    <a class="dropdown-item active" href="#">10</a>
                    <a class="dropdown-item" href="#">20</a>
                </div>
            </div>
        </div>
    </div>
    <div class="separator"></div>
</div>
</div>

<div class="row">
    <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
        <div class="card">
            <div class="card-body">
                <table id="tableGuru" class="data-table  nowrap"
                data-order="[[ 1, &quot;desc&quot; ]]">
                <thead>
                    <tr>
                        <th class="empty">&nbsp;</th>
                        <th>Nip</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Hp/Telepon</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat/Tgl Lahir</th>
                        <th>Status</th>
                        <th class="empty">&nbsp;</th>
                    </tr>
                </thead>
                <tbody class="list">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
@endsection
@section('js')
<script>
    function confirmDelete(id) {
        swal({
            title: "Yakin Menhapus data ini ?",
            text: "Anda tidak dapat mengembalikan data yang telah di hapus",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(willDelete){
            if (willDelete) {
                $('#data-'+id).submit();
            } else {
                swal("Cancelled Successfully");
            }
        });
    }
    $(document).ready(function(){
        
        var $tableGuru = $("#tableGuru").DataTable({
            bLengthChange: false,
            buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2,3,4, 5,6,7 ]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2,3,4, 5,6,7 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2,3,4, 5,6,7 ]
                }
            },
            ],
            scrollX: true,
            destroy: true,
            info: false,
            sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
            pageLength: 10,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('guru.index') }}",
            },
            columns: [
            { data: 'DT_RowIndex', name:'DT_RowIndex'},
            {data: 'nip', name: 'nip'},
            {data: 'nama', name: 'nama'},
            {data: 'email', name: 'email'},
            {data: 'telepon', name: 'telepon'},
            {data: 'jk', name: 'jk'},
            {data: 'tgl_lahir', name: 'tgl_lahir'},
            {data: 'status', name: 'status'},
            {data: 'aksi', name:'aksi'}
            ],
            language: {
                paginate: {
                    previous: "<i class='simple-icon-arrow-left'></i>",
                    next: "<i class='simple-icon-arrow-right'></i>"
                }
            },
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6]
            },
        });
        
        
        $("#dataTablesExcel").on("click", function (event) {
            event.preventDefault();
            $tableGuru.buttons(1).trigger();
        });
        
        $("#dataTablesPrint").on("click", function (event) {
            event.preventDefault();
            $tableGuru.buttons(0).trigger();
        });
        
        $("#dataTablesPdf").on("click", function (event) {
            event.preventDefault();
            $tableGuru.buttons(2).trigger();
        });
        
        
    });
</script>
@endsection