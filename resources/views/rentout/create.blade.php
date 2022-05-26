@extends('layouts.app')

@section('title', 'RentOut Management')
@section('subtitle', 'RentOuts')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('item.index') }}">RentOuts</a></li>
    <li class="breadcrumb-item"><a href="">{{ isset($item) ? 'Edit' : 'New' }}</a></li>
@endsection

@section('content')
    <section ng-controller="RentOutController">
        <div class="mt-3 ml-4 mr-3 mb-0 d-flex flex-row align-items-center justify-content-between">
            <h6 class="font-weight-bold text-primary pt-3">{{ isset($item) ? 'Edit Order' : 'Create New Order' }}</h6>
            <a type="button" class="btn btn-success me-2 d-flex" href="javascript:void(0)" ng-click="save()">Save</a>
        </div>
        <hr />
        <div class="card-body">
            <div class="col-md-12">
                <form id="regForm" action="">
                    <!-- One "tab" for each step in the form: -->
                    <div class="tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categories" class="font-weight-bold">Category</label>
                                    <select name="categories" id="categories" class="select2 form-control">
                                        <option value="">Select a Category...</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="items" class="font-weight-bold">Item</label>
                                    <select name="items" id="items" class="select2 form-control">
                                        <option value="">Select an Item...</option>
                                    </select>
                                </div>
                            </div>

                            <div ng-if="items.length>0" class="col-md-12">
                                <table class="table table-bordered table-responsive-sm table-striped">

                                    <thead>

                                        <tr>

                                            <th>Item</th>

                                            <th style="width: 150px;">Price</th>

                                            

                                            
                                            <th style="width: 250px;">Discount Type</th>

                                            <th style="width: 250px;">Discount</th>
                                            <th style="width: 175px;">Quantity</th>
                                            <th style="width: 150px;">Actual Total</th>
                                            <th style="width: 150px;">Gross Total</th>

                                            <th style="width: 70px;"></th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr ng-repeat="(key,item) in items">

                                            <td><p>@{{item.name}}</p>

                                            {{-- <input type="hidden" name="categoryItem_id" ng-model="data.categoryItem_id">

                                            <input type="hidden" name="price" ng-model="data.price"> --}}

                                            </td>

                                           
                                            <td>

                                                <input type="text" ng-model="item.price" class="form-control allow_numeric" 
                                                ng-change="calculateDiscount(item)">

                                            </td>

                                            

                                            {{-- <td class="text-right">iikkk</td> --}}

                                            

                                            <td>

                                              

                                                 <select ng-model="item.discount_type" class="form-control" ng-change="calculateDiscount(item);">
                                                    <option selected>Select Type...</option>
                                                    <option ng-value="0" selected>None</option>
                                                    <option ng-value="2">Fixed</option>

                                                    <option ng-value="1">%</option>

                                                </select> 

                                            </td>

                                            <td>

                                                <input type="number" ng-model="item.discount" class="form-control allow_numeric" 
                                                ng-change="calculateDiscount(item)">

                                            </td>

                                            <td>

                                                <input type="text" ng-model="item.quantity" class="form-control allow_numeric" 
                                                ng-change="calculateDiscount(item)">

                                            </td>

                                            <td class="text-right">@{{item.actual_total | number : 2}}</td>

                                            <td class="text-right">@{{item.gross_total | number : 2}}</td>

                                            <td>

                                                <div class="button-list">

                                                    <button type="button" ng-click="removeItems(key)" class="btn btn-danger"><i class="fa fa-trash"></i></button>

                                                </div>

                                            </td>

                                        </tr>

                                    </tbody>

                                    <tfoot>

                                        <tr>

                                            <th colspan="6" class="text-right"><strong>Sub Total</strong></th>

                                            <th class="text-right">@{{data.totalforitems | number : 2}}</th>

                                            <th></th>

                                        </tr>



                                        <tr>

                                            <th colspan="6" class="text-right"><strong>Discount</strong></th>

                                            <th class="text-right">@{{data.total_discount | number : 2}}</th>

                                            <th></th>

                                        </tr>



                                      



                                        <tr>

                                            <th colspan="6" class="text-right"><strong>Total</strong></th>

                                            <th class="text-right">@{{data.final_total | number : 2}}</th>

                                            <th></th>

                                        </tr>

                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab">
                        <h4>Customer Details</h4>
                        <div class="form-group">
                            <label class="font-weight-bold" for="exampleInputEmail1">First Name</label>
                            <input type="text" ng-model="item.name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter First Name">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="exampleInputEmail1">Last Name</label>
                            <input type="text" ng-model="item.name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter Last Name">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="exampleInputEmail1">Contact Number 1</label>
                            <input type="text" ng-model="item.name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter Contact Number 1">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="exampleInputEmail1">Contact Number 2</label>
                            <input type="text" ng-model="item.name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter Contact Number 2">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="exampleInputEmail1">Email</label>
                            <input type="text" ng-model="item.name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter Email Address">
                        </div>

                    </div>

                    <div style="overflow:auto;">
                        <div style="float:right;">
                            <button type="button" id="prevBtn" class="btn btn-warning"
                                onclick="nextPrev(-1)">Previous</button>
                            <button type="button" id="nextBtn" class="btn btn-info" onclick="nextPrev(1)">Next</button>
                        </div>
                    </div>

                    <!-- Circles which indicates the steps of the form: -->
                    {{-- <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                    </div> --}}

                </form>
            </div>
        </div>
        <input type="hidden"
            ng-init="url='{{ route('rentout.store') }}'; 
            categories_url ='{{ route('categories') }}'; 
            init_select2_categories(); 
            items_url ='{{ route('items') }}'; 
            init_select2_items(); 
            get_item_url = '{{ route('get_item') }}'; " />
        @if (isset($item))
            <input type="hidden" ng-init="init({{ $item->id }});" />
        @endif
    </section>

@endsection

@section('style')
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        /* Style the form */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px;
        }

        
.select2-container--default .select2-selection--single {
    height: 40px;
}
        /* Style the input fields */


        /* Mark input boxes that gets an error on validation: */
        input.invalid {
            /* background-color: #ffdddd; */
            border-color: red;
        }

        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        /* Mark the active step: */
        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04AA6D;
        }

    </style>
@endsection

@section('script')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/angular/rentout.js') }}"></script>

    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            //   if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
                //...the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false:
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class to the current step:
            x[n].className += " active";
        }
    </script>


    <script type="text/javascript">
        $(".allow_numeric_fld").on("input", function(evt) {

            var self = $(this);
            self.val(self.val().replace(/\D/g, ""));

            if ((evt.which < 48 || evt.which > 57)) {
                evt.preventDefault();
            }

        });

        function getFileName(str) {
            if (str.length > 22) {
                return str.substr(0, 11) + '...' + str.substr(-11)
            }

            return str
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#category-img-tag').attr('src', e.target.result);
                    $('#file-label').text(getFileName(input.files[0].name));
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
