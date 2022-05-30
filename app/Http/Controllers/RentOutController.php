<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\Payment;
use App\Models\RentOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('rentout.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('rentout.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        DB::beginTransaction();
dd( $request->customer->first_name);
        $customer = new Customer();
        $customer->first_name = $request->customer->first_name;
        $customer->last_name = $request->customer->last_name;
        $customer->address = $request->customer->address;
        $customer->mobile_1 = $request->customer->mobile_1;
        $customer->mobile_2 = $request->customer->mobile_2;
        $customer->email = $request->customer->email;

        try {
           $customer->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message'=>$th->getMessage(),'code'=>422]);
        }

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->total = $request->amounts->final_total;
        $order->paid = $request->order->amount;
        $order->notes = $request->order->reference;
        if($request->amounts->final_total > $request->order->amount): $order->status = 0; else: $order->status = 1; endif;
        $order->emailed = 0;
        $order->created_by = Auth::user()->id;
        
        try {
            $order->save();
         } catch (\Throwable $th) {
            DB::rollBack();
             return response()->json(['message'=>$th->getMessage(),'code'=>422]);
         }

         

         foreach ($request->items as $key => $item) {
            $orderedItem = new OrderedItem();
            $orderedItem->order_id = $order->id;
            $orderedItem->item_id = $item->id;
            $orderedItem->price = $item->price;
            $orderedItem->quantity = $item->quantity;
            $orderedItem->discount = $item->discount;
            $orderedItem->discount_type = $item->discount_type;
            $orderedItem->total = $item->gross_total;

            try {
                $orderedItem->save();
             } catch (\Throwable $th) {
                DB::rollBack();
                 return response()->json(['message'=>$th->getMessage(),'code'=>422]);
             }

         }

         $payment = new Payment();
         $payment->order_id = $order->id;
         $payment->notes = $request->order->reference;
         $payment->amount = $request->order->amount;
         $payment->due = $request->amounts->due_amount;

         try {
            $payment->save();
            DB::commit();
            return response()->json(['message'=>'Order Created !', 'url'=> route('rentout.index')]);
         } catch (\Throwable $th) {
             DB::rollBack();
             return response()->json(['message'=>$th->getMessage(),'code'=>422]);
         }
          

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RentOut  $rentOut
     * @return \Illuminate\Http\Response
     */
    public function show(RentOut $rentOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RentOut  $rentOut
     * @return \Illuminate\Http\Response
     */
    public function edit(RentOut $rentOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RentOut  $rentOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RentOut $rentOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RentOut  $rentOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(RentOut $rentOut)
    {
        //
    }
}
