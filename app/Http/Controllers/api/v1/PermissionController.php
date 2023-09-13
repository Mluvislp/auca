<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\PermissionMiddleware;
use App\Http\Functions\MyHelper;
use App\Models\UserTypeDetail;
use App\Models\UserType;
use JWTAuth;
class PermissionController extends Controller
{
    public function GetAllPermission(Request $request)
    {
        $permission = (new PermissionMiddleware)->returnRoute();
        $user = JWTAuth::parseToken()->authenticate();
        $data =[] ;
        if(!$request->id){
            return MyHelper::response(false, 'not found', [], 404);
        }else{
            $type = UserType::where('id',$request->id)->where('groupid',$user->groupid)->first();
            if(!$type){
                return MyHelper::response(false, 'not found', [], 404);
            }
            $typeGroup = UserType::where('id',$request->id)->first();
            $detailtype = UserTypeDetail::where('type_id',$request->id)->get();
            $permissionDetail = [];
            foreach ($permission as $val) {
               foreach ($detailtype as $valtype) 
               {
                 if ($valtype->page == $val) {
                    $permissionDetail[$val][$valtype->action] = $valtype;
                 }
               }
            }
            $data['type'] = $typeGroup;
            $data['permission'] = $permission;
            $data['detail'] = $permissionDetail;
        }
        return MyHelper::response(true, 'Successfully', $data, 200);
    }


    public function AddPermission(Request $request)
    {
        $permission = (new PermissionMiddleware)->returnRoute();
        $user = JWTAuth::parseToken()->authenticate();
        $data =[] ;
        if(!isset($request->id) || !isset($request->type) || !isset($request->page)){
            return MyHelper::response(false, 'Please provided id and type', [], 403);
        }else{
            $type = UserType::where('id',$request->id)->where('groupid',$user->groupid)->first();
            if(!$type){
                return MyHelper::response(false, 'User type not found', [], 404);
            }
            $check = UserTypeDetail::where('page',$request->page)->where('type_id',$request->id)->where('action',$request->type)->first();
            if($check)
            {
                return MyHelper::response(true, 'Already exist', [], 202);
            }
            $detailtype = new UserTypeDetail;

            $detailtype->type_id = $request->id;
            $detailtype->action = $request->type;
            $detailtype->page = $request->page;
            $detailtype->datecreate = time();
            $detailtype->save();
        }
        return MyHelper::response(true, 'Successfully', [], 200);
    }

    public function DelPermission(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $data =[] ;
        if(!isset($request->id) ){
            return MyHelper::response(false, 'Please provided id', [], 403);
        }else{
            $check = UserTypeDetail::where('id',$request->id)->first();
            if(!$check)
            {
                return MyHelper::response(false, 'Not found', [], 404);
            }
            $check->delete();
        }
        return MyHelper::response(true, 'Successfully', [], 200);
    }
    public function getAllRole(Request $request)
    {
        $keyword    = $request->input( 'search' );
        $perPage    = $request->input( 'per_page' , 10 );
        $query      = UserType::query();
        $all_search = $request->all();
        if( !empty( $keyword ) ){
            $query->where( 'name' , 'LIKE' , "%$keyword%" );
        }
        if( array_key_exists( 'columns' , $all_search ) ){
            foreach( $all_search[ 'columns' ] as $val ){
                if( is_null( $val[ 'search' ][ 'value' ] ) || !$val[ 'searchable' ] ){
                    continue;
                }else{
                    $operator        = ( $val[ 'name' ] == 'id' ? '=' : 'LIKE' );
                    $percent_percent = ( $val[ 'name' ] == 'id' ? "" : "%" );
                    $query->where( $val[ 'name' ] , $operator , $percent_percent.$val[ 'search' ][ 'value' ].$percent_percent );
                }
            }
        }
        if( $request->has( 'brand_id' ) ){
            $query->where( 'id' , '=' , $request->input( 'brand_id' ) );
        }
        $brand = $query->orderBy( 'id' , 'asc' )->paginate( $perPage );
        if( !$brand ){
            return MyHelper::response( false , 'No data found' , [] , 404 );
        }

        $data = [
            'data' => collect( $brand->items() )->map( function( $brands ){
                return $brands;
            } ) ,
            'total' => $brand->total() ,
            'per_page' => $brand->perPage() ,
            'current_page' => $brand->currentPage() ,
        ];

        return MyHelper::response( true , 'Successfully' , $data , 200 );
    }

    public function DeleteRole($id)
    {
        $query      = UserType::where('id',$id)->first();
        if(!$query){
            return MyHelper::response( false , 'Not found' , [] , 404 );
        }
        $query->delete();
        return MyHelper::response( true , 'Successfully' , [] , 200 );
    }

    public function UpdateRole($id,Request $request)
    {
        $query      = UserType::where('id',$id)->first();
        $old     = UserType::where('id',$id)->first();
        if(!$query){
            return MyHelper::response( false , 'Not found' , [] , 404 );
        }
        $req = $request->all();
        $name = $request->name;
        $desc = $request->summery;
        $query->name = isset( $request['name'] ) ? $request['name']: $old->name;
        $query->summary = isset( $request->summery ) ? $request->summery : $old->summary;
        $query->save();
        return MyHelper::response( true , 'Successfully' , $request['name'] , 200 );
    }

    public function AddRole(Request $request)
    {
        $query      = new UserType;
        if(!$query){
            return MyHelper::response( false , 'Not found' , [] , 404 );
        }
        $user = JWTAuth::parseToken()->authenticate();
        $req = $request->all();
        $name = $request->name ?? '';
        $desc = $request->summary ?? '';
        $query->name = $name;
        $query->groupid = $user->groupid;
        $query->summary = $desc;
        $query->public = $request->public ?? 'inactive';
        $query->type = 'group';
        $query->datecreate = time();
        $query->save();
        return MyHelper::response( true , 'Successfully' , $request['name'] , 200 );
    }
}
