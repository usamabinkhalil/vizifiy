
/**
 * Control listing Pages
 */

app.controller('listingController', ['$scope', '$http', 'FileUploader', 'uploadImages', 'authInterceptor', '$rootScope', '$window', '$location', function ($scope, $http, FileUploader, uploadImages, authInterceptor, $rootScope, $window, $location) {

        uploadImages.getImages().then(function (response) {
            console.log(response.data);
            $rootScope.img_data = response.data;
        });

        $scope.colorwidth = function(clr_obj){
            /*console.log(clr_obj.color_percentage);*/
             /*console.log(clr_obj.color_percentage) */         /*  return (100/clr_obj.length)+'%'*/
          return clr_obj.color_percentage*100+'%'
        }   

        $scope.getindex=function(data){
            if ($(window).width()<990) {
                if (data%2==0) 
                {   
               /* console.log("samall"+data)*/
                return true;
                }
            }
            else if (data%3==0) 
            {  /* console.log(data)*/
                return true;
            }
               
        }


        
    }]);
