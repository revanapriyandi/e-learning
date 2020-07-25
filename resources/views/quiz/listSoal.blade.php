@extends('layouts.app')
@section('title','List Soal Pilihan Ganda')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>List Soal {{ $data->judul }}</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('soal.pilGanda',[$data->id,$data->judul]) }}" class="btn btn-primary float-right m-md-3">Tambah Soal</a>
                <table id="listSoalPilG" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="empty">&nbsp;</th>
                            <th>Pertanyaan</th>
                            <th class="empty">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody >
                        @php
                        $no =1;
                        @endphp
                        @foreach ($data->pilihanG as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{!! $item->pertanyaan !!}</td>
                            <td>
                                <a href="{{ route('soal.pilGanda.edit',[$item->id,$data->judul]) }}" class="btn btn-warning btn-xs">Edit</a>
                                <form id="data-{{ $item->id }}" action="{{ route('soal.pilGanda.delete',$item->id) }}"   method="post">
                                    @csrf
                                    @method('delete')</form>
                                    <button onclick="confirmDelete({{ $item->id }})" class="btn btn-danger btn-xs">
                                    Delete</button>
                            </td>
                        </tr>
                        @endforeach
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
    $('#listSoalPilG').DataTable({
        
    });
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
</script>
@endsection