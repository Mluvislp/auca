<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserType;
use Auth;
class RoleController extends Controller
{
    public function role(){
        $query      = UserType::where('groupid',auth::user()->groupid)->get();
        return view('backend.page.role.role')->with('data', $query);
    }
}
