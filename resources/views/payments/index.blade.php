@extends('layouts.app')

@section('title', 'Payment Management')
@section('subtitle', 'Payments')


@section ('breadcrumb' )
<li class="breadcrumb-item"><a href="">Payments</a></li>
@endsection

@section('content')
<section ng-controller="PaymentController">
    <div class="mt-3 ml-4 mr-3 mb-0 d-flex flex-row align-items-center justify-content-between">
        <h6 class="font-weight-bold text-primary pt-3">Payments</h6>
        <a type="button" class="btn btn-primary me-2 d-flex" href="{{route('payment.create')}}">New</a>
    </div>
    <hr />
  <div class="card-body">
      <div class="table-responsive p-3">
        <table class="table table-striped table-bordered dt-responsive" id="dataTable" width="100%">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Customer Number</th>
              <th>Name</th>
              <th>Email</th>
              <th>Order Number</th>
              <th>Payment Number</th>
              <th>Paid Amount</th>
              <th>Due Amount</th>
              <th>Order Amount</th>
              <th></th>
            </tr>
        </thead>
          <tbody>
              
  @foreach ($payments as $key => $payment )
               <tr>
                 <td>{{$key+1}}</td>
                 <td>{{$payment->customer->customer_no}}</td>
                 <td>{{$payment->customer->first_name}} {{$payment->customer->last_name}}</td>
                 <td>{{$payment->customer->email}}</td>
                 <td>{{$payment->order->order_no}}</td>
                 <td>{{$payment->payment_no}}</td>
                 <td>{{number_format($payment->amount, 2)}}</td>
                 <td>{{number_format($payment->due, 2)}}</td>
                 <td>{{number_format($payment->order->total, 2)}}</td>
                
                   {{-- <td> --}}
                
                 {{-- <td>{{number_format($payment->$order->total, 2)}}</td>
                 <td>{{number_format($payment->$order->paid, 2)}}</td>
                  
                 <td>{{date('Y-m-d h:i:s A', strtotime($payment->$order->created_at))}}</td>
                 <td>@if($payment->$order->status==0)<label class="badge badge-warning">
                  <i class="" >Incomplete</i>
              </label>@endif</td>
                 <td>
    
                </td> --}}
                 <td>
     
                    <a style="cursor: pointer" 
                   title="Edit Item" href="{{ route('print_preview', $payment->id) }}" class="text-primary"> <i class="fa fa-print"></i></a>
                
                 </td> 
               </tr>
           @endforeach  
          </tbody>
        </table>
      </div>

      <!-- Large modal -->


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title text-info" id="exampleModalLabel"><b>Order Summary</b></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="mt-2 font-weight-bold">Ordered Items</h6>
        <table class="table mb-4 table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Item</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Discount</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="(key,item) in data.order_details.items">
              <th scope="row">@{{key+1}}</th>
              <td>@{{item.item.name}}</td>
              <td>@{{item.price | number : 2}}</td>
              <td>@{{item.quantity}}</td>
              <td>@{{item.discount | number : 2}}</td>
              <td class="text-right font-weight-bold">@{{item.total | number : 2}}</td>
            </tr>
          </tbody>
          <tfoot>
            <tr ng-repeat="(key, order) in data.order_details.order">
                <th colspan="5" class="text-right"><strong>Total Order Amount</strong></th>
                <th class="text-right text-danger">@{{order.total | number: 2}}</th>
            </tr>

            <tr ng-repeat="(key, order) in data.order_details.order">
                <th colspan="5" class="text-right"><strong>Paid Amount</strong></th>
                <th class="text-right text-danger">@{{ order.paid | number: 2 }}</th>
                
            </tr>

            <tr ng-repeat="(key, order) in data.order_details.order">
              <th colspan="5" class="text-right"><strong>Status</strong></th>
              <th class="text-right">
                <div ng-if="order.status=='0'">
                <label class="badge badge-warning">
                  <i class="" >Incomplete</i>
              </label>
                </div>
              </th>
              
          </tr>
        </tfoot>
        </table>

        <h6 class="mt-2 font-weight-bold">Payments</h6>
        <table class="table mb-2 table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Paid Amount</th>
              <th scope="col">Notes</th>
              <th scope="col">Due Amount</th>
              <th scope="col">Paid On</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="(key,payment) in data.order_details.payments">
              <th scope="row">@{{key+1}}</th>
              <td>@{{payment.amount | number : 2}}</td>
              <td>@{{payment.notes}}</td>
              <td>@{{payment.due | number : 2}}</td>
              <td>@{{data.order_details.order.created_at}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

  </div>
  <input type="hidden" ng-init="url='{{ route('payment.store') }}'; order_details_url='{{route('order_details')}}'" />
</section>

@endsection

@section('style')
<!-- DataTables css -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('vendor/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive Datatable css -->
<link href="{{ asset('vendor/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')

 <!-- Page level plugins -->
 <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('vendor/datatables/dataTables.responsive.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('vendor/datatables/responsive.bootstrap4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/angular/payment.js') }}"></script>

 <!-- Page level custom scripts -->
 <script>
   $(document).ready(function () {
     $('#dataTable').DataTable(); // ID From dataTable 
     $('#dataTableHover').DataTable(); // ID From dataTable with Hover
   });
 </script>

@endsection