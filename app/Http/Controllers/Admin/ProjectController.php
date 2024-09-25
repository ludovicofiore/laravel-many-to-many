<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Functions\Helper;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();

        $new_project = new Project;
        $data['slug'] = Helper::generateSlug($data['title'], Project::class);

        $new_project->fill($data);
        $new_project->save();

        return redirect()->route('admin.projects.show', $new_project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projects = Project::find($id);

        if(!isset($projects)){
            abort(404);
        }

        return view('admin.projects.show', compact('projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $projects = Project::find($id);

        $types = Type::all();
        return view('admin.projects.edit', compact('projects', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, string $id)
    {
        $data = $request->all();

        $projects = Project::find($id);

        // condizione per slug
        if($data['title'] === $projects->title){
            $data['slug'] = $projects->slug;
        }else {
            $data['slug'] = Helper::generateSlug($data['title'], Project::class);
        };

        $projects->update($data);

        return redirect()-> route('admin.projects.show', $projects);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projects = Project::find($id);

        $projects->delete();

        return redirect()->route('admin.projects.index');
    }
}
