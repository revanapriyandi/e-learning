@extends('layouts.app')
@section('title','Send File ke Guru')
@section('content')
<div class="container-fluid">
    <div class="row app-row">
        <div class="col-12 chat-app">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('tugas.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input id="judul" value="{{ old('judul') }}" class="form-control" type="text" value="" name="judul">
                        </div>
                        <div class="form-group">
                            <label for="tujuan">Kepada</label>
                            <input id="nama" class="form-control typeahead" type="text" name="nama" readonly value="">
                            <small>Silahkan pilih pengguna disebalah kanan</small>
                            <input type="hidden" name="user_id" value="" id="id">
                        </div>
                        <div class="form-group">
                            <label for="file">Berkas</label>
                             <div class="input-group mb-3">
                                <input readonly id="file" value="{{ old('file') }}" type="text" name="file" class="form-control file" required placeholder="" aria-label="">
                                <div class="input-group-append">
                                    <a id="file" data-input="file" data-preview="holder" class="btn btn-primary file" style="color: white">Choose</a>
                                </div>
                            </div>
                            @error('file')
                            <span style="color:red" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea name="catatan" id="catatan" cols="30" rows="10">{{ old('catatan') }}</textarea>
                        </div>
                        <button class="btn btn-primary float-right">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="app-menu">
    <ul class="nav nav-tabs card-header-tabs ml-0 mr-0 mb-1" role="tablist">
        <li class="nav-item w-50 text-center">
            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#firstFull" role="tab"
            aria-selected="true">Pengguna Sistem</a>
        </li>
    </ul>
    <div class="p-4 h-100">
        <div class="form-group">
            <form action="{{ route('send.tugas') }}" method="get">
                <input type="text" class="form-control rounded" name="search" placeholder="Search">
            </form>
        </div>
        <div class="tab-content h-100">
            <div class="tab-pane fade show active  h-100" id="firstFull" role="tabpanel"
            aria-labelledby="first-tab">
            <div class="scroll">
                @foreach ($user as $user)
                <div class="listSearch d-flex flex-row mb-1 border-bottom pb-3 mb-3 pilih" data-id="{{$user->id}}" id="listS" data-nama="{{ $user->nama }}">
                    <a class="d-flex" href="#">
                        <img alt="Profile " src="{{ $user->avatar }}"
                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                    </a>
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div
                        class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                        <div class="min-width-zero">
                            <a href="#">
                                <td data-id="{{ $user->id }}">
                                    <p class=" mb-0 truncate" >{{ $user->nama }}</p>
                                </td>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
<a class="app-menu-button d-inline-block d-xl-none" href="#">
    <i class="simple-icon-options"></i>
</a>
</div>
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-expander/1.7.0/jquery.expander.min.js"></script>
<script>
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
    
    $(function () {
        $(document).on('click', '.pilih', function (e) {
            document.getElementById("id").value = $(this).attr('data-id');
            document.getElementById("nama").value = $(this).attr('data-nama');
            $('#myModal').modal('hide');
        });
    });
    
    $(document).ready(function(){
        $('#catatan').summernote({
            dialogsInBody: true,
            minHeight: 300,
            toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear','backcolor','fontname']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['style', ['style']],
            ['hr', ['hr']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['codeview',['codeview']],
            ],
        });
    });
</script> 
@endsection