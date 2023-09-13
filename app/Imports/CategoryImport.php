<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class CategoryImport implements OnEachRow
{
    private $user_id;
    private $groupid;

    private $id_lv1 = 0;
    private $id_lv2 = 0;
    private $id_lv3 = 0;
    private $id_lv4 = 0;

    private  $failures     = [];
    private  $countsuccess = 0;
    private  $counttotal   = 0;

    private  $skipFirstRow = true;
    private  $firstRowData = true;
    private  $endProcess = false;

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
        if($this->endProcess){
            return;
        }
        $this->counttotal +=1;
        $rowIndex = $row->getIndex();
        $rowData = $row->toArray();

        $model = new Category();
        $tableName = $model->getTable();
        if($this->firstRowData){
            if(empty($rowData[1])){
                $this->endProcess = true;
                $this->failures[] = [
                    'row_index' => $rowIndex,
                    'errors' => 'Dòng đầu tiên phải là danh mục cấp 1',
                ];
                return;
            }
        }
        $validator = validator($rowData, [
            '0' => 'required|unique:' . $tableName . ',cat_code',//cat_code
            '1' => 'nullable',//lv1
            '2' => 'nullable',//lv2
            '3' => 'nullable',//lv3
            '4' => 'nullable',//lv4
            '5' => 'nullable',//status
            '6' => 'nullable',//show
        ], [
            '0.required' => 'Chưa nhập giá trị mã danh mục tại dòng ' . ($rowIndex ),
            '0.unique' => 'Giá trị mã danh mục tại dòng ' . ($rowIndex) . ' đã tồn tại',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $this->failures[] = [
                'row_index' => $rowIndex,
                'errors' => $errors,
            ];
            return;
        }
        if(empty($rowData[5])||is_null($rowData[5])){
            $rowData[5] = 2;
        }
        if(empty($rowData[6])||is_null($rowData[6])){
            $rowData[6] = 2;
        }
        if($this->firstRowData){
            if(empty($rowData[1])){
                $this->endProcess = true;
                $this->failures[] = [
                    'row_index' => $rowIndex,
                    'errors' => 'Dòng đầu tiên phải là danh mục cấp 1',
                ];
                return;
            }else{
                $count_val = 0;
                for($i = 1 ; $i < 5 ; $i++){
                    if(!empty($rowData[$i])){
                        $count_val +=1;
                    }
                }
                if($count_val > 1){
                    $this->endProcess = true;
                    $this->failures[] = [
                        'row_index' => $rowIndex,
                        'errors' => "Chỉ có thể nhập 1 giá trị ở dòng ". ($rowIndex),
                    ];
                    return;
                }
                $id = Category::insertGetId([
                    'cat_code' => $rowData[0],
                    'cat_name' => $rowData[1],
                    'cat_status'=> $rowData[5],
                    'groupid' => $this->groupid,
                    'user_id'=> $this->user_id,
                    'created_at'=> time(),
                    'updated_at'=> time(),
                ]);
                if($id){
                    $this->countsuccess += 1;
                    $this->id_lv1 = $id;
                    $this->firstRowData = false;
                }else{
                    $this->endProcess = true;
                    $this->failures[] = [
                        'row_index' => $rowIndex,
                        'errors' => "Lỗi khi tạo dữ liệu cho dòng ". ($rowIndex),
                    ];
                    return;
                }
            }
        }else{
            $count_val = 0;
            for($i = 1 ; $i < 5 ; $i++){
                if(!empty($rowData[$i])){
                    $count_val +=1;
                }
            }
            if($count_val > 1){
                $this->failures[] = [
                    'row_index' => $rowIndex,
                    'errors' => "Chỉ có thể nhập 1 giá trị ở dòng ". ($rowIndex),
                ];
                return;
            }
            for($i = 1 ; $i < 5 ; $i++){
                if(!empty($rowData[$i])){
                    switch($i){
                        case 1:
                            $id = Category::insertGetId([
                                'cat_code' => $rowData[0],
                                'cat_name' => $rowData[1],
                                'cat_status'=> $rowData[5],
                                'groupid' => $this->groupid,
                                'user_id'=> $this->user_id,
                                'created_at'=> time(),
                                'updated_at'=> time(),
                            ]);
                            if($id){
                                $this->countsuccess += 1;
                                $this->id_lv1 = $id;
                            }else{
                                $this->failures[] = [
                                    'row_index' => $rowIndex,
                                    'errors' => "Lỗi khi tạo dữ liệu cho dòng ". ($rowIndex),
                                ];
                            }
                            break;
                        case 2:
                            if($this->id_lv1 == 0){
                                $this->failures[] = [
                                    'row_index' => $rowIndex,
                                    'errors' => "Chưa có danh mục cấp 1 cho dòng ". ($rowIndex),
                                ];
                            }else{
                                $id = Category::insertGetId([
                                    'cat_parent_id' => $this->id_lv1,
                                    'cat_name' => $rowData[2],
                                    'cat_code' => $rowData[0],
                                    'cat_status'=> $rowData[5],
                                    'groupid' => $this->groupid,
                                    'user_id'=> $this->user_id,
                                    'created_at'=> time(),
                                    'updated_at'=> time(),
                                ]);
                                if($id){
                                    $this->countsuccess += 1;
                                    $this->id_lv2 = $id;
                                }else{
                                    $this->failures[] = [
                                        'row_index' => $rowIndex,
                                        'errors' => "Lỗi khi tạo dữ liệu cho dòng ". ($rowIndex),
                                    ];
                                }
                            }
                            break;
                        case 3:
                            if($this->id_lv2 == 0){
                                $this->failures[] = [
                                    'row_index' => $rowIndex,
                                    'errors' => "Chưa có danh mục cấp 2 cho dòng ". ($rowIndex),
                                ];
                            }else{
                                $id = Category::insertGetId([
                                    'cat_parent_id' => $this->id_lv1,
                                    'cat_code' => $rowData[0],
                                    'cat_name' => $rowData[3],
                                    'cat_status'=> $rowData[5],
                                    'groupid' => $this->groupid,
                                    'user_id'=> $this->user_id,
                                    'created_at'=> time(),
                                    'updated_at'=> time(),
                                ]);
                                if($id){
                                    $this->countsuccess += 1;
                                    $this->id_lv3 = $id;
                                }else{
                                    $this->failures[] = [
                                        'row_index' => $rowIndex,
                                        'errors' => "Lỗi khi tạo dữ liệu cho dòng ". ($rowIndex),
                                    ];
                                }
                            }
                            break;
                        case 4:
                            if($this->id_lv3 == 0){
                                $this->failures[] = [
                                    'row_index' => $rowIndex,
                                    'errors' => "Chưa có danh mục cấp 3 cho dòng ". ($rowIndex),
                                ];
                            }else{
                                $id = Category::insertGetId([
                                    'cat_parent_id' => $this->id_lv1,
                                    'cat_code' => $rowData[0],
                                    'cat_name' => $rowData[4],
                                    'cat_status'=> $rowData[5],
                                    'groupid' => $this->groupid,
                                    'user_id'=> $this->user_id,
                                    'created_at'=> time(),
                                    'updated_at'=> time(),
                                ]);
                                if($id){
                                    $this->countsuccess += 1;
                                }else{
                                    $this->failures[] = [
                                        'row_index' => $rowIndex,
                                        'errors' => "Lỗi khi tạo dữ liệu cho dòng ". ($rowIndex),
                                    ];
                                }
                            }
                            break;
                        default :
                            return;
                    }
                }
            }
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
