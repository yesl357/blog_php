<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Transformers\CommentTransformer;
use Illuminate\Support\Facades\DB;

//use Dingo\Api\Http\Request;

class CommentsController extends Controller
{
    public function store(Article $article, CommentRequest $request)
    {
        $data = [
            'user_id' => $this->user->id,
            'article_id' => $article->id,
            'contents' => $request->contents,
            'created_at' => now(),
        ];
        DB::table('comments')->insert($data);
        return $this->response->created();
    }

    public function index(Article $article)
    {
        $data = Comment::query()->where('article_id', $article->id)->orderBy('id', 'desc')->get();
        return $this->response->collection($data, new CommentTransformer());
    }
}
