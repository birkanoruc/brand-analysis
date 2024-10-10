@extends('adminlte::page')

@section('title', 'Uploads')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Show Upload</h1>
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
        <div class="card-header">
            <a class="btn btn-info btn-sm" href="{{ route('uploads.edit', $upload->id) }}">
                <i class="fas fa-pencil-alt"></i>
                Edit
            </a>
            <form action="{{ route('uploads.destroy', $upload->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this upload?');">
                    <i class="fas fa-trash"></i>
                    Delete
                </button>
            </form>
            <a class="btn btn-warning btn-sm" href="{{ Storage::url($upload->path) }}">
                <i class="fas fa-download"></i>
                Download
            </a>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $upload->id }}</p>
            <p><strong>Name:</strong> {{ $upload->name }}</p>
            <p><strong>Path:</strong> {{ $upload->path }}</p>
            <p><strong>Extension:</strong> {{ $upload->extension }}</p>
            <p><strong>Size:</strong> {{ $upload->size }} KB</p>
            <p><strong>Brand:</strong> {{ $upload->brand->name }}</p>
            <p><strong>Category:</strong> {{ $upload->category->name }}</p>
            <p><strong>Created At:</strong> {{ $upload->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $upload->updated_at }}</p>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
