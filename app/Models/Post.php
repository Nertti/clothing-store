<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    static function getSingle($id)
    {
        return self::find($id);
    }

    static function getRecord()
    {
        return self::select('posts.*' , 'users.name as user_name', 'category.name as category_name')
            ->join('users', 'users.id', '=','posts.id_user')
            ->join('category', 'category.id', '=','posts.id_category')
            ->orderBy('posts.id', 'asc');
    }
    public function getImage()
    {
        if (!empty($this->image_file) && file_exists('upload/blog/'.$this->image_file)){
            return url('upload/blog/'.$this->image_file);
        }
        else
        {
            return '';
        }
    }
}
