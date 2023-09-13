<?php
namespace App\Http\Functions;

use Illuminate\Support\Facades\Auth;

class MyHelper
{
    public static function Response($status = false, $message = "Fobidden", $data = [], $code = 500)
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data], $code);
    }
    public static function Upload($data){
        if (array_key_exists('file', $data)) {
            if (count($data['file']) > 1) {
                $ar = [];
                foreach ($data['file'] as $file) {
                    $fname = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
                    array_push($ar,
                
                             $fname,
                    );
                    $file->storeAs('public', $fname);
                }

                return ['error' => '' ,'data' => $ar];
            } else {
                $fname = md5($data['file'][0]->getClientOriginalName() . time()) . '.' . $data['file'][0]->getClientOriginalExtension();
                $data['file'][0]->storeAs('public', $fname);
            }
            $type = 'file';
            return ['error' => '' ,'data' => [$fname]];
        } else {
            return ['error' => '' ,'data' => []];
        }
    }
}
