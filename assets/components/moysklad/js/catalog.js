/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 04.02.14.
 */
angular.module('catalogMdl', ['service', 'infinite-scroll']).
   /*controller('calculatorCtrl', ['$scope', '$rootScope', function($scope, $rootScope) {
      $scope.orderSum = 20000;
      $scope.smallBonus = 2450;
      $scope.bigBonus = 235522;
      $scope.$watch('orderSum * (discont / 100)', function(newValue, oldValue) {
         $scope.smallBonus = newValue - $scope.orderSum * 0.1;
         $scope.bigBonus = newValue;
      });
      var discontChange = function(event, ui) {
         $scope.$apply(function() {
            $rootScope.discont  = ui.value;
         });
      };
      var orederSumChange = function(event, ui) {
         $scope.$apply(function() {
            $scope.orderSum  = ui.value;
         });
      };
      $('#discontSlider').slider({
         min: 0,
         max: 100,
         step: 5,
         value: $rootScope.discont,
         slide: discontChange
      });
      $('#orderSumSlider').slider({
         min: 10000,
         max: 200000,
         step: 10000,
         value: $scope.orderSum,
         slide: orederSumChange
      });
      $('.calculatorTooltip').tooltip();
   }]).*/
   controller('orderCtrl', ['$scope', '$rootScope', function($scope, $rootScope) {

   }]).
   controller('catalogCtrl', ['$scope', 'Goods', 'Entities', 'Stock', 'AsyncLoad', function($scope, Goods, Entities, Stock, AsyncLoad) {
      $scope.discont = 10;
      $scope.displayGoods = [];
      $scope.preview = 0;
      $scope.orderSum = 0;
      $scope.orderFormVisible = false;
      $scope.visibleOrderButton = 0;
      $scope.discontCalcVisible = false;
      $scope.showOnlyStock = false;
      var goodsIsLoaded = false;

      AsyncLoad.load('entities', $scope, Entities);
      AsyncLoad.load('stock', $scope, Stock);

      var addDisplayGoods = function(beginIndex, count) {
         for (var i = beginIndex; i < beginIndex + count; i++) {
            $scope.displayGoods.push($scope.goods.good[$scope.goodKeys[i]]);
         }
      };

      $scope.searchCtl = function() {
         while ($scope.displayGoods.length < $scope.goodKeys.length) {
            addDisplayGoods($scope.displayGoods.length, Math.min($scope.goodKeys.length - $scope.displayGoods.length, 10));
         }
         $scope.searchText = $scope.search;
      };
      $scope.loadGoods = function () {
         if (!goodsIsLoaded) {
            AsyncLoad.pushLoad('goods');
            Goods.get({}, function (response) {
               $scope.goods = response;
               $scope.goodKeys = Object.keys($scope.goods.good);
               var goodsCountForDisplay = Math.min($scope.goodKeys.length, 30);
               goodsIsLoaded = true;
               addDisplayGoods($scope.displayGoods.length, goodsCountForDisplay);
               AsyncLoad.popLoad('goods');
             }, function (response) {
               $scope.error = response;
               AsyncLoad.popLoad('goods');
            });
         } else {
            if ($scope.displayGoods.length < $scope.goodKeys.length) {
               addDisplayGoods($scope.displayGoods.length, Math.min($scope.goodKeys.length - $scope.displayGoods.length, 10));
            }
         }
      };

      $scope.getProperty = function (good, propertyName) {
         var result = null;
         if (!good.properties || !$scope.entities) {
            return result;
         }
         var checkProperty = function (property) {
            if ($scope.entities.entity && $scope.entities.entity[property] && $scope.entities.entity[property].name == propertyName) {
               result = $scope.entities.entity[property].value;
            }
         }
         good.properties.forEach(checkProperty);
         return result;
      };

      $scope.getStock = function (productCode) {
         if ($scope.stock[productCode] && $scope.stock[productCode] > 0) {
           return $scope.stock[productCode];
         }
         return 0;
      };
   }]);
