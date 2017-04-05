
/**
 * Control Login Pages
 */
app.controller('loginController', ['$scope', '$http', '$window', '$location',
    function ($scope, $http, $window, $location) {
        $scope.login = function () {
            $scope.submitted = true;
            $scope.error = {};
            $http.post('server/app/frontend/web/index.php?r=api/login', $scope.userModel).success(
                    function (data) {
                        $window.sessionStorage.access_token = data.access_token;
                        $location.path('/uploads').replace();
                    }).error(
                    function (data) {
                        angular.forEach(data, function (error) {
                            $scope.error[error.field] = error.message;
                        });
                    }
            );
        };
        $scope.loggedIn = function () {
            return Boolean($window.sessionStorage.access_token);
        };
        $scope.logout = function () {
            delete $window.sessionStorage.access_token;
            $location.path('/login').replace();
        };
    }
]);
