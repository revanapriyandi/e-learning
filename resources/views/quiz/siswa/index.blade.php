@extends('layouts.app')
@section('title','Create New Quiz')
@section('content')
<div class="container-fluid disable-text-selection">
   <div class="row">
      <div class="col-12">
         <div class="mb-2">
            <h1>Quiz Active</h1>
         </div>
         <div class="separator mb-5"></div>
      </div>
   </div>
   <div class="row">
      <div class="col-12 list" data-check-all="checkAll">
         @foreach ($data as $data)
        <div class="card d-flex flex-row mb-3">
            <div class="d-flex flex-grow-1 min-width-zero">
               <div
                  class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                  <a class="list-item-heading mb-0 truncate w-40 w-xs-100"
                     href="{{ route('quiz.information',[$data->id,$data->judul]) }}">
                  {!! $data->judul !!}
                  </a>
                  <p class="mb-0 text-muted text-small w-15 w-xs-100">{{ $data->mapel_id->nama }}</p>
                  <p class="mb-0 text-muted text-small w-15 w-xs-100">{{ date('d F Y',strtotime($data->created_at)) }}</p>
                  <div class="w-15 w-xs-100">
                     <span class="badge badge-pill badge-secondary">ON HOLD</span>
                  </div>
               </div>
               <label class="custom-control custom-checkbox mb-1 align-self-center pr-4">
               <input type="checkbox" class="custom-control-input">
               <span class="custom-control-label">&nbsp;</span>
               </label>
            </div>
         </div>
         @endforeach
         <nav class="mt-4 mb-3">
            <ul class="pagination justify-content-center mb-0">
               {!! $data->links !!}
            </ul>
         </nav>
      </div>
   </div>
</div>
@endsection