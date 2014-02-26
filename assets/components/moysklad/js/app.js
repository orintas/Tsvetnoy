/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 13.02.14.
 */
angular.module('app', ['catalogMdl']).
   constant('config', {
      phone: "+7 (920) 685 89 33",
      info_mail: "info",
      domain: "protsvetnoy.com"
   }).
   controller('contactsCtl', ['$scope', 'config', function(scope, config) {
      scope.email = config.info_mail + "@" + config.domain;
      scope.phone = config.phone;
   }]).
   directive('ngBlur', function() {
      return function(scope, elem, attrs) {
         elem.bind('blur', function() {
            scope.$apply(attrs.ngBlur);
         });
      };
   });