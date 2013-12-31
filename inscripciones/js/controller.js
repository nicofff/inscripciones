
var inscControllers = angular.module('inscControllers', [])

inscControllers.controller('inscriptosCtrl', ['$scope','Inscriptos' ,function ($scope, Inscriptos) {
  $scope.inscriptos = Inscriptos.query();
}]);