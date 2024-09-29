<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Functions\Helper;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // gestione searchbar
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $projects = Project::where('title', 'LIKE', '%' . $search . '%')->orderBy('id', 'desc')->paginate(10);
            $projects->appends(request()->query());
            return view('admin.projects.index', compact('projects'));
        }


        $projects = Project::paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();

        $new_project = new Project;
        $data['slug'] = Helper::generateSlug($data['title'], Project::class);

        // gestione img
        if(array_key_exists('cover_img', $data)){
            $image = Storage::put('uploads', $data['cover_img']);
            $original_name= $request->file('cover_img')->getClientOriginalName();
            $data['cover_img'] = $image;
            $data['original_img_name'] = $original_name;
        }

        $new_project->fill($data);
        $new_project->save();

        if(array_key_exists('technologies', $data)){
            $new_project->technology()->attach($data['technologies']);
        }

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

        $technologies = Technology::all();
        return view('admin.projects.edit', compact('projects', 'types', 'technologies'));
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

        // gestione img
        if(array_key_exists('cover_img', $data)){
            $image = Storage::put('uploads', $data['cover_img']);
            $original_name= $request->file('cover_img')->getClientOriginalName();
            $data['cover_img'] = $image;
            $data['original_img_name'] = $original_name;
            if($projects->cover_img) {
                Storage::delete($projects->cover_img);
            };
        }

        $projects->update($data);

        if(array_key_exists('technologies', $data)){
            $projects->technology()->sync($data['technologies']);
        }else {
            $projects->technology()->detach();
        }

        return redirect()-> route('admin.projects.show', $projects);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projects = Project::find($id);

        if($projects->cover_img) {
            Storage::delete($projects->cover_img);
        };

        $projects->delete();

        return redirect()->route('admin.projects.index')->with('deleted', 'Il progetto ' . $projects->title . ' è stato eliminato');
    }
}
