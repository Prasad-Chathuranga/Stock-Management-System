@extends('layouts.app')

@section('title', 'Payments')
@section('subtitle', 'Preview Invoice')


@section ('breadcrumb' )
<li class="breadcrumb-item"><a href="">Preview Invoice</a></li>
@endsection

@section('content')
<section>
    <div class="mt-3 ml-4 mr-3 mb-0 d-flex flex-row align-items-center justify-content-between">
        <h6 class="font-weight-bold text-primary pt-3">Preview Invoice</h6>
    </div>
    <hr />
  <div class="card-body">
    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                Invoice
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    {{$payment->payment_no}}
                </small>
            </h1>
    
            <div class="page-tools">
                <div class="action-buttons">
                    <a class="btn bg-white btn-light mx-1px text-95"  data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                    <a class="btn bg-white btn-light mx-1px text-95" href={{route('download_invoice', $payment->id)}} data-title="PDF">
                        <i class="mr-1 fa fa-file-pdf text-danger-m1 text-120 w-2"></i>
                        Export
                    </a>
                </div>
            </div>
        </div>
    
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150">
                               
                                    <img width="50" height="50" src="{{asset('img/logo/logo2.png')}}">
                                 
                                <span class="text-default-d3">SM Store</span>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->
    
                    <hr class="row brc-default-l1 mx-n1 mb-4" />
    
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">To:</span>
                                <span class="text-600 text-110 text-blue align-middle">{{$payment->customer->first_name}} {{$payment->customer->last_name}}</span>
                            </div>
                            <div class="text-grey-m2">
                                <div class="my-1">
                                    {{$payment->customer->email}}
                                </div>
                                
                                <div class="my-1">
                                    <i class="fa fa-phone fa-flip-horizontal text-secondary"></i> 
                                    <b class="text-600">{{$payment->customer->mobile_1}}</b>
                                </div>

                                <div class="my-1">
                                    <i class="fa fa-phone fa-flip-horizontal text-secondary"></i> 
                                    <b class="text-600"> {{$payment->customer->mobile_2}}</b>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
    
                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Invoice
                                </div>
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> {{$payment->payment_no}}</div>
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issued at:</span> {{date('Y-m-d h:i:s A', strtotime($payment->created_at))}}</div>
    
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Order Status:</span>
                                    @if($payment->order->status==0)
                                    <label class="badge badge-warning">
                                        <i class="" >Incomplete</i>
                                    </label>
                                    @else
                                    <label class="badge badge-warning">
                                        <i class="" >Completed</i>
                                    </label>
                                    @endif
                                    </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
   
                    <div class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="d-none d-sm-block col-1">#</div>
                            <div class="col-9 col-sm-5">Item</div>
                            <div class="d-none d-sm-block col-4 col-sm-2">Quantity</div>
                            <div class="d-none d-sm-block col-sm-2">Unit Price</div>
                            <div class="col-2">Amount</div>
                        </div>

            @foreach ($items as $key => $item )
            <div class="text-95 text-secondary-d3">
                <div class="row mb-2 mb-sm-0 py-25">
                    <div class="d-none d-sm-block col-1">{{$key+1}}</div>
                    <div class="col-9 col-sm-5">{{$item->item->name}}</div>
                    <div class="d-none d-sm-block col-2">{{number_format($item->quantity, 2)}}</div>
                    <div class="d-none d-sm-block col-2 text-95">{{number_format($item->price, 2)}}</div>
                    <div class="col-2 text-secondary-d2">{{number_format($item->total, 2)}}</div>
                </div>
            </div>
            @endforeach
                         
    
                        <div class="row border-b-2 brc-default-l2"></div>
    
                        <!-- or use a table instead -->
                      
                {{-- <div class="table-responsive">
                    <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                        <thead class="bg-none bgc-default-tp1">
                            <tr class="text-white">
                                <th class="opacity-2">#</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th width="140">Amount</th>
                            </tr>
                        </thead>
    
                        <tbody class="text-95 text-secondary-d3">
                            <tr></tr>
                            <tr>
                                <td>1</td>
                                <td>Domain registration</td>
                                <td>2</td>
                                <td class="text-95">$10</td>
                                <td class="text-secondary-d2">$20</td>
                            </tr> 
                        </tbody>
                    </table>
                </div> --}}
                
    
                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                Extra note such as company or payment information...<br>
                              
                                {{$payment->notes}}
                                
                            </div>
    
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Total
                                    </div>
                                    <div class="col-5">
                                        <span class="text-120 text-secondary-d1">{{number_format($payment->order->total, 2)}}</span>
                                    </div>
                                </div>
    
                                <div class="row my-2">
                                    <div class="col-7 text-right">
                                        Paid 
                                    </div>
                                    <div class="col-5">
                                        <span class="text-110 text-secondary-d1">{{number_format($payment->amount, 2)}}</span>
                                    </div>
                                </div>
    
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-7 text-right">
                                        Due Amount
                                    </div>
                                    <div class="col-5">
                                        <span class="text-150 text-success-d3 opacity-2">{{number_format($payment->due, 2)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <hr />
    
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  {{-- <input type="hidden" ng-init="url='{{ route('rentout.store') }}'; order_details_url='{{route('order_details')}}'" /> --}}
</section>

@endsection

@section('style')
<style>
    .text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
.bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
}
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #68a3d5!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}
</style>
@endsection

@section('script')

<script src="{{ asset('js/angular/invoice.js') }}"></script>

@endsection