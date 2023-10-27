<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\LikeComment;
use App\Models\LikeReply;
// use Illuminate\Http\Request;

class LikeController extends Controller
{


// ------------------обрабатываем запрос на лайк к посту-------------------------------
    public function create($post_id) // функция принимает номер поста
    {
        $parts = parse_url(request()->server('HTTP_REFERER'));
        if( empty ($parts['query'])) $parts['query'] = 'page=1';
        $name = auth()->user()->name; // получаем имя юзера
$posts = Like::where('post_id',$post_id)->get();  // получаем все лайки с поста
$flag = true; // флаг для проверки есть ли лайк
foreach ($posts as $post){  // перебираем все лайки
    if($post->name == $name){ // если имя из базы такое же как и лайкающий то
       Like::where('post_id',$post_id)->delete();  // удаляем лайк
       $flag = false;  // флаг меняем
   }
}
if($flag)  // если флаг тру пишем в базу лайк
 Like::create(['name' => $name,'like_post' => 1, 'post_id' => $post_id,]);
// return redirect()->route('welcome'); // редирект на главную
return redirect()->route('welcome', $parts['query'].'#anchor'.$post_id);
}


// --------------------обрабатываем лайки на коментарии---------------------------
public function create_like_comm($comment_id, $post_id)  //функция принимает номер коментария
{
    $parts = parse_url(request()->server('HTTP_REFERER'));
    if( empty ($parts['query'])) $parts['query'] = 'page=1';
    $name = auth()->user()->name;  // получаем имя юзера
$comments = LikeComment::where('comment_id',$comment_id)->get();  // получаем все лайки с коментария
$flag = true;  // флаг для проверки есть ли лайк
foreach ($comments as $comment){  // перебираем все лайки
    if($comment->name == $name and $comment->like_post == 0 ){  // если имя из базы такое же как и лайкающий то

        $comment = LikeComment::find($comment->id);
$comment->like_post = 1;  // в колонке титле меняем запись на новую
$comment->save();  // сохраняем
$flag = false; // флаг меняем
}
    elseif($comment->name == $name and $comment->like_post == 1 ){  // если имя из базы такое же как и лайкающий то
        $comment = LikeComment::find($comment->id);
$comment->like_post = 0;  // в колонке титле меняем запись на новую
$comment->save();  // сохраняем
$flag = false; // флаг меняем
}

    }
 // dd($flag);
if($flag) // если флаг тру пишем в базу лайк
    LikeComment::create(['name' => $name,'like_post' => 1, 'comment_id' => $comment_id,]);
 session(['collapse' =>  $post_id]); // для открытия коментариев по умолчанию используем сессию
// return redirect()->route('welcome'); // редирект на главную
return redirect()->route('welcome', $parts['query'].'#anchor'.$post_id);
}


// --------------обрабатываем дизлайки на коментарии-----------------------
public function create_dislike_comm($comment_id, $post_id)  //функция принимает номер коментария
{

     $parts = parse_url(request()->server('HTTP_REFERER'));
if( empty ($parts['query'])) $parts['query'] = 'page=1';
// dd ( $parts['query']);
    $name = auth()->user()->name;  // получаем имя юзера
$comments = LikeComment::where('comment_id',$comment_id)->get();  // получаем все из базы с коментария
$flag = true;  // флаг для проверки есть ли запись в базе
foreach ($comments as $comment){  // перебираем все лайки
    if($comment->name == $name and $comment->dislike_post == 0 ){  // если имя из базы такое же как и лайкающий то
        $comment = LikeComment::find($comment->id);
$comment->dislike_post = 1;  // в колонке титле меняем запись на новую
$comment->save();  // сохраняем
$flag = false; // флаг меняем
}
    elseif($comment->name == $name and $comment->dislike_post == 1 ){  // если имя из базы такое же как и лайкающий то
        $comment = LikeComment::find($comment->id);
$comment->dislike_post = 0;  // в колонке титле меняем запись на новую
$comment->save();  // сохраняем
$flag = false; // флаг меняем
}

    }

if($flag) // если флаг тру пишем в базу лайк
    LikeComment::create(['name' => $name,'dislike_post' => 1, 'comment_id' => $comment_id,]);
 session(['collapse' =>  $post_id]); // для открытия коментариев по умолчанию используем сессию
// return redirect()->route('welcome'); // редирект на главную
return redirect()->route('welcome', $parts['query'].'#anchor'.$post_id);
}

// ---------------обрабатываем дизлайки ответов на комментарии--------------------
public function create_dislike_reply($reply_id, $comment_id, $post_id)  //функция принимает номер коментария
{

      $parts = parse_url(request()->server('HTTP_REFERER'));
        if( empty ($parts['query'])) $parts['query'] = 'page=1';
    // dd($reply_id, $comment_id, $post_id);
    $name = auth()->user()->name;  // получаем имя юзера
    $replys = LikeReply::where('reply_id',$reply_id)->get();
$flag = true;
    foreach ($replys as $reply){
// dd($reply->name, $reply, $name, $reply->dislike);
    if($reply->name == $name and $reply->dislike == 0 ){  // если имя из базы такое же как и лайкающий то
         // dd(444435);
        $comment = LikeReply::find($reply->id);
$reply->dislike = 1;  // в колонке титле меняем запись на новую
$reply->save();  // сохраняем
$flag = false; // флаг меняем
}
    elseif($reply->name == $name and $reply->dislike == 1 ){  // если имя из базы такое же как и лайкающий то
         // dd(4444356);
        $reply = LikeReply::find($reply->id);
$reply->dislike = 0;  // в колонке титле меняем запись на новую
$reply->save();  // сохраняем
$flag = false; // флаг меняем
}

    }

if($flag) LikeReply::create(['name' => $name,'dislike' => 1, 'reply_id' => $reply_id,]);
 session(['collapse' =>  $post_id]); // для открытия коментариев по умолчанию используем сессию
// dd(4444);
return redirect()->route('welcome', $parts['query'].'#anchor'.$post_id);
}

// ---------------обрабатываем лайки ответов на комментарии--------------------
public function create_like_reply($reply_id, $comment_id, $post_id)  //функция принимает номер коментария
{


      $parts = parse_url(request()->server('HTTP_REFERER'));
        if( empty ($parts['query'])) $parts['query'] = 'page=1';
    $name = auth()->user()->name;  // получаем имя юзера


    $replys = LikeReply::where('reply_id',$reply_id)->get();
$flag = true;
    foreach ($replys as $reply){
// dd($reply->name, $reply, $name, $reply->dislike);
    if($reply->name == $name and $reply->like == 0 ){  // если имя из базы такое же как и лайкающий то
         // dd(444435);
        $comment = LikeReply::find($reply->id);
$reply->like = 1;  // в колонке титле меняем запись на новую
$reply->save();  // сохраняем
$flag = false; // флаг меняем
}
    elseif($reply->name == $name and $reply->like == 1 ){  // если имя из базы такое же как и лайкающий то
         // dd(4444356);
        $reply = LikeReply::find($reply->id);
$reply->like = 0;  // в колонке титле меняем запись на новую
$reply->save();  // сохраняем
$flag = false; // флаг меняем
}

    }




 if($flag)LikeReply::create(['name' => $name,'like' => 1, 'reply_id' => $reply_id,]);
// dd($reply_id, $comment_id);
 session(['collapse' =>  $post_id]); // для открытия коментариев по умолчанию используем сессию
return redirect()->route('welcome', $parts['query'].'#anchor'.$post_id);
}











}







