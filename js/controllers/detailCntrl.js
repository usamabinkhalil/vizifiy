/**
 * Control listing Pages
 */
app.controller('detailController', ['$scope', '$http', 'FileUploader', 'uploadImages', 'authInterceptor', '$rootScope', '$window', '$location','$routeParams', function($scope, $http, FileUploader, uploadImages, authInterceptor, $rootScope, $window, $location,$routeParams) {

   /* console.log($routeParams.id);*/
           $scope.myitem=$rootScope.item;
        console.log($scope.myitem); 
    $scope.tagwidth = function(clr_obj) {

        return clr_obj.tag_percentage * 100 + '%'
    }
    $scope.colorwidth = function(clr_obj) {

        return clr_obj.color_percentage * 100 + '%'
    }

    $scope.tagcolor = function(clr_obj) {
        var perc= clr_obj.tag_percentage * 100;
        if (perc>= 75 && perc<= 100 ) {
            return "green";
        } 
        else if(perc>= 50 && perc<= 75) {
            return "orange";
        }
        else if(perc>= 25 && perc<= 50) {
            return "yellow";
        }        
        else if(perc>= 0 && perc<= 25){
            return "red";
        }
    }

    $http({
      method: 'GET',
      url: 'server/app/backend/web/index.php?r=attachments/getimage&id='+$routeParams.id+'&expand=colors,tags',
       headers: {'Content-Type': 'application/x-www-form-urlencoded'}

    }).success(function(response) {
        
        $scope.single_item=response; 
        console.log(response);
        
    });


}]);