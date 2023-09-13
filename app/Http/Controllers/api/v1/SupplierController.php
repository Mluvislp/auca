<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Traits\SupplierTrait;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use SupplierTrait;
    public function getAll( Request $request ){
        return $this->listAlSupplier( $request );
    }
    public function delete( Request $req ){
        return $this->deleteSupplier( $req );
    }
    public function export( Request $req ){
        return $this->handleExportSupplier( $req );
    }
    public function import( Request $req ){
        return $this->handleImportSupplier( $req );
    }
}
