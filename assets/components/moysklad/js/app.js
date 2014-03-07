/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 13.02.14.
 */
angular.module('app', ['catalogMdl', 'sendMailMdl', 'shopsMdl']).
   constant('config', {
      phone: "+7 (920) 685 89 33",
      info_mail: "info",
      domain: "protsvetnoy.com"
   }).
   service('Loading', ['$rootScope', function($rootScope) {
      this.loading = [];
      this.pushLoad = function(id) {
         console.log('Запрос ' + id + '(' + this.loading.length + ')');
         this.loading.push(id);
         $rootScope.isLoading = true;
      };
      this.popLoad = function(id) {
         this. loading.splice(this.loading.indexOf(id), 1);
         console.log('Запрос ' + id + ' выполнен' + '(' + this.loading.length + ')');
         if (this.loading.length == 0) {
            $rootScope.isLoading = false;
         }
      };
   }]).
   controller('contactsCtl', ['$scope', '$location', 'config', function(scope, location, config) {
      scope.email = config.info_mail + "@" + config.domain;
      scope.phone = config.phone;

      scope.getAnchor = function () {
         console.log('Anchor is ' + location.path());
         return location.hash();
      }
   }]);