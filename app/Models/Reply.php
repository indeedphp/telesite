<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LikeReply;

class Reply extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'comment_id',
        'comment',


    ];



                public function like_reply()
        {
// dd($this->hasMany(LikeReply::class));
            return $this->hasMany(LikeReply::class);

        }






}
