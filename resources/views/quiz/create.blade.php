@extends('layouts.app')
@section('title','Create New Quiz')
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="mb-2">
            <h1>@yield('title')</h1>
         </div>
         <div class="mb-2">
            <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
               role="button" aria-expanded="true" aria-controls="displayOptions">
            Display Options
            <i class="simple-icon-arrow-down align-middle"></i>
            </a>
         </div>
         <div class="separator mb-5"></div>
         <div class="card">
            <div class="card-body">
               <form action="{{ route('quiz.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                     <label for="judul">Judul Quiz</label>
                     <input id="judul" class="form-control" type="text" name="judul" value="{{ old('judul') }}" required>
                     @error('judul')
                     <span style="color:red">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="kelas">Kelas</label>
                     <select id="kelas" class="form-control select2" name="kelas" required>
                     @foreach ($kelas as $kelas)
                     <option value="{{ $kelas->id }}" @if(old('kelas') == $kelas->id) selected @endif >{{ $kelas->nama_kelas }}</option>
                     @endforeach
                     </select>
                     @error('kelas')
                     <span style="color:red">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="kelas">Mapel</label>
                     <select id="kelas" class="form-control select2" name="mapel" required>
                     @foreach ($mapel as $mapel)
                     <option value="{{ $mapel->id }}" @if(old('mapel') == $mapel->id) selected @endif >{{ $mapel->nama }}</option>
                     @endforeach
                     </select>
                     @error('mapel')
                     <span style="color:red">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="durasi">Durasi Ujian</label>
                     <input id="durasi" required class="form-control" min="5" type="number" value="{{ old('durasi') }}" name="durasi">
                     <small>Durasi dalam bentuk menit</small>
                     @error('durasi')
                     <span style="color:red">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="deskripsi">Deskripsi/Catatan</label>
                     <textarea id="deskripsi" class="form-control" name="deskripsi" cols="30" rows="10">{!! old('deskripsi') !!}</textarea>
                  </div>
                  {{--  <label for="status">Status</label>
                  <div class="mb-4">
                     <div class="custom-control custom-radio">
                        <input type="radio" required id="publish" name="status" class="custom-control-input" value="1">
                        <label class="custom-control-label" for="publish">Publish</label>
                     </div>
                     <div class="custom-control custom-radio">
                        <input type="radio" id="pending" name="status" class="custom-control-input" value="0">
                        <label class="custom-control-label"  for="pending">Pending</label>
                     </div>
                  </div>  --}}
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection