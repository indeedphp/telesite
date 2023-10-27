<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Reply;
use App\Models\LikeReply;
use Illuminate\Http\Request;

class AdminController extends Controller
{
 //----ADMIN ГЛАВНАЯ СТРАНИЦА-----------------------------------------------------------------------
    public function admin(Request $request)
    {
        $addr = $request->server('SERVER_ADDR');
        $users = User::all();
        $ban = User::where('activ', 1)->get();
        $ban = (count($ban));
        $posts = Post::all();
        $comment = Comment::all();
        $reply = Reply::all();
        return view('admin_main', compact('users', 'posts', 'comment', 'reply', 'addr', 'ban')); // возрращаем вблейд массив
    }
 //----ADMIN СТРАНИЦА ЮЗЕРОВ С СОРТИРОВКОЙ И ПОИСКОМ-----------------------------------------------------------------------
    public function admin_user(Request $request)
    {
        $sort = 0;
        if ($request->sorting == 'date' && ($request->sort == 1 || $request->sort == 2)) {
            $users = User::orderBy('created_at', 'desc')->get();
            $sort = 3;
        } else if ($request->sorting == 'date' && ($request->sort == 1 || $request->sort == 3)) {
            $users = User::orderBy('created_at', 'asc')->get();
            $sort = 2;
        } else if ($request->sorting == 'name' && ($request->sort == 1 || $request->sort == 2)) {
            $users = User::orderBy('name', 'desc')->get();
            $sort = 3;
        } else if ($request->sorting == 'name' && ($request->sort == 1 || $request->sort == 3)) {
            $users = User::orderBy('name', 'asc')->get();
            $sort = 2;
        } else if ($request->sorting == 'email' && ($request->sort == 1 || $request->sort == 2)) {
            $users = User::orderBy('email', 'desc')->get();
            $sort = 3;
        } else if ($request->sorting == 'email' && ($request->sort == 1 || $request->sort == 3)) {
            $users = User::orderBy('email', 'asc')->get();
            $sort = 2;
        } else if ($request->sorting == 'ban' && ($request->sort == 1 || $request->sort == 2)) {
            $users = User::orderBy('activ', 'desc')->get();
            $sort = 3;
        } else if ($request->sorting == 'ban' && ($request->sort == 1 || $request->sort == 3)) {
            $users = User::orderBy('activ', 'asc')->get();
            $sort = 2;
        } else if ($request->sorting == 'id' && ($request->sort == 1 || $request->sort == 2)) {
            $users = User::orderBy('id', 'desc')->get();
            $sort = 3;
        } else if ($request->sorting == 'id' && ($request->sort == 1 || $request->sort == 3)) {
            $users = User::orderBy('id', 'asc')->get();
            $sort = 2;
        } else if (isset($request->user_search)) {
            $users = User::where('name', $request->user_search)->get();
        } else if (isset($request->date_search)) {
            $users = User::where('created_at', $request->date_search)->get();
        } else if (isset($request->email_search)) {
            $users = User::where('email', $request->email_search)->get();
        } else {
            $users = User::all();
            $sort = 1;
        }

        return view('admin_user', compact('users', 'sort')); // возрращаем вблейд массив
    }
 //----ADMIN СТРАНИЦА ПОСТОВ-----------------------------------------------------------------------
    public function admin_post(Request $request)
    {
        $posts = Post::orderBy('id', 'desc')->paginate(50); // вытаскиваем все посты

        return view('admin_post', compact('posts')); // возрращаем вблейд массив
    }
 //----ADMIN СТРАНИЦА ККОММЕНТАРИЕВ-----------------------------------------------------------------------
    public function admin_comm(Request $request)
    {
        $comments = Comment::all(); // вытаскиваем все посты
        return view('admin_comm', compact('comments')); // возрращаем вблейд массив
    }

    //----USER КРУД-----------------------------------------------------------------------

