<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\BatchController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\DepotController;
use App\Http\Controllers\Dashboard\AccountController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\VariantController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\SupplierController;

use App\Http\Controllers\Dashboard\InventoryController;
use App\Http\Controllers\Dashboard\ProductInfoController;
use App\Http\Controllers\Dashboard\StoragetimeController;
use App\Http\Controllers\Dashboard\VariantGroupController;
use App\Http\Controllers\Dashboard\VariantValueController;

use App\Http\Controllers\Dashboard\Ecommerce\TikiController;
use App\Http\Controllers\Dashboard\ProductBarcodeController;
use App\Http\Controllers\Dashboard\ProductPackageController;
use App\Http\Controllers\Dashboard\Warehouse\BillController;
use App\Http\Controllers\Dashboard\Ecommerce\SendoController;

use App\Http\Controllers\Dashboard\CategoryInternalController;
use App\Http\Controllers\Dashboard\Ecommerce\LazadaController;
use App\Http\Controllers\Dashboard\Ecommerce\ShopeeController;
use App\Http\Controllers\Dashboard\Ecommerce\TiktokController;

use App\Http\Controllers\Dashboard\Warehouse\Check\CheckController;
use App\Http\Controllers\Dashboard\Warehouse\Draft\DraftController;
use App\Http\Controllers\Dashboard\Warehouse\Limit\LimitController;
use App\Http\Controllers\Dashboard\Warehouse\History\HistoryController;
use App\Http\Controllers\Dashboard\Warehouse\Location\LocationController;
use App\Http\Controllers\Dashboard\Warehouse\Transfer\TransferController;
use App\Http\Controllers\Dashboard\Warehouse\Check\ProductCheckController;
use App\Http\Controllers\Dashboard\Warehouse\Draft\PorudctDraftController;
use App\Http\Controllers\Dashboard\Warehouse\Location\BillLocationController;
use App\Http\Controllers\Dashboard\Warehouse\Transfer\TransferMoveController;
use App\Http\Controllers\Dashboard\Warehouse\Transfer\TransferNoteController;
use App\Http\Controllers\Dashboard\Warehouse\Forecasting\ForecastingController;
use App\Http\Controllers\Dashboard\Warehouse\Transfer\TransferToMoveController;
use App\Http\Controllers\Dashboard\Warehouse\Location\ProductLocationController;
use App\Http\Controllers\Dashboard\Warehouse\Transfer\TransferConfirmController;
use App\Http\Controllers\Dashboard\Warehouse\Location\CategoryLocationController;


Route::redirect('/', '/admin/dashboard');

Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
Route::post('/login', [AdminController::class, 'loginAction'])->name('loginWeb');
Route::get('/register', [AdminController::class, 'register'])->name('register');


// ------------------------------- ADMIN ------------------------------------ //

