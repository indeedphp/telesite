<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Автоэлектрики</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap-icons-1.10.5/font/bootstrap-icons.min.css">
</head>
<header>

    <body>

      <nav class="navbar "  style = "background-color : #800000"; >

        <a class="navbar-brand text-white" href="{{ route('welcome') }}">Автоэлектрики</a>
        <ul class="nav justify-content-end">

            @auth

            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('cabinet') }}"><i class="bi bi-calendar2-event"></i> Вы в панели администриравания {{Auth::user()->name}}</a>
            </li>


            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                    @csrf
                    <input class="nav-link  text-white btn btn-link" type="submit" name="formS" value=" Выход" />
                </form>
            </li>

            <li class="nav-item">
                @else
                <a class="nav-link text-white" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Вход</a>
            </li>
            <li class="nav-item">
                @if (Route::has('register'))
                <a class="nav-link text-white" href="{{ route('register') }}"><i class="bi bi-bookmark-star"></i>  Регистрация</a>

                @endif
                @endauth
            </li>
        </ul>
    </nav>
</header>

<ul class="nav nav-tabs">

      <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{ route('admin') }}">Основное</a>
  </li>

  <li class="nav-item">
    <a class="nav-link"  href="{{ route('admin_user') }}">Пользователи</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin_post') }}">Посты</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin_comm') }}">Комментарии</a>
  </li>

</ul>

<div class="container">
 <p>Админка сайта автоэлектрик</p>

<p>Число пользователей {{count($users)}}</p>
<p>Подключилось в последний месяц </p>

<p>Количество постов {{count($posts)}}</p>
<p>Количество постов за последний месяц </p>
<p>Всего комментариев {{count($comment)}}</p>
<p>Всего ответов на комментарии {{count($reply)}}</p>
<p>Всего комментариев и ответов на комментарии {{count($reply)+count($comment)}}</p>
<p>Размер хранилища фото </p>
<p>Всего забанено пользователей {{$ban}}</p>
<p>Всего забанено коментариев  </p>
<p>Время сервера {{date('i:H d-m-Y')}}</p>
<p>Адрес сервера {{$addr}}</p>


</div>




<main>

</body>
</html>
