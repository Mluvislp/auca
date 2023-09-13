<?php

namespace App\Http\Controllers\Dashboard\Warehouse\Forecasting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForecastingController extends Controller
{
    public function forecasting(){
        return view('backend.page.warehouse.forecasting.forecasting');
    }
}