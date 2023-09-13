<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\BrandTrait;
use App\Traits\CategoryInternalTrait;
use App\Traits\CategoryTrait;
use App\Traits\ProductTraits;
use App\Traits\ProductTypeTraits;
use App\Traits\WarehouseTrait;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    use WarehouseTrait ,
        BrandTrait ,
        CategoryTrait ,
        CategoryInternalTrait ,
        ProductTypeTraits;
    public function inventory(){
        $warehouse = $this->getAllWareHouseView();
        $brand = $this->getBrandForCombobox();
        $type_product = $this->getProductTypeForCombobox();
        $categories = $this->getIdAndNameCategoryForCombo();
        $categories_internal = $this->getIdAndNameCategoryInternal();
        return view('backend.page.warehouse.inventory.inventory' , compact(
            'warehouse',
            'brand',
            'type_product',
            'categories',
            'categories_internal',
            )
        );
    }
}
