app.controller('ItemController', ($scope, $http, Loader, $timeout) => {

 

    $scope.init = (id) => {
    
        $http.get($scope.url + '/' + id)
                .then((response) => {

                   

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



    $scope.save = () => {

        var url = $scope.url;

        if (typeof (beforeSubmit) == 'function') {
            beforeSubmit($scope.category);
        }

        if ($scope.category.id) {
            url += '/' + $scope.category.id;
            $scope.category._method = 'put';
        }

        Loader.start();

        $http.post(url, $scope.category)
                .then((response) => {

                    Loader.stop();
                    pnotify('Success', response.data.message, 'success');
                    $timeout(() => {
                      window.location = response.data.url;
                    }, 2000);

                })
                .catch((error) => {
                    Loader.stop();
                    pnotify('Error', getErrorAsString(error.data), 'error');
                   
                    // iziToast.error({
                    //     title: 'Something went wrong !',
                    //     message: getErrorAsString(error),
                    //     position: 'topRight'
                    //   });
                });

    };

    $scope.delete = (id) => {
    
        swal({
            title: 'Are you sure want to delete ?',
            text: 'Once deleted, will not be able to recover this category !',
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
              }else{
                  return;
              }
            });

        
    };

    

});