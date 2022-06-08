<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $orders = Order::whereMonth('created_at', date('m'))->get();
        $orders_last_month = Order::whereMonth('created_at', date('m', strtotime("last month")))->get();
        $ordersAll = Order::all();
        $customers = Customer::whereMonth('created_at', date('m'))->count();
        $ordered_items = OrderedItem::whereYear('created_at', date('Y'))->count();
        $stock = Item::all();
        $order_total = 0;
        $order_total_last_month = 0;
        $stock_total = 0;
        $order_precentage = 0;
        $all_order_total = 0;
        $latest_inv = Payment::with('order','customer')->latest()->take(5)->get();
        
        foreach ($orders as $key => $order) {
            $order_total += $order->total;
            $order_precentage += $order->total / 100;
        }

        foreach ($ordersAll as $key => $all) {
            $all_order_total += $all->total;
        }


        foreach ($stock as $key => $item) {
            $stock_total += $item->stock;
        }

        foreach ($orders_last_month as $key => $last) {
           $order_total_last_month += $last->total;
        }
        

        $this_month = ($order_total/$all_order_total)*100;
        $prev_month = ($order_total_last_month/$all_order_total)*100;

        $precentage_orders = 0;

        if($this_month > $prev_month){
            $precentage_orders = $this_month-$prev_month;
        }else{
            $precentage_orders = $prev_month-$this_month;
        }

        $sales_items = $this->getSalesItemWise();

        return view('home', compact('order_total',
        'order_precentage','ordered_items',
        'customers','stock_total',
        'precentage_orders','latest_inv','sales_items'));
    }

    public function getOrdersMonthWise(){

        $users = Order::select('total', 'created_at')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

    $usermcount = [];
    $userArr = [];
    


    foreach ($users as $keyMain => $value) {

        $total = 0;

        foreach ($value as $key => $user) {
            $total += $user->total;
         

        }
       
           $usermcount[(int)$keyMain] = $total;
       
    }
    
 

    for ($i = 1; $i <= 12; $i++) {
        if (!empty($usermcount[$i])) {
            $userArr[$i] = $usermcount[$i];
        } else {
            $userArr[$i] = 0;
        }
    }

    return response()->json(array_values($userArr));


    }


    public function getSalesItemWise(){


        $data = [];
        $items = OrderedItem::with('item')->distinct('item_id')->select('item_id')->limit(5)->get();

        foreach ($items as $key => $item) {
            $quantity = OrderedItem::whereItemId($item->item_id)
            ->sum('quantity');
            $data[$key]['quantity'] = $quantity;

            $data[$key]['item'] = $item->item->name;
            $data[$key]['stock'] = $item->item->stock;

            $precentage = round($quantity / $item->item->stock * 100);

            $data[$key]['precentage'] = $precentage;

            if($precentage > 50): $data[$key]['class'] = 'bg-success'; else: $data[$key]['class'] = 'bg-warning'; endif;



            $data[$key]['id'] = $item->item_id;
        }

        return $data;

    }

}
