<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function company()
    {
        return view('backend.page.company.company', [
            'group' => Auth::user()->group,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'group_name'    => 'required',
            'tax_code'      => 'required',
            'email'         => 'email',
        ]);
        $requestDatas   = $request->all();
        $groupId        = Auth::user()->groupid;
        $group          = Group::updateOrCreate(['id' => $groupId], $requestDatas);
        return response()->json([
            'status'    => 1,
            'message'   => __('Data inserted successfully'),
            'data'      => $group,
        ]);
    }
}
