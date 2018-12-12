<?php

namespace App\Transformers;

use App\Markdown\Markdown;
use App\Markdown\Parser;
use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    public function transform(Comment $comment)
    {

        return [
            'id' => $comment->id,
            'name' => $comment->user->name,
            'contents' => $comment->contents,
            'created_at' => $comment->created_at->diffForHumans(),
//            'updated_at' => $comment->updated_at->toDateTimeString(),
        ];
    }
}