<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Functions\MyHelper;
use App\Models\User;
use App\Models\v1\v;
use Illuminate\Http\Request;
use JWTAuth;

class AuthController extends Controller {
    public function __construct(){
        $this->middleware( 'auth:api' , [ 'except' => [ 'login' ] ] );
    }

    public function login( Request $request ){
        $check_user = new User;
        $token = auth( 'api' )->attempt( $request->all() );
        if( $token ){
            $user = auth( 'api' )->user();
            $token = $this->respondWithToken( $token )->original;
            $permissions = $user->Permissions()->get( [ 'page' , 'action' ] );
            $typeRole = $user->Roles()->get( 'name' )->pluck( 'name' );
            $format_permisssions = [];
            foreach( $permissions as $key => $permission ){
                $format_permisssions[ $permission[ 'page' ] ][] = $permission[ 'action' ];
            }
            $token[ 'data_user' ] = $user;
            $token[ 'roles' ][ 'type' ] = $typeRole;
            $token[ 'permissions' ] = $format_permisssions;
            return MyHelper::response( true , 'Successfully' , $token , 200 );
        }else{
            return MyHelper::response( false , 'Unauthorized' , [] , 401 );
        }
    }

    protected function respondWithToken( $token ){
        return response()->json( [ 'access_token' => $token , 'token_type' => 'bearer' , 'expires_in' => auth( 'api' )->factory()->getTTL() , ] );
    }
}
