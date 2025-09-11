<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponder;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    use ApiResponder;

    /**
     * Menampilkan daftar semua project.
     */
    public function index()
    {
        // Ambil semua project beserta data pembuatnya untuk efisiensi query
        $projects = Project::with('creator:id,name,email')->latest()->get();
        return $this->successResponse($projects, 'Projects fetched successfully');
    }

    /**
     * Menyimpan project baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'technologies' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        $project = Project::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'technologies' => $validatedData['technologies'],
            'image' => $imagePath,
            'created_by' => Auth::id(),
        ]);

        return $this->successResponse($project, 'Project created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return $this->successResponse($project->load('creator:id,name,email'), 'Project fetched successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'technologies' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validatedData['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validatedData);

        return $this->successResponse($project, 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return $this->successResponse(null, 'Project deleted successfully');
    }
}
