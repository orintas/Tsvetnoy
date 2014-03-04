/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 13.02.14.
 */
angular.module('app', ['catalogMdl', 'sendMailMdl']).
   constant('config', {
      phone: "+7 (920) 685 89 33",
      info_mail: "info",
      domain: "protsvetnoy.com"
   }).
   service('Loading', ['$rootScope', function($rootScope) {
      this.loading = [];
      this.pushLoad = function(id) {
         this.loading.push(id);
         console.log('Загрузка ' + id + '(' + this.loading.length + ')');
         $rootScope.isLoading = true;
      };
      this.popLoad = function(id) {
         this.loading.splice(this.loading.indexOf(id), 1);
         console.log('Загрузка ' + id + ' завершена');
         if (this.loading.length == 0) {
            $rootScope.isLoading = false;
         }
      };
   }]).
   controller('contactsCtl', ['$scope', 'config', function(scope, config) {
      scope.email = config.info_mail + "@" + config.domain;
      scope.phone = config.phone;
   }]);