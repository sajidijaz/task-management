@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tasks</h1>
        <div class="mb-3">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>
        </div>

        <div class="mb-3">
            <label for="filter-project">Filter by Project:</label>
            <select id="filter-project" class="form-control" onchange="window.location.href = this.value;">
                <option value="{{ route('tasks.index') }}">All Projects</option>
                @foreach ($projects as $project)
                    <option value="{{ route('tasks.index', ['project_id' => $project->id]) }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <ul id="task-list" class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item" data-id="{{ $task->id }}">
                    {{ $task->name }} (Priority: {{ $task->priority }})
                    <span class="ml-2">Date: {{ $task->created_at }}</span>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-secondary float-right ml-2">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="float-right">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        new Sortable(document.getElementById('task-list'), {
            animation: 150,
            onEnd: function(evt) {
                var items = document.querySelectorAll('#task-list li');
                var order = Array.from(items).map((item, index) => ({
                    id: item.dataset.id, // Assuming each li has data-id attribute
                    priority: index + 1  // Setting priority based on 0-indexed position in the list
                }));
                fetch("{{ route('tasks.reorder') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({order})
                }).then(response => response.json())
                    .then(data => {
                        console.log(data);
                        location.reload(); // Optionally reload the page to reflect the new order
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endsection
