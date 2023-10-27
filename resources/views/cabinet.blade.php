<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Автоэлектрики</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<header>
    <body>

      <nav class="navbar "  style = "background-color : #800000"; >

        <a class="navbar-brand text-white" href="{{ route('welcome') }}">Автоэлектрики</a>
        <ul class="nav justify-content-end">

                @auth

 <li class="nav-item">
                <a class="nav-link text-white" href="/">Главная</a>
            </li>


                <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                    @csrf
                    <input class="nav-link  text-white btn btn-link" type="submit" name="formS" value=" Выход" />
                </form>
            </li>


                @endauth
            </li>
        </ul>
    </nav>
</header>
<main>


      @auth
   @if (Auth::user()->name == 'admin')
          <a  href="{{ route('admin') }}"> админка </a>

                @endif



                @endauth



<div>Вы находитесь в своем кабинете, здесь редактировать посты и удалять их.</div>

<p>Редактировать свой пост.</p>
<form action="{{route('post_edit')}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method ('PUT')
  <input type="hidden" name="id" value="{{ isset($post->id) ? $post->id : 'Правки поста' }}">
 <textarea cols="60" rows="5" name="textarea_post" >{{ isset($post) ? $post->text : 'Правки поста' }}</textarea>
<p>загрузить фото</p>
 <input type="file" name="image" id="image">
  <input type="submit">
</form>


   <form method="POST"  action="{{route('post_del')}}">
    @csrf
    @method('DELETE')
    <input type="hidden" name="post_id"  value="{{ isset($post->id) ? $post->id : 'Правки поста' }}">

    <button class="justify-content-end" type="submit"  > Удалить </button>

</form>


</main>
<footer>
</footer>
</body>
</html>
