@extends('layouts.app')

@section('title', 'Re-Order Management')
@section('subtitle', 'Items')


@section ('breadcrumb' )
<li class="breadcrumb-item"><a href="">Re-Order</a></li>
@endsection

@section('content')
<section ng-controller="ReOrderController">
    <div class="mt-3 ml-4 mr-3 mb-0 d-flex flex-row align-items-center justify-content-between">
        <h6 class="font-weight-bold text-primary pt-3">Re-Order</h6>
        <a type="button" class="btn btn-primary disabled me-2 d-flex text-light">New</a>
    </div>
    <hr />
  <div class="card-body">
      <div class="table-responsive p-3">
        <table class="table table-striped table-bordered dt-responsive" id="dataTable" width="100%">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Item Category</th>
              <th>Category Stock</th>
              <th>Item</th>
              <th>Item Stock</th>
              <th>Stock to be Updated</th>
              <th></th>
             
            </tr>
        </thead>
          <tbody>
  @foreach ($items as $key => $item )
               <tr>
                 <td>{{$key+1}}</td>
                 <td>{{$item->category->name}}</td>
                 <td>{{$item->category->stock}}</td>
                 <td>{{$item->name}}</td>
                 <td>{{$item->stock}}</td>
                 <td><input type="text" ng-model="data.new[{{$item->id}}].to_be_update" id="to_be_update" name="to_be_update" class="allow_numeric_fld form-control form-control-sm" /></td>

                 
                 <td>
     
                   <a style="cursor: pointer" data-toggle='tooltip' data-placement="right" ng-click="updateStock({{$item}})"  title="Update Stock" class="text-info"> <i class="fa fa-refresh"></i></a>
                  {{-- <a style="cursor: pointer"  data-toggle='tooltip' data-placement="right" ng-click="delete({{$item->id}})" title="Delete Category" class="ml-3 text-danger"> <i class="fas fa-fw fa-trash"></i></a>  --}}
         
                </td>
               </tr>
           @endforeach  
          </tbody>
        </table>
      </div>

      <!-- Large modal -->




  </div>
  {{-- <input type="hidden" ng-init="url='{{ route('update_stock') }}';" /> --}}
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
<script src="{{ asset('js/angular/reorder.js') }}"></script>

 <!-- Page level custom scripts -->
 <script>
   $(document).ready(function () {
     $('#dataTable').DataTable(); // ID From dataTable 
     $('#dataTableHover').DataTable(); // ID From dataTable with Hover
   });

   $(".allow_numeric_fld").on("input", function(evt) {

var self = $(this);
self.val(self.val().replace(/\D/g, ""));

if ((evt.which < 48 || evt.which > 57)) {
    evt.preventDefault();
}

});
 </script>

@endsection