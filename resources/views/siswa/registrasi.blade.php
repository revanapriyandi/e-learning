@extends('layouts.app')
@section('title','Daftar Registrasi Siswa')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>@yield('title')</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Siswa</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Akun</li>
                </ol>
            </nav>
            <div class="mb-2">
                <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                role="button" aria-expanded="true" aria-controls="displayOptions">
                Display Options
                <i class="simple-icon-arrow-down align-middle"></i>
            </a>
        </div>
    </div>
    <div class="separator"></div>
</div>
</div>

<div class="row">
    <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
        <div class="card">
            <div class="card-body">
                <table id="registrasiSiswa" class="data-table  nowrap"
                data-order="[[ 1, &quot;desc&quot; ]]">
                <thead>
                    <tr>
                        <th class="empty">&nbsp;</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Hp/Telepon</th>
                        <th>Jenis Kelamin</th>
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
        
        var $registrasiSiswa = $("#registrasiSiswa").DataTable({
            bLengthChange: false,
            scrollX: true,
            destroy: true,
            info: false,
            sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
            pageLength: 10,
            processing: true,
            serverSide: true,
            ajax: {
                url:"{{ route('registrasi.siswa') }}",
            },
            columns: [
            { data: 'DT_RowIndex', name:'DT_RowIndex'},
            {data: 'nis', name: 'nis'},
            {data: 'nama', name: 'nama'},
            {data: 'email', name: 'email'},
            {data: 'telepon', name: 'telepon'},
            {data: 'jk', name: 'jk'},
            {data: 'aksi', name:'aksi'}
            ],
            language: {
                paginate: {
                    previous: "<i class='simple-icon-arrow-left'></i>",
                    next: "<i class='simple-icon-arrow-right'></i>"
                }
            },
        });
        
        
    });
</script>
@endsection