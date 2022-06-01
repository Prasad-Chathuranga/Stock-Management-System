<?php

namespace App\Http\Controllers;

use App\Models\OrderedItem;
use App\Models\Payment;
use App\Models\RentOut;
use Illuminate\Http\Request;
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
     
        return $pdf->stream('nicesnippets.pdf');
      

     
    }

    public function getAllOrders(Request $request){
        $name = $request->query('term');
        $category = $request->category_id;

        dd($request->query('term'));

    //     $item = RentOut::orderBy('id', 'desc')
    //     ->when(!empty($name), function ($q1) use ($name) {

    //             $q1->where('name','like',"%{$name}%");
    //     })
    //     ->when(!empty($category), function ($q1) use ($category) {

    //         $q1->where('category_id',$category);
    // });

    
    $result = [];

    if(isset($category)):

        foreach ($item->get() as $val) {
            $result[] = ['id' => $val->id, 'text' => $val->name];

        }
 
    endif;


    return response()->json(['results' => $result]);
    }
}
