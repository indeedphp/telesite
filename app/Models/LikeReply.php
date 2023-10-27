<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reply;

class LikeReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'reply_id',
        'like',
        'dislike',

    ];



}
