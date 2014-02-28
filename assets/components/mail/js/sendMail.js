/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 26.02.14.
 */
angular.module('sendMailMdl', ['service']).
   controller('contactFormCtrl', ['$rootScope', '$scope', 'SendMail', function($rootScope, $scope, SendMail) {
      $scope.mailForm = {
         isSent: false,
         error: null,
         response: null
      };
      var mailSendHandler = function (response) {
         $scope.mailForm.isSent = true;
         $scope.mailForm.error = response.error;
         $scope.mailForm.response = response.message;
         $rootScope.isLoading = false;
      }
      $scope.sendMail = function() {
         $rootScope.isLoading = true;
         $scope.mailForm.error = null;
         $scope.mailForm.response = null;
         SendMail.save($scope.mailForm, mailSendHandler, function (response) {
            response.mailForm.error = 'Ошибка отправки сообщения!';
            mailSendHandler(response);
         });
      };

      $scope.emailValidation = function() {
        if (!$scope.mailForm.email || $scope.mailForm.email.$invalid) {
           return ' has-error';
        }
         return '';
      };


   }]);