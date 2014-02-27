/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 26.02.14.
 */
angular.module('sendMailMdl', ['service']).
   controller('contactFormCtrl', ['$rootScope', '$scope', 'SendMail', function($rootScope, $scope, SendMail) {
      $scope.mail = {
         isSent: false,
         error: null,
         response: null
      };
      $scope.mail.isSent = false;
      var mailSendHandler = function (response) {
         $scope.mail.isSent = true;
         $scope.mail.error = response.error;
         $scope.mail.response = response.message;
         $rootScope.isLoading = false;
      }
      $scope.sendMail = function() {
         $rootScope.isLoading = true;
         $scope.mail.error = null;
         $scope.mail.response = null;
         SendMail.save($scope.mail, mailSendHandler, function (response) {
            response.error = 'Ошибка отправки сообщения!';
            mailSendHandler(response);
         });
      };


   }]);