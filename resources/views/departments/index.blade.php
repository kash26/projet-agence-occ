@extends('layouts.main')

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Departments</h1>
    </div>

    <div class="row">
        <div class="mx-auto w-100 mb-3">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="card mx-auto table-responsive">

            <div class="card-header">
                <div class="row d-flex justify-content-between">
                    <div class="col-6">
                        <form method="GET" action="{{ route('departments.index') }}">
                            <div class="form-row align-center">
                                <div class="col">
                                    <input type="text" name="search" class="form-control mb-2" id="inlineFormInput" placeholder="Kinshasa">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="float-right">
                        <a href="{{ route('departments.create') }}" class="btn btn-primary">Create</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <th scope="row">{{ $department->id }}</th>
                                <td>{{ $department->name }}</td>
                                <td>
                                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-success">Edit</a>
                                    <form style="display: inline" action="{{ route('departments.destroy', $department->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
