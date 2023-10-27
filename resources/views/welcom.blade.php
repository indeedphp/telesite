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
                <a class="nav-link text-white" href="{{ route('cabinet') }}"><i class="bi bi-calendar2-event"></i> Кабинет {{Auth::user()->name}}</a>
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

<main>

    <div class="container-fluid " >
        <div class="row">





            <div class="col-sm-3  d-none d-md-block" >


<div class="card" style="width: 18rem;">

  <div class="card-body">
    <h5 class="card-title">Название карточки</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Переход куда-нибудь</a>
  </div>
</div>



            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero possimus rerum praesentium, commodi natus quidem aliquam quam esse iste in voluptatibus. In, a, adipisci? Molestiae, sequi quia quidem, vero totam, soluta perspiciatis, neque quasi omnis distinctio laudantium! Aperiam delectus sunt deserunt consequuntur accusamus molestias sequi enim impedit et rem dolore a voluptas eius inventore pariatur id numquam, necessitatibus consequatur deleniti maxime suscipit temporibus? Corporis totam fugit doloribus ad sapiente ea saepe, fugiat cumque in unde obcaecati quis voluptate odio incidunt aliquid qui eos quaerat neque placeat necessitatibus quam porro illo ducimus? Perspiciatis illo consequatur magni deserunt? Itaque qui consequatur, quidem eligendi, maiores animi id doloremque consectetur cum odit veniam expedita omnis ipsa ducimus soluta fugit porro, vitae nemo deserunt repellendus doloribus optio sed laudantium nihil ullam! Reprehenderit, veniam eaque atque voluptatibus hic velit, aperiam quia natus sunt eos dolorem officia mollitia, ab. Aperiam, adipisci molestiae ipsam nostrum. Voluptas culpa tempora aspernatur, ullam laborum odio. Corrupti, expedita eveniet ipsam, reprehenderit consectetur ea magnam, debitis ut qui ullam aperiam rerum vitae! Doloribus, ratione eaque magnam, eius repudiandae minima quidem accusantium laborum. Praesentium eos at, delectus pariatur accusantium doloribus. Deleniti maxime voluptatem blanditiis vero? Placeat quis, temporibus debitis, quae facilis doloribus quibusdam, facere quam nam, repudiandae totam quo dolore delectus saepe possimus eligendi minima maxime sit tempore iste? Minus, quaerat? Nemo magnam consequatur, quaerat eius in ut possimus odio dolores tenetur at suscipit harum. Quas, animi. Odit similique ut ea, quas blanditiis, deserunt unde dolor aspernatur suscipit accusantium quod minus eveniet asperiores magni consequatur ipsam minima reiciendis, sint exercitationem. Quas fugiat quam perspiciatis ipsam reprehenderit officia voluptatum debitis, nostrum incidunt mollitia, tempore commodi, expedita vel non rerum facilis consequatur cupiditate esse ab dicta. Possimus quis accusantium odio praesentium quasi officia minus rem, est in sit consectetur iusto cumque voluptatem. Molestias, ea unde consequuntur, provident praesentium quisquam. Hic veniam suscipit maxime distinctio reiciendis dolore, minima illo, harum. </div>
            <div class="col p-0"  >



                {{-- -------------достаем посты и формируем карточку начало---------------}}
                @foreach ($arr_posts as $post_com)
                <div class="card mt-3 ">
                  <div class="card-header text-white " style = "background-color : #800000";>
                     <a id="anchor{{$post_com['id']}}"></a>  <!-- якорная ссылка-->
                     <i class="bi bi-card-text"></i> {{$post_com['id']}} &nbsp &nbsp
                     <i class="bi bi-clock"></i> {{$post_com['date']}}&nbsp &nbsp
                     <i class="bi bi-universal-access"></i> {{$post_com['username']}} &nbsp &nbsp


                     <!-- Ссылка на лайки поста -->
                     <a @auth {{-- если авторизован то ссылка на роут--}}
                     href="{{route('create_like', $post_com['id'])}}"
                     @endauth
                     @guest  {{-- если гость то ссылка на модалку №5--}}
                     href=""
                     data-bs-toggle="modal"
                     data-bs-target="#Modal2"
                     @endguest  >
                     <i class="bi bi-hand-thumbs-up"></i> {{$post_com['like']}}
                 </a> &nbsp &nbsp
                 @if(Auth::check())  <!-- если зарегистрирован-->
                 @if (Auth::user()->name == $post_com['username'])
                 <a
                 href="{{ route('cabinet_edit', $post_com['id']) }}" >
                 <i class="bi bi-pencil"></i>  правка
             </a>
             @endif
             @endif

         </div>
         <div class="card-body" style = "background-color : #E5E5E5"; >
             <img src="speaker_k_esp.jpg" height="240" class="rounded  float-md-left  mr-3 "  >
             <h5 class="card-title" >Текст поста </h5>
             <p class="card-text">{{$post_com['text']}}</p>


         </div>
         <div class="card-footer" style = "background-color : #E1D8D4"; >
            <div class="d-flex justify-content-between">
             <a
             data-bs-toggle="collapse"
             href="#collapseExample1{{$post_com['id']}}"
             aria-controls="collapseExample{{ $loop->iteration }}">
             <i class="bi bi-chat-dots"></i> Коментарии {{$post_com['comment']}}
         </a>

         <a @auth
         @if (Auth::user()->activ == 0)
         href="#"
         data-bs-toggle="modal"
         data-bs-target="#exampleModal{{ $loop->iteration }}"
         @else
         href=""
         data-bs-toggle="modal"
         data-bs-target="#Mod4"
         @endif
         @endauth
         @guest
         href=""
         data-bs-toggle="modal"
         data-bs-target="#Modal2"
         @endguest  >
         <i class="bi bi-chat"></i> Написать коментарий
     </a>





 </div>


 <!-- Коментарии начало,  в див условие открытые коментарии или скрытые по умолчанию-->
 <div
 @if($collapse == $post_com['id'] )
 class="collapse show"
 id="collapseExample1{{$collapse}}"
 @else
 class="collapse"
 id="collapseExample1{{$post_com['id']}}"
 @endif
 >

 <!-- --------------------цикл развертывания коментариев с кнопками------------------------------ -->
 @foreach ($post_com['comment_plus'] as $d )
 <div>
    <!-- лайки -->
    <a @auth
    href="{{route('create_like_comm', [ $d['id'], $post_com['id'] ] )}}"
    @endauth
    @guest
    href=""
    data-bs-toggle="modal"
    data-bs-target="#Modal2"
    @endguest  >
    <i class="bi bi-hand-thumbs-up"></i> {{$d['like']}}
