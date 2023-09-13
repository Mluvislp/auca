<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Group\CreateGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Traits\GroupTrait;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    use GroupTrait;
    public function createGroup(CreateGroupRequest $request){
        $validated = $request->validated();
        return $this->create($validated);
    }
    public function updateGroup(UpdateGroupRequest $request){
        $validated = $request->validated();
        return $this->update($validated);
    }
    public function getAll(Request $request){
        return $this->getAllGroup($request);
    }
}
