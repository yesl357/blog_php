<?php

namespace App\Transformers;

use App\Markdown\Markdown;
use App\Markdown\Parser;
use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    public function transform(Article $article)
    {
        $markdown = new Markdown(new Parser());
        return [
            'id' => $article->id,
            'type' => $article->blogType->name,
            'title' => $article->title,
            'desc' => $article->desc,
            'author' => $article->author,
            'img' => $this->imgurl($article->img),
            'content' => $markdown->markdown($article->content),
            'reply' => $article->reply,
            'looked' => $article->looked,
            'created_at' => $article->created_at->diffForHumans(),
            'updated_at' => $article->updated_at->toDateTimeString(),
        ];
    }

    private function imgurl($url)
    {
        if (strpos($url, 'http') !== 0) {
            return env('APP_URL').'/uploads/'.$url;
        } else {
            return $url;
        }
    }
}