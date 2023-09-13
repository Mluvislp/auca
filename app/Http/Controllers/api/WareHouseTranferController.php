<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Functions\MyHelper;
use App\Models\ProductDetail;
use App\Models\Warehouse;
use App\Models\WareHouseBill;
use App\Models\WareHouseBillProduct;
use App\Models\WarehouseProduct;
use App\Models\WareHouseTranfer;
use App\Models\WareHouseTranferProduct;
use DB;
use Illuminate\Http\Request;
use JWTAuth;
use App\Models\User;

class WareHouseTranferController extends Controller
{

    public function index(Request $request, $type)
    {
        $keyword = $request->input('search');
        $perPage = $request->input('per_page', 5);
        $query = WareHouseTranfer::query();
        $all_search = $request->all();
        $user = JWTAuth::parseToken()->authenticate();
        if($type != 'draft' && $type != 'accept' && $type != 'confirm') {
            return MyHelper::response(false, 'No data found', [], 404);
        }
        if (array_key_exists('columns', $all_search)) {

            foreach ($all_search['columns'] as $val) {
                if (!isset($val['search']['value']) || is_null($val['search']['value']) || !$val['searchable']) {
                    continue;
                } else {
                    $operator = ($val['name'] == $val['name'] ? '=' : 'LIKE');
                    $percent_percent = ($val['name'] == $val['name'] ? "" : "%");
                    $query->where($val['name'], $operator, $percent_percent . $val['search']['value'] . $percent_percent);

                }
            }
        }
        if ($request->has('wtrans_id')) {
            $query->where('wtrans_id', '=', $request->input('wtrans_id'));
        }
        $query->where('wtrans_status',$type);
        $batch = $query->orderByRaw('wtrans_id desc')->paginate($perPage);
        if (!$batch) {
            return MyHelper::response(false, 'No data found', [], 404);
        }
        foreach ($batch as $val) {
            $creator = User::where('user_id',$val->created_by)->first();
            $checkWareTo = Warehouse::where('w_id', $val->wtrans_to_w_id)->first();
            $checkWareFrom = Warehouse::where('w_id', $val->wtrans_from_w_id)->first();
            $ProductStranfer = WareHouseTranferProduct::where('wht_id', $val->wtrans_id)->count();
            $ProductQuantity = WareHouseTranferProduct::where('wht_id', $val->wtrans_id)->sum('wtp_quantity');
            $ProductPriceTotal = WareHouseTranferProduct::where('wht_id', $val->wtrans_id)->selectRaw('SUM(wtp_price * wtp_quantity) as total')->value('total');
            $creators = [
               'name' => $creator->user_name,
               'date' =>date('Y-m-d H:i:s', $val->created_at),
            ];
            $WareHouseInfor = [
              'to' => $checkWareTo->w_name,
              'from' => $checkWareFrom->w_name
            ];
            if(isset($val->accepted_by)){
                $acceptor2 = User::where('user_id',$val->accepted_by)->first();
                if(isset($acceptor2)) {
                    $acceptor = [
                        'name' => $acceptor2->user_name,
                        'date' =>date('Y-m-d H:i:s', $val->accepted_at),
                    ];
                }else{
                    $acceptor = null;
                }
            }else{
                $acceptor = null;
            }

            if(isset($val->confirm_by)){
                $confirmtor2 = User::where('user_id',$val->confirm_by)->first();
                if(isset($confirmtor2)) {
                    $confirmtor = [
                        'name' => $confirmtor2->user_name,
                        'date' =>date('Y-m-d H:i:s', $val->confirm_at),
                    ];
                }else{
                    $confirmtor= null;
                }
            }else{
                $confirmtor = null;
            }

            $val->creator = $creators;
            $val->acceptor = $acceptor;
            $val->confirmer = $confirmtor;
            $val->wareHouse = $WareHouseInfor;
            $val->productCount = $ProductStranfer;
            $val->productQuantity = $ProductQuantity;
            $val->productTotal =  $ProductPriceTotal;
        }
        $data = [
            'data' => collect($batch->items())->map(function ($batch2) {
                return $batch2;
            }),
            'total' => $batch->total(),
            'per_page' => $batch->perPage(),
            'current_page' => $batch->currentPage(),
        ];

        return MyHelper::response(true, 'Successfully', $data, 200);
    }
    public function create(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $from = $request->from ?? 0;
        $to = $request->to ?? 0;
        $tag = $request->tag ?? null;
        $status = $request->status ?? 'draft';
        $desc = $request->desc ?? '';
        $checkWareTo = Warehouse::where('w_id', $to)->first();
        $checkWareFrom = Warehouse::where('w_id', $from)->first();
        if (!$checkWareTo || !$checkWareFrom) {
            return MyHelper::response(false, 'Warehouse not found', [], 404);
        }
        if ($checkWareTo == $checkWareFrom) {
            return MyHelper::response(false, 'from warehouse must not equal to to warehouse', [], 422);
        }
        $NewWare = new WareHouseTranfer;
        $NewWare->wtrans_to_w_id = $to;
        $NewWare->wtrans_from_w_id = $from;
        $NewWare->wtrans_tag = $tag;
        $NewWare->wtrans_status = $status;
        $NewWare->wtrans_description = $desc;
        $NewWare->groupid = $user->groupid;
        $NewWare->created_by = $user->user_id;
        $NewWare->created_at = time();
        $NewWare->save();
        return MyHelper::response(false, 'Successfully', ['id' => $NewWare->wtrans_id], 200);
    }
    public function createProduct(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $prd_id = $request->prd_id ?? 0;
        $quantity = $request->quantity ?? 1;
        $wareId = $request->wareId ?? 0;
        $errorProduct = $request->error ?? 0;
        $ticket = WareHouseTranfer::where('wtrans_id', $wareId)->first();
        if (!$ticket) {
            return MyHelper::response(false, 'Ticket not found', [], 404);
        }
        $checkStorage = WarehouseProduct::where('prd_id', $prd_id)->where('w_id', $ticket->wtrans_from_w_id)->first();
        if (!$checkStorage) {
            return MyHelper::response(false, 'Product not found in the warehouse', [], 404);
        }
        if ($checkStorage->wp_quantity < $quantity) {
            return MyHelper::response(false, 'Quantity exceed the Warehouse actual', [], 422);
        }
        $product = ProductDetail::where('prd_id', $prd_id)->first();
        $NewProduct = new WareHouseTranferProduct;
        $NewProduct->prd_id = $prd_id;
        $NewProduct->wht_id = $wareId;
        $NewProduct->wtp_price = $product->pd_price;
        $NewProduct->wtp_quantity = $quantity;
        $NewProduct->wtp_quantity_defective = $errorProduct;
        $NewProduct->groupid = $user->groupid;
        $NewProduct->save();
        return MyHelper::response(false, 'Successfully', ['id' => $NewProduct->wtp_id], 200);
    }

