<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{

    public function index(Request $request): Factory|Application|View|FoundationApplication
    {
        $projects = Project::all();
        $selectedProjectId = $request->project_id;
        if ($selectedProjectId) {
            $tasks = Task::where('project_id', $selectedProjectId)->orderBy('priority', 'asc')->get();
        } else {
            $tasks = Task::orderBy('priority', 'asc')->get();
        }
        return view('tasks.index', compact('tasks', 'projects', 'selectedProjectId'));
    }

    public function create(): Factory|Application|View|FoundationApplication
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $task = Task::create([
                                 'name' => $request->name,
                                 'priority' => (Task::max('priority') ?? 0) + 1,
                                 'project_id' => $request->project_id
                             ]);
        if ($task) {
            return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
        } else {
            return back()->withErrors('Failed to create the task.');
        }
    }

    public function edit(Task $task): Factory|Application|View|FoundationApplication
    {
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(TaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function reorder(Request $request): JsonResponse
    {
        $order = $request->order;
        foreach ($order as $item) {
            $task = Task::find($item['id']);
            if ($task) {
                $task->priority = $item['priority'];
                $task->save();
            }
        }
        return response()->json(['status' => 'success', 'message' => 'Tasks reordered successfully!']);
    }
}
