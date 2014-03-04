/*jslint node: true */
"use strict";
/**
 * Created by Orintas on 26.02.14.
 */
angular.module('sendMailMdl', ['service']).
   controller('contactFormCtrl', ['$scope', 'SendMail', 'Loading', function($scope, SendMail, Loading) {
      $scope.mailForm = {
         isSent: false,
         error: null,
         response: null
      };
      var mailSendHandler = function (response) {
         $scope.mailForm.isSent = true;
         $scope.mailForm.error = response.error;
         $scope.mailForm.response = response.message;
         Loading.pop('sendMail');
      }
      $scope.sendMail = function() {
         Loading.push('sendMail');
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

      $scope.nextMessage = function() {
         $scope.mailForm.isSent = false;
         $scope.mailForm.error = null;
         $scope.mailForm.response = null;
         $scope.mailForm.text = null;
      };


   }]);