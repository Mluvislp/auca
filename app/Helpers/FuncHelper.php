<?php

use Carbon\Carbon;
use \Illuminate\Support\Facades\Auth;

if (!function_exists('DataInsert')) {
    function DataInsert($data , $ignore = [])
    {
        $output = [];
        if($data){
            foreach($data as $key => $val){
                if($key !== 'holdform' && !in_array($key, $ignore)){
                    $output[$key] = $val;
                }
            }
            if(!empty($output)){
                $output['user_id'] = Auth::check() ? Auth::user()->user_id : 0;
                $output['created_at'] =time();
                $output['updated_at'] =time();
            }
        }
        return $output;
    }
}
if (!function_exists('DataUpdate')) {
    function DataUpdate($data , $ignore = [])
    {
        $output = [];
        if($data){
            foreach($data as $key => $val){
                if($key !== 'holdform' && !in_array($key, $ignore)){
                    $output[$key] = $val;
                }
            }
            if(!empty($output)){
                $output['updated_at'] =time();
            }
        }
        return $output;
    }
}
if (!function_exists('CheckExist')) {
    function CheckExist($modal , $col , $val)
    {
        $result = $modal->where($col, $val)->exists();
        dd($result);
        return $result;
    }
}

if (!function_exists('uploadFile')) {
    function uploadFile($file)
    {
        if (!$file->isValid()) {
            return false;
        }
        $extension = $file->getClientOriginalExtension();
        $fileName = md5($file->getClientOriginalName() . time()) . '.' . $extension;
        $filePath = $file->storeAs('public', $fileName);
        if (!$filePath) {
            return false;
        }
        return $fileName;
    }
}
if (!function_exists('unlinkImage')) {
    function unlinkImage($file)
    {
        $path = public_path('storage/' . $file);
        if (file_exists($path)) {
            unlink($path);
            return true;
        }else{
            return false;
        }
    }
}
if (!function_exists('checkIsImageAndUpLoad')) {
    function checkIsImageAndUpLoad($file)
    {
        if ($file->isValid() && $file->isFile() && startsWith($file->getMimeType(), 'image/')) {
            $name = uploadFile($file);
            if ($name) {
                return $name;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
if (!function_exists('startsWith')) {
    function startsWith($string, $prefix)
    {
        return strncmp($string, $prefix, strlen($prefix)) === 0;
    }
}
if (!function_exists('genarateBarcode')) {
    function genarateBarcode($barcode)
    {
        if(empty($barcode)){
            $randomNumber = rand(10000000, 99999999);
            $barcode = 'PRD-' . str_pad($randomNumber, 8, '0', STR_PAD_LEFT);
        }else{
            $barcode = $barcode;
        }
        return $barcode;
    }
}
if (!function_exists('dateToTimeStamp')) {
    function dateToTimeStamp($date)
    {
        $carbonDate = Carbon::createFromFormat('d/m/Y', $date);
        return $carbonDate->timestamp;
    }
}
if (!function_exists('timeStampToDate')) {
    function timeStampToDate($timestamp)
    {
        $carbon = Carbon::createFromTimestamp($timestamp);
        return $carbon->toDateString();
    }
}
