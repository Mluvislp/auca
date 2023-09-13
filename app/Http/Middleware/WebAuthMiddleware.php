<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class WebAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // $user = Auth::user();
        // echo json_encode($user);
        // exit;
        if (!Auth::check()) {
            $route = $request->fullUrl();
            session(['route' => $route]);
            // Người dùng chưa được xác thực, chuyển hướng đến trang đăng nhập
            return redirect()->route('login');
        }

        return $next($request);
    }
}
