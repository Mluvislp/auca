<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use App\Http\Functions\MyHelper;
use App\Models\v1\AuthModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(){
        return view('common.login');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
    public function loginAction(Request $request)
    {
        $check_user = new User;
        $token = Auth::attempt($request->all());
        if ($token) {
            $user = Auth::user();
            $token = [];
            $token['data_user'] = $user;
            $route = session('route') ?? route('dashboard') ;
            $token['route'] = $route;
            session()->forget('route');
            return MyHelper::response(true, 'Successfully', $token, 200);
        } else {
            return MyHelper::response(false, 'Unauthorized', [], 401);
        }
    }
 
    
    public function register(){
        return view('common.register');
    }

    public function index(){
        return view('backend.dashboard');
    }

    public function bill(){
        return view('backend.page.bill.bill');
    }

    
    public function blog(){
        return view('backend.page.blog.blog.blog');
    }

    public function add_blog(){
        return view('backend.page.blog.blog.add_blog');
    }

    public function edit_blog(){
        return view('backend.page.blog.blog.edit_blog');
    }

    public function trash_blog(){
        return view('backend.page.blog.blog.trash_blog');
    }

    public function blogCategory(){
        return view('backend.page.blog.category.category');
    }

    public function addBlogCategory(){
        return view('backend.page.blog.category.add_category');
    }

    public function editBlogCategory(){
        return view('backend.page.blog.category.edit_category');
    }

    public function trashBlogCategory(){
        return view('backend.page.blog.category.trash_category');
    }

    public function voucher(){
        return view('backend.page.promotion.voucher.voucher');
    }

    public function add_voucher(){
        return view('backend.page.promotion.voucher.add_voucher');
    }

    public function edit_voucher(){
        return view('backend.page.promotion.voucher.edit_voucher');
    }

    public function trash_voucher(){
        return view('backend.page.promotion.voucher.trash_voucher');
    }

    public function deal(){
        return view('backend.page.promotion.deal.deal');
    }
    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL(),
        ]);
    }
}