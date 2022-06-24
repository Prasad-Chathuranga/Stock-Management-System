@extends('layouts.app')

@section('title', 'GRN Management')
@section('subtitle', 'GRNs')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('grn.index') }}">GRNs</a></li>
    <li class="breadcrumb-item"><a href="">New</a></li>
@endsection

@section('content')
    <section ng-controller="GRNController">
        <div class="mt-3 ml-4 mr-3 mb-0 d-flex flex-row align-items-center justify-content-between">
            <h6 class="font-weight-bold text-primary pt-3">Create New GRN</h6>
            <a type="button" class="btn btn-success me-2 d-flex" href="javascript:void(0)" ng-click="save()">Save</a>
        </div>
        <hr />
        <div class="card-body">
            <div class="col-md-12">
                <form id="regForm" action="">
                    <!-- One "tab" for each step in the form: -->
                    <div class="tab">
                        <h6 class="text-info"><strong>Item Details</strong></h6>
                        <hr>
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
                                            <th>Category</th>
                                            <th>Stock</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>GRN Quantity</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="(key,item) in items">
                                            <td>
                                                <p>@{{ item.category }}</p>
                                            </td>
                                            <td>
                                                <p>@{{ item.category_stock }}</p>
                                            </td>
                                            <td>
                                                <p>@{{ item.name }}</p>
                                            </td>
                                            <td>
                                                <p>@{{ item.stock }}</p>
                                            </td>
                                            <td>
                                                <input type="text" ng-model="item.grn_quantity" class="form-control allow_numeric" />
                                            </td>

                                          
                                            <td>
                                                <div class="button-list">
                                                    <button type="button" ng-click="removeItems(key)"
                                                        class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    

                                </table>
                            </div>

                            

                        </div>
                    </div>

                    


                   


                </form>
            </div>
        </div>
        <input type="hidden" ng-init="url='{{ route('grn.store') }}';
                categories_url ='{{ route('categories') }}';
                customers_url ='{{ route('customers') }}';
                init_select2_customers(); 
                init_select2_categories();
                items_url ='{{ route('items') }}';
                init_select2_items();
                get_item_url = '{{ route('get_item') }}';
                customer_details_url = '{{route('customer_details')}}';" />
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

        /* #select2-customers-container{
            width: 100%;
        } */
       

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
    <script src="{{ asset('js/angular/grn.js') }}"></script>

    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            document.getElementById("nextBtn").style.display = "inline";

            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").style.display = "none";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            // ... and run a function that displays the correct step indicator:
            // fixStepIndicator(n)
        }

        function nextPrev(n) {

            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // if(categories & items){
                x[currentTab].style.display = "none";
                currentTab = currentTab + n;
                showTab(currentTab);
            // }else{
                // console.log('ffg');
            // }



            // // Exit the function if any field in the current tab is invalid:
            //   if (n == 1 && !validateForm()) return false;
            // // Hide the current tab:
            // x[currentTab].style.display = "none";
            // // Increase or decrease the current tab by 1:
            // currentTab = currentTab + n;
            // // if you have reached the end of the form... :
            // if (currentTab >= x.length) {
            //     //...the form gets submitted:
            //     document.getElementById("regForm").submit();
            //     return false;
            // }
            // Otherwise, display the correct tab:
           
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
            // if (valid) {
            //     document.getElementsByClassName("step")[currentTab].className += " finish";
            // }
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
