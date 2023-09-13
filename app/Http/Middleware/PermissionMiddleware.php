<?php

namespace App\Http\Middleware;

use App\Http\Functions\AuthUser;
use App\Http\Functions\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Functions\MyHelper;

class PermissionMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $args
     *
     * @return mixed
     */
    public function handle( Request $request , \Closure $next , ...$args ){
        if( !empty( $args ) || $this->shouldPassThrough( $request ) ){
            return $next( $request );
        }

        //Group admin

        // if (AuthUser::user()->isAdmin()) {
        //     return $next($request);
        // }
        if( !AuthUser::user() ){
            return $next( $request );
        }
        if( AuthUser::user()->level == 'admin' || AuthUser::user()->level == 'groupadmin') {
            return $next($request);
        }
        $Permissions = AuthUser::user()->allPermissions()->toArray();

        if( !$Permissions ){
            return Permission::error();
        }else{
            $routePath = $request->path();
            $newPermissions = [];
            $methods = [
                'get' => 'view' ,
                'post' => 'add' ,
                'put' => 'edit' ,
                'delete' => 'delete' ,
                'patch' => 'edit'
            ];
            $method = strtolower( $request->method() );
            $route = explode( '.' , request()->route()->getAction()[ 'as' ] )[ 0 ];
            $route = $this->convertRoute( $route );
            foreach( $Permissions as $key => $permission ){
                $newPermissions[ $permission[ 'page' ] ][] = $permission[ 'action' ];
            }

            if( array_key_exists( $route , $newPermissions ) ){
                $method = $methods[ $method ];
                if( in_array( $method , $newPermissions[ $route ] ) ){
                    return $next( $request );
                }else{
                    return Permission::error();
                }
            }else{
                return Permission::error();
            }

        }
        return $next( $request );
    }


    /**
     * Determine if the request has a URI that should pass through verification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    //lưu ý thêm route khi tạo 1 route mới trong api ở hai function này
    protected function convertRoute( $route ){
        $args = [ 
            'product' => 'product',
            'brand' => 'brand',
            'variant' => 'variant',
            'variantgroup' => 'variantgroup',
            'variantvalue' => 'variantvalue',
            'permission' => 'permission',
            'category' => 'category',
            'batch_product' => 'batch_product',
            'categoryinternal' => 'categoryinternal',
            'supplier' => 'supplier',
            'batch' => 'batch'

        ];

        return $args[ $route ];
    }

    public function returnRoute(){
        $args = [ 
            'product' => 'product' ,
            'brand' => 'brand',
            'variant' => 'variant',
            'variantgroup' => 'variantgroup',
            'variantvalue' => 'variantvalue',
            'permission' => 'permission',
            'category' => 'category',
            'batch_product' => 'batch_product',
            'categoryinternal' => 'categoryinternal',
            'supplier' => 'supplier',
            'batch' => 'batch'
    ];

        return $args;
    }

    /**
     * Determine if the request has a URI that should pass through verification.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function shouldPassThrough( $request ){
        $routePath = $request->path();
        $exceptsPAth = [
            'api/auth/login' ,
            'api/v1/auth/logout' ,
            'api/brand-all'
        ];
        return in_array( $routePath , $exceptsPAth );
    }


}
