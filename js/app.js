/**
 * Main AngularJS Web Application
 */
var app = angular.module('myApp', ['ngRoute', 'angularFileUpload', 'thumbs', 'fblindSimpleImageGallery']);

/**
 * Configure the Routes
 */
app.config(['$routeProvider', '$httpProvider', function ($routeProvider, $httpProvider) {
        $routeProvider
                .when("/", {templateUrl: "views/partials/home.html", controller: "siteController"})
                .when("/login", {templateUrl: "views/partials/login.html", controller: "loginController"})
//                .when("/logout", {controller: "siteController"})
                .when("/about", {templateUrl: "views/partials/about.html", controller: "siteController"})
                .when("/contact", {templateUrl: "views/partials/contact.html", controller: "siteController"})
                .when("/pricing", {templateUrl: "views/partials/pricing.html", controller: "siteController"})
                .when("/services", {templateUrl: "views/partials/services.html", controller: "siteController"})
                .when("/work", {templateUrl: "views/partials/work.html", controller: "siteController"})
                .when("/demo", {templateUrl: "views/partials/demo.html", controller: "demoController"})
                .when("/slider", {templateUrl: "views/partials/slider.html", controller: "siteController"})
                .when("/uploads", {templateUrl: "views/partials/uploads.html", controller: "uploadsController"})
                .when("/listing", {templateUrl: "views/partials/listing.html", controller: "listingController"})
                .when("/photoDetails/:id", {templateUrl: "views/partials/photoColor.html", controller: "detailController"})
                .otherwise("/404", {templateUrl: "views/partials/404.html", controller: "siteController"});
        $httpProvider.interceptors.push('authInterceptor');
    }]);
