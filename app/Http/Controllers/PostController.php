<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Comment;
use App\Models\Live;
use App\Models\Like;
use App\Models\Post;
use App\Models\Thread;
use App\Models\User;
use Cloudinary;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function userLike(Request $request)
    {
        // リクエストからデータを取得
        $input = $request->input('like');
    
        // Likeモデルからデータをクエリビルダで取得
        $likes = Like::where($input)->get();
        
        if($likes->isNotEmpty()){
            $user = Auth::user();
            $likes = Like::with(['thread.live.artist'])->where('user_id', $user->id)->get();
            return view('threads.index')->with(['likes' => $likes]);
        }else{
            return view('threads.no');
        }
    }
    
    public function deletePost(Like $like, Post $post){
        $post->delete();
        return redirect('/' . $like->id . '/post');
    }
    
    public function deleteLike(Like $like){
        $like->delete();
        return redirect('/');
    }
    
    public function threadPost(Like $like)
    {
        $likes = Like::all();
        return view('threads.chat')->with(['like' => $like, 'likes' => $likes]);
    }
    
    public function storePost(Request $request, Like $like)
    {
        $body = $request->input('body');
        
        // ユーザーIDとアーティストIDを追加
        $input['user_id'] = Auth::id(); // 現在のユーザーのIDを設定
        $input['thread_id'] = $like->thread_id; // 関連するアーティストのIDを設定
        $input['body'] = $body;

        // 新しいライブのインスタンスを作成して保存
        $post = new Post;
        $post->fill($input)->save();
        
        return redirect('/' . $like->id . '/post');
    }
    
    public function comment(Post $post, Like $like)
    {
        $likes = Like::all();
        return view('threads.comment')->with(['post' => $post, 'likes' => $likes]);
    }
    
    public function storeComment(Request $request, Post $post)
    {
        
        $input['user_id'] = Auth::id();
        $input['post_id'] = $post->id;
        $input['comment'] = $request->input('comment');
        
        $comment = new Comment;
        $comment->fill($input)->save();
        
        return redirect('/' . $post->id . '/comment');
    }
    
    public function deleteComment(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect('/' . $post->id . '/comment');
    }
    
    public function threadArtist(Thread $thread)
    {
        return view('threads.artist')->with(['thread' => $thread]);
    }
    
    public function setlist(Thread $thread)
    {
        return view('threads.setlist')->with(['thread' => $thread]);
    }
    
    public function serchIndex(){
        // スレッドと関連するライブとアーティストを取得
        $threads = Thread::with('live.artist')->get();

        return view('serches.index')->with(['threads' => $threads]);
    }
    
    public function storeLike(Request $request)
    {
        $thread_id = $request->input('thread_id');
        
    //     if (is_null($thread_id)) {
    //     dd("thread_id is null");
    // } else {
    //     dd("thread_id: $thread_id");
    // }
        
        $user = Auth::user();
        // 既に「いいね」しているか確認
        $existing_like = Like::where('user_id', $user->id)
                             ->where('thread_id', $thread_id)
                             ->first();

        if (!$existing_like) {
            // まだ「いいね」していない場合、新しい「いいね」を作成
            Like::create([
                'user_id' => $user->id,
                'thread_id' => $thread_id,
            ]);
        }
        $likes = Like::with('thread.live.artist')->where('user_id', $user->id)->get();
        
        return view('threads.index')->with(['likes' => $likes]);
    }
    
    public function makeArtist()
    {
        return view('makes.artist');
    }
    
    public function storeArtist(Artist $artist, Request $request)
    {
        $image_url = Cloudinary::upload($request->file('image_path')->getRealPath())->getSecurePath();  //画像のURLを画面に表示
    
        
        $input = $request['artist'];
        $input += ['image_path' => $image_url];
        $artist->fill($input)->save();
        return redirect('/serch/' . $artist->id);
    }
    
    public function serchArtist(Artist $artist, Request $request)
    {
        $keyword = $request->input('search_name');
        $artists = Artist::where("name", "like", "%{$keyword}%")->get();
        if($artists->isNotEmpty()){
            return view('serches.artist')->with(['artists' => $artists]);
        }else{
            return view('serches.no');
        }
    }
    
    public function showArtist(Artist $artist, Live $live)
    {
        return view('serches.show')->with(['artist' => $artist, 'live' => $live]);
    }
    
    public function makeLive(Artist $artist, )
    {
        return view('makes.live')->with(['artist' => $artist]);
    }
    
    public function storeLive(Request $request, Artist $artist)
    {
        // 入力データを取得
        $input = $request->input('live');
        
        // ユーザーIDとアーティストIDを追加
        $input['user_id'] = Auth::id(); // 現在のユーザーのIDを設定
        $input['artist_id'] = $artist->id; // 関連するアーティストのIDを設定

        // 新しいライブのインスタンスを作成して保存
        $live = new Live;
        $live->fill($input)->save();

        // リダイレクト
        return redirect('/serch/' . $artist->id);
    }
    
    public function makeThread(Artist $artist, Live $live)
    {
        return view('makes.thread')->with(['artist' => $artist, 'live' => $live]);
    }

    public function storeThread(Artist $artist, Live $live, Request $request) // 引数をRequestからPostRequestにする
    {
        $input = $request->input('thread');
        $input['user_id'] = Auth::id();
        $input['live_id'] = $live->id;
        $thread = new Thread;
        $thread->fill($input)->save();
        
        return redirect('/serch/' . $artist->id);
    }
    
    public function makeSetlist()
    {
        return view('makes.setlist');
    }
}