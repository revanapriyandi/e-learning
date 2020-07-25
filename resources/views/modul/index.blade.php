@extends('layouts.app')
@section('title','Modul / Tugas')
@section('content')
<div class="container-fluid">
    <div class="row app-row">
        <div class="col-12">
            <div class="mb-2">
                <h1>@yield('title')</h1>
                <div class="top-right-button-container">
                    @if (auth()->user()->role =='guru')
                    <a href="{{ route('modul.create') }}" class="btn btn-outline-primary btn-lg top-right-button  mr-1"
                    >ADD NEW</a>
                    @endif
                    @if (auth()->user()->role == 'siswa')
                    <a href="{{ route('send.tugas') }}" class="btn btn-outline-primary btn-lg top-right-button  mr-1"
                    >Kirim Tugas</a>
                    @endif
                </div>
            </div>
            
            {{--  <div class="mb-2">
                <form action="{{ route('modul.index') }}" method="get">
                    <div class="collapse d-md-block" id="displayOptions">
                        <div class="d-block d-md-inline-block">
                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                <input placeholder="Search..." type="text" name="search" id="search">
                            </div>
                        </div>
                    </div>
                </form>
            </div>  --}}
            <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                    aria-controls="first" aria-selected="true">Modul</a>
                </li>
                 @if (auth()->user()->role == 'siswa')
                <li class="nav-item">
                    <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                    aria-controls="second" aria-selected="false">Tugas Terkirim</a>
                </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                    <div class="list disable-text-selection" data-check-all="checkAll">
                        @foreach ($datas as $data)
                        <div class="card d-flex flex-row mb-3" id="card">
                            <div class="d-flex flex-grow-1 min-width-zero">
                                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                    <a class="list-item-heading mb-0  w-40 w-xs-100 mt-0"
                                    href="{{ route('modul.show',$data->id) }}">
                                    <span class="align-middle d-inline-block">{{ $data->judul }}</span>
                                </a>
                                @empty($data->kelas->nama_kelas)
                                <p class="mb-0 text-muted text-small w-15 w-xs-100">Semua Pengguna</p>
                                @else
                                <p class="mb-0 text-muted text-small w-15 w-xs-100">{{ $data->kelas->nama_kelas }}</p>
                                @endempty
                                <p class="mb-0 text-muted text-small w-15 w-xs-100">{{ date('d F Y ',strtotime($data->created_at)) }}</p>
                                <div class="w-15 w-xs-100">
                                    @if($data->kategori == 'tugas')
                                    <span class="badge badge-pill badge-success">Tugas </span>
                                    @else
                                    <span class="badge badge-pill badge-info">Modul </span>
                                    @endempty
                                </div>
                                <div class="w-15 w-xs-100">
                                    @if($data->status == true)
                                    <span class="badge badge-pill badge-secondary">Published </span>
                                    @else
                                    <span class="badge badge-pill badge-dark">Draft </span>
                                    @endempty
                                </div>
                            </div>
                            <label class="custom-control custom-checkbox mb-0 align-self-center mr-4 mb-1">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-label">&nbsp;</span>
                            </label>
                            <input type="hidden" value="{{ $data->id }}" id="modul_id" name="modul_id">
                        </div>
                    </div>
                    @endforeach      
                </div>
            </div>
            @if (auth()->user()->role == 'siswa')
            <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="list disable-text-selection" data-check-all="checkAll">
                            @foreach ($tugasMasuk as $tugasMasuk)
                            <div class="card d-flex flex-row mb-3">
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                    <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0"
                                    href="{{ route('tugas.masuk.show',$tugasMasuk->id) }}">
                                    <i class="simple-icon-refresh heading-icon"></i>
                                    <span class="align-middle d-inline-block">{{ $tugasMasuk->judul }}</span>
                                </a>
                                <p class="mb-0 text-muted text-small w-15 w-xs-100">{{ $tugasMasuk->pengirim->nama }}</p>
                                <p class="mb-0 text-muted text-small w-15 w-xs-100">{{ date('d F Y',strtotime($tugasMasuk->created_at)) }}</p>
                                @if ($data->status == 'read')
                                    <span class="badge badge-pill badge-success">{{ $tugasMasuk->status() }}</span>
                                    @else
                                    <span class="badge badge-pill badge-primary">{{ $tugasMasuk->status() }}</span>
                                @endif
                            </div>
                            <label class="custom-control custom-checkbox align-self-center mr-4 mt-2">
                                <span class="badge badge-pill badge-secondary"></span>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
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
                        Jumlah Modul
                        <span class="float-right">{{ $jumlahModul }}</span>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="simple-icon-refresh"></i>
                        Jumlah Tugas
                        <span class="float-right">{{ $jumlahTugas }}</span>
                    </a>
                </li>
            </ul>
            <p class="text-muted text-small">Kategori</p>
            <form action="{{ route('modul.index') }}" method="get">
                <div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="tugas"  name="kategori" value="tugas" class="custom-control-input">
                        <label class="custom-control-label" for="tugas">Tugas</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="modul" value="modul" name="kategori" class="custom-control-input">
                        <label class="custom-control-label" for="modul">Modul Pelajaran</label>
                    </div>
                </div>
                <button class="btn btn-secondary btn-xs mb-1 float-right">Search</button>
            </form>
            <br>
            <p class="text-muted text-small">Labels</p>
            <div>
                @foreach ($datas as $item)
                @foreach (json_decode($item->file) as $label)
                <p class="d-sm-inline-block mb-1">
                    <a href="{{ route('modul.show',$item->id) }}">
                        <span class="badge badge-pill badge-outline-primary mb-1">{{ $label }}</span>
                    </a>
                </p>
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <a class="app-menu-button d-inline-block d-xl-none" href="#">
        <i class="simple-icon-options"></i>
    </a>
</div>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-expander/1.7.0/jquery.expander.min.js"></script>
<script>
    $('.read-more').expander({
        slicePoint:       120,  
        expandPrefix:     ' ', 
        expandText:       '', 
        collapseTimer:    5000, 
        userCollapseText: '[^]'
    });
    function confirmDelete(id) {
        console.log(id);
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