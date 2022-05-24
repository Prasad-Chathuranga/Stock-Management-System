@extends('layouts.app')

@section('title', 'Item Management')
@section('subtitle', 'Items')


@section ('breadcrumb' )
<li class="breadcrumb-item"><a href="">Items</a></li>
@endsection

@section('content')
<section ng-controller="ItemController">
    <div class="mt-3 ml-4 mr-3 mb-0 d-flex flex-row align-items-center justify-content-between">
        <h6 class="font-weight-bold text-primary pt-3">Items</h6>
        <a type="button" class="btn btn-primary me-2 d-flex" href="{{route('item.create')}}">New</a>
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
              <th>Created On</th>
              <th></th>
            </tr>
        </thead>
          <tbody>
           {{-- @foreach ($categories as $key => $category )
               <tr>
                 <td>{{$key+1}}</td>
                 <td>{{$category->name}}</td>
                 <td>{{$category->stock}}</td>
                 <td>{{date('Y-m-d h:i:s A', strtotime($category->created_at))}}</td>
                 <td>
     
                   <a style="cursor: pointer" data-toggle='tooltip' data-placement="right" href='{{route('item.edit',$category->id)}}' title="Edit Item" class="text-info"> <i class="fas fa-fw fa-pen"></i></a>
                  <a style="cursor: pointer"  data-toggle='tooltip' data-placement="right" ng-click="delete({{$category->id}})" title="Delete Category" class="ml-3 text-danger"> <i class="fas fa-fw fa-trash"></i></a> 
         
                </td>
               </tr>
           @endforeach --}}
          </tbody>
        </table>
      </div>
  </div>
  <input type="hidden" ng-init="url='{{ route('item.store') }}';" />
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
<script src="{{ asset('js/angular/category.js') }}"></script>

 <!-- Page level custom scripts -->
 <script>
   $(document).ready(function () {
     $('#dataTable').DataTable(); // ID From dataTable 
     $('#dataTableHover').DataTable(); // ID From dataTable with Hover
   });
 </script>

@endsection