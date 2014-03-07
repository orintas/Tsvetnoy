/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 08.03.14.
 */
angular.module('shopsMdl', ['service']).
   controller('shopsCtrl', ['$scope', 'Loading', function($scope, Loading) {
      Loading.pushLoad('RetailDemands');
      Entities.get({}, function (response) {
         $scope.entities = response;
         Loading.popLoad('Entities');
      }, function (response) {
         $scope.error = response;
         Loading.popLoad('Entities');
      });
   }]);

