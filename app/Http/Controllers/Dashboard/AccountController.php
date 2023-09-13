<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function account(){
        return view('backend.page.account.account');
    }

    public function add_account(){
        return view('backend.page.account.add_account');
    }

    public function edit_account(){
        return view('backend.page.account.edit_account');
    }

    public function trash_account(){
        return view('backend.page.account.trash_account');
    }

    public function edit_permission(){
        return view('backend.page.account.edit_permission');
    }

    // public function account_detail(){
    //     return view('backend.page.account.account_detail');
    // }
}