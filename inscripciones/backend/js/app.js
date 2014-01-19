'use strict';
var inscApp = angular.module('inscApp', [
    'ngRoute',
    'inscControllers',
    'inscServices']);

inscApp.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
                when('/editar/:inscId', {
                    templateUrl: 'partials/editar.html',
                    controller: 'editCtrl'
                }).
                otherwise({
                    redirectTo: '/'
                });
    }]);