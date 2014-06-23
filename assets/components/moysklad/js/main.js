/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 04.02.14.
 */
angular.module('mainMdl', ['ngAnimate']).
   controller('mainCtrl', ['$scope','$location', '$anchorScroll', function($scope, $location, $anchorScroll) {
      var scrollTo = function(id) {
         var old = $location.hash();
         $location.hash(id);
         $anchorScroll();
         //reset to old to keep any additional routing logic from kicking in
         $location.hash(old);
      };

      $scope.isShowDescription = false;
      $scope.toogleDescription = function () {
         $scope.isShowDescription = !$scope.isShowDescription;
         if ($scope.isShowDescription) {
            scrollTo('description');
         }
      };
   }]);
