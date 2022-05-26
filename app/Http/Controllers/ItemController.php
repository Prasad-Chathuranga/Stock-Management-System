<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Item::all();
        return view('item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('item.create');
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

        $item = new Item();
        $item->name =  $request->name;
        $item->stock = $request->stock;
        $item->category_id = $request->category;
        $item->price = floatval($request->price);

        if($request->hasFile('imageFile')):

            $filename = uniqid('item-' , true). '.' . $request->file('imageFile')->getClientOriginalExtension();
            $path = public_path('images/items/');

            if(!file_exists($path)):

                mkdir($path , 777,true);

            endif;

            $request->file('imageFile')->move($path , $filename);
            $item->image = $filename;
        else:
            $item->image = null;
        endif;

        try {
            $item->save();
            DB::commit();
            return response()->json(['message'=>'Item Created !', 'url'=> route('item.index')]);
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex);
            return response()->json(['message'=>$ex->getMessage(),'code'=>422]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $item = Item::with('category')->findOrFail($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $item = Item::findOrFail($id);
        return view('item.create', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = Item::findOrFail($id);

       try {
           $item->delete();
           return response()->json(['message'=>'Item Deleted !', 'url'=> route('item.index')]);
        } catch (\Exception $ex) {
            return response()->json(['message'=>$ex->getMessage(),'code'=>422]);
        }
    }

    /**
     * Get all categories
     *
     * @return Category
     */
    public function getAllCategories(Request $request){
        
        $name = $request->query('term');

        $category = Category::orderBy('id', 'desc')
        ->when(!empty($name), function ($q1) use ($name) {

                $q1->where('name','like',"%{$name}%");
        });

    $result = [];



    foreach ($category->get() as $val) {
        $result[] = ['id' => $val->id, 'text' => $val->name];

    }
    return response()->json(['results' => $result]);


    }

    /**
     * All Items to Select 2
     *
     * @param Request $request
     * @return void
     */
    public function getAllItems(Request $request){
    
        $name = $request->query('term');
        $category = $request->category_id;

        $item = Item::orderBy('id', 'desc')
        ->when(!empty($name), function ($q1) use ($name) {

                $q1->where('name','like',"%{$name}%");
        })
        ->when(!empty($category), function ($q1) use ($category) {

            $q1->where('category_id',$category);
    });

    
    $result = [];

    if(isset($category)):

        foreach ($item->get() as $val) {
            $result[] = ['id' => $val->id, 'text' => $val->name];

        }
 
    endif;


    return response()->json(['results' => $result]);

    }

    /**
     * get Single Item
     *
     * @param Request $request
     * @return void
     */
    public function getSingleItem(Request $request){
       $item_id = $request->item_id;
       
       $item = Item::with('category')->findOrFail($item_id);

       return response()->json($item);
    }
 
}
