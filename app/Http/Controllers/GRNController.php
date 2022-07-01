<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\GRN;
use App\Models\GRNItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GRNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $grns = GRN::with('grn_items', 'grn_items.item')->get();
        return view('grn.index', compact('grns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('grn.create');
    }

      /**
     * Genrate GRN Number
     *
     * @return void
     */
    public function generateGRNNumber(){

       
        $payment = GRN::latest()->first();
        
        $id = 0;
        if(!$payment){
            $id = 1;
        }else{
            $id = $payment->id;
        }
        return 'GRN'. sprintf('%06d', $id).'';

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
     
        $items = $request->items;

        $total_items = $request->total;

        $grn = new GRN();
        $grn->grn_no =  $this->generateGRNNumber();
        $grn->notes =  $request->notes;
        $grn->created_by = Auth::user()->id;
        $grn->total = $total_items;
        $grn->save();
      

        foreach ($items as $key => $item) {

            $stock_item = Item::findOrFail($item['id']);
            $stock_item->stock =  intval($stock_item->stock) + intval($item['grn_quantity']);
             
            $stock_item->save();
          

            $stock_category= Category::findOrFail($item['category_id']);
            $stock_category->stock =  intval($stock_category->stock) + intval($item['grn_quantity']);
            $stock_category->save();

            $grn_item = new GRNItem();
            $grn_item->grn_id = $grn->id;
            $grn_item->item_id = $item['id'];
            $grn_item->category_id = $item['category_id'];
            $grn_item->current_stock = $item['stock'];
            $grn_item->new_stock = $item['grn_quantity'];
            $grn_item->save();
        }
       
        try {
            DB::commit();
            return response()->json(['message'=>'GRN Created !', 'url'=> route('grn.index')]);
         } catch (\Exception $th) {
             DB::rollBack();
             return response()->json(['message'=>$th->getMessage(),'code'=>422]);
         }

       
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GRN  $gRN
     * @return \Illuminate\Http\Response
     */
    public function show(GRN $gRN)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GRN  $gRN
     * @return \Illuminate\Http\Response
     */
    public function edit(GRN $gRN)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GRN  $gRN
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GRN $gRN)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GRN  $gRN
     * @return \Illuminate\Http\Response
     */
    public function destroy(GRN $gRN)
    {
        //
    }
}
