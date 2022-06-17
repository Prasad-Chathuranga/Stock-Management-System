<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Item::with('category')->where('stock', '<', 5)->get();
        return view('reorder.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Update Stock 
     *
     * @param Request $request
     * @return void
     */
    public function updateStock(Request $request){

        DB::beginTransaction();

        $item = json_decode($request->item);
        $current_stock = intval($item->stock);
        $current_category_stock = intval($item->category->stock);
        $stock_to_be_update = $current_stock + intval($request->new_stock);
        $category_stock_to_be_update = $current_category_stock + intval($request->new_stock);


        try {
            $updated_stock = Item::whereId($item->id)->update(['stock'=> $stock_to_be_update]);
            $updated_category_stock = Category::whereId($item->category->id)->update(['stock'=> $category_stock_to_be_update]);
            
            if($updated_stock && $updated_category_stock):
                DB::commit();
                return response()->json(['message'=>'Stock Updated !', 'url'=> route('reorder.index')]);
            endif;
            
        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['message'=>$th->getMessage(),'code'=>422]);
        }
       

        dd($updated_stock);
       
    }
}
