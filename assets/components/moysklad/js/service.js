/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 04.02.14.
 */
angular.module('service', ['ngResource']).
   value('server', {
      protocol: 'http',
      host: 'protsvetnoy.com/rest',
      getPath: function () {
         return this.protocol + '://' + this.host;
      }
   }).
   service('resourceFactory', ['$resource', 'server', function (resource, server) {
      this.create = function (localPath) {
         return resource(server.getPath() + '/' + localPath + '.js');
      };
   }]).
   factory('Goods', ['resourceFactory', function (resourceFactory) {
      return resourceFactory.create('goods');
   }]);