</a>
<!-- дизлайки -->
<a @auth
href="{{route('create_dislike_comm', [ $d['id'], $post_com['id'] ] )}}"
@endauth
@guest
href=""
data-bs-toggle="modal"
data-bs-target="#Modal2"
@endguest  >
<i class="bi bi-hand-thumbs-down"></i> {{$d['dislike']}}
</a>

<i class="bi bi-clock"></i> {{ Carbon\Carbon::parse($d['created_at'])->format('Y-m-d H:i:s') }}
<i class="bi bi-universal-access"></i>  {{$d['name']}}
<i class="bi bi-chat-dots"></i> {{$d['comment']}}
@if(Auth::check())  <!-- асли зарегистрирован-->
@if (Auth::user()->name == $d['name']) <!-- если имя совпадает с иенем коментатораи-->
<a
href=""
data-bs-toggle="modal"
{{-- в onclick для скрипта передаем значения, идут в форму модалки --}}
onclick="deliv('{{$d['id']}}','{{$d['comment']}}','{{$post_com['id']}}')"
data-bs-target="#exampleModalx" >
<i class="bi bi-pencil"></i> Исправить
</a>

@elseif(Auth::user()->activ == 1){{-- проверяем не забанен ли--}}

<a
href=""
data-bs-toggle="modal"
data-bs-target="#Mod4"
>Ответить</a>
@else
<a
href=""
data-bs-toggle="modal"
{{-- в onclick для скрипта передаем значения, идут в форму модалки --}}
onclick="deliv('{{$d['id']}}','{{$d['name']}}','{{$post_com['id']}}')"
data-bs-target="#exampleModalx2" >
<i class="bi bi-pencil"></i> Ответить
</a>


