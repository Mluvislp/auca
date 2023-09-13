<?php

namespace App\Exports;

use App\Models\Supplier;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SupplierExport implements FromCollection , WithHeadings {
    protected $all_search;

    public function __construct( $filterData ){
        $this->all_search = $filterData;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(){
        $all_search = $this->all_search;
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
        //Chạy
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
        return $supplier;
    }

    public function headings(): array{
        return [
            'ID' ,
            'Mã nhà cung cấp' ,
            'Tên nhà cung cấp' ,
            'Địa chỉ' ,
            'Loại nhà cung cấp' ,
            'Số điện thoại' ,
            'Email' ,
            'Ngân hàng' ,
            'Chi nhánh' ,
            'Số tài khoản' ,
            'Chủ tài khoản' ,
            'Người tạo' ,
            'Trạng thái' ,
        ];
    }
}