Route::middleware('webAuth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::prefix('account')->group(function () {
        Route::get('/', [AccountController::class, 'account'])->name('account');
        Route::get('/edit-account', [AccountController::class, 'edit_account'])->name('edit_account');
        Route::get('/trash-account', [AccountController::class, 'trash_account'])->name('trash_account');
        Route::get('/edit-permission/{id}', [AccountController::class, 'edit_permission'])->name('edit_permission');
        // Route::get('/account-detail', [AccountController::class, 'account_detail'])->name('account_detail');

    });

    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'role'])->name('role');
        Route::get('/add', [AccountController::class, 'add_account'])->name('add_account');
    });

    Route::prefix('bill')->group(function () {
        Route::get('/', [AdminController::class, 'bill'])->name('bill');

    });
    
    Route::prefix('company')->group(function () {
        Route::get('/company', [CompanyController::class, 'company'])->name('company');
        Route::post('/store', [CompanyController::class, 'store'])->name('store_company');
        // Route::get('/add-company', [CompanyController::class, 'add_company'])->name('add_company');
        // Route::get('/edit-company', [CompanyController::class, 'edit_company'])->name('edit_company');

    });

    Route::prefix('depot')->group(function () {
        Route::get('/depot', [DepotController::class, 'depot'])->name('depot');
        Route::get('/add-depot', [DepotController::class, 'add_depot'])->name('add_depot');
        Route::get('/edit-depot', [DepotController::class, 'edit_depot'])->name('edit_depot');

    });

    Route::prefix('store')->group(function () {

        Route::get('/brand', [BrandController::class, 'brand'])->name('brand');
        Route::get('/add-brand', [BrandController::class, 'add_brand'])->name('add_brand');
        Route::get('/edit-brand/{id}', [BrandController::class, 'edit_brand'])->name('edit_brand');
        Route::get('/trash-brand', [BrandController::class, 'trash_brand'])->name('trash_brand');
        Route::get('/import-brand', [BrandController::class, 'import_brand'])->name('import_brand');


        Route::get('/product', [ProductController::class, 'product'])->name('product');
        Route::get('/add-product', [ProductController::class, 'add_product'])->name('add_product');
        Route::get('/edit-product', [ProductController::class, 'edit_product'])->name('edit_product');
        Route::get('/detail-product', [ProductController::class, 'detail_product'])->name('detail_product');
        Route::get('/product/barcode', [ProductController::class, 'barcode'])->name('barcode_product');
        Route::post('/product/barcode/export', [ProductController::class, 'barcodeExport'])->name('export_barcode_product');
        Route::get('/trash-product', [ProductController::class, 'trash_product'])->name('trash_product');
        Route::get('/barcode-product', [ProductBarcodeController::class, 'barcode_product'])->name('barcode_product');
        
        Route::get('/product-info', [ProductInfoController::class, 'product_info'])->name('product_info');

        Route::get('/product-sell-price', [ProductController::class, 'sell_price'])->name('sell_price');
        Route::get('/product-import-price', [ProductController::class, 'import_price'])->name('import_price');
        Route::get('/product-edit-history', [ProductController::class, 'edit_history'])->name('edit_history');

        // TMDT
        Route::get('/tiki', [TikiController::class, 'tiki'])->name('tiki');
        Route::get('/shopee', [ShopeeController::class, 'shopee'])->name('shopee');
        Route::get('/tiktok', [TiktokController::class, 'tiktok'])->name('tiktok');
        Route::get('/lazada', [LazadaController::class, 'lazada'])->name('lazada');

        Route::get('/add-porduct-package', [ProductPackageController::class, 'add'])->name('add_product_package');
        Route::get('/unbox-porduct-package', [ProductPackageController::class, 'unbox'])->name('unbox_product_package');

        Route::get('/batch', [BatchController::class, 'batch'])->name('batch');
        Route::get('/add-batch', [BatchController::class, 'add_batch'])->name('add_batch');
        Route::get('/batch-edit/{id}', [BatchController::class, 'edit_batch'])->name('edit_batch');
        Route::get('/batch-import', [BatchController::class, 'import_batch'])->name('import_batch');

        Route::get('suppliers/import', [SupplierController::class, 'import'])->name('import-supplier');
        Route::resource('suppliers', SupplierController::class);
        Route::get('suppliers/{supplierId}/restore', [SupplierController::class, 'restore'])->name('suppliers.restore');
        Route::get('suppliers/{supplierId}/forcedelete', [SupplierController::class, 'forcedelete'])->name('suppliers.forcedelete');

        //Variant
        Route::get('/variant', [VariantController::class, 'variant'])->name('variant');
        Route::get('/variant/create', [VariantController::class, 'create'])->name('create-variant');
        Route::get('/variant/edit', [VariantController::class, 'edit'])->name('edit-variant');
        //Variant group
        Route::get('/variant-group/create', [VariantGroupController::class, 'createGroup'])->name('create-variant-group');
        Route::get('/variant-group/edit', [VariantGroupController::class, 'editGroup'])->name('edit-variant-group');
        //Variant value
        Route::get('/variant/value', [VariantValueController::class, 'variantValue'])->name('variant-value');
        Route::get('/variant/value/create', [VariantValueController::class, 'create'])->name('create-variant-value');
        Route::get('/variant/value/edit', [VariantValueController::class, 'edit'])->name('edit-variant-value');
        Route::get('/variant/value/import', [VariantValueController::class, 'import'])->name('import-variant-value');
        Route::post('/variant/value/handle-import', [VariantValueController::class, 'handleImportValue'])->name('handle-import-variant-value');
        //Category
        Route::get('/category', [CategoryController::class, 'category'])->name('category');
        Route::get('/category/import', [CategoryController::class, 'import'])->name('import-category');
        Route::get('/add-category', [CategoryController::class, 'add_category'])->name('create-category');
        Route::get('/edit-category', [CategoryController::class, 'edit_category'])->name('edit-category');
        Route::get('/trash-category', [CategoryController::class, 'trash_category'])->name('trash_category');
        //Category internal
        Route::get('/category-internal', [CategoryInternalController::class, 'categoryInternal'])->name('category-internal');
        Route::get('/category-internal/create', [CategoryInternalController::class, 'create'])->name('create-category-internal');
        Route::get('/category-internal/edit', [CategoryInternalController::class, 'edit'])->name('edit-category-internal');
        Route::get('/category-internal/import', [CategoryInternalController::class, 'import'])->name('import-category-internal');

    });

    Route::prefix('blog')->group(function () {
        Route::get('/', [AdminController::class, 'blog'])->name('blog');
        Route::get('/add-blog', [AdminController::class, 'add_blog'])->name('add_blog');
        Route::get('/edit-blog', [AdminController::class, 'edit_blog'])->name('edit_blog');
        Route::get('/trash-blog', [AdminController::class, 'trash_blog'])->name('trash_blog');

        Route::get('/blogCategory', [AdminController::class, 'blogCategory'])->name('blogCategory');
        Route::get('/addBlogCategory', [AdminController::class, 'addBlogCategory'])->name('addBlogCategory');
        Route::get('/editBlogCategory', [AdminController::class, 'editBlogCategory'])->name('editBlogCategory');
        Route::get('/trashBlogCategory', [AdminController::class, 'trashBlogCategory'])->name('trashBlogCategory');

    });

    Route::prefix('promotion')->group(function () {
        Route::get('/voucher', [AdminController::class, 'voucher'])->name('voucher');
        Route::get('/add-voucher', [AdminController::class, 'add_voucher'])->name('add_voucher');
        Route::get('/edit-voucher', [AdminController::class, 'edit_voucher'])->name('edit_voucher');
        Route::get('/trash-voucher', [AdminController::class, 'trash_voucher'])->name('trash_voucher');

        Route::get('/deal', [AdminController::class, 'deal'])->name('deal');

    });

    Route::prefix('warehouse')->group(function () {
      Route::get('/bill', [BillController::class, 'bill'])->name('bill');
      Route::get('/import', [BillController::class, 'import'])->name('import');
      Route::get('/export', [BillController::class, 'export'])->name('export');

      Route::get('/transfer', [TransferController::class, 'transfer'])->name('transfer');
      Route::get('/transfer-note', [TransferNoteController::class, 'transfer_note'])->name('transfer_note');
      Route::get('/transfer-move', [TransferMoveController::class, 'transfer_move'])->name('transfer_move');
      Route::get('/transfer-to-move', [TransferToMoveController::class, 'transfer_to_move'])->name('transfer_to_move');
      Route::get('/transfer-confirm', [TransferConfirmController::class, 'transfer_confirm'])->name('transfer_confirm');
      
      Route::get('/add-transfer', [BillController::class, 'add_transfer'])->name('add_transfer');
      Route::get('/add-transfer-note', [BillController::class, 'add_transfer_note'])->name('add_transfer_note');
      Route::get('/call-transfer', [BillController::class, 'call_transfer'])->name('call_transfer');

      Route::get('/location', [LocationController::class, 'location'])->name('location');
      Route::get('/locationCategory', [CategoryLocationController::class, 'category_location'])->name('categoryLocation');
      Route::get('/billLocation', [BillLocationController::class, 'bill_location'])->name('billLocation');
      Route::get('/locationProduct', [ProductLocationController::class, 'product_location'])->name('productLocation');

      Route::get('/put-in-location', [LocationController::class, 'putIn'])->name('putInLocation');
      Route::get('/put-out-location', [LocationController::class, 'putOut'])->name('putOutLocation');
      Route::get('/add-category-location', [CategoryLocationController::class, 'addCategoryLocation'])->name('addCategoryLocation');
      Route::get('/add-location', [CategoryLocationController::class, 'addLocation'])->name('addLocation');

      Route::get('/check', [CheckController::class, 'check'])->name('check');
      Route::get('/check-product', [ProductCheckController::class, 'product_check'])->name('product_check');
      Route::get('/add-check', [CheckController::class, 'add_check'])->name('add_check');

      Route::get('/draft', [DraftController::class, 'draft'])->name('draft');
      Route::get('/supplier-draft', [DraftController::class, 'supplier_draft'])->name('supplier_draft');
      Route::get('/move-draft', [DraftController::class, 'move_draft'])->name('move_draft');
      Route::get('/retail-draft', [DraftController::class, 'retail_draft'])->name('retail_draft');
      Route::get('/resell-draft', [DraftController::class, 'resell_draft'])->name('resell_draft');
      Route::get('/other-draft', [DraftController::class, 'other_draft'])->name('other_draft');

      Route::get('/draft-product', [PorudctDraftController::class, 'draft_product'])->name('draft_product');
      Route::get('/ncc-draft', [PorudctDraftController::class, 'ncc_draft'])->name('ncc_draft');
      Route::get('/move-to-draft', [PorudctDraftController::class, 'moveTo_draft'])->name('moveTo_draft');
      Route::get('/nnk-retail-draft', [PorudctDraftController::class, 'nnk_retail_draft'])->name('nnk_retail_draft');
      Route::get('/nnk-resell-draft', [PorudctDraftController::class, 'nnk_resell_draft'])->name('nnk_resell_draft');
      Route::get('/nnk-other-draft', [PorudctDraftController::class, 'nnk_other_draft'])->name('nnk_other_draft');

      Route::get('/limit', [LimitController::class, 'limit'])->name('limit');
      Route::get('/add-limit', [LimitController::class, 'add_limit'])->name('add_limit');

      Route::get('/forecasting', [ForecastingController::class, 'forecasting'])->name('forecasting');

      Route::get('/inventory', [InventoryController::class, 'inventory'])->name('inventory');

      Route::get('/storagetime', [StoragetimeController::class, 'storagetime'])->name('storagetime');

      Route::get('/xnk-history', [HistoryController::class, 'history'])->name('history');

    });

    Route::get('/notfound', function(){
        return view('backend.common.404');
    });
    
});