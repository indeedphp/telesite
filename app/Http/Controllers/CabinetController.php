<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CabinetController extends Controller
{


    public function edit($id_post)
    {
        $post = Post::where('id', $id_post)->first(); // одна запись с ид 1
        return view('cabinet', compact('post'));
    }


    public function view()
    {

        return view('cabinet');
    }


    public function edit_post(Request $request)
    {
        // dd($request);
        $q = $request->input('id');
        $pos = $request->input('textarea_post');

        $post = Post::find($q);
        // dd($post);
        $post->text = $pos; // в колонке титле меняем запись на новую
        $post->save(); // сохраняем



        $post = (object) ['text' => $pos];


        return view('cabinet', compact('post'));
    }

    public function del(Request $request)
    { {
            $link = $request->server('HTTP_REFERER');
            // $post_id = $request->input('post_id');
// dd($request);
            Post::find($request->input('post_id'))->delete(); // без полученияхаписи из таблицы

        }
        // return redirect()->route('welcome');
        if ($link == 'http://telesite/admin_post') {
            return redirect()->route('admin_post');
        } else
            return redirect()->route('cabinet');



    }








}
