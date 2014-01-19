
var inscControllers = angular.module('inscControllers', []);

inscControllers.controller('nuevoCtrl', ['$scope', 'Inscriptos', 'Paises', 'Profesiones', 'Laboratorios', 'TiposDoc', function($scope,Inscriptos, Paises, Profesiones, Laboratorios, TiposDoc) {
        $scope.inscriptos = Inscriptos.query();
        $scope.paisesNac = Paises.query();
        $scope.paisesRes = Paises.query();
        $scope.profesiones = Profesiones.query();
        $scope.laboratorios = Laboratorios.query();
        $scope.tiposDoc = TiposDoc.query();
    }]);

inscControllers.controller('nuevoCtrl', ['$scope', 'Inscriptos', 'Paises', 'Profesiones', 'Laboratorios', 'TiposDoc', function($scope, Inscriptos, Paises, Profesiones, Laboratorios, TiposDoc) {
        $scope.inscriptos = Inscriptos.query();
        $scope.paisesNac = Paises.query();
        $scope.paisesRes = Paises.query();
        $scope.profesiones = Profesiones.query();
        $scope.laboratorios = Laboratorios.query();
        $scope.tiposDoc = TiposDoc.query();

    }]);

inscControllers.controller('adminCtrl', ['$scope', 'Inscriptos', function($scope, Inscriptos) {
        $scope.inscriptos = Inscriptos.query();

        $scope.borrarInsc = function(insc) {
            Inscriptos.borrar({id: insc.ID}, function (success) {
                $scope.inscriptos = Inscriptos.query();
        })};

    }]);

inscControllers.controller('editCtrl', ['$scope', '$location', 'Inscriptos', 'Paises', 'Profesiones', 'Laboratorios', 'TiposDoc', function($scope, $location, Inscriptos, Paises, Profesiones, Laboratorios, TiposDoc) {
        $scope.paisesNac = Paises.query();
        $scope.paisesRes = Paises.query();
        $scope.profesiones = Profesiones.query();
        $scope.laboratorios = Laboratorios.query();
        $scope.tiposDoc = TiposDoc.query();


    }]);