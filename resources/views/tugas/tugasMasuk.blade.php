@extends('layouts.app')
@section('title','Tugas Masuk')
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
         <div class="collapse d-md-block" id="displayOptions">
            <div class="d-block d-md-inline-block">
               <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                  <form action="{{ route('tugas.masuk.index') }}" method="get">
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
               href="{{ route('tugas.masuk.show',$data->id) }}">
               <i class="simple-icon-refresh heading-icon"></i>
               <span class="align-middle d-inline-block">{{ $data->judul }}</span>
            </a>
            <p class="mb-0 text-muted text-small w-15 w-xs-100">{{ $data->pengirim->nama }}</p>
            <p class="mb-0 text-muted text-small w-15 w-xs-100">{{ date('d F Y',strtotime($data->created_at)) }}</p>
            @if ($data->status == 'read')
            <span class="badge badge-pill badge-success">{{ $data->status() }}</span>
            @else
            <span class="badge badge-pill badge-primary">{{ $data->status() }}</span>
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

@endsection