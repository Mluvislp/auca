<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class GroupIdScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $user = auth( 'api' )->user();
        if(!$user){
            $user = Auth::user();
            if (!$user) {
                abort(Response::HTTP_UNAUTHORIZED, 'Lỗi: Người dùng không xác thực.');
            } else {
//            if ($user && $user->isAdmin()) {
//                return;
//            }
                $groupid = $user->groupid;
            }
        }else{
            if (!$user) {
                abort(Response::HTTP_UNAUTHORIZED, 'Lỗi: Người dùng không xác thực.');
            } else {
//            if ($user && $user->isAdmin()) {
//                return;
//            }
                $groupid = $user->groupid;
            }
        }
        $tableName = $model->getTable();
        $builder->where("$tableName.groupid", $groupid);
    }
}
