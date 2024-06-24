<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AutoLoginMiddleware
{
    public function handle($request, Closure $next)
    {
        if (app()->environment('local')) { // 開発環境のみ
            //Auth::loginUsingId(1); // IDが1のユーザーでログイン
        }
        return $next($request);
    }
}