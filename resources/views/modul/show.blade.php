@extends('layouts.app')
@section('title','Detail Modul Pembelajaran')
@section('content')
<div class="container-fluid">
    <div class="row app-row">
        <div class="col-12" data-check-all="checkAll">
            <div class="mb-2">
                <h1>
                    <i class="simple-icon-refresh heading-icon"></i>
                    <span class="align-middle d-inline-block pt-1 truncate">{{$data->judul}}</span>
                </h1>
                <div class="float-md-right">
                    @if (auth()->user()->role == 'guru')
                    <button type="button"
                    class="btn btn-lg btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ACTIONS
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('modul.edit',$data->id) }}">Edit</a>
                    <a class="dropdown-item" onclick="confirmDelete({{ $data->id }});">Delete</a>
                    <form id="data-{{ $data->id }}" action="{{ route('modul.destroy',$data->id) }}"  method="post">
                        @csrf
                        @method('delete')
                    </form>
                </div>
                @endif
            </div>
        </div>
        
        
        
        <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                aria-controls="first" aria-selected="true">DETAILS</a>
            </li>
            
        </ul>
        <div class="tab-content mb-4">
            <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                <div class="row">
                    <div class="col-lg-4 col-12 mb-4">
                        <div class="card mb-4">
                            <div class="position-absolute card-top-buttons">
                                <button class="btn btn-header-light icon-button">
                                    <i class="simple-icon-pencil"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <p class="list-item-heading mb-4">Summary</p>
                                <p class="text-muted text-small mb-2">Info</p>
                                <p class="mb-3 read-more">
                                    @foreach (json_decode($data->file) as $file)
                                    <div class="d-flex flex-row mb-4 media-thumb-container">
                                        <a class="d-flex align-self-center media-thumbnail-icon"
                                        href="{{ route('modul.fileDownload',[$data->user_id,$data->id,$file]) }}">
                                        <i class="iconsminds-folder-open"></i>
                                    </a>
                                    <div class="pl-3">
                                        <a href="{{ route('modul.fileDownload',[$data->user_id,$data->id,$file]) }}">
                                            <p class="font-weight-medium mb-2">{{ $file }}</p>
                                            <p class="text-muted mb-0 text-small">{{ date('d F Y',strtotime($data->created_at)) }} - {{ date('H:m',strtotime($data->created_at)) }}</p>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </p>
                            
                            <p class="text-muted text-small mb-2">Date</p>
                            <p class="mb-3">
                                {{ date('d F Y ',strtotime($data->created_at)) }}
                            </p>
                            <p class="text-muted text-small mb-2">Dibagikan Untuk</p>
                            <div class="mb-3">
                                <p class="d-sm-inline-block mb-1">
                                    <a href="#">
                                       @empty($data->kelas)
                                        <span
                                        class="badge badge-pill badge-outline-theme-3 mb-1">{{ $data->pembagian() }}</span>
                                        @endempty
                                    </a>
                                </p>
                            </div>
                            <p class="text-muted text-small mb-2">Mata Pelajaran</p>
                            <div>
                                <p class="d-sm-inline-block mb-1">
                                    <a href="#">
                                        <span
                                        class="badge badge-pill badge-outline-theme-3 mb-1">{{ $data->user->mapel->nama }}</span>
                                    </a>
                                </p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Diunduh Oleh</h6>
                            <div role="progressbar" class="progress-bar-circle position-relative"
                            data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="{{ $siswa }}"
                            aria-valuenow="{{ $diunduh }}" data-show-percent="true">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="position-absolute card-top-buttons">
                        <button class="btn btn-header-light icon-button">
                            <i class="simple-icon-refresh"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <p class="list-item-heading mb-4">Modul Pembelajaran</p>
                        
                        {!! $data->deskripsi !!}
                        <br>
                        @foreach (json_decode($data->file) as $file)
                        
                        @php
                        $formatFile = explode(".",$file);
                        $url = 'storage/files/' . $data->user_id . '/' . $file;
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
                        @endforeach
                        @empty(!$data->links)
                        <p class="list-item-heading mb-4">Modul Video</p>
                        @foreach (json_decode($data->links) as $link)
                        <div class="position-relative">
                            <div class="video-view">
                                <div class="plyr__video-embed player">
                                    <iframe
                                    src="{{ $link }}"
                                    allowfullscreen
                                    allowtransparency
                                    allow="autoplay"
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                        <br>
                        @endforeach
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>

<div class="app-menu">
    <div class="p-4 h-100">
        <div class="scroll">
            <p class="text-muted text-small">Status</p>
            <ul class="list-unstyled mb-5">
                <li class="active">
                    <a href="#">
                        <i class="simple-icon-refresh"></i>
                        Total Siswa
                        <span class="float-right">{{ $siswa }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="simple-icon-check"></i>
                        Siswa Mengunduh
                        <span class="float-right">{{ $diunduh }}</span>
                        
                    </a>
                </li>
            </ul>
            
            <p class="text-muted text-small">Kategori</p>
            <ul class="list-unstyled mb-5">
                <li>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" disabled checked class="custom-control-input" id="{{ $data->kategori }}">
                        <label class="custom-control-label"  for="{{ $data->kategori }}">{{ $data->kategori }}</label>
                    </div>
                </li>
            </ul>
            
            
            
            
            <p class="text-muted text-small">Labels</p>
            <div>
                @foreach (json_decode($data->file) as $label)
                <p class="d-sm-inline-block mb-1">
                    <a href="#">
                        <span class="badge badge-pill badge-outline-primary mb-1">{{ $label }}</span>
                    </a>
                </p>
                @endforeach
            </div>
            
        </div>
    </div>
    <a class="app-menu-button d-inline-block d-xl-none" href="#">
        <i class="simple-icon-options"></i>
    </a>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/plyr/plyr.css') }}" />
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-expander/1.7.0/jquery.expander.min.js"></script>
<script src="{{asset('js/vendor/Chart.bundle.min.js')}}"></script>
<script src="{{ asset('js/vendor/progressbar.min.js') }}"></script>
<script src="{{ asset('vendor/plyr/plyr.js') }}"></script>
<script>
    const players = Plyr.setup('.player');
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
    $('.read-more').expander({
        slicePoint:       120,  
        expandPrefix:     ' ', 
        expandText:       '', 
        collapseTimer:    5000, 
        userCollapseText: '[^]'
    });
    $(".progress-bar-circle").each(function () {
        var val = $(this).attr("aria-valuenow");
        var color = $(this).data("color") || themeColor1;
        var trailColor = $(this).data("trailColor") || "#d7d7d7";
        var max = $(this).attr("aria-valuemax") || 100;
        var showPercent = $(this).data("showPercent");
        var circle = new ProgressBar.Circle(this, {
            color: color,
            duration: 20,
            easing: "easeInOut",
            strokeWidth: 4,
            trailColor: trailColor,
            trailWidth: 4,
            text: {
                autoStyleContainer: false
            },
            step: function (state, bar) {
                if (showPercent) {
                    bar.setText(Math.round(bar.value() * 100) + "%");
                } else {
                    bar.setText(val + "/" + max);
                }
            }
        }).animate(val / max);
    });
</script>
@endsection