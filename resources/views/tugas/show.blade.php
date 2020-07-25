@extends('layouts.app')
@section('title','Tugas Masuk')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Tugas {{ $data->pengirim->nama }}</h1>
                <div class="top-right-button-container">
                    <div class="top-right-button-container">
                        <form id="data-{{ $data->id }}" action="{{ route('delete.tugas.siswa',$data->id) }}"   method="post">
                            @csrf
                            @method('delete')</form>
                            <button onclick="confirmDelete({{ $data->id }})" class="btn btn-outline-danger btn-lg">
                                Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                </div>
                <div class="separator mb-5"></div>
                <div class="col-md-12 col-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $data->judul }}</h5>
                            <p class="card-text">{!! $data->catatan !!}</p>
                            @foreach (json_decode($data->file) as $file)
                            
                            @php
                            $formatFile = explode(".",$file);
                            $url = 'storage/files/' . $data->dari . '/' . $file;
                            @endphp
                            <div class="position-relative">
                                <div class="video-view">
                                    @if ($formatFile[1] == 'mp4' || $formatFile[1] == 'mkv')
                                    <video class="player" playsinline controls >
                                        <source src="{{ url($url) }}" type="video/mp4" />
                                    </video>
                                    @elseif($formatFile[1] == 'mp3')
                                    <audio class="player" controls>
                                        <source src="{{ url($url) }}" type="audio/mp3" />
                                    </audio>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="d-flex flex-row mb-4 media-thumb-container">
                                <a class="d-flex align-self-center media-thumbnail-icon"
                                href="{{ route('download.tugas.siswa',[$data->id,$file]) }}">
                                <i class="iconsminds-folder-open"></i>
                            </a>
                            <div class="pl-3">
                                <a href="{{ route('download.tugas.siswa',[$data->id,$file]) }}">
                                    <p class="font-weight-medium mb-2">{{ $file }}</p>
                                    <p class="text-muted mb-0 text-small">{{ date('d F Y',strtotime($data->created_at)) }} - {{ date('H:m',strtotime($data->created_at)) }}</p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/plyr/plyr.css') }}" />
@endsection
@section('js')
<script src="{{ asset('vendor/plyr/plyr.js') }}"></script>
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
    const players = Plyr.setup('.player');
</script>
@endsection