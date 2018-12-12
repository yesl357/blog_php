<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    public static function boot()
    {
        parent::boot();
    }

    protected $fillable = [
        'blog_type_id', 'title', 'desc', 'author', 'img', 'content', 'reply', 'looked', 'excellent', 'is_show'
    ];

    protected $hidden = [

    ];

    public function blogType()
    {
        return $this->belongsTo(BlogType::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
