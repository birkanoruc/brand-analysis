@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Show Category</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}">Categories</a></li>
            </ol>
        </div>
    </div>

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-info btn-sm" href="{{ route('categories.edit', $category->id) }}">
                <i class="fas fa-pencil-alt"></i>
                Edit
            </a>
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this category?');">
                    <i class="fas fa-trash"></i>
                    Delete
                </button>
            </form>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $category->id }}</p>
            <p><strong>Name:</strong> {{ $category->name }}</p>
            <p><strong>Options:</strong> {{ $category->options }}</p>
            <p><strong>Created At:</strong> {{ $category->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $category->updated_at }}</p>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
