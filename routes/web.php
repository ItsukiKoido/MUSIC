<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SpotifyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// 未認証のユーザーがアクセスするとログインページにリダイレクト
Route::get('/', function () {
    return redirect('/register');
})->middleware('guest');

// 認証後はダッシュボードにリダイレクト


Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'userLike');
    Route::delete('/{post}/comments/{comment}', 'deleteComment');
    Route::delete('/{like}/{post}', 'deletePost');
    Route::delete('/{like}', 'deleteLike');
    Route::get('/{like}/post', 'threadPost');
    Route::post('/{like}/post', 'storePost');
    Route::get('/{post}/comment', 'comment');
    Route::post('/{post}/comment', 'storeComment');
    Route::get('/serch/artist', 'serchArtist');
    Route::get('/{like}/artist', 'threadAtrist');
    Route::get('/{like}/setlist', 'setlist');
    
    Route::get('/serch', 'serchIndex');
    Route::post('/serch', 'storeLike');
    
    Route::get('/serch/makeartist', 'makeArtist');
    Route::post('/serch/makeartist', 'storeArtist');
    Route::get('/serch/{artist}', 'showArtist');
    Route::get('/serch/{artist}/makelive', 'makeLive'); 
    Route::post('/serch/{artist}/makelive', 'storeLive');
    Route::get('/serch/{artist}/{live}/makethread', 'makeThread');
    Route::post('/serch/{artist}/{live}/makethread', 'storeThread');
    Route::get('/serch/makesetlist', 'makeSetlist');
});

Route::controller(SpotifyController::class)->middleware(['auth'])->group(function(){
    
    Route::get('/spotify/login', 'spotifyLogin');
    Route::get('/spotify-test', 'accessToken');
    Route::get('/accesstoken-test', 'errors');
    Route::get('/spotify/index', 'index');
    Route::get('/spotify/makesetlist', 'makeSetlist');
    Route::get('/spotify/serch', 'serch');
    Route::get('/spotify/getplaylist', 'getPlaylist');
    Route::post('/spotify/store', 'store');
    Route::delete('/spotify/{playlist}', 'deletePlaylist');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
