<?php

namespace App\Transformers;

use App\Models\BlogType;
use League\Fractal\TransformerAbstract;

class BlogTypeTransformer extends TransformerAbstract
{
    public function transform(BlogType $type)
    {
        return [
            'id' => $type->id,
            'name' => $type->name,
            'sort' => $type->sort,
            'desc' => $type->desc,
            'img_path' => $this->imgurl($type->img_path),
            'created_at' => $type->created_at->toDateTimeString(),
            'updated_at' => $type->updated_at->toDateTimeString(),
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