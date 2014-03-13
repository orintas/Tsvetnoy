/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 08.03.14.
 */
angular.module('shopsMdl', ['service']).
   controller('shopsCtrl',
      ['$scope', '$timeout', 'AsyncLoad', 'RetailDemands', 'Goods', 'Shops',
         function($scope, $timeout, AsyncLoad, RetailDemands, Goods, Shops) {
      $scope.displayDemands = [];
      $scope.lastCheckDemandTime = new Date();
      var loadDemands = function() {
         $scope.lastCheckDemandTime = new Date();
         AsyncLoad.load('retailDemands', $scope, RetailDemands)
         $timeout(loadDemands, 1000 * 60);
      }
      loadDemands();
      AsyncLoad.load('goods', $scope, Goods);
      AsyncLoad.load('shops', $scope, Shops);
   }]).
   controller('shopsContactsCtrl', ['$scope', 'AsyncLoad', 'Shops', function($scope, AsyncLoad, Shops) {
      AsyncLoad.load('shops', $scope, Shops);
   }]);


