/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 04.02.14.
 */
angular.module('catalogMdl', ['service', 'infinite-scroll']).
   controller('calculatorCtrl', ['$scope', '$rootScope', function($scope, $rootScope) {
      $rootScope.discont = 10;
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
   }]).
   controller('catalogCtrl', ['$scope', '$rootScope', 'Goods', function($scope, $rootScope, Goods) {
      $scope.displayGoods = [];
      $scope.preview = 0;
      $scope.discontCalcVisible = false;
      var goodsIsLoaded = false;
      var addDisplayGoods = function(beginIndex, count) {
         for (var i = beginIndex; i < beginIndex + count; i++) {
            $scope.displayGoods.push($scope.goods.good[i]);
         }
      };

      $scope.searchCtl = function() {
         $rootScope.isLoading = true;
         while ($scope.displayGoods.length < $scope.goods.good.length) {
            addDisplayGoods($scope.displayGoods.length, Math.min($scope.goods.good.length - $scope.displayGoods.length, 10));
         }
         $scope.searchText = $scope.search;
         $rootScope.isLoading = false;
      };
      $scope.loadGoods = function () {
         if (!goodsIsLoaded) {
            $rootScope.isLoading = true;
            Goods.get({}, function (response) {
               $scope.goods = response;
               goodsIsLoaded = true;
               addDisplayGoods($scope.displayGoods.length, Math.min($scope.goods.good.length, 30));
               $rootScope.isLoading = false;
             }, function (response) {
               $scope.error = response;
               $rootScope.isLoading = false;
            });
         } else {
            if ($scope.displayGoods.length < $scope.goods.good.length) {
               addDisplayGoods($scope.displayGoods.length, Math.min($scope.goods.good.length - $scope.displayGoods.length, 10));
            }
         }
      };
   }]);
