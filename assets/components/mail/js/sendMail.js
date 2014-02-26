/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 26.02.14.
 */
angular.module('sendMailMdl', ['service']).
   controller('contactFormCtrl', ['$scope', 'SendMail', function($scope, SendMail) {
      $scope.sendMail = function() {
         console.log("Send mail");
         SendMail.save({data: 'testData'}, function (response) {
            $scope.sendMailResponse = response;
         }, function (response) {
            $scope.error = response;
         });
      }
   }]);