    public function admin_user_update(Request $request)
    {
        $user_id = $request->input('user_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $user = User::find($user_id);
        $user->name = $name;
        $user->email = $email;
        $user->save(); // сохраняеadmin_userм
        return redirect()->route('admin_user');
    }

    public function admin_user_ban(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        if ($user->activ == 0)
            $user->activ = 1;
        else
            $user->activ = 0;
        $user->save(); // сохраняеadmin_userм

        return redirect()->route('admin_user');
    }

    public function admin_user_delete(Request $request)
    {
        User::find($request->input('user_id'))->delete();
        return redirect()->route('admin_user');
    }

    //------ ЗАПРОСЫ СО СТРАНИЦ ПО КОНКРЕТНЫМ ЮЗЕРАМ ПОСТАМ КОММЕНТАМ--------------------------------------------------------

    public function admin_post_get_comment(Request $request, $get)
    {
        $comments = Comment::where('post_id', $get)->get();

        return view('admin_get', compact('comments')); // возрращаем вблейд массив
    }

    public function admin_get_reply(Request $request, $get)
    {
        $replys = Reply::where('comment_id', $get)->get();
        return view('admin_get_reply', compact('replys')); // возрращаем вблейд массив
    }

    public function admin_get_user_post(Request $request, $name)
    {
        $posts = Post::where('username', $name)->get();
        return view('admin_get_user_post', compact('posts')); // возрращаем вблейд массив
    }

    public function admin_get_user_comm(Request $request, $name)
    {
        $comments = Comment::where('name', $name)->get();
        return view('admin_get_user_comm', compact('comments')); // возрращаем вблейд массив
    }

    //--------COMMENT--------------------------------------------------------------------------

    public function admin_comment_update(Request $request)
    {
        // dd($request);
        $name = $request->input('name');
        $user_id = $request->input('user_id');
        $post_id = $request->input('post_id');
        $comment_id = $request->input('comment_id');
        $text = $request->input('text');
        $comment = Comment::find($comment_id); // Через модель копируем строку таблицы в переменную
        $comment->comment = $text; // в колонке таблицы меняем запись на новую
        $comment->save(); // сохраняем
        return redirect()->route('admin_get_user_comm', $name);
    }

    public function admin_comment_ban(Request $request)
    {
        // dd($request);
        $name = $request->input('user_name');
        $comment_id = $request->input('comment_id');
        $post_id = $request->input('post_id');
        $comment = Comment::find($comment_id); // Через модель копируем строку таблицы в переменную
        if ($comment->activ == 0)
            $comment->activ = 1; // в колонке таблицы меняем запись на новую
        else
            $comment->activ = 0; // в колонке таблицы меняем запись на новую
        $comment->save(); // сохраняем
        return redirect()->route('admin_get_user_comm', $name);
    }

    public function admin_comment_delete(Request $request)
    {
        // dd($request);
        $name = $request->input('name');
        Comment::find($request->input('comment_id'))->delete();
        return redirect()->route('admin_get_user_comm', $name);
    }


    //---------POST-------------------------------------------------------------------------------

    public function admin_post_update(Request $request)
    {
        // dd($request);
        $address = $request->input('address');
        $user_id = $request->input('user_id');
        $post_id = $request->input('post_id');
        $text = $request->input('text');
        $post = Post::find($post_id);
        $post->text = $text; // в колонке таблицы меняем запись на новую
        $post->save(); // сохраняем
        return redirect()->route($address, $user_id);
    }

    public function admin_post_ban(Request $request)
    {
        // dd($request);
        $address = $request->input('address');
        $user_name = $request->input('user_name');
        $user_id = $request->input('user_id');
        $post_id = $request->input('post_id');
        $post = Post::find($post_id);
        if ($post->activ == 0)
            $post->activ = 1;
        else
            $post->activ = 0;
        $post->save(); // сохраняеadmin_userм
        return redirect()->route($address, $user_name);
    }

    public function admin_post_delete(Request $request)
    {
        // dd($request);
        $post_id = $request->input('post_id');
        $user_id = $request->input('user_id');
        Post::find($post_id)->delete();
        return redirect()->route('admin_get_user_post', $user_id);
    }

    //---------------------------------------------------------------------

    // public function del(Request $request)
    // { {
    //         Post::find($request->input('post_id'))->delete(); // без полученияхаписи из таблицы
    //     }
    //     return redirect()->route('cabinet');
    // }

}
