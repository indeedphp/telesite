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
    <a class="nav-link" href="{{ route('admin') }}">Основное</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin_user') }}">Пользователи</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin_post') }}">Посты</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin_comm') }}">Комментарии</a>
  </li>

    <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{ route('admin_get_reply') }}">Ответы на комментарии</a>
  </li>

</ul>



<table class="table">
  <thead>
    <tr>
         <th scope="col">id</th>
      <th scope="col">Дата</th>
      <th scope="col">Имя</th>

      <th scope="col">Бан</th>

      <th scope="col">Ответы</th>
      <th scope="col">Заразбанить</th>
      <th scope="col">Изменить</th>
      <th scope="col">Удалить</th>
  </tr>
</thead>
 @foreach ($replys as $reply)
<tbody>
    <tr>
       <th scope="row">{{$reply->id}}</th>

      <td>{{$reply->created_at}}</td>
      <td>{{$reply->name}}</td>
      <td>{{ ($reply->activ == 0) ? 'нет' : 'да' }}</td>


       <td>{{Str::limit($reply->comment, 30) }}</td>
      <td><a href= "?qqq=1">Бан</a></td>
      <td><a href= "?qqq=1">Изменить </a></td>
      <td><a href= "?qqq=1">Удалить </a></td>
  </tr>

</tbody>
@endforeach
</table>







<main>

</body>
</html>



