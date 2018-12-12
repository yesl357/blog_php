<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Models\BlogType;
use App\Transformers\ArticleTransformer;
use App\Transformers\BlogTypeTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ArticleController extends Controller
{
    public function recommend()
    {
        $data = Article::query()->orderBy('id', 'desc')->with(['blogType'])->limit(10)->get();
        return $this->response->collection($data, new ArticleTransformer());
    }

    public function typeIndex(Request $request)
    {
        $data = BlogType::query()->get();
        return $this->response->collection($data, new BlogTypeTransformer());
    }

    public function index(Request $request, BlogType $blogType)
    {
        $data = Article::query()->where(['blog_type_id' => $blogType->id])->orderBy('id', 'desc')->with(['blogType'])->paginate(5);
        return $this->response->paginator($data, new ArticleTransformer());
    }

    public function show(Request $request, Article $article)
    {
        $data = Article::query()->where(['id' => $article->id])->first();

        return $this->response->item($data, new ArticleTransformer());
    }
}
