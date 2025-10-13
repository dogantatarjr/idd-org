<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likeArticle(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
        ]);

        $user = Auth::user();
        $article = Article::findOrFail($request->article_id);

        $existingLike = Like::where('user_id', $user->id)
            ->where('article_id', $article->id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
            $article->decrement('likes');
            $liked = false;
        } else {
            Like::create([
                'user_id' => $user->id,
                'article_id' => $article->id,
            ]);
            $article->increment('likes');
            $liked = true;
        }

        $likeCount = Like::where('article_id', $article->id)->count();

        return response()->json([
            'liked' => $liked,
            'likeCount' => $likeCount,
            'dbLikeCount' => $article->likes
        ]);
    }
}
