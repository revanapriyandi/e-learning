@extends('layouts.app')
@section('title','Edit Data Matapelajaran')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>@yield('title')</h1>
        </div>
        
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb pt-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Data Matapelajaran</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $data->nama }}</li>
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
                <form action="{{ route('mapel.update',$data->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="nama">Nama Mapel</label>
                        <input id="nama" class="form-control" value="{{ $data->nama }}" required type="text" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="pengajar">Pengajar</label>
                        <select name="pengajar" id="pengajar" required class="form-control select2">
                            @foreach ($pengajar as $p)
                            <option value="{{ $p->id }}" @if($data->pengajar == $p->id) selected @endif>{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" required class="form-control select2">
                            @foreach ($kelas as $p)
                            <option value="{{ $p->id }}"  @if($data->kelas_id == $p->id) selected @endif>{{ $p->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskrisi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="10">{{ $data->deskripsi }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection