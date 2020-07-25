@extends('layouts.app')
@section('title','Manajemen Quiz')
@section('content')
<div class="container-fluid">
   <div class="row app-row">
      <div class="col-12">
         <div class="mb-2">
            <h1>@yield('title')</h1>
            <div class="top-right-button-container">
               <a href="{{ route('quiz.create') }}" class="btn btn-primary btn-lg top-right-button mr-1">ADD
               NEW</a>
            </div>
         </div>
         <div class="mb-2">
            <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
               role="button" aria-expanded="true" aria-controls="displayOptions">
            Display Options
            <i class="simple-icon-arrow-down align-middle"></i>
            </a>
            <div class="collapse d-md-block" id="displayOptions">
               <div class="d-block d-md-inline-block">
                  <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                     <form action="{{ route('quiz.index') }}" method="get">
                        <input placeholder="Search..." name="search" id="search" type="text">
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="separator mb-5"></div>
         <div class="list disable-text-selection" data-check-all="checkAll">
            @foreach ($data as $data)
            <div class="card d-flex flex-row mb-3">
               <div class="d-flex flex-grow-1 min-width-zero">
                  <div
                     class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                     <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0"
                        href="{{ route('quiz.tipeSoal',[$data->id,$data->judul,$data->kelas]) }}">
                     <i class="simple-icon-refresh heading-icon"></i>
                     <span class="align-middle d-inline-block">{{ $data->judul }}</span>
                     </a>
                     <p class="mb-0 text-muted text-small w-15 w-xs-100">{{ $data->kelas_id->nama_kelas }}</p>
                     <p class="mb-0 text-muted text-small w-15 w-xs-100">{{ date('d F Y',strtotime($data->created_at)) }}</p>
                     <span class="badge badge-pill badge-dark">{{ $data->mapel_id->nama }}</span>
                  </div>
                  <label class="custom-control custom-checkbox align-self-center mr-4 mt-2">
                  <span class="badge badge-pill badge-secondary">{{ $data->status() }}</span>
                  </label>
               </div>
            </div>
            @endforeach
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
               Quiz
               <span class="float-right">{{ $data->count() }}</span>
               </a>
            </li>
         </ul>
         <p class="text-muted text-small">Kategori</p>
         <ul class="list-unstyled mb-5">
            <form action="{{ route('quiz.index') }}" method="get">
               @foreach ($mapel as $mapel)
               <li>
                  <div class="custom-control custom-checkbox mb-2">
                     <input type="checkbox" name="mapel" value="{{ $mapel->id}}"class="custom-control-input" id="{{ $mapel->id }}">
                     <label class="custom-control-label" for="{{ $mapel->id }}">{{ $mapel->nama }}</label>
                  </div>
               </li>
               @endforeach
               <button class="btn btn-info btn-xs float-right" type="submit">Search</button>
            </form>
         </ul>
         {{--  
         <p class="text-muted text-small">Labels</p>
         <div>
            <p class="d-sm-inline-block mb-1">
               <a href="#">
               <span class="badge badge-pill badge-outline-primary mb-1"></span>
               </a>
            </p>
         </div>
         --}}
      </div>
   </div>
   <a class="app-menu-button d-inline-block d-xl-none" href="#">
   <i class="simple-icon-options"></i>
   </a>
</div>
@endsection