<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Reply;

class CommentController extends Controller
{


//--------------создание комментария к посту------------------------------
    public function create(Request $request)
    {
        {
            $pos = $request->input();
            dd($pos);
            $post_id = $request->input('post_id');
            $parts = parse_url($request->server('HTTP_REFERER'));
            if( empty ($parts['query'])) $parts['query'] = 'page=1';
            Comment::create($request->only(['name', 'comment', 'post_id']));
        }
        session(['collapse' =>  $post_id]); // для открытия коментариев по умолчанию используем сессию
        return redirect()->route('welcome', $parts['query'].'#anchor'.$post_id);
    }


//--------------------удаление комментария в посте--------------------------
    public function del(Request $request)
    {
        // dd($request);

            $link = $request->server('HTTP_REFERER');
            $parts = parse_url($request->server('HTTP_REFERER'));
            if( empty ($parts['query'])) $parts['query'] = 'page=1';
            $post_id = $request->input('post_id');
  // Comment::find($request->input('comment_id'))->delete();  // без полученияхаписи из таблицы


   if($link == 'http://telesite/admin_comm'){
          return redirect()->route('admin_comm');
        }
        elseif ($link == 'http://telesite/admins/14') {
            return redirect()->route('admin_get');
        }

        else return redirect()->route('welcome', $parts['query'].'#anchor'.$post_id);


}


//--------------------исправление комментария в посте----------------------------
public function update(Request $request)
{
    $parts = parse_url($request->server('HTTP_REFERER'));
    if( empty ($parts['query'])) $parts['query'] = 'page=1';
    $q = $request->input('comment_id');
    $qq = $request->input('comment');
    $post_id = $request->input('post_id');
    $comment = Comment::find($q);
$comment->comment = $qq;  // в колонке титле меняем запись на новую
$comment->save();  // сохраняем
// return redirect()->route('welcome');
session(['collapse' =>  $post_id]); // для открытия коментариев по умолчанию используем сессию
return redirect()->route('welcome',  $parts['query'].'#anchor'.$post_id );
}


//---------------------ответ на комментарий, создание----------------------------
public function create_reply(Request $request)
{
    // dd($request);
    $parts = parse_url($request->server('HTTP_REFERER'));
    if( empty ($parts['query'])) $parts['query'] = 'page=1';
    $post_id = $request->input('post_id');
    session(['collapse' =>  $post_id]); // для открытия коментариев по умолчанию используем сессию
    Reply::create($request->only(['name', 'comment', 'comment_id', 're_name']));
    return redirect()->route('welcome',  $parts['query'].'#anchor'.$post_id );
}


//----------------------исправление ответа на комментарий----------------------
public function update_reply(Request $request)
{
    // dd($request);
    $parts = parse_url($request->server('HTTP_REFERER'));
    if( empty ($parts['query'])) $parts['query'] = 'page=1';
    $q = $request->input('comment_id');
    $qq = $request->input('comment');
    $post_id = $request->input('post_id');
    $comment = Reply::find($q);
$comment->comment = $qq;  // в колонке титле меняем запись на новую
$comment->save();  // сохраняем
session(['collapse' =>  $post_id]); // для открытия коментариев по умолчанию используем сессию
return redirect()->route('welcome', $parts['query'].'#anchor'.$post_id);
}


//------------------------удаление ответа на комментарий-----------------------
public function  del_reply(Request $request)
{
    // dd($request);
    $parts = parse_url($request->server('HTTP_REFERER'));
    if( empty ($parts['query'])) $parts['query'] = 'page=1';
    $post_id = $request->input('post_id');
Reply::find($request->input('comment_id'))->delete();  // без полученияхаписи из таблицы
session(['collapse' =>  $post_id]); // для открытия коментариев по умолчанию используем сессию
return redirect()->route('welcome', $parts['query'].'#anchor'.$post_id);
}



}

// // допустим у нас GET-запрос
// $method = $request->method(); // GET

// if ($request->isMethod('get')) {
//   // true
// }