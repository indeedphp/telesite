<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class LikeComment extends Model
{
    use HasFactory;

      protected $fillable = [
        'name',
        'post_id',
        'comment_id',
        'like_post',
        'dislike_post',

    ];
}
