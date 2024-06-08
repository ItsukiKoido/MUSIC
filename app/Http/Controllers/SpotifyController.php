<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;

class SpotifyController extends Controller
{
    
    public function accessToken(Request $request){
        $code = $request->input("code");
        
        // ("Client ID" . ":" . "Client secret")
        $base64 = base64_encode("190f5fe85108404c8ad184ae8358cdb5" . ":" . "66b5b819f9c7476a83526bfdb108ad07");
        
        $accessToken = Http::withHeaders([
            'Authorization'=> 'Basic ' . $base64,
        ])->asForm()->post('https://accounts.spotify.com/api/token', [
            'code' => $code,
            'redirect_uri' => 'https://c17039964ea14ad1a4cc905104872779.vfs.cloud9.us-east-1.amazonaws.com/spotify-test',
            'grant_type' => 'authorization_code',
        ]);
        
        $accessToken->json();
        $access_token = $accessToken['access_token'];
        
        //ここからユーザプロファイル取得
        // Spotify APIへのリクエスト
        $profileData = Http::withHeaders([
            'Authorization'=> 'Bearer ' . $access_token,
        ])->get('https://api.spotify.com/v1/me');
        
        // レスポンスのJSONデータを取得
        $profileDataJson = $profileData->json();
        
        // プロフィールデータの出力
        //dd($profileDataJson, $accessToken, $access_token);
        
        session(['access_token' => $access_token, 'profileDataJson' => $profileDataJson]);
        
        return redirect('/spotify/getplaylist');
    }
    
    public function index()
    {
        return view('spotifys.index');
    }
    
    public function getPlaylist()
    {
        $access_token = session('access_token');
        $profileDataJson = session('profileDataJson');
        
        $user_id = $profileDataJson['id'];
        
        // Spotify APIリクエストの作成
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json',
        ])->get("https://api.spotify.com/v1/users/{$user_id}/playlists", [
            'limit' => 20,
            'offset' => 0
        ]);
        
        // レスポンスデータを確認
        $playlists = $response->json();
        
        // 必要に応じてデバッグ出力
        //dd($playlists);
        
        // プレイリストを返す（ddを削除する場合）
        // return response()->json($playlists);

        return view('spotifys.index')->with(['playlists' => $playlists['items']]);
    }
    
    public function makeSetlist(Request $request)
    {
        //ここからプレイリスト作成
        $access_token = session('access_token');
        $profileDataJson = session('profileDataJson');
        
        $setlistName = $request->input('setlist_name');
        
        $makePlaylist = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
            'Content-Type' => 'application/json',
        ])->post("https://api.spotify.com/v1/users/{$profileDataJson['id']}/playlists", [
            'name' => $setlistName,
            'public' => true,
            'collaborative' => false,
            'description' => 'A new playlist created via API'
        ]);
        
        $makePlaylistJson = $makePlaylist->json();
        dd($makePlaylistJson);
    }
    
    public function serch(Request $request)
    {
        //ここからアイテム検索
        $access_token = session('access_token');
        $artist_name = session('artist_name');
        
        $serchItem = Http::withHeaders([
            'Authorization' => 'Bearer' . $access_token,
        ])->get("https://api.spotify.com/v1/search", [
            'q' => artist%3 . $artist_name,
            'type' => "track",
            ]);
    }
    
    public function store(Request $request, Playlist $playlist)
    {
        $spotify_id = $request->input('spotify_id');
        $live = session('live');
    
        $input['live_id'] = $live->id;
        $input['spotify_id'] = $spotify_id;
        // 新しいライブのインスタンスを作成して保存
        $playlist = new Playlist;
        $playlist->fill($input)->save();
        
        return view(spotifys.index);
    }
    
    public function deletePlaylist(Playlist $playlist){
        dd($playlist);
        $playlist->delete();
        return view(serches.show);
    }
    
    public function errors(){
        dd("error");
    }
    
    public function spotifyLogin(Request $request){
        $live = json_decode($request->input('live'));
        session(['live' => $live]);
        $state = bin2hex(random_bytes(16));
        return redirect("https://accounts.spotify.com/authorize?client_id=190f5fe85108404c8ad184ae8358cdb5&response_type=code&redirect_uri=https://c17039964ea14ad1a4cc905104872779.vfs.cloud9.us-east-1.amazonaws.com/spotify-test&state={$state}&scope=playlist-modify-private,playlist-modify-public")->with(["artist_name"]);
    }
}
