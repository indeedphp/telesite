<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\LikeReply;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;

class WelcomeController extends Controller
{

    public function welcome(Request $request)
    {
        // $arr_posts = cache('key');  // Смотрим в кеш
        // if($arr_posts == null) {  // если кеш пустой
        $q = 0;
        $qq = 0;
        $qqq = 0;
        $qqqq = 0;
        $w = 0;
        $ww = 0;
        $posts = Post::orderBy('id', 'desc')->paginate(5); // вытаскиваем все посты

        // dd($posts);
        foreach ($posts as $post) { // перебираем посты
            $post->comment_plus(); //прибавляем коментарии, применяя функцию из модели пост
            $qqqq += count($post->comment_plus);
            foreach ($post->comment_plus as $comment) { // перебираем коментарии
                $comment->comment_like(); // прибавляем лайки к коментариям, применяя функцию из модели комент
                $comment->comment_reply(); // прибавляем ответы к коментариям
                foreach ($comment->comment_reply as $comment_reply) {
                    $comment_reply->like_reply;
                    // dd(111);
                    foreach ($comment_reply->like_reply as $like_reply) {
                        if ($like_reply->like == 1)
                            $w++;
                        if ($like_reply->dislike == 1)
                            $ww++;
                        // dump($w++);
                    }

                    $comment_reply->like = $w;
                    $comment_reply->dislike = $ww;
                    $ww = 0;
                    $w = 0;
                }


                $qqq += count($comment->comment_reply);
                foreach ($comment->comment_like as $comment_like) {
                    if ($comment_like->like_post == 1)
                        $q++;
                    if ($comment_like->dislike_post == 1)
                        $qq++;
                }
                $comment->like = $q;
                $comment->dislike = $qq;
                $q = 0;
                $qq = 0;
            }
            $post->like_plus; //прибавляем лайки коментариев, применяя функцию из модели пост
            $post->like = count($post->like_plus); // считаем количество в массиве и записываем в объект пост
            $post->comment = $qqq + $qqqq;
            // dump($qqq);
            $arr_posts[] = $post->toArray(); // складываем в массив
            $qqq = 0;
            $qqqq = 0;
        }

        // Cache::add('key', $arr_posts, $seconds=10);
// }
// dd($arr_posts);
        $collapse = $request->session()->pull('collapse');
        // dump($value);
        return view('welcom', compact('arr_posts', 'posts', 'collapse')); // возрращаем вблейд массив
    }


}



//     public function welcome()
//     {
//         // $arr_posts = cache('key');  // Смотрим в кеш
//         // if($arr_posts == null) {  // если кеш пустой
//         $q = 0;
//         $qq = 0;
//  $qqq = 0;
//  $qqqq  = 0;
// $posts = Post::orderBy('id', 'desc')->paginate(5);  // вытаскиваем все посты

// // dd($posts);
// foreach ($posts as $post) {  // перебираем посты
// $post->comment_plus();  //прибавляем коментарии, применяя функцию из модели пост
// $qqqq += count($post->comment_plus);
// foreach ($post->comment_plus as $comment) { // перебираем коментарии
// $comment->comment_like(); // прибавляем лайки к коментариям, применяя функцию из модели комент
// $comment->comment_reply();  // прибавляем ответы к коментариям
// $qqq += count($comment->comment_reply);
// foreach ($comment->comment_like as $comment_like) {
//     if($comment_like->like_post == 1) $q++;
//     if($comment_like->dislike_post == 1) $qq++;
// }
// $comment->like = $q;
// $comment->dislike = $qq;
// $q = 0;
// $qq = 0;
// }
// $post->like_plus;  //прибавляем лайки коментариев, применяя функцию из модели пост
// $post->like = count($post->like_plus); // считаем количество в массиве и записываем в объект пост
// $post->comment = $qqq+$qqqq;
// // dump($qqq);
// $arr_posts[] = $post->toArray(); // складываем в массив
// $qqq = 0;
// $qqqq = 0;
// }

// // Cache::add('key', $arr_posts, $seconds=10);
// // }
// // dd($arr_posts);

// return view('welcom', compact('arr_posts', 'posts')); // возрращаем вблейд массив
// }
