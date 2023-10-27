<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Автоэлектрики</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap-icons-1.10.5/font/bootstrap-icons.min.css">
</head>
<header>

    <body>

        <nav class="navbar " style = "background-color : #800000";>

            <a class="navbar-brand text-white" href="{{ route('welcome') }}">Автоэлектрики</a>
            <ul class="nav justify-content-end">

                @auth

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('cabinet') }}"><i class="bi bi-calendar2-event"></i>
                            Вы в панели администриравания {{ Auth::user()->name }}</a>
                    </li>


                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input class="nav-link  text-white btn btn-link" type="submit" name="formS" value=" Выход" />
                        </form>
                    </li>

                    <li class="nav-item">
                    @else
                        <a class="nav-link text-white" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i>
                            Вход</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link text-white" href="{{ route('register') }}"><i
                                    class="bi bi-bookmark-star"></i> Регистрация</a>
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
        <a class="nav-link active" aria-current="page" href="">Посты пользователя</a>
    </li>

</ul>



<table class="table">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Дата</th>
            <th scope="col">Имя</th>



            <th scope="col">Текст</th>

            <th scope="col">Бан</th>
            <th scope="col">Комментарии</th>

            <th scope="col">Изменить</th>
            <th scope="col">Удалить</th>
        </tr>
    </thead>
    @foreach ($posts as $post)
        <tbody>
            <tr>
                <th scope="row">{{ $post->id }}</th>

                <td>{{ $post->date }}</td>
                <td>{{ $post->username }}</td>

                <td>{{ Str::limit($post->text, 15) }}</td>
                <td>
                    <form action="{{ route('admin_post_ban') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method ('PUT')
                        <input type="hidden" name="user_name" value="{{ $post->username }}">
                        <input type="hidden" name="address" value="admin_get_user_post">

                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="user_id" value="{{ $post->user_id }}">
                        <input type="submit" value="{{ $post->activ == 0 ? 'Нет' : 'Да' }}">
                    </form>

                </td>

                <td><a href="{{ route('admin_post_get_comment', [$post->id]) }}">Комментарии </a></td>

                <td>
                    <a href="" data-bs-toggle="modal" {{-- в onclick для скрипта передаем значения, идут в форму модалки --}}
                        onclick="deliv('{{ $post->id }}','{{ $post->text }}','{{ $post->user_id }}')"
                        data-bs-target="#ModalUpgate"> Исправить
                    </a>
                </td>
                <td>
                    <a href="" data-bs-toggle="modal" {{-- в onclick для скрипта передаем значения, идут в форму модалки --}}
                        onclick="deliv('{{ $post->id }}','{{ $post->user_id }}')"
                        data-bs-target="#ModalDelete"> Удалить
                    </a>
                </td>
            </tr>

        </tbody>
    @endforeach
</table>

<main>
<!-- Модальное окно -->
<div class="modal" id="ModalUpgate" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Исправление поста</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin_post_update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="address"  value="admin_get_user_post">
                    <input type="hidden" name="post_id" id="in1" value="">
                    <input type="hidden" name="user_id" id="in3" value="">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Текст</label>
                        <input type="text" name="text" class="form-control" id="in2">
                    </div>

                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Модальное окно конец -->
<!-- Модальное окно удаления -->
<div class="modal" id="ModalDelete" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Подтвердите удаление пользователя</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin_post_delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="address"  value="admin_get_user_post">
                    <input type="hidden" name="post_id" id="in4" value="">
                    <input type="hidden" name="user_id" id="in5" value="">
                    <button type="submit" class="btn btn-primary">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Модальное окно удаления конец -->




    {{-- Получаем в функцию значения из кнопки модалки --}}
    <script type="text/javascript">
        function deliv(t, r, q) {
            document.getElementById('in1').value = t;
            document.getElementById('in2').value = r;
            document.getElementById('in3').value = q;
            document.getElementById('in4').value = t;
            document.getElementById('in5').value = r;
        }
    </script>
    {{-- Скрипт здесь для работы модальных окон --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>



    </body>

</html>
