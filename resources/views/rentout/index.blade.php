@extends('layouts.app')

@section('title', 'RentOut Management')
@section('subtitle', 'Items')


@section ('breadcrumb' )
<li class="breadcrumb-item"><a href="">RentOuts</a></li>
@endsection

@section('content')
<section ng-controller="RentOutController">
    <div class="mt-3 ml-4 mr-3 mb-0 d-flex flex-row align-items-center justify-content-between">
        <h6 class="font-weight-bold text-primary pt-3">RentOuts</h6>
        <a type="button" class="btn btn-primary me-2 d-flex" href="{{route('rentout.create')}}">New</a>
    </div>
    <hr />
  <div class="card-body">
      <div class="table-responsive p-3">
        <table class="table table-striped table-bordered dt-responsive" id="dataTable" width="100%">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Stock</th>
              <th>Price</th>
              <th>Image</th>
              <th>Created On</th>
              <th>Action</th>
            </tr>
        </thead>
          <tbody>
 {{-- @foreach ($items as $key => $item )
               <tr>
                 <td>{{$key+1}}</td>
                 <td>{{$item->name}}</td>
                 <td>{{$item->stock}}</td>
                 <td>{{$item->price}}</td>
                 <td>
 
                    @if(isset($item->image))
                    <img style="max-height: 50px;  object-fit: cover" src="{{url('images/items/')}}/{{$item->image}}" class="img-fluid" >
                      <span class="feather icon-chevron-down live-icon"></span>
                      @else
                      <img style="max-height: 50px;  object-fit: cover" src="{{url('images/items/')}}/default_image.png" class="img-fluid" >
                      <span class="feather icon-chevron-down live-icon"></span>
                    @endif
                  </td>
                 
                  
                 <td>{{date('Y-m-d h:i:s A', strtotime($item->created_at))}}</td>
                 <td>
     
                   <a style="cursor: pointer" data-toggle='tooltip' data-placement="right" href='{{route('item.edit',$item->id)}}' title="Edit Item" class="text-info"> <i class="fas fa-fw fa-pen"></i></a>
                  <a style="cursor: pointer"  data-toggle='tooltip' data-placement="right" ng-click="delete({{$item->id}})" title="Delete Category" class="ml-3 text-danger"> <i class="fas fa-fw fa-trash"></i></a> 
         
                </td>
               </tr>
           @endforeach   --}}
          </tbody>
        </table>
      </div>
  </div>
  <input type="hidden" ng-init="url='{{ route('rentout.store') }}';" />
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
<script src="{{ asset('js/angular/rentout.js') }}"></script>

 <!-- Page level custom scripts -->
 <script>
   $(document).ready(function () {
     $('#dataTable').DataTable(); // ID From dataTable 
     $('#dataTableHover').DataTable(); // ID From dataTable with Hover
   });
 </script>

@endsection