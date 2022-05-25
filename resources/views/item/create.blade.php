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
                <label for="select2SinglePlaceholder" class="font-weight-bold">Category</label>
                <select name="categories" id="categories" class="select2 form-control">
                    <option value="">Select a Category...</option>
                </select>
              </div>
            <div class="form-group">
                <label class="font-weight-bold" for="exampleInputEmail1">Item Name</label>
                <input type="text" ng-model="item.name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Enter Item Name">

            </div>
            <div class="form-group">
                <label class="font-weight-bold" for="exampleInputPassword1">Current Stock</label>
                <input type="text" class="form-control allow_numeric_fld" ng-model="item.stock" id="exampleInputPassword1" placeholder="Enter Current Stock">
            </div>

            <div class="form-group">
                <label class="font-weight-bold" for="exampleInputPassword1">Price</label>
                <input type="text" class="form-control allow_numeric_fld" ng-model="item.price" id="exampleInputPassword1" placeholder="Enter Current Price">
            </div>

           
           
        </div>
        <div class="col-md-3 ml-5">
             <div class="form-group">
        <label class="font-weight-bold" for="customFile">Image</label>
        <div class="custom-file">
          <input type="file" accept="image/png, image/gif, image/jpeg" onchange="readURL(this);angular.element('#customFile').scope().imageChanged(this);" class="custom-file-input" id="customFile">
          <label class="custom-file-label font-weight-bold" id="file-label" ng-if="item.image" ng-bind="item.image" for="customFile">Choose file</label>
          <label class="custom-file-label font-weight-bold" id="file-label" ng-if="!item.image" for="customFile">Choose file</label>
        </div>
      </div> 
      <div class="form-group" ng-if="!item.image">
        <img src="{{asset('images/items/default_image.png')}}"  class="img-fluid img-thumbnail img-responsive" id="category-img-tag" />
    </div> 

    <div class="form-group" ng-if="item.image">
        <img ng-src="@{{item.item_image_url}}"  class="img-fluid img-thumbnail img-responsive" id="category-img-tag" />
    </div> 
        </div>
     
        
  
    </div>
    </div>
    <input type="hidden" ng-init="url='{{ route('item.store') }}'; categories_url ='{{ route('categories') }}'; init_select2_categories(); " />
    @if (isset($item))
    <input type="hidden" ng-init="init({{ $item->id }});" />
@endif
</section>

@endsection

@section('style')
  <!-- Select2 -->
  <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('script')
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/angular/item.js') }}"></script>

    

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
