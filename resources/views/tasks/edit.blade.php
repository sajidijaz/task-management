@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Task</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Task Name</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $task->name) }}">
            </div>
            <div class="form-group">
                <label for="project_id">Project</label>
                <select class="form-control" id="project_id" name="project_id">
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ (old('project_id', $task->project_id) == $project->id) ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Task</button>
        </form>
    </div>
@endsection
