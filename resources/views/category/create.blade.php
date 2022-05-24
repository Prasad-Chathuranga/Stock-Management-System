@extends('layouts.app')

@section('title', 'Category Management')
@section('subtitle', 'Categories')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('category.index')}}">Categories</a></li>
    
    <li class="breadcrumb-item"><a href="">{{ isset($category) ? 'Edit' : 'New' }}</a></li>
@endsection

@section('style')

    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@section('content')
<section ng-controller="CategoryController">
    <div class="mt-3 ml-4 mr-3 mb-0 d-flex flex-row align-items-center justify-content-between">
        <h6 class="font-weight-bold text-primary pt-3">{{ isset($category) ? 'Edit Category' : 'Create New Category' }}</h6>
        <a type="button" class="btn btn-success me-2 d-flex" href="javascript:void(0)" ng-click="save()">Save</a>
    </div>
    <hr />
    <div class="card-body">
        <div class="col-md-3">
            <div class="form-group">
                <label class="font-weight-bold" for="exampleInputEmail1">Category Name</label>
                <input type="text" ng-model="category.name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Category Name">

            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="exampleInputPassword1">Current Stock</label>
                <input type="number" class="form-control" ng-model="category.stock" id="exampleInputPassword1" placeholder="Enter Current Stock">
            </div>

           
            {{-- <div class="form-group">
        <label class="font-weight-bold" for="customFile">Image</label>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="customFile">
          <label class="custom-file-label font-weight-bold" for="customFile">Choose file</label>
        </div>
      </div> --}}
        </div>
    </div>
    <input type="hidden" ng-init="url='{{ route('category.store') }}';" />
    @if (isset($category))
    <input type="hidden" ng-init="init({{ $category->id }});" />
@endif
</section>

@endsection

@section('script')

    <script src="{{ asset('js/angular/category.js') }}"></script>


@endsection
