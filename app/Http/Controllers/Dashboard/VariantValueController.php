<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Imports\VariantValueImport;
use App\Traits\VariantTrait;
use App\Traits\VariantValueTrait;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VariantValueController extends Controller {
    use VariantTrait , VariantValueTrait;
    public  function variantValue(Request $request){
        $variant_id = $request->query('variant');
        $variant_model = $this->getVariant($variant_id);
        if( empty( $variant_id ) || is_null( $variant_id ) || !$variant_model ){
            return redirect( '/notfound' );
        }
        return view( 'backend.page.store.variant.attribute' , compact('variant_id'));
    }
    public  function create(Request $request){
        $variant_id = $request->query('variant');
        $variant_model = $this->getVariant($variant_id);
        if( empty( $variant_id ) || is_null( $variant_id ) || !$variant_model ){
            return redirect( '/notfound' );
        }
        $variant_value = $this->getIdAndNameVariantValue();
        return view( 'backend.page.store.variant.createattribute' ,compact('variant_value' , 'variant_id'));
    }
    public  function edit(Request $request){
        $variant_id = $request->query('variant');
        $variant_value_id = $request->query('variant_value');
        $variant_model = $this->getVariant($variant_id);
        $variant_value_model = $this->getVariantValue($variant_value_id);
        if( empty( $variant_id ) || is_null( $variant_id ) || !$variant_model || empty( $variant_value_id ) || is_null( $variant_value_id || !$variant_value_model)){
            return redirect( '/notfound' );
        }
        $variant_value = $this->getIdAndNameVariantValue();
        return view( 'backend.page.store.variant.editattribute' ,compact('variant_value' , 'variant_id','variant_value_id','variant_value_model'));
    }
    public function import( Request $request ){
        $id = $request->query( 'id' );
        if( empty( $id ) || is_null( $id ) ){
            return redirect( '/notfound' );
        }
        $variant = $this->getVariant( $id );
        if( $variant ){
            return view( 'backend.page.store.variant.importvariantvalue' , compact( 'variant' ) );
        }else{
            return redirect( '/notfound' );
        }
    }

    public function handleImportValue( Request $request ){
        try{
            $id     = $request->input( 'var_id' );
            $import = new VariantValueImport( $id );
            Excel::import( $import , $request->file( 'fileUpload' ) );

            $total     = $import->getTotal();
            $failures  = $import->getFailures();
            $successes = $import->getSuccesses();
            $fail_data = [];

            if( !empty( $failures ) ){
                foreach( $failures as $failure ){
                    $rowIndex    = $failure['row_index'];
                    $errors      = $failure['errors'];
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
                return redirect()->back()->with( [
                    'message_status' => 'success' ,
                    'message' => 'Thêm mới thành công'
                ] )->with(['import_response_data' => $import_response_data] );
            }else{
                return redirect()->back()->with( [
                    'message_status' => 'error' ,
                    'message' => 'Thêm mới thất bại' ,
                ] )->with(['import_response_data' => $import_response_data] );
            }
        }catch( \Exception $e ){
            return redirect()->back()->with( [
                'message_status' => "error" ,
                "message" => "Thêm giá trị thất bại ! vui lòng kiểm tra lại"
            ] )->withInput();
        }
    }
}
