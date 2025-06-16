<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author')
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category' => 'required|in:saving_tips,budgeting,investment,debt_management,financial_planning',
            'tags' => 'nullable|array',
            'read_time_minutes' => 'nullable|integer|min:1',
            'is_published' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['author_id'] = auth()->id();

        if ($request->is_published) {
            $data['published_at'] = now();
        }

        $article = Article::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Article created successfully',
            'data' => $article->load('author')
        ], 201);
    }

    public function show($id)
    {
        $article = Article::with('author')->find($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found'
            ], 404);
        }

        // Increment views
        $article->increment('views');

        return response()->json([
            'success' => true,
            'data' => $article
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'content' => 'string',
            'excerpt' => 'nullable|string',
            'category' => 'in:saving_tips,budgeting,investment,debt_management,financial_planning',
            'tags' => 'nullable|array',
            'read_time_minutes' => 'nullable|integer|min:1',
            'is_published' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        if ($request->has('title')) {
            $data['slug'] = Str::slug($request->title);
        }

        if ($request->is_published && !$article->published_at) {
            $data['published_at'] = now();
        }

        $article->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Article updated successfully',
            'data' => $article->load('author')
        ]);
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Article not found'
            ], 404);
        }

        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article deleted successfully'
        ]);
    }

    public function getByCategory($category)
    {
        $articles = Article::with('author')
            ->where('category', $category)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }
}
