<?php

namespace App\Traits;

use App\Http\Functions\MyHelper;
use App\Imports\SupplierImport;
use App\Models\Supplier;
use Auth;
use Carbon\Carbon;
use DB;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

trait SupplierTrait {
    public function listAlSupplier( $request ){
        $perPage        = $request->input( 'per_page' , 10 );
        $query          = Supplier::query();
        $all_search     = $request->all();
        if( array_key_exists( 'filter_sup_name' , $all_search ) && !empty( $all_search[ 'filter_sup_name' ] ) ){
            $query->where( 'sup_name' ,"LIKE", "%".$all_search[ 'filter_sup_name' ]."%" );
        }
        if( array_key_exists( 'filter_sup_tel' , $all_search ) && !empty( $all_search[ 'filter_sup_tel' ] ) ){
            $query->where( 'sup_tel' ,"LIKE", "%".$all_search[ 'filter_sup_tel' ]."%" );
        }
        if( array_key_exists( 'filter_sup_id' , $all_search ) && !empty( $all_search[ 'filter_sup_id' ] ) ){
            $query->where( 'sup_id' , $all_search[ 'filter_sup_id' ] );
        }
        if (array_key_exists('filter_from_date', $all_search) && !empty($all_search['filter_from_date'])) {
            $fromDate = Carbon::parse($all_search['filter_from_date'])->startOfDay();
            $query->where('created_at', '>=', $fromDate);
        }
        if (array_key_exists('filter_to_date', $all_search) && !empty($all_search['filter_to_date'])) {
            $toDate = Carbon::parse($all_search['filter_to_date'])->endOfDay();
            $query->where('created_at', '<=', $toDate);
        }
        if( array_key_exists( 'filter_sup_type' , $all_search ) && !empty( $all_search[ 'filter_sup_type' ] ) ){
            $query->where( 'sup_type_id' , $all_search[ 'filter_sup_type' ] );
        }
        if( array_key_exists( 'filter_sup_status' , $all_search ) && !empty( $all_search[ 'filter_sup_status' ] ) ){
            $query->where( 'sup_status' , $all_search[ 'filter_sup_status' ] );
        }
        if( array_key_exists( 'filter_sup_status' , $all_search ) && !empty( $all_search[ 'filter_sup_status' ] ) ){
            $query->where( 'sup_status' , $all_search[ 'filter_sup_status' ] );
        }
        if (array_key_exists('filter_user_name', $all_search) && !empty( $all_search[ 'filter_user_name' ] ) ) {
            $query->whereHas('user', function ($q) use ($all_search) {
                $q->where('user_name','LIKE' ,"%".$all_search['filter_user_name']."%");
            });
        }
        $supplier = $query->with( 'user' )->orderBy('created_at' , "DESC")->paginate( $perPage );
        if( !$supplier ){
            return MyHelper::response( false , 'No data found' , [] , 404 );
        }
        $data = [
            'data' => collect( $supplier->items() )->map( function( $supplier ){
                $supplier->user_name = $supplier->user ? $supplier->user->user_name : "---";
                unset( $supplier->user );
                $supplier->sup_type_name   = getNameSupplierType( $supplier->sup_type_id );
                $supplier->sup_status_name = $supplier->sup_status == 1 ? "Đang giao dịch" : "Ngưnng giao dịch";
                return $supplier;
            } ) ,
            'total' => $supplier->total() ,
            'per_page' => $supplier->perPage() ,
            'current_page' => $supplier->currentPage() ,
        ];
        return MyHelper::response( true , 'Successfully' , $data , 200 );
    }


