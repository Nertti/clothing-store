<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'post';

    static function getSingle($id)
    {
        return self::find($id);
    }

    static function getRecord()
    {
        return self::select('posts.*')
            ->orderBy('posts.id', 'asc');
    }
}
