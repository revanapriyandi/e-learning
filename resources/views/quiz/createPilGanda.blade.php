@extends('layouts.app')
@section('title','Create New Quiz')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>@yield('title')</h1>
                <div class="top-right-button-container">
                    <form action="{{ route('soal.pilGanda.publish',[$data->id,$data->judul]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg"> Publish</button>
                    </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('soal.pilGanda.store',[$data->id,$data->judul]) }}" method="POST">
                            @csrf
                            <h5 class="card-title">
                                <div class="row">
                                    <div class="col-md-8 col-8 col-lg-8">
                                        Insert Questions (Stored Question(s) : {{ $banyakSoal }})
                                    </div>
                                    <div class="col-md-4 col-4 col-lg-4">
                                        <button type="submit" class="btn btn-primary btn-block float-right"> Simpan</button>
                                        
                                    </div>
                                </div>
                            </h5>
                            <div class="row">
                                <div class="col-md-3 col-12 col-lg-3">
                                    <ul class="nav text-center nav-pills flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="Question-tab" data-toggle="tab" href="#Question" role="tab"
                                            aria-controls="Question" aria-selected="true">Question</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pilA-tab" data-toggle="tab" href="#pilA" role="tab"
                                            aria-controls="pilA" aria-selected="true">Option A</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pilB-tab" data-toggle="tab" href="#pilB" role="tab"
                                            aria-controls="pilB" aria-selected="true">Option B</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pilC-tab" data-toggle="tab" href="#pilC" role="tab"
                                            aria-controls="pilC" aria-selected="true">Option C</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pilD-tab" data-toggle="tab" href="#pilD" role="tab"
                                            aria-controls="pilD" aria-selected="true">Option D</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pilE-tab" data-toggle="tab" href="#pilE" role="tab"
                                            aria-controls="pilE" aria-selected="true">Option E</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-9 col-12 col-lg-9">
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="Question" role="tabpanel" aria-labelledby="Question-tab">
                                            <h6 for="">Answers :</h6>
                                            <div class="btn-group btn-block btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-primary">
                                                    <input required type="radio" value="A" name="jawaban" id="A" @if(old('jawaban') == 'A') checked @endif > Pilihan A
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" value="B" name="jawaban" id="B" @if(old('jawaban') == 'B') checked @endif> Pilihan B
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" value="C" name="jawaban" id="C" @if(old('jawaban') == 'C') checked @endif> Pilihan C
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" value="D" name="jawaban" id="D" @if(old('jawaban') == 'D') checked @endif> Pilihan D
                                                </label>
                                                <label class="btn btn-primary">
                                                    <input type="radio" value="E" name="jawaban" id="E" @if(old('jawaban') == 'E') checked @endif> Pilihan E
                                                </label>
                                            </div>
                                            <div class="mt-4">
                                                <textarea name="soal" id="soal" class="form-control summernote" required cols="30"  rows="10">{{ old('soal') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pilA" role="tabpanel" aria-labelledby="pilA-tab">
                                            <div class="mt-4">
                                                <textarea name="pilA" id="pilA" class="form-control summernote" required cols="30"  rows="10">{{ old('pilA') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pilB" role="tabpanel" aria-labelledby="pilB-tab">
                                            <div class="mt-4">
                                                <textarea name="pilB" id="pilB" class="form-control summernote" required cols="30"  rows="10">{{ old('pilB') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pilC" role="tabpanel" aria-labelledby="pilC-tab">
                                            <div class="mt-4">
                                                <textarea name="pilC" id="pilC" class="form-control summernote" required cols="30"  rows="10">{{ old('pilC') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pilD" role="tabpanel" aria-labelledby="pilD-tab">
                                            <div class="mt-4">
                                                <textarea name="pilD" id="pilD" class="form-control summernote" required cols="30"  rows="10">{{ old('pilD') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pilE" role="tabpanel" aria-labelledby="pilE-tab">
                                            <div class="mt-4">
                                                <textarea name="pilE" id="pilE" class="form-control summernote" required cols="30"  rows="10">{{ old('pilE') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height:300,
            });
        });
    </script>    
    @endsection