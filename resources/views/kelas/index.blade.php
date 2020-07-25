@extends('layouts.app')
@section('title','Data Kelas')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>@yield('title')</h1>
            
            <div class="top-right-button-container">
                <div class="top-right-button-container">
                    <a data-toggle="modal"
                    data-target="#exampleModal" type="button" class="btn btn-outline-primary btn-lg">
                    TAMBAH DATA</a>
                </div>
            </div>
            
        </div>
        
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb pt-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
            </ol>
        </nav>
        <div class="mb-2">
            <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
            role="button" aria-expanded="true" aria-controls="displayOptions">
            Display Options
            <i class="simple-icon-arrow-down align-middle"></i>
        </a>
    </div>
    <div class="separator"></div>
</div>

<div class="row">
    <div class="col-12 mb-4 data-table-rows data-tables-hide-filter">
        <div class="card">
            <div class="card-body">
                <table id="data-kelas" width="100%" class="data-table data-table-feature">
                    <thead>
                        <tr>
                            <th class="empty">&nbsp;</th>
                            <th>Nama Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Ketua Kelas</th>
                            <th class="empty">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kelas.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input id="nama_kelas" class="form-control" type="text" name="nama_kelas">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/validator.min.js') }}"></script>
<script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
<script>
    function confirmDelete(id) {
        swal({
            title: "Yakin Menghapus data ini ?",
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
    var table = $('#data-kelas').DataTable({
        processing: true,
        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        serverSide: true,
        ajax: "{{ route('kelas.index') }}",
        columns: [
        { data: 'DT_RowIndex', name:'DT_RowIndex'},
        {data: 'nama_kelas', name: 'nama_kelas'},
        {data: 'walikelas', name: 'walikelas'},
        {data: 'ketuakelas', name: 'ketuakelas'},
        {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
        ]
    });
    
</script>

@endsection