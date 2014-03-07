/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 08.03.14.
 */
angular.module('shopsMdl', ['service']).
   controller('shopsCtrl', ['$scope', 'AsyncLoad', 'RetailDemands', 'Goods', function($scope, AsyncLoad, RetailDemands, Goods) {
      AsyncLoad.load('retailDemands', $scope, RetailDemands);
      AsyncLoad.load('goods', $scope, Goods);
   }]);

