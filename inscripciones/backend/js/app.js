'use strict';
var inscApp = angular.module('inscApp', [
    'ngRoute',
    'inscControllers',
    'inscServices']);

inscApp.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
                when('/',{
                    templateUrl: 'list.html',
                    controller: 'adminCtrl'
                }).
                when('/editar/:inscId', {
                    templateUrl: 'editar.html',
                    controller: 'editCtrl'
                }).
                otherwise({
                    redirectTo: '/'
                });
    }]);