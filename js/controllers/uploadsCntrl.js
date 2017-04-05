
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
            uploadImages.getImages().then(function (response) {
                $scope.attachments = response.data;
            });
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
