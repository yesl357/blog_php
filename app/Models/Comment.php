<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public static function boot()
    {
        parent::boot();
    }

    protected $fillable = [
        'user_id', 'article_id', 'contents', 'agrees', 'refuses'
    ];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

}
