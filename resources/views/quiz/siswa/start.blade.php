@extends('layouts.app')
@section('title','Quiz')
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-12 survey-app">
            <div class="mb-2">
                <h1>Developer Survey</h1>
                <div class="text-zero top-right-button-container">
                    <button type="button"
                    class="btn btn-lg btn-primary" disabled>
                    12:46
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="sortable-survey">
                    <div>
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <label><span>1.</span> What is your gender?</label>
                                    <div class="mb-4">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1"
                                            name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label"
                                            for="customRadio1">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2"
                                            name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label"
                                            for="customRadio2">Female</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3"
                                            name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label"
                                            for="customRadio3">Other</label>
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