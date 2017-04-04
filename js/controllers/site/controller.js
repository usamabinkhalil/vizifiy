
/**
 * Control all Pages
 */
app.controller('siteController', ['$scope', '$http', 'authInterceptor', '$rootScope', '$window', '$location', function ($scope, $http, authInterceptor, $rootScope, $window, $location) {
        $scope.loggedIn = function () {
            return Boolean($window.sessionStorage.access_token);
        };
        $scope.logout = function () {
            delete $window.sessionStorage.access_token;
            $location.path('/login').replace();
        };
    }]);