app.controller('InvoiceController', ($scope, $http, Loader, $timeout) => {

    let items = [];
    $scope.data = [];
    $scope.items = [];
    $scope.payment = [{}];
    // $scope.odrer = {};
    // $scope.odrer.advance_payment = "0";

    $scope.init = (id) => {

        $http.get($scope.url + '/' + id)
            .then((response) => {

                



            })
            .catch((error) => {
             
            });

    };



    $scope.getOrderDetails = (id) =>{
        $http.get($scope.order_details_url, {params:{
            id : id
        }})
            .then((response) => {
                console.log(response);
                $scope.data.order_details = response.data;
               
                
                response.data.order.forEach(element => {
                    $scope.data.order_details.order.created_at = returnSenskaDateTimeString(element.created_at);
                    $scope.data.order_details.order.order_num = element.order_no;
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



});
