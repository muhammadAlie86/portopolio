<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Traits\ApiResponder;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('user:id,name')->latest()->get();
        return $this->successResponse($articles, 'Articles fetched successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        $article = Article::create([
            'title' => $validatedData['title'],
            'slug' => Str::slug($validatedData['title']) . '-' . time(), // Generate unique slug
            'content' => $validatedData['content'],
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return $this->successResponse($article, 'Article created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return $this->successResponse($article->load('user:id,name'), 'Article fetched successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $validatedData['image'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($validatedData);

        return $this->successResponse($article, 'Article updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();
        return $this->successResponse(null, 'Article deleted successfully', 204);
    }
}
