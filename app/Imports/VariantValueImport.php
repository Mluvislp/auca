<?php

namespace App\Imports;

use App\Models\VariantValue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class VariantValueImport implements OnEachRow
{
    private $id;
    private $user_id;

    private $failures = [];
    private $countsuccess = 0;
    private $counttotal = 0;

    private $skipFirstRow = true;

    public function __construct($id)
    {
        $this->id = $id;
        $this->user_id = Auth::user()->user_id;
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
            '0' => 'nullable|numeric',//parent_id
            '1' => 'required',//name
            '2' => 'nullable',
            '3' => 'nullable',
            '4' =>  [
                'nullable',
                Rule::unique('variant_value', 'vv_code'),
            ],
            '5' => 'nullable',
            '6' => 'nullable',
            '7' => 'nullable|numeric',
        ], [
            '0.numeric' => 'Giá trị của thuộc tính cha không hợp lệ tại dòng ' . ($rowIndex ),
            '1.required' => 'Thiếu giá trị tên tại dòng ' . ($rowIndex),
            '4.unique' => 'Mã đã tồn tại tại dòng ' . ($rowIndex),
            '7.numeric' => 'Giá trị của thứ tự không hợp lệ tại dòng ' . ($rowIndex),

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $this->failures[] = [
                'row_index' => $rowIndex,
                'errors' => $errors,
            ];
            return;
        }
        $variantValue = VariantValue::create([
            'vv_parent_id' => $rowData[0],
            'vv_name' => $rowData[1],
            'var_id'=> $this->id,
            'vv_value'=> $rowData[3],
            'vv_other_name'=> $rowData[2],
            'vv_code'=> $rowData[4],
            'vv_other_code'=> $rowData[5],
            'vv_unit'=> $rowData[6],
            'vv_order'=> $rowData[7],
            'user_id'=> $this->user_id,
        ]);
        if($variantValue){
            $this->countsuccess += 1;
        }else{
            $this->failures[] = [
                'row_index' => $rowIndex,
                'errors' => "Lỗi khi tạo dữ liệu",
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
