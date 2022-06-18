<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use stdClass;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    /**
     * get All Customers to Select 2
     *
     * @param Request $request
     * @return $result
     */
    public function getAllCustomers(Request $request){
        $term = $request->query('term');

        $customer = Customer::orderBy('id', 'desc')
        ->when(!empty($name), function ($q1) use ($term) {
            $q1->where('first_name', 'like', '%'.$term.'%')
            ->orWhere('last_name', 'like', '%'.$term.'%')
            ->orWhere('email', 'like', '%'.$term.'%')
            ->orWhere('order_no', 'like', '%'.$term.'%');
        });

    
    $result = [];

  

        foreach ($customer->get() as $val) {
            $result[] = ['id' => $val->id, 'text' => $val->customer_no . ' - '.$val->first_name];

        }
 
 


    return response()->json(['results' => $result]);
    }

    /**
     * Get Customer Details
     *
     * @param [type] $id
     * @return void
     */
    public function getCustomerDetails(Request $request){
        
        $id = $request->query('id');
        $data = Customer::findOrFail($id);
      
        
        return response()->json($data);

    }
}
