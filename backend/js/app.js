'use strict';
var inscApp = angular.module('inscApp', [
    'ngRoute',
    'inscControllers',
    'inscServices',
    'ngSanitize',
    'ngCsv']);

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