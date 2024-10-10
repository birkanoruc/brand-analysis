@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Create Category</h1>
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
        <div class="card-body">
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="row">
                    <x-adminlte-input name="name" label="Category Name" placeholder="Category Name"
                        fgroup-class="col-md-8" required value="{{ old('name') }}" />
                    <x-adminlte-textarea name="options" label="Options" rows=10 igroup-size="sm"
                        placeholder="Category options..." fgroup-class="col-md-8" required>
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-dark">
                                <i class="fas fa-lg fa-file-alt text-warning"></i>
                            </div>
                        </x-slot>
                        {{ old('options') }}
                    </x-adminlte-textarea>
                    <div class="form-group col-md-8">
                        <x-adminlte-button label="Create Category" theme="dark w-100" type="submit" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
