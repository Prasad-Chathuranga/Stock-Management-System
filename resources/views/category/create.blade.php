@extends('layouts.app')

@section('title', 'Category Management')
@section('subtitle', 'Categories')

@section ('breadcrumb' )
<li class="breadcrumb-item"><a href="">Categories</a></li>
<li class="breadcrumb-item"><a href="">New</a></li>
@endsection

@section('style')

<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@section('content')
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">{{ isset($category) ? 'Edit Category':'Create New Category' }}</h6>
    <a type="button" class="btn btn-success btn-sm me-2 d-flex" href="{{route('category.create')}}">Save</a>
  </div>
<div class="card-body">
    <form>
      <div class="form-group">
        <label class="font-weight-bold" for="exampleInputEmail1">Category Name</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
          placeholder="Enter Category Name">
        <small id="emailHelp" class="form-text text-muted">We'll never share your
          email with anyone else.</small>
      </div>
      <div class="form-group">
        <label class="font-weight-bold" for="exampleInputPassword1">Current Stock</label>
        <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Enter Current Stock">
      </div>
      <div class="form-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="customFile">
          <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
      </div>
      <div class="form-group">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
          <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  

@endsection

@section('script')



@endsection