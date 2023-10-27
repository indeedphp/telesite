<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\LikeComment;

class Comment extends Model
{


    protected $fillable = [
        'name',
        'post_id',
        'comment',


    ];


        public function comment_like()
        {
 // dump($this->hasMany(LikeComment::class));
            return $this->hasMany(LikeComment::class);
// dd(123456);
        }
                public function comment_reply()
        {

            return $this->hasMany(Reply::class);
// dd(123456);
        }
    
}
