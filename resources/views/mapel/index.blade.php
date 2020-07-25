@extends('layouts.app')
@section('title','Data Matapelajaran')
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
                <li class="breadcrumb-item active" aria-current="page">Data Matapelajaran</li>
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
                <table id="data-mapel" width="100%" class="data-table data-table-feature">
                    <thead>
                        <tr>
                            <th class="empty">&nbsp;</th>
                            <th>Nama Mapel</th>
                            <th>Guru Mapel</th>
                            <th>Kelas</th>
                            <th>Deskripsi</th>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('mapel.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="nama">Nama Mapel</label>
                        <input id="nama" class="form-control" value="{{ old('nama') }}" required type="text" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="pengajar">Pengajar</label>
                        <select name="pengajar" id="pengajar" required class="form-control select2">
                            @foreach ($pengajar as $p)
                                <option value="{{ $p->id }}" @if(old('pengajar') == $p->id) selected @endif>{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" required class="form-control select2">
                            @foreach ($kelas as $p)
                                <option value="{{ $p->id }}"  @if(old('kelas') == $p->id) selected @endif>{{ $p->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskrisi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="10">{{ old('deskrisi') }}</textarea>
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
    var table = $('#data-mapel').DataTable({
        processing: true,
        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        serverSide: true,
        ajax: "{{ route('mapel.index') }}",
        columns: [
        { data: 'DT_RowIndex', name:'DT_RowIndex'},
        {data: 'nama', name: 'nama'},
        {data: 'guru', name: 'guru'},
        {data: 'kelas', name: 'kelas'},
        {data: 'deskripsi', name: 'deskripsi'},
        {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
        ]
    });
    
</script>

@endsection