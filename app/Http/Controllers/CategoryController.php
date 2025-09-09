<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $articles = Article::with('user')
            ->status('active')->where('category_id', $id)
            ->latest()
            ->paginate(3);

        $categories = Category::all();

        return view(
            'frontend.blog.show-category-articles',
            compact('category', 'articles', 'categories')
        );
    }

    public function update(Request $request) {
        $category = Category::findOrFail($request->id);

        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        if ($request->status == 'passive') {
            $category->articles()->update(['status' => 'passive']);
        } else {
            $category->articles()->update(['status' => 'active']);
        }

        return redirect()->back()->with('success-category', 'Kategori güncellendi!');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'status' => 'required|string|in:active,passive',
        ]);

        Category::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success-category', 'Kategori başarıyla eklendi!');
    }

}
