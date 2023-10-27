<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome'); // id идет в контроллер
Route::post('/', [CommentController::class, 'create'])->name('comment');
Route::put('/', [CommentController::class, 'update'])->name('comment_update');
Route::delete('/', [CommentController::class, 'del'])->name('comment_del');

Route::post('/reply', [CommentController::class, 'create_reply'])->name('comment_reply');
Route::put('/reply', [CommentController::class, 'update_reply'])->name('update_reply');
Route::delete('/reply', [CommentController::class, 'del_reply'])->name('del_reply');

// Route::get('/like/{message_id}', [WelcomeController::class, 'like'])->name('like');  // id идет в контроллер

Route::get('/like/{post_id}', [LikeController::class, 'create'])->name('create_like'); // id идет в контроллер
Route::get('/dislike_comm/{comment_id}/{post_id}', [LikeController::class, 'create_dislike_comm'])->name('create_dislike_comm');
Route::get('/like_comm/{comment_id}/{post_id}', [LikeController::class, 'create_like_comm'])->name('create_like_comm');
Route::get('/dislike_reply/{reply_id}/{comment_id}/{post_id}', [LikeController::class, 'create_dislike_reply'])->name('create_dislike_reply');
Route::get('/like_reply/{reply_id}/{comment_id}/{post_id}', [LikeController::class, 'create_like_reply'])->name('create_like_reply');



//-----ADMIN------------------------------------------------------------------------------------------

Route::get('/admin', [AdminController::class, 'admin'])->name('admin')->middleware('auth'); // id идет в контроллер
Route::get('/admin_post', [AdminController::class, 'admin_post'])->name('admin_post')->middleware('auth'); // id идет в контроллер
Route::get('/admin_comm', [AdminController::class, 'admin_comm'])->name('admin_comm')->middleware('auth'); // id идет в контроллер
Route::get('/admin_user', [AdminController::class, 'admin_user'])->name('admin_user')->middleware('auth'); // id идет в контроллер
Route::get('/admin_post_get_comment/{get?}', [AdminController::class, 'admin_post_get_comment'])->name('admin_post_get_comment')->middleware('auth'); // id идет в контроллер
Route::get('/admin_get_reply/{get?}', [AdminController::class, 'admin_get_reply'])->name('admin_get_reply')->middleware('auth'); // id идет в контроллер
Route::get('/admin_get_user_post/{name?}', [AdminController::class, 'admin_get_user_post'])->name('admin_get_user_post')->middleware('auth'); // id идет в контроллер
Route::get('/admin_get_user_comm/{name?}', [AdminController::class, 'admin_get_user_comm'])->name('admin_get_user_comm')->middleware('auth'); // id идет в контроллер

Route::put('/admin_user_update', [AdminController::class, 'admin_user_update'])->name('admin_user_update')->middleware('auth'); // id идет в контроллер
Route::put('/admin_user_ban', [AdminController::class, 'admin_user_ban'])->name('admin_user_ban')->middleware('auth'); // id идет в контроллер
Route::put('/admin_post_update', [AdminController::class, 'admin_post_update'])->name('admin_post_update')->middleware('auth'); // id идет в контроллер
Route::put('/admin_post_ban', [AdminController::class, 'admin_post_ban'])->name('admin_post_ban')->middleware('auth'); // id идет в контроллер
Route::put('/admin_comment_update', [AdminController::class, 'admin_comment_update'])->name('admin_comment_update')->middleware('auth'); // id идет в контроллер
Route::put('/admin_reply_update', [AdminController::class, 'admin_reply_update'])->name('admin_reply_update')->middleware('auth'); // id идет в контроллер
Route::put('/admin_comment_ban', [AdminController::class, 'admin_comment_ban'])->name('admin_comment_ban')->middleware('auth'); // id идет в контроллер
Route::put('/admin_reply_ban', [AdminController::class, 'admin_reply_ban'])->name('admin_reply_ban')->middleware('auth'); // id идет в контроллер

Route::delete('/admin_user_delete', [AdminController::class, 'admin_user_delete'])->name('admin_user_delete');
Route::delete('/admin_post_delete', [AdminController::class, 'admin_post_delete'])->name('admin_post_delete');
Route::delete('/admin_comment_delete', [AdminController::class, 'admin_comment_delete'])->name('admin_comment_delete');

//--------------------------------------------------------------------------------------------------

Route::get('/cabinet', [CabinetController::class, 'view'])->name('cabinet')->middleware('auth'); // id идет в контроллер
Route::get('/cabinet/{id_post}', [CabinetController::class, 'edit'])->name('cabinet_edit')->middleware('auth'); // id идет в контроллер
Route::put('/cabinet', [CabinetController::class, 'edit_post'])->name('post_edit'); // id идет в контроллер
Route::delete('/cabinet', [CabinetController::class, 'del'])->name('post_del');
