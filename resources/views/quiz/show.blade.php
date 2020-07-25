@extends('layouts.app')
@section('title','List Soal Quiz')
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-12 survey-app">
            <div class="mb-2">
                <h1>List Soal Quiz {{ $data->judul }}</h1>
                <div class="text-zero top-right-button-container">
                    <button type="button"
                    class="btn btn-lg btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ACTIONS
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                </div>
            </div>
        </div>
        <div class="tab-content mb-4">
            <div class="row">
                <div class="col-lg-4 col-12 mb-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <p class="list-item-heading mb-4">Detail</p>
                            <p class="text-muted text-small mb-2">Pembuat</p>
                            <p class="mb-3">
                                {{ $data->user->nama }}
                            </p>
                            <p class="text-muted text-small mb-2">Catatan</p>
                            <p class="mb-3">
                                {!! $data->deskripsi !!}
                            </p>
                            <p class="text-muted text-small mb-2">Durasi</p>
                            <p class="mb-3">
                                {{ $data->durasi }} menit
                            </p>
                            <p class="text-muted text-small mb-2">Mata Pelajaran</p>
                            <div>
                                <p class="d-sm-inline-block mb-1">
                                    <a href="#">
                                        <span
                                        class="badge badge-pill badge-outline-theme-3 mb-1">{{ $data->mapel_id->nama }}</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="sortable-survey">
                        <div>
                            <div class="card question d-flex mb-4 edit-quesiton">
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                </div>
                            </div>
                            <div class="question-collapse collapse show" id="q1">
                                <div class="card-body pt-0">
                                    <div class="edit-mode">
                                        @foreach ($data->pilihanG as $soalPil)
                                        <div class="form-group mb-3">
                                            <label>{!! $soalPil->pertanyaan !!}</label>
                                            <input class="form-control" type="text" name="">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-outline-primary btn-sm mb-2">
                        <i class="simple-icon-plus btn-group-icon"></i>
                        Add Question</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection