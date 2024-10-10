@extends('adminlte::page')

@section('title', 'Analysis')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">List Analysis</h1>
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
    @if (isset($analysis))
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 20px">#</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Analysis Date</th>
                            <th>Created At</th>
                            <th>Actions</th>
                            <th>Analysis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($analysis as $analysi)
                            <tr>
                                <td>{{ $analysi->id }}</td>
                                <td>{{ $analysi->name }}</td>
                                <td>{{ $analysi->brand->name }}</td>
                                <td>{{ $analysi->analysisDate }}</td>
                                <td>{{ $analysi->created_at }}</td>
                                <td class="project-actions">
                                    <a class="btn btn-primary btn-sm" href="{{ route('analysis.show', $analysi->id) }}">
                                        <i class="fas fa-folder"></i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="{{ route('analysis.edit', $analysi->id) }}">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('analysis.destroy', $analysi->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this analysi?');">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a target="_blank" class="btn btn-success btn-sm"
                                        href="{{ route('analysis-result.show', $analysi->id) }}">
                                        <i class="fas fa-chart-bar"></i>
                                        Analysis
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $analysis->links('pagination::bootstrap-4') }}
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
