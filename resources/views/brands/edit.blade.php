@extends('adminlte::page')

@section('title', 'Brands')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit Brand</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('brands.index') }}">Brands</a></li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('brands.update', $brand->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <x-adminlte-input name="name" label="Brand Name" placeholder="Brand Name" fgroup-class="col-md-8"
                        required value="{{ $brand->name }}" />
                    <x-adminlte-input name="logoUrl" label="Brand Logo Url" placeholder="Brand Logo Url"
                        fgroup-class="col-md-8" value="{{ $brand->logoUrl }}" />
                    <div class="form-group col-md-8">
                        <x-adminlte-button label="Update Brand" theme="dark w-100" type="submit" />
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
