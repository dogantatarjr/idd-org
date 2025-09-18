<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'article_id' => 'required|exists:articles,id',
            'parent_comment_id' => 'nullable|exists:comments,id',
        ]);

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->article_id = $validated['article_id'];
        $comment->parent_comment_id = $validated['parent_comment_id'] ?? null;
        $comment->user_id = Auth::id();
        $comment->save();

        Article::where('id', $validated['article_id'])->increment('comments');

        return redirect()->back()->with('success-comment', 'Yorum başarıyla eklendi!');
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->content = $validated['content'];
        $comment->save();

        return redirect()->back()->with('success-comment', 'Yorum başarıyla güncellendi!');
    }
}
