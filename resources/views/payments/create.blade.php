@extends('layouts.app')

@section('title', 'Payments Management')
@section('subtitle', 'Payment')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('payment.index')}}">Payments</a></li>
    <li class="breadcrumb-item"><a href="">{{ isset($payment) ? 'Edit' : 'New' }}</a></li>
@endsection

@section('content')
<section ng-controller="PaymentController">
    <div class="mt-3 ml-4 mr-3 mb-0 d-flex flex-row align-items-center justify-content-between">
        <h6 class="font-weight-bold text-primary pt-3">{{ isset($payment) ? 'Edit Payment' : 'Make New Payment' }}</h6>
        {{-- <a type="button" class="btn btn-success me-2 d-flex" href="javascript:void(0)" ng-click="save()">Save</a> --}}
    </div>
    <hr />
    <div class="card-body">
        <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="select2SinglePlaceholder" class="font-weight-bold">Order</label>
                <select name="orders" id="orders" class="select2 form-control">
                    <option value="">Search for an Order...</option>
                </select>
              </div>
        </div>
    </div>


    <div ng-if="data.order_details.order" class="card">
        <div class="modal-content">
          <div class="card-header">
            <h6 class="card-title text-info" id="exampleModalLabel"><b>Order Summary - @{{data.order_details.order.order_num}}</b></h6>
          </div>
          <div class="card-body">
            <h6 class="font-weight-bold">Ordered Items</h6>
            <table class="table table-hover table-bordered">
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
          <div class="ml-auto mb-3 mr-3">
            <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-success">Pay</button>
          </div>
        </div> 
      </div>


      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title text-info" id="exampleModalLabel"><b>Make New Payment to @{{data.order_details.order.order_num}}</b></h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{-- @{{data.order_info}} --}}
                            <label class="font-weight-bold" for="exampleInputEmail1">Order Number</label>
                            <input type="text" ng-model="data.order_info.order_no" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Order Number">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="exampleInputPassword1">Total</label>
                            <input type="text" ng-model="data.order_info.total" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Order Number">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="exampleInputPassword1">Due</label>
                            <input type="text" ng-model="data.order_info.due" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="exampleInputPassword1">Amount to be Settled</label>
                            <input type="text" ng-model="data.order_info.settle" class="form-control allow_numeric_fld" ng-model="item.stock" id="exampleInputPassword1" placeholder="Enter Current Stock">
                        </div>

                        <div class="ml-auto mb-3 mr-3 form-group">
                            <button ng-click="payForOrder()" class="btn btn-primary">Make Payment</button>
                          </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <input type="hidden" ng-init="url='{{ route('item.store') }}'; 
    pay_for_order_url='{{route('pay_for_order')}}';
    order_details_url='{{route('order_details')}}'; 
    orders_url ='{{ route('orders') }}'; 
    init_select2_orders(); " />
    @if (isset($item))
    <input type="hidden" ng-init="init({{ $item->id }});" />
@endif
</section>

@endsection

@section('style')
  <!-- Select2 -->
  <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" type="text/css">

  <style>
      .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px;
        }


        .select2-container--default .select2-selection--single {
            height: 40px;
        }

  </style>
@endsection

@section('script')
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/angular/payment.js') }}"></script>

    

    <script type="text/javascript">

$(".allow_numeric_fld").on("input", function(evt) {

var self = $(this);
self.val(self.val().replace(/\D/g, ""));

if ((evt.which < 48 || evt.which > 57)){
    evt.preventDefault();
}

});

function getFileName (str) {
  if (str.length > 22) {
    return str.substr(0, 11) + '...' + str.substr(-11)
  }

  return str
}

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
    
                reader.onload = function (e) {
                    $('#category-img-tag').attr('src', e.target.result);
                    $('#file-label').text(getFileName(input.files[0].name));
                }
    
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
