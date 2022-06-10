@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings ( {{date('F')}} )</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($order_total, 2)}}</div>
               <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{round( $precentage_orders).'%'}}</span>
              </div> 
            </div>
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings ( Today )</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($order_total, 2)}}</div>
               <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> {{round( $precentage_orders).'%'}}</span>
              </div> 
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ordered_items}}</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                <span>Since last years</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-shopping-cart fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$customers}}</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                <span>Since last month</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Available Items</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$stock_total}}</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                <span>Since yesterday</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-inbox fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
              aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Items Sold</h6>
          {{-- <div class="dropdown no-arrow">
            <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Month <i class="fas fa-chevron-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
              aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Select Periode</div>
              <a class="dropdown-item" href="#">Today</a>
              <a class="dropdown-item" href="#">Week</a>
              <a class="dropdown-item active" href="#">Month</a>
              <a class="dropdown-item" href="#">This Year</a>
            </div>
          </div> --}}
        </div>
        <div class="card-body">
          @foreach ($sales_items as $key => $sale)
              
         
          <div class="mb-3">
            <div class="small text-gray-500">{{$sale['item']}}
              <div class="small float-right"><b>{{$sale['quantity']}} of {{$sale['stock']}} Items - {{$sale['precentage']}}%</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar {{$sale['class']}}" role="progressbar" style="width: {{$sale['precentage']}}%" aria-valuenow="80"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>

          @endforeach
          {{-- <div class="mb-3">
            <div class="small text-gray-500">Gundam 90'Editions
              <div class="small float-right"><b>500 of 800 Items</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="small text-gray-500">Rounded Hat
              <div class="small float-right"><b>455 of 800 Items</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-danger" role="progressbar" style="width: 55%" aria-valuenow="55"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="small text-gray-500">Indomie Goreng
              <div class="small float-right"><b>400 of 800 Items</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="small text-gray-500">Remote Control Car Racing
              <div class="small float-right"><b>200 of 800 Items</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div> --}}
        </div>
        <div class="card-footer text-center">
          <a class="m-0 small text-primary card-link" href="#">View More <i
              class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </div>
    <!-- Invoice Example -->
    <div class="col-xl-8 col-lg-7 mb-4">
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Payments</h6>
          <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i
              class="fas fa-chevron-right"></i></a>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Paid</th>
                <th>Order</th>
                <th>Order Status</th>
                <th>Order Total</th>
                <th>Pending</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($latest_inv as $key => $invoice)
              <tr>
                <td><a href="#">{{$key+1}}</a></td>
                <td>{{$invoice->customer->customer_no}}</td>
                <td>{{number_format($invoice->amount, 2)}}</td>
                <td>{{$invoice->order->order_no}}</td>
                <td>
                  @if ($invoice->order->status)
                  <span class="badge badge-success">Complete</span>
                  @else
                  <span class="badge badge-warning">Incomplete</span>
                  @endif
                  
                </td>
                <td>
                  {{number_format($invoice->order->total, 2)}}
                </td>
                <td>
                  {{number_format($invoice->due, 2)}}
                </td>
              </tr>        
              @endforeach
          
              
            </tbody>
          </table>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
    <!-- Message From Customer-->
    <div class="col-xl-4 col-lg-5 ">
      <div class="card">
        <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-light">Message From Customer</h6>
        </div>
        <div>
          <div class="customer-message align-items-center">
            <a class="font-weight-bold" href="#">
              <div class="text-truncate message-title">Hi there! I am wondering if you can help me with a
                problem I've been having.</div>
              <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok · 58m</div>
            </a>
          </div>
          <div class="customer-message align-items-center">
            <a href="#">
              <div class="text-truncate message-title">But I must explain to you how all this mistaken idea
              </div>
              <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
            </a>
          </div>
          <div class="customer-message align-items-center">
            <a class="font-weight-bold" href="#">
              <div class="text-truncate message-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit
              </div>
              <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau · 25m</div>
            </a>
          </div>
          <div class="customer-message align-items-center">
            <a class="font-weight-bold" href="#">
              <div class="text-truncate message-title">At vero eos et accusamus et iusto odio dignissimos
                ducimus qui blanditiis
              </div>
              <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang · 54m</div>
            </a>
          </div>
          <div class="card-footer text-center">
            <a class="m-0 small text-primary card-link" href="#">View More <i
                class="fas fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')



@endsection

