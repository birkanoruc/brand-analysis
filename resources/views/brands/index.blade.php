@extends('adminlte::page')

@section('title', 'Brands')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">List Brands</h1>
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
    @if (isset($brands))
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 20px">#</th>
                            <th>Name</th>
                            <th>Logo Url</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->logoUrl }}</td>
                                <td>{{ $brand->created_at }}</td>
                                <td class="project-actions">
                                    <a class="btn btn-primary btn-sm" href="{{ route('brands.show', $brand->id) }}">
                                        <i class="fas fa-folder"></i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('brands.edit', $brand->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this brand?');">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $brands->links('pagination::bootstrap-4') }}
                </ul>
            </div>
        </div>
    @endif
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
