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

        if ($category->status != 'active') {
            return redirect()->route('blog')->with('error-inactive', 'Bu kategori şu anda aktif değil.');
        }

        $articles = Article::with('category')
            ->status('active')->where('category_id', $id)
            ->latest()
            ->paginate(3);

        return view(
            'frontend.blog.show-category-articles',
            compact('category', 'articles')
        );
    }

    public function update(Request $request) {
        $category = Category::findOrFail($request->id);

        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        if($request->status == 'active' && $category->articles()->where('status', 'active')->count() === 0) {
            return redirect()->back()->with('fail-category', 'Kategori aktif yapılmak isteniyor ancak bu kategoride aktif bir makale bulunmamaktadır. Lütfen önce bu kategoriye ait en az bir makaleyi aktif yapınız.');
        } else if ($request->status == 'passive') {
            $category->articles()->update(['status' => 'passive']);
        } else {
            $category->articles()->update(['status' => 'active']);
        }

        return redirect()->back()->with('success-category', 'Kategori başarıyla güncellendi!');
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