    public function submitTicket(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $wareId = $request->wareId ?? 0;
        $type = $request->type ?? 'accept';
        $req = $request->all();
        $ticket = WareHouseTranfer::where('wtrans_id', $wareId)->first();
        if (!$ticket) {
            return MyHelper::response(false, 'Ticket not found', [], 404);
        }
        $ProductStranfer = WareHouseTranferProduct::where('wht_id', $wareId)->get();
        if (count($ProductStranfer) == 0) {
            return MyHelper::response(false, 'Ticket does not have product', [], 403);
        }
        foreach ($ProductStranfer as $val) {
            if (!isset($req['product_' . $val->wtp_id])) {
                return MyHelper::response(false, 'Missing value for product with id ' . $val->wtp_id . ' please add field product_' . $val->wtp_id . ' ', [], 404);
            }
        }
        DB::beginTransaction();
        try {
            DB::commit();
            if ($type == 'accept') {
                if (isset($ticket->accepted_by) || isset($ticket->confirm_by)) {
                    return MyHelper::response(false, 'Ticket already been submit or accepted', [], 422);
                }
                $newBill = new WareHouseBill;
                $newBill->w_id = $ticket->wtrans_from_w_id;
                $newBill->wb_type = 'Import';
                $newBill->wb_mode = 'warehouse';
                $newBill->sup_id = $user->user_id;
                $newBill->wtrans_id = $ticket->wtrans_id;
                $newBill->wb_from_w = $ticket->wtrans_from_w_id;
                $newBill->wb_to_w = $ticket->wtrans_to_w_id;
                $newBill->wb_description = $ticket->wtrans_description;
                $newBill->created_at = time();
                $newBill->groupid = $user->groupid;
                $newBill->save();
                $total = 0;
                foreach ($ProductStranfer as $val) {
                    $product = ProductDetail::where('prd_id', $val->prd_id)->first();
                    $quantity = $req['product_' . $val->wtp_id] ?? 1;
                    $total += $product->pd_price * $quantity;
                    $newProduct = new WareHouseBillProduct;
                    $newProduct->prd_id = $val->prd_id;
                    $newProduct->wb_id = $newBill->wb_id;
                    $newProduct->wbp_quantity = $quantity;
                    $newProduct->wbp_quantity_defective = $val->wtp_quantity_defective;
                    $newProduct->wbp_price = $product->pd_price;
                    $newProduct->wbp_shipping_weight = $product->pd_shipping_weight;
                    $newProduct->groupid = $user->groupid;
                    $newProduct->save();
                }
                //save product
                $oldBill = WareHouseBill::where('wb_id', $newBill->wb_id)->first();
                $oldBill->wb_total_money = $total;
                $oldBill->save();
                $ticket->wtrans_status = 'accept';
                $ticket->accepted_by = $user->user_id;
                $ticket->accepted_at = time();
                $ticket->save();

            } else if ($type == 'submit') {
                if (!isset($ticket->accepted_by)) {
                    return MyHelper::response(false, 'Ticket is not accepted yet', [], 422);
                }
                if (isset($ticket->confirm_by)) {
                    return MyHelper::response(false, 'Ticket Has been submitted', [], 422);
                }
                $oldBill = WareHouseBill::where('wtrans_id', $ticket->wtrans_id)->where('wb_type', 'Import')->first();

                if ($oldBill) {
                    $newBill = new WareHouseBill;
                    $newBill->w_id = $oldBill->w_id;
                    $newBill->wb_type = 'Export';
                    $newBill->wb_mode = 'warehouse';
                    $newBill->sup_id = $oldBill->sup_id;
                    $newBill->wtrans_id = $oldBill->wtrans_id;
                    $newBill->wb_from_w = $oldBill->wb_from_w;
                    $newBill->wb_to_w = $oldBill->wb_to_w;
                    $newBill->wb_description = $oldBill->wb_description;
                    $newBill->created_at = time();
                    $newBill->wb_total_money = $oldBill->wb_total_money;
                    $newBill->groupid = $user->groupid;
                    $newBill->save();
                }
                $oldProduct = WareHouseBillProduct::where('wb_id', $oldBill->wb_id)->get();
                foreach ($oldProduct as $val) {
                    $newProduct = new WareHouseBillProduct;
                    $newProduct->prd_id = $val->prd_id;
                    $newProduct->wb_id = $newBill->wb_id;
                    $newProduct->wbp_quantity = $val->wbp_quantity;
                    $newProduct->wbp_quantity_defective = $val->wtp_quantity_defective;
                    $newProduct->wbp_price = $val->wbp_price;
                    $newProduct->wbp_shipping_weight = $val->wbp_shipping_weight;
                    $newProduct->groupid = $user->groupid;
                    $newProduct->save();
                }
                $ticket->status = 'confirm';
                $ticket->confirm_by = $user->user_id;
                $ticket->confirm_at = time();
                $ticket->save();

            }
            return MyHelper::response(true, 'Successfully', [], 200);
        } catch (\Exception $ex) {
            DB::rollback();
            return MyHelper::response(false, $ex->getMessage() . ' at line ' . $ex->getLine(), [], 500);
        }

    }

    public function GetProductWarehoust($id)
    {
        $wareHouseProduct = (new WarehouseProduct)->GetProductfromwarehouse($id);
        return MyHelper::response(true, 'Successfully', $wareHouseProduct, 200);
    }
    public function ShowProductWarehoust($id)
    {
        $wareHouseProduct = (new WarehouseProduct)->ShowProductfromwarehouse($id);
        return MyHelper::response(true, 'Successfully', $wareHouseProduct, 200);
    }

}
