@extends('layouts.app')
@section('title','Edit Quiz Essay')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>@yield('title')</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('soal.Essay.update',[$data->id,$judul]) }}" method="POST">
                        @csrf
                        @method('patch')
                        <h5 class="card-title">
                        </h5>
                        <div class="row">
                            <div class="col-md-12 col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="soal">Question</label>
                                    <textarea name="soal" id="soal" cols="30" rows="10" class="form-control summernote">{{ $data->pertanyaan }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block float-right"> Update</button>
                                
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
    $(document).ready(function(){
        
        var lfm = function(options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = cb;
        };
        var LFMButton = function(context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: 'Insert image with filemanager',
                click: function() {
                    
                    lfm({type: 'image', prefix: '/laravel-filemanager'}, function(lfmItems, path) {
                        lfmItems.forEach(function (lfmItem) {
                            context.invoke('insertImage', lfmItem.url);
                        });
                    });
                    
                }
            });
            return button.render();
        };
        
        $('.summernote').summernote({
            height:300,
            toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'lfm', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
            ],
            buttons: {
                lfm: LFMButton
            }
        })
    });
</script>    
@endsection