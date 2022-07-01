<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\Payment;
use App\Models\RentOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments = Payment::with('order', 'customer')->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('payments.create');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Print Preview of Invoice
     *
     * @param Request $request
     * @return void
     */
    public function printPreview(Request $request){
        
        $payment = Payment::with('order', 'customer')->whereId($request->route('id'))->get();
        $payment = $payment[0];
        $items = OrderedItem::with('item')->whereOrderId($payment->order->id)->get();
        
        return view('invoice.preview', compact('payment', 'items'));
    }


    /**
     * Download Invoice as a PDF
     *
     * @param Request $request
     * @return void
     */
    public function downloadInvoice(Request $request){
        
        $payment = Payment::with('order', 'customer')->whereId($request->route('id'))->get();
        // $payment = $payment[0];
        $items = OrderedItem::with('item')->whereOrderId($payment[0]->order_id)->get();
        $data = [
            'items' => $items,
            'payment' => $payment[0]
        ];

        // $pdf = PDF::loadView('invoice.pdf_invoice', $data);
        
        // return $pdf->download('invoice.pdf');
        $pdf = PDF::loadView('invoice.pdf_invoice',$data);
        $pdf->setOptions(['isHtml5ParserEnabled', false]);
     
        $filename = 'Payment for '. $payment[0]->order->order_no . date('Y-m-d H:i A');

        return $pdf->download($filename . '.pdf');
      

     
    }

    public function getAllOrders(Request $request){

        $term = $request->query('term');
    
        $item = Order::with('customer')
       
        ->whereHas('customer', function($query) use ($term) {
            $query->where('customer_no','like','%'.$term.'%')
            ->orWhere('first_name', 'like', '%'.$term.'%')
            ->orWhere('last_name', 'like', '%'.$term.'%')
            ->orWhere('email', 'like', '%'.$term.'%')
            ->orWhere('order_no', 'like', '%'.$term.'%');
        });
       

        $result = [];

   
        foreach ($item->get() as $val) {
            $result[] = ['id' => $val->id, 'text' => 'Order No : '.$val->order_no
            .' / '.'Order Amount : '. number_format($val->total, 2).' / '. 'Customer No : '.$val->customer->customer_no.' / '.'Customer Name : '.$val->customer->first_name.' '.$val->customer->last_name
        ];

        }
 
    return response()->json(['results' => $result]);
    }

    
    public function generatePaymentNumber(){

        $payment = Payment::latest()->first();
        
        $id = 0;
        if(!$payment){
            $id = 1;
        }else{
            $id = $payment->id;
        }
        return 'PAY'. sprintf('%06d', $id).'';

    }

    /**
     * payForOrder function
     *
     * @param Request $request
     * @return void
     */
    public function payForOrder(Request $request){

        
       

        DB::beginTransaction();

        // dd($request);

        $settle = $request->settle;
        $due = $request->due;
        $total = $request->total;

        if($due<$settle):
            return response()->json('error',200);
        endif;

        $payment = new Payment();
        $payment->order_id = $request->id;
        $payment->payment_no = $this->generatePaymentNumber();
        $payment->notes = $request->notes;
        $payment->amount = $request->settle;
        $payment->method = 'Cash';
        $payment->due = $due - $settle; 

    
        try {
            $payment->save();

            $paid_invoices = Payment::whereOrderId($request->id)->latest()->first();
            // dd($paid_invoices['due'] == 0);
            if($paid_invoices['due'] == 0){
                $order = Order::findOrFail($request->id);
                $order->paid = $request->total;
                $order->status = 1;

                $order->save();

                // Post::where('id',3)->update(['title'=>'Updated title']);
            }else{
                $order = Order::findOrFail($request->id);
                $order->paid = $request->sett;
                $order->status = 1;

                $order->save();
            }


            DB::commit();
            return response()->json(['message'=>'Payment Created !', 'url'=> route('payment.index')]);
         } catch (\Throwable $th) {
             DB::rollBack();
             return response()->json(['message'=>$th->getMessage(),'code'=>422]);
         }

    }
}
