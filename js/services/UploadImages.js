angular.module('myApp')
        .service('uploadImages', ['$http', function ($http) {

                var url = 'server/app/backend/web/index.php?r=attachments';
                this.getImages = function () {
                    return $http.get(url + '&expand=colors,tags');
                };

                this.insertImage = function (data) {
                    return $http.post(url + '/upload', data);
                };

            }]);