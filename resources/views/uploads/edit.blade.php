@extends('adminlte::page')

@section('title', 'Uploads')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Uploads</h1>
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
            <form action="{{ route('uploads.update', $upload->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <x-adminlte-input-file name="upload_file" id="upload_file" igroup-size="md"
                        placeholder="Choose a file..." accept=".xlsx" required fgroup-class="col-md-8" label="Upload File">
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>

                    <x-adminlte-select name="brand_id" label="Brand" fgroup-class="col-md-8" required>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $upload->brand->id == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-select name="category_id" label="Category" fgroup-class="col-md-8" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $upload->category->id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-adminlte-select>
                    <div class="form-group col-md-8">
                        <x-adminlte-button label="Upload Upload" theme="dark w-100" type="submit" />
                    </div>
                </div>
                <form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop

@section('plugins.BsCustomFileInput', true)
