@extends('layouts.app')
@section('title','Tipe Soal Quiz')
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="mb-2">
            <h1>@yield('title')</h1>
            <div class="top-right-button-container">
               @if ($data->status == true)
               <form action="{{ route('soal.unpublish',[$data->id,$data->judul]) }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-danger btn-lg"> Unpublish</button>
               </form>
               @else
               <form action="{{ route('soal.pilGanda.publish',[$data->id,$data->judul]) }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-success btn-lg"> Publish</button>
               </form>
               @endif
            </div>
         </div>
         <div class="separator mb-5"></div>
         <div class="row">
            <div class="col-md-3 col-lg-3">
            </div>
            <div class="col-md-6 col-12 col-lg-6">
               <div class="card mt-5">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-6 col-6 col-lg-6">
                           <a href="{{ route('soal.pilGanda',[$data->id,$data->judul]) }}" class="btn btn-secondary btn-xl">Create Soal Objective</a>
                        </div>
                        <div class="col-md-6 col-6 col-lg-6">
                           <a href="{{ route('soal.Essay',[$data->id,$data->judul]) }}" class="btn btn-primary btn-xl">Create Soal Essay</a>
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-md-6 col-6 col-lg-6">
                           <a href="{{ route('soal.show',[$data->id,$data->judul]) }}" class="btn btn-secondary btn-xl">List Pilihan Ganda</a>
                        </div>
                        <div class="col-md-6 col-6 col-lg-6">
                           <a href="{{ route('soal.Essay.show',[$data->id,$data->judul]) }}" class="btn btn-primary btn-xl">List Soal Essay</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection