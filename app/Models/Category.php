<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    static function getSingle($id)
    {
        return self::find($id);
    }

    static function getRecordCategory()
    {
        return self::select('category.*')
            ->orderBy('category.id', 'asc');
    }
    static function getCategory()
    {
        return self::select('category.*')
            ->where('status','=', '1');
    }
}
