@extends('layouts.app')
@section('title','Add New Modul Pembelajaran')
@section('content')
<div class="container-fluid library-app">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <h1>@yield('title')</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Modul</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Data</li>
                    </ol>
                </nav>
            </div>
            <div class="separator mb-5"></div>
        </div>
    </div>
    
    <form action="{{ route('modul.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-8 col-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judul">Judul Modul</label>
                            <input id="judul" required class="form-control" type="text" name="judul" value="{{ old('judul') }}">
                            @error('judul')
                            <span style="color:red" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas yang dapat melihat</label>
                            <select name="kelas" required id="kelas" data-width="100%" class="form-control select2">
                                <option value="semua">Semua Kelas</option>
                                @foreach ($kelas as $kelas)
                                <option value="{{ $kelas->id }}" @if(old('kelas') == $kelas->id) selected @endif>{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('kelas')
                            <span style="color:red" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Modul</label>
                            <textarea name="deskripsi" required id="deskripsi" class="form-control" cols="30" rows="10">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-4 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="control-label " for="file">Files</label>
                            <div class="input-group mb-3">
                                <input readonly id="file" value="{{ old('file') }}" type="text" name="file" class="form-control file" required placeholder="" aria-label="">
                                <div class="input-group-append">
                                    <a id="file" data-input="file" data-preview="holder" class="btn btn-primary file" style="color: white">Choose</a>
                                </div>
                                <small>File yang diupload sebaiknnya tidak lebih dari 100 Mb </small>
                            </div>
                            @error('file')
                            <span style="color:red" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input id="link" class="form-control" value="{{ old('link')}}" type="text" name="link" placeholder="https://www.youtube.com/watch?v=0LHmevWVvpc&list=RDMMHxIUkj5X194&index=8">
                            <small>Jika Ingin Menambahkan Video dari Youtube,Audio</small>
                            @error('link')
                            <span style="color:red" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <p class="text-muted text-small">Kategori</p>
                        <ul class="list-unstyled mb-5">
                            <li>
                                <div class="custom-control custom-radio">
                                    <input type="radio" @if(old('kategori') == 'tugas') checked @endif required value="tugas" id="tugas" name="kategori"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="tugas">Tugas</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio">
                                    <input value="modul" @if(old('kategori') == 'modul') checked @endif type="radio" id="modul" name="kategori"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="modul">Modul</label>
                                </div>
                            </li>
                        </ul>
                        <p class="text-muted text-small">Status</p>
                        <ul class="list-unstyled mb-5">
                            <li>
                                <div class="custom-control custom-radio">
                                    <input type="radio" @if(old('status') == 'publish') checked @endif required value="publish" id="customRadio1" name="status"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Publish</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-radio">
                                    <input value="pending" @if(old('status') == 'pending') checked @endif type="radio" id="customRadio2" name="status"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Pending</label>
                                </div>
                            </li>
                        </ul>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
<script>
    $(document).ready(function(){
        
        var route_prefix = "/filemanager";
        $.fn.filemanager = function (type, options) {
            type = type || 'file';
            
            this.on('click', function (e) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
                var target_input = $('#' + $(this).data('input'));
                var target_preview = $('#' + $(this).data('preview'));
                window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                window.SetUrl = function (items) {
                    var file_path = items.map(function (item) {
                        return item.name;
                    }).join(',');
                    
                    // set the value of the desired input to image url
                    target_input.val('').val(file_path).trigger('change');
                    
                    // clear previous preview
                    target_preview.html('');
                    
                    // set or change the preview image src
                    items.forEach(function (item) {
                        target_preview.append(
                        $('<img>').css('height', '5rem').attr('src', item.thumb_url)
                        );
                    });
                    
                    // trigger change event
                    target_preview.trigger('change');
                };
                return false;
            });
        };
        $('.file').filemanager('file', {prefix: route_prefix});
        
        var image = function(options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = cb;
        };
        
        
        $('#deskripsi').summernote({
            dialogsInBody: true,
            minHeight: 300,
            toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear','backcolor','fontname']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['style', ['style']],
            ['hr', ['hr']],
            ['link', ['link']],
            ['color', ['color']],
            ['insert', ['link']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['codeview',['codeview']],
            ],
        });
    });
    
</script>
@endsection