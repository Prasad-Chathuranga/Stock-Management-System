@extends('layouts.app')

@section('title', 'Item Management')
@section('subtitle', 'Items')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('item.index')}}">Items</a></li>
    <li class="breadcrumb-item"><a href="">{{ isset($item) ? 'Edit' : 'New' }}</a></li>
@endsection

@section('content')
<section ng-controller="ItemController">
    <div class="mt-3 ml-4 mr-3 mb-0 d-flex flex-row align-items-center justify-content-between">
        <h6 class="font-weight-bold text-primary pt-3">{{ isset($item) ? 'Edit Item' : 'Create New Item' }}</h6>
        <a type="button" class="btn btn-success me-2 d-flex" href="javascript:void(0)" ng-click="save()">Save</a>
    </div>
    <hr />
    <div class="card-body">
        <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="font-weight-bold" for="exampleInputEmail1">Item Name</label>
                <input type="text" ng-model="category.name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Item Name">

            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="exampleInputPassword1">Current Stock</label>
                <input type="number" class="form-control" ng-model="category.stock" id="exampleInputPassword1" placeholder="Enter Current Stock">
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="exampleInputPassword1">Price</label>
                <input type="number" class="form-control" ng-model="category.stock" id="exampleInputPassword1" placeholder="Enter Current Price">
            </div>

           
            <div class="form-group">
        <label class="font-weight-bold" for="customFile">Image</label>
        <div class="custom-file">
          <input type="file" accept="image/png, image/gif, image/jpeg" onchange="readURL(this);" class="custom-file-input" id="customFile">
          <label class="custom-file-label font-weight-bold" id="file-label" for="customFile">Choose file</label>
        </div>
      </div> 
        </div>
        <div class="col-md-3">
            <img src="#" id="category-img-tag" /> 
        </div>
    </div>
    </div>
    <input type="hidden" ng-init="url='{{ route('item.store') }}';" />
    @if (isset($category))
    <input type="hidden" ng-init="init({{ $category->id }});" />
@endif
</section>

@endsection

@section('script')

    <script src="{{ asset('js/angular/item.js') }}"></script>

    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
    
                reader.onload = function (e) {
                    $('#category-img-tag').attr('src', e.target.result);
                    $('#file-label').text(input.files[0].name);
                }
    
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
