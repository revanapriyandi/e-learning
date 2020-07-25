@extends('layouts.app')
@section('title','Data Semester')
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
                    <li class="breadcrumb-item active" aria-current="page">Data Semester</li>
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
                    <table id="data-semester" width="100%" class="data-table data-table-feature">
                        <thead>
                            <tr>
                                <th>Semester</th>
                                <th>Tahun Ajaran</th>
                                <th>Status</th>
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
            <form action="{{ route('semester.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group position-relative error-l-50">
                        <label for="name" >Semester</label>
                        <input type="number" id="kode" name="kode" class="form-control" autofocus required>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-6">
                            <div class="form-group position-relative error-l-50">
                                <label for="name" >Tahun Ajaran</label>
                                <input type="text" id="awal" name="awal" class="form-control year" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-6">
                            <div class="form-group position-relative error-l-50">
                                <label for="name" >/</label>
                                <input type="text" id="akhir" name="akhir" class="form-control year" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
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
@section('css')
<link rel="stylesheet" href="{{ asset('css/vendor/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/vendor/select2-bootstrap.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
@endsection
@section('js')
<script src="{{ asset('js/vendor/datatables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script src="{{ asset('js/validator.min.js') }}"></script>
<script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
<script>
    $(".year").datepicker({
        format: "yyyy",
        autoclose: true,
        viewMode: "years", 
        minViewMode: "years"
    });
    function confirmDelete(id) {
        swal({
            title: "Yakin Menghapus data Semester ini ?",
            text: "Semua data yang berhubungan dengan semester ini akan dihapus",
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
    function addForm() {
        save_method = "add";
        $('#action').val("Add");
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').text('Add Semester Baru');
    }
    $(document).ready(function(){
        
        var table = $('#data-semester').DataTable({
            processing: true,
            "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
            serverSide: true,
            ajax: "{{ route('semester.index') }}",
            columns: [
            {data: 'semester', name: 'semester'},
            {data: 'tahun_ajaran', name: 'tahun_ajaran'},
            {data: 'status', name: 'status'},
            {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
            ]
        });
    });
    
</script>

@endsection