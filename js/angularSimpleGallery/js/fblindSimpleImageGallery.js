'use strict';
angular.module('fblindSimpleImageGallery', [])
        .directive('simpleImageGallery',
                function () {
                    var template = '<div id="simple-gallery">' +
                            '<div id="simple-gallery" class="col-sm-12 image">' +
                            '<div class="item active">' +
                            '<img ng-src="server/uploads/{{currentImage}}" class="img-responsive"/>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-sm-12">' +
                            '<div class="row">' +
                            '<div class="col-sm-12" id="slider-thumbs">' +
                            '<ul>' +
                            '<li ng-repeat="image in images track by $index">' +
                            '<a ng-click="activateImg($index)" href="">' +
                            '<img ng-src="server/uploads/{{image.file_encrypt_name}}" id="{{image.id}}" class="img-responsive simple-gallery-thumbnail"/>' +
                            '</a>' +
                            '</li>' +
                            '</ul>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    return {
                        restrict: 'E',
                        scope: {
                            images: '='
                        },
                        template: template,
                        controller: function ($scope, $rootScope) {
                            if (typeof $scope.currentImage == 'undefined') {
                                $rootScope.$watch('attachments', function (newValue, oldValue) {
                                    if (typeof newValue != 'undefined') {
                                        $scope.currentImage = newValue[0].file_encrypt_name;
                                        $scope.images = newValue;
                                        $rootScope.colors = newValue[0].colors;
                                        $rootScope.tags = newValue[0].tags;
                                    }
                                });
                            }

                            $scope.activateImg = function (index) {
                                $scope.currentImage = $scope.images[index].file_encrypt_name;
                                $rootScope.colors = $scope.images[index].colors;
                                $rootScope.tags = $scope.images[index].tags;
                            };

                        },
                        link: function (scope, element, attrs) {
                            if (typeof scope.images != 'undefined')
                                scope.currentImage = scope.images[0] || {};
                        }
                    };
                });
