@extends('adminlte::page')

@section('title', 'Analysis')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Show Analysi</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('analysis.index') }}">Analysis</a></li>
            </ol>
        </div>
    </div>

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-info btn-sm" href="{{ route('analysis.edit', $analysi->id) }}">
                <i class="fas fa-pencil-alt"></i>
                Edit
            </a>
            <form action="{{ route('analysis.destroy', $analysi->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this analysi?');">
                    <i class="fas fa-trash"></i>
                    Delete
                </button>
            </form>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $analysi->id }}</p>
            <p><strong>Name:</strong> {{ $analysi->name }}</p>
            <p><strong>Brand:</strong> {{ $analysi->brand->name }}</p>
            <p><strong>Analysis Date:</strong> {{ $analysi->analysisDate }}</p>
            <p><strong>Created At:</strong> {{ $analysi->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $analysi->updated_at }}</p>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
