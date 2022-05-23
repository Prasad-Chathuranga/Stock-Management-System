@extends('layouts.app')

@section('title', 'Category Management')
@section('subtitle', 'Categories')


@section ('breadcrumb' )
<li class="breadcrumb-item"><a href="">Categories</a></li>
@endsection

@section('style')

<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@section('content')
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
    <a type="button" class="btn btn-primary btn-sm me-2 d-flex" href="{{route('category.create')}}">New</a>
  </div>
  <div class="card-body">
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush" id="dataTable">
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Stock</th>
            </tr>
        </thead>
          <tbody>
            <tr>
              <td>Jonas Alexander</td>
              <td>Canada</td>
              <td>14</td>
            </tr>
            <tr>
              <td>Shad Decker</td>
              <td>Edinburgh</td>
              <td>51</td>

            </tr>
            <tr>
              <td>Michael Bruce</td>
              <td>Singapore</td>
              <td>29</td>
 
            </tr>
            <tr>
              <td>Donna Snider</td>
              <td>New York</td>
              <td>27</td>

            </tr>
          </tbody>
        </table>
      </div>
  </div>
  

@endsection

@section('script')

 <!-- Page level plugins -->
 <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

 <!-- Page level custom scripts -->
 <script>
   $(document).ready(function () {
     $('#dataTable').DataTable(); // ID From dataTable 
     $('#dataTableHover').DataTable(); // ID From dataTable with Hover
   });
 </script>

@endsection