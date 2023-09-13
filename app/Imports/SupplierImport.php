<?php

namespace App\Imports;

use App\Models\Supplier;
use App\Models\SupplierType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class SupplierImport implements OnEachRow
{
    private $user_id;
    private $groupid;

    private  $failures     = [];
    private  $countsuccess = 0;
    private  $counttotal   = 0;

    private  $skipFirstRow = true;

    public function __construct()
    {
        $this->user_id = Auth::user()->user_id;
        $this->groupid = Auth::user()->groupid;
    }

    public function onRow(Row $row)
    {
        if ($this->skipFirstRow) {
            $this->skipFirstRow = false;
            return; // Bỏ qua dòng đầu tiên
        }
        $this->counttotal +=1;
        $rowIndex = $row->getIndex();
        $rowData = $row->toArray();
        $validator = validator($rowData, [
            '0' => 'required',//cup_type
            '1' => [
                'nullable',
                Rule::unique('supplier', 'sup_code'),
            ],//sup_code
            '2' => 'required',//sup_name
            '3' => 'nullable',
            '4' => 'nullable|numeric',
            '5' => 'nullable|email',
            '6' => 'nullable',
            '7' => 'nullable',
            '8' => 'nullable|numeric',
            '9' => 'nullable',
            '10' => 'nullable|numeric',
            '11' => 'nullable',
            '12' => 'nullable',
            '13' => 'nullable|numeric',
            '14' => 'nullable',
            '15' => 'nullable',
        ], [
            '0.required' => 'Chưa nhập giá trị cho loại hình dòng ' . ($rowIndex ),
            '1.unique' => 'Mã đã tồn tại tại dòng ' . ($rowIndex),
            '2.required' => 'Thiếu giá trị tên tại dòng ' . ($rowIndex),
            '4.numeric' => 'Sai giá trị số điện thoại dòng ' . ($rowIndex),
            '5.email' => 'Sai giá trị email dòng ' . ($rowIndex),
            '8.numeric' => 'Giá trị của CCCD/CMTND không hợp lệ tại dòng ' . ($rowIndex),
            '10.numeric' => 'Giá trị số điện thoại không lệ tại dòng ' . ($rowIndex),
            '13.numeric' => 'Giá trị số tài khoản không lệ tại dòng ' . ($rowIndex),
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $this->failures[] = [
                'row_index' => $rowIndex,
                'errors' => $errors,
            ];
            return;
        }
        if(!empty($rowData[0])){
            $find = SupplierType::whereRaw("LOWER(sup_type_name) = LOWER(?)", [$rowData[0]])->first();
            if($find){
                $rowData[0] = $find->sup_type_id;
            }else{
                $this->failures[] = [
                    'row_index' => $rowIndex,
                    'errors' => 'Không tim thấy loại hình doanh nghiệp hợp lệ tại dòng '. ($rowIndex),
                ];
                return;
            }
        }
        $variantValue = Supplier::create([
            'sup_type_id' => $rowData[0],
            'sup_code' => $rowData[1],
            'sup_name'=> $rowData[2],
            'sup_address'=> $rowData[3],
            'sup_tel'=> $rowData[4],
            'sup_email'=> $rowData[5],
            'sup_tax_code'=> $rowData[6],
            'sup_representative_name'=> $rowData[7],
            'sup_personal_id'=> $rowData[8],
            'sup_representative_position'=> $rowData[9],
            'sup_representative_mobile'=> $rowData[10],
            'sup_bank_name'=> $rowData[11],
            'sup_bank_branch'=> $rowData[12],
            'sup_bank_account_number'=> $rowData[13],
            'sup_bank_account_holder'=> $rowData[14],
            'sup_note'=> $rowData[15],
            'sup_status' => 1,
            'groupid' => $this->groupid,
            'user_id'=> $this->user_id,
            'created_at'=> time(),
            'updated_at'=> time(),
        ]);
        if($variantValue){
            $this->countsuccess += 1;
        }else{
            $this->failures[] = [
                'row_index' => $rowIndex,
                'errors' => "Lỗi khi tạo dữ liệu cho dòng ". ($rowIndex),
            ];
        }
    }

    public function getFailures()
    {
        return $this->failures;
    }
    public function getSuccesses()
    {
        return $this->countsuccess;
    }
    public function getTotal()
    {
        return $this->counttotal;
    }


    public function model( array $row ){
        // TODO: Implement model() method.
    }
}
