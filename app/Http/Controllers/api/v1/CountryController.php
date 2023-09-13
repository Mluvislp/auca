<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Traits\CountryTraits;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use CountryTraits;
    public function getAll(Request $req){
        return $this->ListAll($req);
    }
}