@endif
@endif

<!-- -----------------------ответы к коментариям----------------------------- -->
@foreach ($d['comment_reply'] as $ddd )

<br> &nbsp &nbsp &nbsp


<a @auth
href="{{route('create_like_reply', [ $ddd['id'], $d['id'], $post_com['id'] ])}}"
@endauth
@guest
href=""
data-bs-toggle="modal"
data-bs-target="#Modal2"
@endguest  >
<i class="bi bi-hand-thumbs-up"></i> {{$ddd['like']}}
</a>

<a @auth
href="{{route('create_dislike_reply', [ $ddd['id'], $d['id'], $post_com['id'] ] )}}"
@endauth
@guest
href=""
data-bs-toggle="modal"
data-bs-target="#Modal2"
@endguest  >
<i class="bi bi-hand-thumbs-down"></i> {{$ddd['dislike']}}
</a>



<i class="bi bi-clock"></i> {{ Carbon\Carbon::parse($d['created_at'])->format('Y-m-d H:i:s') }}
<i class="bi bi-universal-access"></i>  {{$ddd['name']}}
<i class="bi bi-chat-dots"></i> {{$ddd['comment']}}
@auth
@if (Auth::user()->name == $ddd['name']) <!-- если имя совпадает с иенем коментатораи-->
<a
href=""
data-bs-toggle="modal"
{{-- в onclick для скрипта передаем значения, идут в форму модалки --}}
onclick="deliv('{{$ddd['id']}}','{{$ddd['comment']}}','{{$post_com['id']}}')"
data-bs-target="#ex" >
<i class="bi bi-pencil"></i> Исправить
</a>
@else
<a
href=""
data-bs-toggle="modal"
{{-- в onclick для скрипта передаем значения, идут в форму модалки --}}
onclick="deliv('{{$d['id']}}','{{$ddd['name']}}','{{$post_com['id']}}')"
data-bs-target="#exampleModalx2" >
<i class="bi bi-pencil"></i> Ответить
</a>


@endif
@endauth
@endforeach
<!-- ---------------------------^^^ответы к коментариям^^^---------------------------- -->
</div>
@endforeach
<!-- --------------------^^^^цикл развертывания коментариев с кнопками^^^----------------------- -->
</div>



<!-- Модальное окно -->
<div

class="modal fade" id="exampleModal{{ $loop->iteration }}"
tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        Напишите коментарий!
        <button
        type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
    </button>
</div>

<form
action="{{route('comment')}}" method="POST" >
<div class="input-group">
   @csrf
   <input type="hidden" name="name" value="{{ (Auth::check()) ? Auth::user()->name : 'аноним' }}">
   <input type="hidden" name="post_id" value="{{$post_com['id']}}">
   <textarea name="comment" class="form-control" aria-label="With textarea"></textarea>
</div>
<button type="submit" class="btn btn-primary">Отправить</button>
</form>

</div>
</div>
</div>
<!-- Модальное окно конец -->






<!-- Модальное окно -->

<div class="modal fade" id="exampleModalx" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        Исправить или удалить коментарий.
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
    </div>

    <form
    action="{{route('comment')}}" method="POST" >
    <div class="input-group">
     @csrf
     @method('PUT')
     {{-- в id="inputVal" value="" заполняем из скрипта значения --}}
     <input type="hidden" name="comment_id" id="inputVal" value="">
     <input type="hidden" name="post_id" id="inputVal4" value="">
     <textarea name="comment" id="inputVal2" class="form-control" aria-label="With textarea"  >  </textarea>
 </div>
 <button type="submit" class="btn btn-primary">Изменить</button>
