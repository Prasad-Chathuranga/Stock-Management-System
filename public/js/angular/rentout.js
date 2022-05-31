app.controller('RentOutController', ($scope, $http, Loader, $timeout) => {

    let items = [];
    $scope.data = [];
    $scope.items = [];
    $scope.payment = [{}];
    // $scope.odrer = {};
    // $scope.odrer.advance_payment = "0";

    $scope.init = (id) => {

        $http.get($scope.url + '/' + id)
            .then((response) => {

                $scope.item = response.data;
                $scope.item.item_image_url = document.location.origin + '/images/items/' + response.data.image;

                $('#categories').append($('<option>', {

                    value: $scope.item.category.id,

                    text: $scope.item.category.name,

                    selected: true,



                }));


                if (typeof (initDone) == 'function') {
                    initDone($scope.category);
                }

            })
            .catch((error) => {
                //    iziToast.error({
                //         title: 'Something went wrong !',
                //         message: getErrorAsString(error),
                //         position: 'topRight'
                //       });
            });

    };




    $scope.init_select2_categories = () => {

        $('#categories').select2({

            ajax: {
                url: $scope.categories_url,
                data: function (term) {
                    return term;
                },

                dataType: 'json'
            }

        }).on('change', function () {
            $scope.data.category_id = document.getElementById('categories').value;
        });

    }


    $scope.init_select2_items = () => {

        $('#items').select2({

            ajax: {
                url: $scope.items_url,
                data: function (params) {
                    var query = {
                        search: params.term,
                        category_id: $scope.data.category_id,
                    }

                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },

                dataType: 'json'
            }

        }).on('change', function () {
            $scope.data.item_id = document.getElementById('items').value;

            var found = 0;
            items.forEach(element => {
                if ($scope.data.item_id == element.id) {
                    found++;
                }
            });
            if (found == 0) {

                $scope.on_item_change();
            } else {
                pnotify('Error', 'Item already in list', 'error');
            }

        });
    }



    $scope.on_item_change = () => {
        var url = $scope.get_item_url;

        if ($scope.data.item_id != null) {
            Loader.start();

            var submit_data = {
                item_id: $scope.data.item_id
            };

            $http.get(url, {
                    params: submit_data
                })
                .then((response) => {
                    // console.log(response);
                    var data = response.data;

                    // if(response.data.allow_to_buy==false){
                    //     Loader.stop();
                    //     pnotify('Error', response.data.message, 'error');
                    // }
                    // else{
                    //     let price = ($scope.data.local)?data.priceLocal:data.priceINTL;
                    //     Loader.stop();
                    var new_item = {
                        'category': data.category.name,
                        'name': data.name,
                        'price': data.price,
                        'stock': data.stock,
                        'image': data.image,
                        'quantity': 1,
                        'id': data.id,
                        'discount_type': 0,
                        'discount': 0,
                        'gross_total': data.price - 0,
                        'actual_total': data.price * 1
                    };
                    items.push(new_item);
                    $scope.items = items;

                    $scope.calculateTotal();
                    // }
                })
                .catch((error) => {
                    console.log(error);
                    // Loader.stop();
                    // pnotify('Error', getErrorAsString(error.data), 'error');
                    // Loader.stop();
                });
        }
    }

    $scope.getOrderDetails = (id) =>{
        $http.get($scope.order_details_url, {params:{
            id : id
        }})
            .then((response) => {
                console.log(response);
                $scope.data.order_details = response.data;
               
                
                response.data.order.forEach(element => {
                    $scope.data.order_details.order.created_at = returnSenskaDateTimeString(element.created_at);
                    $scope.data.order_details.order.order_no = element.order_no;
                });
                // console.log(JSON.stringify(response.data.order));
            })
            .catch((error) => {
                console.log(error);
                // Loader.stop();
                // pnotify('Error', getErrorAsString(error.data), 'error');
                // Loader.stop();
            });
    }

    $scope.calculateDiscount = (item) => {

        // console.log(document.getElementById('qty').value);
        let discount = 0;
        let total = item.price * item.quantity;
        let subtotal = 0;
        let totalForItems = 0;
        let actual_total = 0;


        if (item.discount_type == "1") { //precentage
            discount = total * (item.discount / 100);

        } else if (item.discount_type == "2") { //fixed
            discount = item.discount;

        } else {
            discount = 0;

        }

        item.actual_total = total;
        item.discount = discount;
        item.gross_total = total - discount;

        items.forEach((element, index) => {
            if (element.id === item.id) {
                items[index] = item;
            }

        });

        $scope.calculateTotal();
    }

    $scope.calculateTotal = () => {


        let subtotal = 0;
        let totalForItems = 0;
        let total_discount = 0;
        let final_total = 0;

        items.forEach((element, index) => {
            final_total = final_total + element.gross_total;
            totalForItems = totalForItems + (element.price * element.quantity);
            total_discount = total_discount + element.discount;
        });

        $scope.data.subtotal = subtotal;
        $scope.data.totalforitems = totalForItems;
        $scope.data.total_discount = total_discount;
        $scope.data.final_total = final_total;
    }


    $scope.save = () => {

        // console.log($scope.payment);

        // $scope.item.category = document.getElementById('categories').value;
        var url = $scope.url;

        // if (typeof (beforeSubmit) == 'function') {
        //     beforeSubmit($scope.item);

        // }

        // var formData = new FormData();

        // if ($scope.item.id) {
        //     url += '/' + $scope.item.id;
        //     $scope.rentout._method = 'put';
        //     // formData.append('_method', 'put');
        // }


        // angular.forEach($scope.item, (value, key) => {
        //     formData.append(key, value);
        // });

        var amounts = {
            subtotal : $scope.data.subtotal,
            totalforitems : $scope.data.totalforitems,
            total_discount : $scope.data.total_discount,
            final_total : $scope.data.final_total,
            due_amount : $scope.data.final_total-$scope.order.amount
        }

        var data = {
            item : $scope.items,
            customer : $scope.customer,
            amounts :  amounts,
            order :  $scope.order
        }



        // if ($scope.image) {
        //     formData.append('imageFile', $scope.image);
        // }

        // Loader.start();

        

        $http.post(url, data)
            .then((response) => {
                console.log(response);
                // Loader.stop();
                // pnotify('Success', response.data.message, 'success');
                // $timeout(() => {
                //     window.location = response.data.url;
                // }, 2000);

            })
            .catch((error) => {
                console.log(error);
                // Loader.stop();
                // console.log(error);
                // pnotify('Error', getErrorAsString(error.data), 'error');
            });

    };

    $scope.delete = (id) => {

        swal({
                title: 'Are you sure want to delete ?',
                text: 'Once deleted, will not be able to recover this item !',
                icon: 'error',
                buttons: true,
                dangerMode: true,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                showLoaderOnConfirm: true
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = $scope.url + '/' + id;

                    Loader.start();

                    $http.delete(url)
                        .then((response) => {
                            $scope.data = {};
                            Loader.stop();
                            pnotify('Success', response.data.message, 'success');

                            $timeout(() => {
                                window.location = response.data.url;
                            }, 2000);

                        })
                        .catch((error) => {
                            pnotify('Error', getErrorAsString(error.data), 'error');
                            Loader.stop();
                        });
                } else {
                    return;
                }
            });


    };

 

    $scope.checkAmount = (total, amount) =>{
        if(amount > total){
            $scope.payment.amount = 0;
            pnotify('Warning !', 'Amount is higher than total amount', 'error');
        }
    }

    $scope.removeItems = function (id) { // remove dynamic fieldsto cargo details

        items.splice(id, 1);
        $scope.calculateTotal();

    }

    $scope.addPayment = () =>{
        var new_payment = {};
        $scope.payment.push(new_payment);

    }

    $scope.removePayment = function (id) { // remove dynamic fieldsto cargo details
        if ($scope.payment.length > 1) {
            $scope.payment.splice(id, 1);
            // $scope.calculatePaymentTotal();
        }
    }

    $scope.imageChanged = (el) => {
        $scope.image = el.files[0];
    }


});
