<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel Task Manager') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportContent" aria-controls="navbarSupportContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('tasks') ? 'active' : '' }}" href="{{ route('tasks.index') }}">Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('projects') ? 'active' : '' }}" href="{{ route('projects.index') }}">Projects</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
