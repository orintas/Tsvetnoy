/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 08.03.14.
 */
angular.module('shopsMdl', ['service']).
   controller('shopsCtrl',
      ['$scope', '$timeout', 'AsyncLoad', 'RetailDemands', 'Goods', 'Shops', '$location',
         function($scope, $timeout, AsyncLoad, RetailDemands, Goods, Shops, $location) {
      $scope.displayDemands = [];
      var params = $location.search();
      if (params.shopUUID) {
         $scope.currentShopUUID = params.shopUUID;
      }
      $scope.lastCheckDemandTime = new Date();
      $scope.matchShop = function () {
         return function (shop) { return shop.id == $scope.currentShop.id; }
      };
      $scope.sortDemand = function (demand) {
         console.log("Sort on demand");
         console.log(demand);
         return 1;
      };

      var loadDemands = function() {
         $scope.lastCheckDemandTime = new Date();
         AsyncLoad.load('retailDemands', $scope, RetailDemands)
         $timeout(loadDemands, 1000 * 60);
      };
      loadDemands();
      AsyncLoad.pushLoad("shops");
      Shops.get({}, function (response) {
         $scope.shops = response;
         if (!$scope.currentShopUUID) {
            $scope.currentShopUUID = "e4405e53-a9a0-11e2-dd46-001b21d91495";
         }
         $scope.currentShop = $scope.shops[$scope.currentShopUUID];
         AsyncLoad.popLoad("shops");
      }, function (response) {
         $scope.error = response;
         AsyncLoad.popLoad("shops");
      });
      AsyncLoad.load('goods', $scope, Goods);
   }])
   .filter('demandFilter', function() {
      return function (demands, selectedShopUUID) {
         var filteredDemands = {};
         for (var key in demands) {
            if (demands.hasOwnProperty(key) && (demands[key].sourceStoreUuid == selectedShopUUID)) {
               filteredDemands[key] = demands[key];
            }
         }
         return filteredDemands;
      };
   })
   .filter("toArray", function(){
      return function(obj) {
         var result = [];
         angular.forEach(obj, function(val, key) {
            result.push(val);
         });
         return result;
      };
   });
   controller('shopsContactsCtrl', ['$scope', 'AsyncLoad', 'Shops', function($scope, AsyncLoad, Shops) {
      AsyncLoad.load('shops', $scope, Shops);
   }]);


