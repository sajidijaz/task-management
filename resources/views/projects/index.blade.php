@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Projects</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Add New Project</a>
        <ul class="list-group mt-3">
            @foreach ($projects as $project)
                <li class="list-group-item">
                    {{ $project->name }}

                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm float-right btn-secondary ml-2">Edit</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="float-right">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>

                </li>
            @endforeach
        </ul>
    </div>
@endsection
