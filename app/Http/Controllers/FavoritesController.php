<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Micropost;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * お気に入り追加
     */
    public function store(int $id)
    {
        $micropost = Micropost::findOrFail(intval($id));
    
        // 認証済みユーザーを取得
        $user = \Auth::user();
        if($user->favorite($micropost->id)){
            // 前のURLへリダイレクトさせる
            return back()->with('Favorite Success');
        }
    
        return back()->with('Favorite Failed');
    }

    /**
     * Remove the specified resource from storage.
     * お気に入り解除
     */
    public function destroy(int $id)
    {
        $micropost = Micropost::findOrFail(intval($id));
        
        // 認証済みユーザーを取得
        $user = \Auth::user();
        if($user->unfavorite($micropost->id)){
            // 前のURLへリダイレクトさせる
            return back()->with('Unfavorite Success');
        }
        
        return back()->with('Unfavorite Failed');
    }
}