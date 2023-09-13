<?php

namespace App\Imports;

use App\Models\CategoryInternal;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class CategoryInternalImport implements OnEachRow
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
            '0' => 'nullable',//cup_type
            '1' => 'required',//sup_code
            '2' => 'required',//sup_name
        ], [
            '1.required' => 'Chưa nhập giá trị tên tại dòng ' . ($rowIndex ),
            '2.required' => 'Thiếu giá trị cho mã tại dòng ' . ($rowIndex),
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
            $find = CategoryInternal::whereRaw("LOWER(cat_inter_code) = LOWER(?)", [$rowData[0]])->first();
            if($find){
                $rowData[0] = $find->cat_inter_id;
            }else{
                $this->failures[] = [
                    'row_index' => $rowIndex,
                    'errors' => 'Không tim thấy giá danh mục cha có mã trùng khớp tại '. ($rowIndex),
                ];
                return;
            }
        }
        $variantValue = CategoryInternal::create([
            'cat_inter_parent_id' => $rowData[0],
            'cat_inter_name' => $rowData[1],
            'cat_inter_code'=> $rowData[2],
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
