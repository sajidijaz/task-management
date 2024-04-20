<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function index(): Factory|Application|View|FoundationApplication
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create(): Factory|Application|View|FoundationApplication
    {
        return view('projects.create');
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        Project::create($request->all());
        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
    }

    public function edit(Project $project): Factory|Application|View|FoundationApplication
    {
        return view('projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }
}