// //////////////////////////////////////////// Обновление записи с изменением времени обновления в колонке
//    public function update(Request $request, User $user)  // то что приходит с формы и ид с формы обработаный в юзере
//     {
//        $user->update($request->only(['name','email']));  // обновляем в базе
//     }
// //////////////////////////
// $post = Post::find(3); // обращаемся к таблице пост , ид 3
// $post->title = 'new title';  // в колонке титле меняем запись на новую
// $post->save();  // сохраняем
//
// $flight = Flight::create([
//     'name' => 'London to Paris',
// ]);,'#anchor'.$message_id
//     public function create(Request $request)
//     {
//         {
//             // dd($request);
//             $q = $request->input('post_id');

//             Comment::create($request->only(['name', 'comment', 'post_id']));
//         }
//         // return redirect()->route('welcome');
//         return redirect()->route('welcome','#anchor'.$q);
//     }
//
//     // обрабатываем лайки на коментарии
// public function create_like_comm($comment_id)  //функция принимает номер коментария
// {
//     $name = auth()->user()->name;  // получаем имя юзера
// $comments = LikeComment::where('comment_id',$comment_id)->get();  // получаем все лайки с коментария
// $flag = true;  // флаг для проверки есть ли лайк
// foreach ($comments as $comment){  // перебираем все лайки
//     if($comment->name == $name){  // если имя из базы такое же как и лайкающий то
//         LikeComment::where('comment_id',$comment_id)->delete(); // удаляем лайк
//         $flag = false; // флаг меняем
//     }
// }
// if($flag) // если флаг тру пишем в базу лайк
//     LikeComment::create(['name' => $name,'like_post' => 1, 'comment_id' => $comment_id,]);
// return redirect()->route('welcome'); // редирект на главную
// }
//
//
// http://telesite/?page=3#anchor13