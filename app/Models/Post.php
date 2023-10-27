<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Like;
use App\Models\Comment;

class Post extends Model
{



        public function comment_plus()
        {

            return $this->hasMany(Comment::class);
// dd(123456);
        }



        public function like_plus()
        {

            return $this->hasMany(Like::class);
// dd(1);
        }




   protected $fillable = [
        'like',
        'comment',
        'id',


    ];



}