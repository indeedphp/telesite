<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Like extends Model
{
    use HasFactory;



    protected $fillable = [
        'name',
        'post_id',
        'like_post',
        'dislike_post',

    ];


    //     protected $hidden = [
    //     'created_at',
    //     'updated_at',
    //     'id',
    //     'like_post',
    //     'dislike_post',

    // ];

    //  protected $attributes = [
    //     'delayed' => false,
    // ];
}

