<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('category.create');
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

        $category = new Category();
        $category->fill($request->all());

        try {
            $category->save();
            DB::commit();
            return response()->json(['message'=>'Category Created !', 'url'=> route('category.index')]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['message'=>$ex->getMessage(),'code'=>422]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::findOrFail($id);
        return view('category.create', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        DB::beginTransaction();
        $category = Category::findOrFail($id);

        $category->fill($request->all());

        try {
            $category->save();
            DB::commit();
            return response()->json(['message'=>'Category Updated !', 'url'=> route('category.index')]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['message'=>$ex->getMessage(),'code'=>422]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::findOrFail($id);

       try {
           $category->delete();
           return response()->json(['message'=>'Category Deleted !', 'url'=> route('category.index')]);
        } catch (\Exception $ex) {
            return response()->json(['message'=>$ex->getMessage(),'code'=>422]);
        }
    }
}
