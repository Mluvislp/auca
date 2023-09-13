<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Imports\SupplierImport;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = Supplier::all();
        return view( 'backend.page.store.supplier.supplier' , compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $hideViewPartial = $request->input('hideViewPartial');
        return view( 'backend.page.store.supplier.add_supplier' ,compact('hideViewPartial'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ){
        $rules                     = [
            'is_iframe' =>'nullable' ,
            'sup_name' => 'bail|required|unique:supplier,sup_name' ,
            'sup_code' => 'nullable|unique:supplier,sup_code',
            'sup_representative_name' => 'nullable' ,
            'sup_representative_position' => 'nullable' ,
            'sup_representative_mobile' => 'nullable' ,
            'sup_tel' => 'bail|required|numeric' ,
            'sup_email' => 'nullable|email' ,
            'sup_address' => 'nullable' ,
            'sup_tax_code' => 'nullable' ,
            'sup_type_id' => 'bail|required|numeric' ,
            'sup_personal_id' => 'nullable|numeric' ,
            'sup_bank_name' => 'nullable' ,
            'sup_bank_branch' => 'nullable' ,
            'sup_bank_account_number' => 'nullable|numeric' ,
            'sup_bank_account_holder' => 'nullable' ,
            'sup_note' => 'nullable' ,
            'sup_status' => 'numeric|in:1,2'
        ];
        $messages                  = [
            'sup_name.required' => 'Tên nhà cung cấp là bắt buộc.' ,
            'sup_name.unique' => 'Tên nhà cung cấp đã tồn tại.' ,
            'sup_code.unique' => 'Mã nhà cung cấp đã tồn tại.' ,
            'sup_tel.required' => 'Số điện thoại là bắt buộc.' ,
            'sup_tel.numeric' => 'Số điện thoại phải là số.' ,
            'sup_email.email' => 'Địa chỉ email không hợp lệ.' ,
            'sup_type_id.required' => 'Loại nhà cung cấp là bắt buộc.' ,
            'sup_type_id.numeric' => 'Loại nhà cung cấp phải là số.' ,
        ];
        $validator                 = Validator::make( $request->except( '__token' ) , $rules , $messages );
        $validated                 = $validator->validated();
        $validated[ 'user_id' ]    = auth()->user()->user_id;
        $validated[ 'groupid' ]    = auth()->user()->groupid;
        $validated[ 'created_at' ] = time();
        $validated[ 'updated_at' ] = time();
        if( Supplier::create( $validated ) ){
            if(isset($validated['is_iframe']) && !empty($validated['is_iframe']) && !is_null($validated['is_iframe'])){
                return redirect()->back()->with( [
                    'message_status' => 'success' ,
                    'message' => 'Thêm mới thành công'
                ] );
            }else{
                return redirect(route( 'suppliers.index' ))->with( [
                    'message_status' => 'success' ,
                    'message' => 'Thêm mới thành công'
                ] );
            }
        }else{
            return redirect()->back()->with( [
                'message_status' => "error" ,
                "message" => "Thêm giá trị thất bại ! vui lòng kiểm tra lại"
            ] )->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function show( Supplier $supplier ){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit( Supplier $supplier ){
        return view( 'backend.page.store.supplier.edit_supplier' , compact( 'supplier' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request , Supplier $supplier ){
        $rules                          = [
            'sup_name' => [
                'bail' ,
                'required' ,
                Rule::unique( 'supplier' , 'sup_name' )->where( function( $query ) use ( $supplier ){
                    $query->where( 'sup_id' , '!=' , $supplier->sup_id );
                } ) ,
            ] ,
            'sup_code' => [
                'bail' ,
                Rule::unique( 'supplier' , 'sup_code' )->where( function( $query ) use ( $supplier ){
                    $query->where( 'sup_id' , '!=' , $supplier->sup_id );
                } )
            ] ,
            'sup_representative_name' => 'nullable' ,
            'sup_representative_position' => 'nullable' ,
            'sup_representative_mobile' => 'nullable' ,
            'sup_tel' => 'bail|required|numeric' ,
            'sup_email' => 'nullable|email' ,
            'sup_address' => 'nullable' ,
            'sup_tax_code' => 'nullable' ,
            'sup_type_id' => 'bail|required|numeric' ,
            'sup_personal_id' => 'nullable|numeric' ,
            'sup_bank_name' => 'nullable' ,
            'sup_bank_branch' => 'nullable' ,
            'sup_bank_account_number' => 'nullable|numeric' ,
            'sup_bank_account_holder' => 'nullable' ,
            'sup_note' => 'nullable' ,
            'sup_status' => 'numeric|in:1,2'
        ];
        $messages = [
            'sup_name.required' => 'Trường Tên nhà cung cấp là bắt buộc.',
            'sup_name.unique' => 'Trường Tên nhà cung cấp đã tồn tại.',
            'sup_code.unique' => 'Trường Mã nhà cung cấp đã tồn tại.',
            'sup_tel.required' => 'Trường Số điện thoại là bắt buộc.',
            'sup_tel.numeric' => 'Trường Số điện thoại phải là số.',
            'sup_email.email' => 'Trường Email phải là địa chỉ email hợp lệ.',
            'sup_type_id.required' => 'Trường Loại nhà cung cấp là bắt buộc.',
            'sup_type_id.numeric' => 'Trường Loại nhà cung cấp phải là số.',
            'sup_bank_account_number.numeric' => 'Trường Số tài khoản ngân hàng phải là số.',
            'sup_status.in' => 'Trường Trạng thái không hợp lệ.',
        ];

        $validator                      = Validator::make( $request->except( [
            '__token' ,
            '__method'
        ] ) , $rules , $messages);
        $validated                      = $validator->validated();
        $validated[ 'user_id' ]         = auth()->user()->user_id;
        $validated[ 'sup_type_id' ]     = 1;
        $validated[ 'sup_personal_id' ] = auth()->user()->user_id;
        foreach( $validated as $key => $value ){
            $supplier->$key = $value;
        }
        if( $supplier->save() ){
            return redirect(route( 'suppliers.index' ))->with( [
                'message_status' => 'success' ,
                'message' => 'Cập nhật thành công'
            ] );
        }else{
            return redirect()->back()->with( [
                'message_status' => "error" ,
                "message" => "Thêm giá trị thất bại ! vui lòng kiểm tra lại"
            ] )->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy( Supplier $supplier ){
        if( $supplier->delete() ){
            return redirect( route( 'suppliers.index' ) );
        }
    }
    public function restore( $supplierId ){
        $restoredSupplier = Supplier::onlyTrashed()->where( 'sup_id' , $supplierId )->first();

        if( $restoredSupplier ){
            $restoredSupplier->restore();
            return redirect()->route( 'suppliers.index' );
        }
    }
    public function forcedelete( $supplierId ){
        $restoredSupplier = Supplier::onlyTrashed()->where( 'sup_id' , $supplierId )->first();

        if( $restoredSupplier ){
            $restoredSupplier->forcedelete();
            return redirect()->route( 'suppliers.index' );
        }
    }
    public function import(){
        return view( 'backend.page.store.supplier.importexcel');
    }}
