app.controller('ItemController', ($scope, $http, Loader, $timeout) => {

   

    $scope.init = (id) => {
    
        $http.get($scope.url + '/' + id)
                .then((response) => {

                    $scope.item = response.data;
                    $scope.item.item_image_url = document.location.origin+'/images/items/'+response.data.image;
    
                    $('#categories').append($('<option>', {

                        value: $scope.item.category.id,

                        text: $scope.item.category.name,

                        selected:true,

                        

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
                data: function(term) {
                    return term;
                },

                dataType: 'json'
            }

        });

    }



    $scope.save = () => {


        $scope.item.category = document.getElementById('categories').value;
        var url = $scope.url;

        if (typeof (beforeSubmit) == 'function') {
            beforeSubmit($scope.item);
            
        }

        var formData = new FormData();

        if ($scope.item.id) {
            url += '/' + $scope.item.id;
            $scope.item._method = 'put';
            formData.append('_method', 'put');
        }

        
        angular.forEach($scope.item, (value, key) => {
            formData.append(key, value);
        });


        if ($scope.image) {
            formData.append('imageFile', $scope.image);
        }

        Loader.start();

        $http.post(url, formData,{transformRequest: angular.identity, headers: {'content-type': undefined}})
                .then((response) => {

                    Loader.stop();
                    pnotify('Success', response.data.message, 'success');
                    $timeout(() => {
                      window.location = response.data.url;
                    }, 2000);

                })
                .catch((error) => {
                    Loader.stop();
                    console.log(error);
                    pnotify('Error', getErrorAsString(error.data), 'error');
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
              }else{
                  return;
              }
            });

        
    };

    $scope.imageChanged = (el) =>{
        $scope.image = el.files[0];
    }
    

});