/**
 * Control listing Pages
 */
app.controller('listingController', ['$scope', '$http', 'FileUploader', 'uploadImages', 'authInterceptor', '$rootScope', '$window', '$location', function($scope, $http, FileUploader, uploadImages, authInterceptor, $rootScope, $window, $location) {

    var searchArray;
    uploadImages.getImages().then(function(response) {
        console.log(response.data);
        $rootScope.img_data = response.data;
        searchArray = response.data;
    });

    $scope.colorwidth = function(clr_obj) {
        /*console.log(clr_obj.color_percentage);*/
        /*console.log(clr_obj.color_percentage) */
        /*  return (100/clr_obj.length)+'%'*/
        return clr_obj.color_percentage * 100 + '%';
    }

    $scope.getindex = function(data) {
        if ($(window).width() < 990) {
            if (data % 2 == 0) {
                return true;
            }
        } 
        else if (data % 3 == 0) { /* console.log(data)*/
            return true;
        }

    }


    $scope.setid = function(id) {

      for (var i = 0; i < searchArray.length; i++) {
          if ( searchArray[i].id == id) {
             $rootScope.item=searchArray[i];
             /* $rootScope.$emit('item', searchArray[i]);*/
            /* console.log($scope.item.id);*/
          }
      }
      
    }

    clerifai.models.predict(Clarifai.GENERAL_MODEL, 'https://samples.clarifai.com/metro-north.jpg').then(
        function(response) {
            /* console.log(response);*/

            /*    var arr= response.outputs[0].data.concepts;
                for (var data in arr) {
                    console.log(arr[data].name)
                }*/
        },
        function(err) {
            console.error(err);
        }
    );

}]);