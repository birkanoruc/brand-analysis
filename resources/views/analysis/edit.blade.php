@extends('adminlte::page')

@section('title', 'Analysis')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit Analysi</h1>
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
        <div class="card-body">
            <form method="POST" action="{{ route('analysis.update', $analysi->id) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <x-adminlte-input name="name" label="Analysi Name" placeholder="Analysi Name" fgroup-class="col-md-8"
                        required value="{{ $analysi->name }}" />

                    <x-adminlte-select name="brand_id" label="Brand" fgroup-class="col-md-8" required>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $analysi->brand_id == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-input type="date" name="analysisDate" label="Analysis Date" placeholder="Analysis Date"
                        fgroup-class="col-md-8" required value="{{ $analysi->analysisDate }}" />

                    @foreach ($categories as $category)
                        <x-adminlte-select name="analysis_metas[{{ $category->id }}]" label="{{ $category->name }}"
                            fgroup-class="col-md-8">
                            <option value="">Select an upload</option>

                            @php
                                $selectedUpload = $analysi->analysisMetas->where('category_id', $category->id)->first();
                            @endphp

                            @foreach ($category->uploads as $upload)
                                <option value="{{ $upload->id }}"
                                    {{ $selectedUpload && $selectedUpload->upload_id == $upload->id ? 'selected' : '' }}>
                                    {{ $upload->name }}
                                </option>
                            @endforeach
                        </x-adminlte-select>
                    @endforeach

                    <div class="form-group col-md-8">
                        <x-adminlte-button label="Update Analysi" theme="dark w-100" type="submit" />
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
