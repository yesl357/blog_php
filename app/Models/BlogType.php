<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sort', 'img_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $table = 'blog_types';


    public static function boot()
    {
        parent::boot();
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