    public function deleteSupplier( $req ){
        $validator = Validator::make( $req->all() , [
            'id' => 'required|integer' ,
        ] );
        if( $validator->fails() ){
            return MyHelper::response( false , 'Kiểm tra lại định dạng dữ liệu' , [] , 404 );
        }
        $req          = $req->all();
        $model = ( new Supplier() )->findFirstById( $req[ 'id' ] );
        if( !$model ){
            return MyHelper::response( false , 'Không tìm thấy dữ liệu' , [] , 404 );
        }
        $deleted = $model->delete();
        if( $deleted ){
            return MyHelper::response( true , 'Xoá thành công id : '.$req[ 'id' ] , [] , 200 );
        }else{
            return MyHelper::response( false , 'Không thành công' , [] , 404 );
        }
    }
    public function handleExportSupplier( $req){
        try{
            $all_search     = $req->all();
            $query      = Supplier::query();
            if( array_key_exists( 'filter_sup_name' , $all_search ) && !empty( $all_search[ 'filter_sup_name' ] ) ){
                $query->where( 'sup_name' , "LIKE" , "%".$all_search[ 'filter_sup_id' ]."%" );
            }
            if( array_key_exists( 'filter_sup_tel' , $all_search ) && !empty( $all_search[ 'filter_sup_tel' ] ) ){
                $query->where( 'sup_tel' , "LIKE" , "%".$all_search[ 'filter_sup_tel' ]."%" );
            }
            if( array_key_exists( 'filter_sup_id' , $all_search ) && !empty( $all_search[ 'filter_sup_id' ] ) ){
                $query->where( 'sup_id' , $all_search[ 'filter_sup_id' ] );
            }
            if( array_key_exists( 'filter_from_date' , $all_search ) && !empty( $all_search[ 'filter_from_date' ] ) ){
                $fromDate = Carbon::parse( $all_search[ 'filter_from_date' ] )->startOfDay();
                $query->where( 'created_at' , '>=' , $fromDate );
            }
            if( array_key_exists( 'filter_to_date' , $all_search ) && !empty( $all_search[ 'filter_to_date' ] ) ){
                $toDate = Carbon::parse( $all_search[ 'filter_to_date' ] )->endOfDay();
                $query->where( 'created_at' , '<=' , $toDate );
            }
            if( array_key_exists( 'filter_sup_type' , $all_search ) && !empty( $all_search[ 'filter_sup_type' ] ) ){
                $query->where( 'sup_type_id' , $all_search[ 'filter_sup_type' ] );
            }
            if( array_key_exists( 'filter_sup_status' , $all_search ) && !empty( $all_search[ 'filter_sup_status' ] ) ){
                $query->where( 'sup_status' , $all_search[ 'filter_sup_status' ] );
            }
            if( array_key_exists( 'filter_sup_status' , $all_search ) && !empty( $all_search[ 'filter_sup_status' ] ) ){
                $query->where( 'sup_status' , $all_search[ 'filter_sup_status' ] );
            }
            if( array_key_exists( 'filter_user_name' , $all_search ) && !empty( $all_search[ 'filter_user_name' ] ) ){
                $query->whereHas( 'user' , function( $q ) use ( $all_search ){
                    $q->where( 'user_name' , 'LIKE' , "%".$all_search[ 'filter_user_name' ]."%" );
                } );
            }
            $supplier = $query->with( 'user' )->get();
            $supplier = collect( $supplier )->map( function( $supplier ){
                $supplier->user_name = $supplier->user ? $supplier->user->user_name : "---";
                unset( $supplier->user );
                $supplier->sup_type_name   = getNameSupplierType( $supplier->sup_type_id );
                $supplier->sup_status_name = $supplier->sup_status == 1 ? "Đang giao dịch" : "Ngưnng giao dịch";
                unset( $supplier->sup_representative_name );
                unset( $supplier->sup_representative_position );
                unset( $supplier->sup_representative_mobile );
                unset( $supplier->sup_tax_code );
                unset( $supplier->sup_personal_id );
                unset( $supplier->sup_type_id );
                unset( $supplier->created_at );
                unset( $supplier->updated_at );
                unset( $supplier->deleted_at );
                unset( $supplier->groupid );
                unset( $supplier->user_id );
                unset( $supplier->sup_status );
                unset( $supplier->sup_note );
                return [
                    $supplier->sup_id ,
                    $supplier->sup_code ,
                    $supplier->sup_name ,
                    $supplier->sup_address ,
                    $supplier->sup_type_name ,
                    $supplier->sup_tel ,
                    $supplier->sup_email ,
                    $supplier->sup_bank_name ,
                    $supplier->sup_bank_branch ,
                    $supplier->sup_bank_account_number ,
                    $supplier->sup_bank_account_holder ,
                    $supplier->user_name ,
                    $supplier->sup_status_name ,
                ];
            } );
            return MyHelper::response( true , 'Successfully' , $supplier , 200 );
        }catch(\Exception $e){
            return MyHelper::response( false , 'Đã có lỗi xảy ra trong quá trình lấy dữ liệu' , [] , 404 );
        }
    }
    public function handleImportSupplier($req){
        try{
            $import = new SupplierImport();
            Excel::import( $import , $req->file( 'fileUpload' ) );
            $total     = $import->getTotal();
            $failures  = $import->getFailures();
            $successes = $import->getSuccesses();
            $fail_data = [];
            if( !empty( $failures ) ){
                foreach( $failures as $failure ){
                    $rowIndex    = $failure[ 'row_index' ];
                    $errors      = $failure[ 'errors' ];
                    $fail_data[] = [
                        'row_index' => $rowIndex ,
                        'errors' => $errors ,
                    ];
                }
            }
            $import_response_data = [
                'success_count' => $successes ,
                'fail_data' => $fail_data ,
                'total_record' => $total ,
            ];
            if( $successes > 0 ){
                return MyHelper::response( true , "Thêm mới liệu thành công" , $import_response_data , 200 );
            }else{
                return MyHelper::response( false , 'Đã có lỗi xảy ra trong quá trình thêm dữ liệu' , $import_response_data , 404 );
            }
        }catch( \Exception $e ){
            return MyHelper::response( false , 'Đã có lỗi xảy ra trong quá trình thêm dữ liệu' , [] , 404 );
        }
    }

}