</form>

<form method="POST"  action="{{route('comment_del')}}">
    @csrf
    @method('DELETE')
    <input type="hidden" name="post_id" id="inputVal5" value="">
    <input type="hidden" id="inputVal3" name="comment_id" value="">
    <button class="justify-content-end" type="submit"  > Удалить </button>

</form>


</div>
</div>
</div>
<!-- Модальное окно конец -->






</div>
</div>
@endforeach

{{-- достаем посты и формируем карточку конец--}}

</div>
</div>
</div>

<!-- ------------------Модальное окно  №5--------------------------------- -->
<div
class="modal fade" id="Modal2"
tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        Войдите или зарегистрируйтесь!
        <button
        type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
    </button>
</div>
<a  href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Вход</a>
<a  href="{{ route('register') }}"><i class="bi bi-bookmark-star"></i>  Регистрация</a>

</div>
</div>
</div>
<!-- ----------------------Модальное окно №5 конец-------------------------- -->

<!-- Модальное окно -->
<div class="modal fade" id="exampleModalx2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        Напишите ответ на комментарий.
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
    </div>

    <form
    action="{{route('comment_reply')}}" method="POST" >
    <div class="input-group">
     @csrf
     {{-- в id="inputVal" value="" заполняем из скрипта значения --}}

     <input type="hidden" name="comment_id" id="in7" value="">
     <input type="hidden" name="post_id" id="in8" value="">
     @auth
     <input type="hidden" name="name" value="{{Auth::user()->name}}">
     @endauth
     <textarea name="comment" id="in6" class="form-control" aria-label="With textarea"  > </textarea>
 </div>
 <button type="submit" class="btn btn-primary">Ответить</button>
</form>

</div>
</div>
</div>
<!-- Модальное окно конец -->



<!-- Модальное окно -->
<div class="modal fade" id="ex" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        Исправить или удалить коментарий.
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
    </div>

    <form
    action="{{route('update_reply')}}" method="POST" >
    <div class="input-group">
     @csrf
     @method('PUT')
     {{-- в id="inputVal" value="" заполняем из скрипта значения --}}
     <input type="hidden" name="comment_id" id="in5" value="">
     <input type="hidden" name="post_id" id="inp4" value="">
     <textarea name="comment" id="in4" class="form-control" aria-label="With textarea"  >  </textarea>
 </div>
 <button type="submit" class="btn btn-primary">Изменить</button>
</form>

<form method="POST"  action="{{route('del_reply')}}">
    @csrf
    @method('DELETE')
    <input type="hidden" name="post_id" id="i2" value="">
    <input type="hidden" id="i1" name="comment_id" value="">
    <button class="justify-content-end" type="submit"  > Удалить </button>

</form>


</div>
</div>
</div>
<!-- Модальное окно конец -->


<!-- ------------------Модальное окно  №10--------------------------------- -->
<div
class="modal fade" id="Mod4"
tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <p>Вы забанены!</p>
        <button
        type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть">
    </button>
</div>
</div>
</div>
</div>
<!-- ----------------------Модальное окно №10 конец-------------------------- -->



<div> {{ $posts->links()}}  </div>  <!-- подключаем пагинацию -->
</main>
<footer>
</footer>

<script type="text/javascript">
    function deliv(t,r,q){  {{--Получаем в функцию значения из кнопки модалки--}}


    document.getElementById('inputVal').value = t;
    document.getElementById('inputVal2').value = r;
    document.getElementById('in6').value = r;
    document.getElementById('in8').value = q;
    document.getElementById('in4').value = r;
    document.getElementById('inputVal3').value = t;
    document.getElementById('in7').value = t;
    document.getElementById('in5').value = t;
    document.getElementById('i1').value = t;
    document.getElementById('i2').value = q;
    document.getElementById('inp4').value = q; {{--Для якорной ссылки--}}
    document.getElementById('inputVal5').value = q; {{--Для якорной ссылки--}}
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</body>
</html>



