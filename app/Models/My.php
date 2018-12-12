<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class My extends Model
{
    protected $table = 'mys';

    public static function boot()
    {
        parent::boot();
    }

    protected $fillable = [
        'author', 'content',
    ];

    protected $hidden = [

    ];
}
