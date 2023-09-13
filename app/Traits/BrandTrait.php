<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Models\BrandModel;
use App\Models\User;
use DB;
use JWTAuth;

trait BrandTrait {

    public function GetAll( $request ){
        $keyword    = $request->input( 'search' );
        $perPage    = $request->input( 'per_page' , 10 );
        $query      = BrandModel::query();
        $all_search = $request->all();
        if( !empty( $keyword ) ){
            $query->where( 'brand_name' , 'LIKE' , "%$keyword%" );
        }
        if( array_key_exists( 'columns' , $all_search ) ){
            foreach( $all_search[ 'columns' ] as $val ){
                if( is_null( $val[ 'search' ][ 'value' ] ) || !$val[ 'searchable' ] ){
                    continue;
                }else{
                    $operator        = ( $val[ 'name' ] == 'brand_id' ? '=' : 'LIKE' );
                    $percent_percent = ( $val[ 'name' ] == 'brand_id' ? "" : "%" );
                    $query->where( $val[ 'name' ] , $operator , $percent_percent.$val[ 'search' ][ 'value' ].$percent_percent );
                }
            }
        }
        if( $request->has( 'brand_id' ) ){
            $query->where( 'brand_id' , '=' , $request->input( 'brand_id' ) );
        }
        $brand = $query->orderByRaw('ISNULL(brand_order), brand_order')->paginate( $perPage );
        if( !$brand ){
            return MyHelper::response( false , 'No data found' , [] , 404 );
        }
        foreach( $brand as $val ){
            $user = User::where('user_id',$val[ 'user_id' ])->first();
            $val['create_by'] = $user->user_name;
            $val[ 'number' ] = [
                'order' => $val[ 'brand_order' ] ,
                'id' => $val[ 'brand_id' ]
            ];
            $val['created_at']=date('Y-m-d', strtotime($val['created_at']));
            $val['date'] = date('Y-m-d H:i:s', strtotime($val['created_at']));
            $val['status_data'] =[
                'id' => $val[ 'brand_id' ],
                'status' =>$val[ 'brand_status' ],
            ];
            if( isset( $val->brand_image ) ){
                $val[ 'brand_image' ] = asset( '/storage/'.$val[ 'brand_image' ] );
            }
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

    public function updatestatusFunc( $id ){

        $brand = BrandModel::where( 'brand_id' , $id )->first();
        if( !$brand ){
            return MyHelper::response( false , 'Not found' , [] , 404 );
        }else{

            DB::beginTransaction();
            try{
                DB::commit();
                if( $brand->brand_status == 1 || $brand->brand_status == '1' ){
                    $brand->brand_status = 2;
                    $brand->save();
                }else{
                    $brand->brand_status = 1;
                    $brand->save();
                }
                $brand->save();
            }catch( \Exception $ex ){
                DB::rollback();
                return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
            }

            return MyHelper::response( true , 'Successfully' , [ $brand ] , 200 );
        }
    }

    public function Created( $request ){
        $user = JWTAuth::parseToken()->authenticate();
        $req  = $request->all();
        DB::beginTransaction();
        try{
            DB::commit();
            $brand_parent_id    = $request->brand_parent_id ?? 0;
            $brand_name         = $request->brand_name ?? '';
            $brand_code         = $request->brand_code ?? 0;
            $brand_order        = $request->brand_order;
            $brand_description  = $request->brand_description ?? '';
            $brand_content      = $request->brand_content ?? '';
            $brand_meta_title   = $request->brand_meta_title ?? '';
            $brand_meta_keyword = $request->brand_meta_keyword ?? '';
            $brand_status       = $request->brand_status ?? 1;
            if( $request->hasFile( 'file' ) ){
                $file = MyHelper::Upload( $req );
            }else{
                $file = '';
            }
            if( $file == '' ){
                $filename = '';
            }else{
                $filename = implode( ',' , $file[ 'data' ] );
            }
            $brand_image               = $filename ?? '';
            $brand                     = new BrandModel;
            $brand->brand_parent_id    = $brand_parent_id;
            $brand->brand_name         = $brand_name;
            $brand->brand_code         = $brand_code;
            $brand->brand_order        = $brand_order;
            $brand->brand_description  = $brand_description;
            $brand->brand_content      = $brand_content;
            $brand->brand_image        = $brand_image;
            $brand->brand_meta_title   = $brand_meta_title;
            $brand->brand_meta_title   = $brand_meta_title;
            $brand->brand_meta_keyword = $brand_meta_keyword;
            $brand->brand_status       = $brand_status;
            $brand->user_id            = $user->user_id;
            $brand->save();
            return MyHelper::response( true , 'Successfully' , [] , 200 );
        }catch( \Exception $ex ){
            DB::rollback();
            return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
        }
    }


    public function updateContent( $request , $id ){
        $user     = JWTAuth::parseToken()->authenticate();
        $req      = $request->all();
        $brandval = BrandModel::where( 'brand_id' , $id )->first();
        if( !$brandval ){
            return MyHelper::response( false , 'not found' , [] , 404 );
        }else{
            DB::beginTransaction();
            try{
                DB::commit();
                if( $request->hasFile( 'file' ) ){
                    $file = MyHelper::Upload( $req );
                }else{
                    $file = '';
                }
                if( $file == '' ){
                    $filename = '';
                }else{
                    $filename    = implode( ',' , $file[ 'data' ] );
                    $brand_image = $filename ?? '';
                }
                $brand                     = BrandModel::where( 'brand_id' , $id )->first();
                $brand->brand_parent_id    = isset( $request->brand_parent_id ) ? $request->brand_parent_id : $brandval->brand_parent_id;
                $brand->brand_name         = isset( $request->brand_name ) ? $request->brand_name : $brandval->brand_name;
                $brand->brand_code         = isset( $request->brand_code ) ? $request->brand_code : $brandval->brand_code;
                $brand->brand_order        = isset( $request->brand_order ) ? $request->brand_order : $brandval->brand_order;
                $brand->brand_description  = isset( $request->brand_description ) ? $request->brand_description : $brandval->brand_description;
                $brand->brand_content      = isset( $request->brand_content ) ? $request->brand_content : $brandval->brand_content;
                $brand->brand_image        = isset( $filename ) ? $filename : $brandval->brand_image;
                $brand->brand_meta_title   = isset( $request->brand_meta_title ) ? $request->bbrand_meta_title : $brandval->brand_meta_title;
                $brand->brand_meta_keyword = isset( $request->brand_meta_keyword ) ? $request->brand_meta_keyword : $brandval->brand_meta_keyword;
                $brand->brand_status       = isset( $request->brand_status ) ? $request->brand_status : $brandval->brand_status;
                $brand->user_id            = $user->user_id;
                $brand->save();
                return MyHelper::response( true , 'Successfully' , [] , 200 );
            }catch( \Exception $ex ){
                DB::rollback();
                return MyHelper::response( false , $ex->getMessage().'at line'.$ex->getLine() , [] , 500 );
            }
        }
    }

    public function deleteContent( $id ){
        $brandval = BrandModel::where( 'brand_id' , $id )->first();
        if( !$brandval ){
            return MyHelper::response( false , 'not found' , [] , 404 );
        }else{
            $brandval->delete();
            return MyHelper::response( true , 'Successfully' , [] , 200 );
        }
    }
    public function getBrandForCombobox(){
        $brand = (new BrandModel())->getIdAndNameForCombo();
        if($brand){
            return $brand;
        }
        return [];
    }
}
