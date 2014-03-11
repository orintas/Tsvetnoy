/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 08.03.14.
 */
angular.module('shopsMdl', ['service']).

   controller('shopsCtrl', ['$scope', '$timeout', 'AsyncLoad', 'RetailDemands', 'Goods', function($scope, $timeout, AsyncLoad, RetailDemands, Goods) {
      $scope.displayDemands = [];
      $scope.lastCheckDemandTime = new Date();
      var loadDemands = function() {
         $scope.lastCheckDemandTime = new Date();
         AsyncLoad.load('retailDemands', $scope, RetailDemands)
         $timeout(loadDemands, 1000 * 60);
      }
      loadDemands();
      AsyncLoad.load('goods', $scope, Goods);
   }]);

