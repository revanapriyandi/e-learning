@extends('layouts.app')
@section('title','Edit Data Kelas')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-12 col-lg-12 ">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('kelas.update',$data->id) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input id="nama_kelas" value="{{ $data->nama_kelas}}"class="form-control" type="text" name="nama_kelas">
                            @error('nama_kelas')
                            <span style="color:red" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="walikelas">Walikelas</label>
                            <select required name="walikelas" id="walikelas" class="form-control select2">
                                @foreach ($walikelas as $guru)
                                <option value="{{ $guru->id }}" @if(old('walikelas') == $guru->id) selected @endif>{{ $guru->nama }}</option>
                                @endforeach
                            </select>
                            @error('walikelas')
                            <span style="color:red" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ketuakelas">Ketua Kelas</label>
                            <select  name="ketuakelas" id="ketuakelas" class="form-control select2">
                                @foreach ($siswa as $siswa)
                                <option value="{{ $siswa->id }}" @if(old('ketuakelas') == $siswa->id) selected @endif>{{ $siswa->nama }}</option>
                                @endforeach
                            </select>
                            @error('ketuakelas')
                            <span style="color:red" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        
                        <button type="submit" id="simpan" name="simpan" class="btn btn-primary mb-0 float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection