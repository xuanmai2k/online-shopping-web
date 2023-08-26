<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $dataOrders = DB::table('order')
        ->selectRaw('status, count(status) as number')
        ->groupBy('status')->get();
        $arrayDatas = [];
        $arrayDatas[] = ['Status', 'Number'];
        foreach($dataOrders as $data){
            $arrayDatas[] = [$data->status, $data->number];
        }

        return view('admin.pages.dashboard', compact('arrayDatas'));
    }
}
