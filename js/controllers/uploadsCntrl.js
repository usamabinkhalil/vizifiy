
/**
 * Control uploads Pages
 */

app.controller('uploadsController', ['$scope', '$http', 'FileUploader', 'uploadImages', 'authInterceptor', '$rootScope', '$window', '$location', function ($scope, $http, FileUploader, uploadImages, authInterceptor, $rootScope, $window, $location) {

        /**
         * angular file uploder
         * 
         **/
        $scope.attachments = {};

        $scope.uploader = new FileUploader({
            url: 'server/app/backend/web/index.php?r=attachments/upload'
        });

        $scope.uploader.onBeforeUploadItem = function (item) {
            formData = [{
                    file_name: item._file.name,
                    model_name: 'user_images',
                    user_id: 1,
                    file_encrypt_name: new Date().getTime() + item._file.name,
                }];
            Array.prototype.push.apply(item.formData, formData);
        };

        $scope.uploader.onSuccessItem = function (fileItem, response, status, headers) {
           /* console.log(response);  */
            
            uploadImages.getImages().then(function (response) {
                $scope.attachments = response.data;           
            });
            var img_id =response.id; /*response.url*/
            var img_url="https://images6.alphacoders.com/412/412086.jpg";
            clerifai.models.predict(Clarifai.GENERAL_MODEL, img_url).then(function(response) {
                /*console.log(response.outputs[0].data.concepts);*/
                
                var tags_array= response.outputs[0].data.concepts;
                var tags_obj={id:img_id,tags:tags_array};
               

/*                for (var data in tags_array) {

                    console.log(tags_array[data].name)
                }*/
                        $http({
                              method: 'Post',
                              url: 'server/app/backend/web/index.php?r=attachments/tags',
                              data: tags_obj,
                              headers: {'Content-Type': 'application/json'}
                            }).
                            success(function(response) {
                                 uploadImages.getImages().then(function (response) {
                                $rootScope.attachments = response.data;
        });
/*                                var parsed=JSON.parse(response);
                                $rootScope.tags=parsed;
                                console.log(parsed);*/
                            });
                },
              function(err) {
                console.error(err);
              }
            );          

        };
        // FILTERS
        $scope.uploader.filters.push({
            name: 'imageFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });

        uploadImages.getImages().then(function (response) {
            $rootScope.attachments = response.data;
        });
        $scope.loggedIn = function () {
            return Boolean($window.sessionStorage.access_token);
        };
        $scope.logout = function () {
            delete $window.sessionStorage.access_token;
            $location.path('/login').replace();
        };
    }]);
