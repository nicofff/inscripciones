'use strict';
var inscApp = angular.module('inscApp', [
  'ngRoute',
  'inscControllers',
  'inscServices'
]);

inscApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/borrar/:phoneId', {
        templateUrl: 'partials/borrar.html',
        controller: 'PhoneListCtrl'
      }).
      when('/editar/:phoneId', {
        templateUrl: 'partials/editar.html',
        controller: 'PhoneDetailCtrl'
      }).
      otherwise({
        redirectTo: '/phones'
      });
  }]);