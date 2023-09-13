<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('auth/login', [AuthController::class, 'login'])->name('loginApi');
// Route::middleware('auth:sanctum')->get('/user', functon (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1', 'middleware' => ['auth:api'], 'namespace' => 'App\Http\Controllers\api\v1'], function () {
    Route::get('check-exist-company',[\App\Http\Controllers\api\v1\GroupController::class , 'checkExist'])->name('group.check');
    Route::post('company/create',[\App\Http\Controllers\api\v1\GroupController::class , 'createGroup'])->name('group.create');
    Route::post('company/update',[\App\Http\Controllers\api\v1\GroupController::class , 'updateGroup'])->name('group.update');

    Route::get('warehouse/list',[\App\Http\Controllers\api\v1\WareHouseController::class , 'getList'])->name('warehouse.list');
    Route::post('warehouse/create',[\App\Http\Controllers\api\v1\WareHouseController::class , 'create'])->name('warehouse.create');
    Route::get('warehouse/get-info',[\App\Http\Controllers\api\v1\WareHouseController::class , 'getInfo'])->name('warehouse.getinfo');
    Route::post('warehouse/update',[\App\Http\Controllers\api\v1\WareHouseController::class , 'update'])->name('warehouse.update');
    Route::delete('warehouse/delete',[\App\Http\Controllers\api\v1\WareHouseController::class , 'delete'])->name('warehouse.delete');


    Route::get('batch_all',[\App\Http\Controllers\api\v1\BatchProductController::class , 'showAll'])->name('batch_product.all');

    // Route::apiResource('product', 'ProductController');
    Route::apiResource('brand', 'BrandApiController');
    //BRAND
    Route::get('brand-all',[\App\Http\Controllers\api\v1\BrandApiController::class , 'GetAllbrand'])->name('brand.getAll');
    Route::get('brand/show/{id}', 'BrandApiController@show')->name('brand.showBrand');
    Route::delete('brand/delete/{id}', 'BrandApiController@destroy')->name('brand.deleteBrand');
    Route::post('brand/action/create', 'BrandApiController@store')->name('brand.createBrand');
    Route::post('brand/update/{id}', 'BrandApiController@update')->name('brand.updateBrand');
    Route::put('brand/status/{id}','BrandApiController@updateStatus')->name('brand.updateStatusbrand');
    Route::put('brand/count/{id}','BrandApiController@updateOrder')->name('brand.updateOrderbrand');
    Route::post('brand/image/delete/{id}','BrandApiController@deleteFile')->name('brand.deleteimage');

    //permission
    Route::get('permision/get-all', 'PermissionController@GetAllPermission')->name('permission.viewALL');
    Route::post('permision/add-value', 'PermissionController@AddPermission')->name('permission.add');
    Route::delete('permision/del-value', 'PermissionController@DelPermission')->name('permission.del');
    Route::get('permision/role', 'PermissionController@getAllRole')->name('permission.role');
    Route::post('permision/role/add', 'PermissionController@AddRole')->name('permission.AddRole');
    Route::delete('permision/role/delete/{id}', 'PermissionController@DeleteRole')->name('permission.Roledelete');
    Route::put('permision/role/update/{id}', 'PermissionController@UpdateRole')->name('permission.UpdateRole');

    //VARIANT GROUP
    Route::get('variant-group-all',[\App\Http\Controllers\api\v1\VariantGroupController::class , 'getAll'])->name('variantgroup.all');
    Route::post('variant-group/create', [\App\Http\Controllers\api\v1\VariantGroupController::class , 'create'])->name('variantgroup.create');
    Route::post('variant-group/edit',[\App\Http\Controllers\api\v1\VariantGroupController::class , 'edit'])->name('variantgroup.edit');
    Route::post('variant-group/edit-order',[\App\Http\Controllers\api\v1\VariantGroupController::class , 'editOrder'])->name('variantgroup.edit.order');
    Route::delete('variant-group/delete',[\App\Http\Controllers\api\v1\VariantGroupController::class , 'delete'])->name('variantgroup.delete');
    //VARIANT
    Route::get('variant',[\App\Http\Controllers\api\v1\VariantController::class , 'getAll'])->name('variant.all');
    Route::post('variant/create', [\App\Http\Controllers\api\v1\VariantController::class , 'create'])->name('variant.create');
    Route::post('variant/edit', [\App\Http\Controllers\api\v1\VariantController::class , 'edit'])->name('variant.edit');
    Route::post('variant/edit-order',[\App\Http\Controllers\api\v1\VariantController::class , 'editOrder'])->name('variant.edit.order');
    Route::delete('variant/delete',[\App\Http\Controllers\api\v1\VariantController::class , 'delete'])->name('variant.delete');
    Route::post('variant/find',[\App\Http\Controllers\api\v1\VariantController::class , 'find'])->name('variant.find');
    //VARIANT VALUE
    Route::get('variant-value-all',[\App\Http\Controllers\api\v1\VariantValueController::class , 'getAll'])->name('variantvalue.all');
    Route::post('variant-value/create',[\App\Http\Controllers\api\v1\VariantValueController::class , 'create'])->name('variantvalue.create');
    Route::post('variant-value/edit',[\App\Http\Controllers\api\v1\VariantValueController::class , 'edit'])->name('variantvalue.edit');
    Route::post('variant-value/edit-order',[\App\Http\Controllers\api\v1\VariantValueController::class , 'editOrder'])->name('variantvalue.edit.order');
    Route::delete('variant-value/delete',[\App\Http\Controllers\api\v1\VariantValueController::class , 'delete'])->name('variantvalue.delete');
    //SUPPLIER
    Route::get('supplier',[\App\Http\Controllers\api\v1\SupplierController::class , 'getAll'])->name('supplier.all');
    Route::delete('supplier/delete',[\App\Http\Controllers\api\v1\SupplierController::class , 'delete'])->name('supplier.delete');
    Route::post('suppliers/export/handle', [\App\Http\Controllers\api\v1\SupplierController::class, 'export'])->name('supplier.export');
    Route::post('suppliers/import/handle', [\App\Http\Controllers\api\v1\SupplierController::class, 'import'])->name('supplier.import');
    //CATEGORY
    Route::get('category',[\App\Http\Controllers\api\v1\CategoryController::class , 'getAll'])->name('category.all');
    Route::post('category/import/handle',[\App\Http\Controllers\api\v1\CategoryController::class , 'import'])->name('category.import');
    Route::post('category/edit-order',[\App\Http\Controllers\api\v1\CategoryController::class , 'editOrder'])->name('category.edit.order');
    Route::post('category/create',[\App\Http\Controllers\api\v1\CategoryController::class , 'create'])->name('category.create');
    Route::post('category/edit',[\App\Http\Controllers\api\v1\CategoryController::class , 'edit'])->name('category.edit');
    Route::delete('category/delete',[\App\Http\Controllers\api\v1\CategoryController::class , 'delete'])->name('category.delete');
    //CATEGORY INTERNAL
    Route::get('category-internal',[\App\Http\Controllers\api\v1\CategoryInternalController::class , 'getAll'])->name('categoryinternal.all');
    Route::post('category-internal/create',[\App\Http\Controllers\api\v1\CategoryInternalController::class , 'create'])->name('categoryinternal.create');
    Route::post('category-internal/edit',[\App\Http\Controllers\api\v1\CategoryInternalController::class , 'edit'])->name('categoryinternal.edit');
    Route::delete('category-internal/delete',[\App\Http\Controllers\api\v1\CategoryInternalController::class , 'delete'])->name('categoryinternal.delete');
    Route::post('category-internal/export/handle',[\App\Http\Controllers\api\v1\CategoryInternalController::class , 'export'])->name('categoryinternal.export');
    Route::post('category-internal/import/handle',[\App\Http\Controllers\api\v1\CategoryInternalController::class , 'import'])->name('categoryinternal.import');
    //BATCH
    Route::post('add_batch',[\App\Http\Controllers\api\v1\BatchProductController::class , 'createBatch'])->name('batch.add');
    //BATCH PRODUCT
    Route::get('batch_all',[\App\Http\Controllers\api\v1\BatchProductController::class , 'showAll'])->name('batch_product.all');
    Route::get('batch_show/{id}',[\App\Http\Controllers\api\v1\BatchProductController::class , 'show'])->name('batch_product.show');
    Route::post('batch_update/{id}',[\App\Http\Controllers\api\v1\BatchProductController::class , 'update'])->name('batch_product.update');
    Route::post('batch_add',[\App\Http\Controllers\api\v1\BatchProductController::class , 'create'])->name('batch_product.add');


    Route::post('batch_import',[\App\Http\Controllers\api\v1\BatchProductController::class , 'importBatch'])->name('batch_product.import');

    Route::post('batch_status/{id}',[\App\Http\Controllers\api\v1\BatchProductController::class , 'updateStatus'])->name('batch_product.status_update');
    Route::delete('batch_del/{id}',[\App\Http\Controllers\api\v1\BatchProductController::class , 'delete'])->name('batch_product.del');

    //Api country
    Route::get('country',[\App\Http\Controllers\api\v1\CountryController::class , 'getAll'])->name('country.all');
    //Api group (doanh nghiep)
    Route::get('group',[\App\Http\Controllers\api\v1\GroupController::class , 'getAll'])->name('group.all');
    Route::get('warehouse-list',[\App\Http\Controllers\api\v1\WareHouseController::class , 'getAll'])->name('warehouse.all');
    Route::get('warehouse-select',[\App\Http\Controllers\api\v1\WareHouseController::class , 'getSelect'])->name('warehouse.select');

    Route::get('product',[\App\Http\Controllers\api\v1\ProductController::class , 'getAll'])->name('product.all');
    Route::post('product/create',[\App\Http\Controllers\api\v1\ProductController::class , 'create'])->name('product.create');
    Route::get('product/find',[\App\Http\Controllers\api\v1\ProductController::class , 'find'])->name('product.find');
    Route::get('product/get-bar-code',[\App\Http\Controllers\api\v1\ProductController::class , 'barCode'])->name('product.barcode.get');
    Route::post('product/update',[\App\Http\Controllers\api\v1\ProductController::class , 'update'])->name('product.update');
    Route::delete('product/delete',[\App\Http\Controllers\api\v1\ProductController::class , 'delete'])->name('product.delete');
    Route::post('product/fastupload',[\App\Http\Controllers\api\v1\ProductController::class , 'fastUpload'])->name('product.fastupload');
    Route::get('product/selectField',[\App\Http\Controllers\api\v1\ProductController::class , 'ListAllSelect'])->name('product.selectAll');
    Route::get('product/selectShow/{id}',[\App\Http\Controllers\api\v1\ProductController::class , 'ShowOne'])->name('product.selectShow');

    Route::get('product/type',[\App\Http\Controllers\api\v1\ProductController::class , 'productType'])->name('product.type');
    Route::get('product/status',[\App\Http\Controllers\api\v1\ProductController::class , 'productStatus'])->name('product.status');
    //Inventory
    Route::get('product/inventory/head',[\App\Http\Controllers\api\v1\ProductInventoryController::class , 'getHeadDatatables'])->name('productinventory.head');
    Route::get('product/inventory',[\App\Http\Controllers\api\v1\ProductInventoryController::class , 'getListProductInventory'])->name('productinventory.all');

    //
    Route::get('log-product',[\App\Http\Controllers\api\v1\LogProductController::class , 'getAll'])->name('logproduct.all');
    Route::get('log-product/view',[\App\Http\Controllers\api\v1\LogProductController::class , 'viewLog'])->name('logproduct.view');

    Route::get('product/select2',[\App\Http\Controllers\api\v1\ProductController::class , 'Select2Fucntion'])->name('product.select2');
    //Api vị trí sản phẩm
    Route::get('product-position',[\App\Http\Controllers\api\v1\ProductPositionController::class , 'index'])->name('product-position.getAll');
    Route::post('product-position',[\App\Http\Controllers\api\v1\ProductPositionController::class , 'create'])->name('product-position.create');
    Route::delete('product-position/{id}',[\App\Http\Controllers\api\v1\ProductPositionController::class , 'delete'])->name('product-position.delete');


    //api warehouse bill
    Route::get('warehouse/bill',[\App\Http\Controllers\api\v1\WarehouseBillController::class , 'listAll'])->name('warehousebill.getAll');
    Route::get('warehouse/bill/product/list',[\App\Http\Controllers\api\v1\WarehouseBillController::class , 'listWareHouseBillProduct'])->name('warehousebill.getAllProduct');
    Route::post('warehouse/bill/create',[\App\Http\Controllers\api\v1\WarehouseBillController::class , 'create'])->name('warehousebill.create');

    //api package
    Route::post('warehouse/package/create',[\App\Http\Controllers\api\v1\PackageController::class , 'create'])->name('package.create');
    Route::post('warehouse/package/extract',[\App\Http\Controllers\api\v1\PackageController::class , 'extract'])->name('package.extract');
    //api archive
    Route::get('warehouse/archive/list',[\App\Http\Controllers\api\v1\WarehouseProductArchiveController::class , 'getAllWareHouseArchive'])->name('archive.getAll');
    Route::post('warehouse/archive/create',[\App\Http\Controllers\api\v1\WarehouseProductArchiveController::class , 'create'])->name('archive.create');

    //api category postion

    Route::get('position-category',[\App\Http\Controllers\api\v1\PositionCategoryController::class , 'index'])->name('position-category.getAll');
    Route::post('position-category',[\App\Http\Controllers\api\v1\PositionCategoryController::class , 'create'])->name('position-category.create');
    Route::delete('position-category/{id}',[\App\Http\Controllers\api\v1\PositionCategoryController::class , 'delete'])->name('position-category.delete');
    Route::get('position-level',[\App\Http\Controllers\api\v1\PositionCategoryController::class , 'LevelSearch'])->name('position-category.level');
    Route::get('position-parent',[\App\Http\Controllers\api\v1\PositionCategoryController::class , 'ParentSearch'])->name('position-category.parent');


    Route::post('transfer-ware',[\App\Http\Controllers\api\WareHouseTranferController::class , 'create'])->name('transfer-ware.add');
    Route::post('transfer-ware/addProduct',[\App\Http\Controllers\api\WareHouseTranferController::class , 'createProduct'])->name('transfer-ware.addProduct');
    Route::put('transfer-ware/submitTicket',[\App\Http\Controllers\api\WareHouseTranferController::class , 'submitTicket'])->name('transfer-ware.submitTicket');
    Route::get('transfer-ware/product-list/{id}',[\App\Http\Controllers\api\WareHouseTranferController::class , 'GetProductWarehoust'])->name('transfer-ware.warehouse');
    Route::get('transfer-ware/product-show/{id}',[\App\Http\Controllers\api\WareHouseTranferController::class , 'ShowProductWarehoust'])->name('transfer-ware.showware');
    Route::get('transfer-ware/list/{type}',[\App\Http\Controllers\api\WareHouseTranferController::class , 'index'])->name('transfer-ware.showAll');
});
