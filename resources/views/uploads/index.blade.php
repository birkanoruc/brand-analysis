@extends('adminlte::page')

@section('title', 'Uploads')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">List Uploads</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('uploads.index') }}">Uploads</a></li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                @if (isset($uploads))
                    @foreach ($uploads as $upload)
                        <div class="col-md-2">
                            <span class="mailbox-attachment-icon"><i class="far fa-file-excel"></i></span>
                            <div class="mailbox-attachment-info">
                                <a href="{{ route('uploads.show', $upload->id) }}" class="mailbox-attachment-name"><i
                                        class="fas fa-paperclip"></i>
                                    {{ $upload->name }}</a>
                                <span class="mailbox-attachment-size clearfix mt-1">
                                    <span>{{ $upload->size }} KB</span>
                                    <a href="{{ Storage::url($upload->path) }}"
                                        class="btn btn-default btn-sm float-right"><i
                                            class="fas fa-cloud-download-alt"></i></a>
                                </span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @if (isset($uploads))
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $uploads->links('pagination::bootstrap-4') }}
                </ul>
            </div>
        @endif
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        $(document).ready(function() {
            @if (session('success'))
                toastr.success('{{ session('success') }}');
            @endif
        });
    </script>
@stop

@section('plugins.Toastr', true)

@section('plugins.BsCustomFileInput', true)
