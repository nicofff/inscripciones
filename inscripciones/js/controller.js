
var inscControllers = angular.module('inscControllers', []);

inscControllers.controller('nuevoCtrl', ['$scope', 'Inscriptos', 'Paises', 'Profesiones', 'Laboratorios', 'TiposDoc', function($scope,Inscriptos, Paises, Profesiones, Laboratorios, TiposDoc) {
        $scope.inscriptos = Inscriptos.query();
        $scope.paisesNac = Paises.query();
        $scope.paisesRes = Paises.query();
        $scope.profesiones = Profesiones.query();
        $scope.laboratorios = Laboratorios.query();
        $scope.tiposDoc = TiposDoc.query();
    }]);

inscControllers.controller('nuevoCtrl', ['$scope', 'Inscriptos', 'Paises', 'Profesiones', 'Laboratorios', 'TiposDoc', 'Provincias','NuevoSave', function($scope, Inscriptos, Paises, Profesiones, Laboratorios, TiposDoc, Provincias, NuevoSave) {
        $scope.inscriptos = Inscriptos.query();
        $scope.paisesNac = Paises.query();
        $scope.paisesRes = Paises.query();
        $scope.profesiones = Profesiones.query();
        $scope.laboratorios = Laboratorios.query();
        $scope.tiposDoc = TiposDoc.query();
        $scope.provincias = Provincias.query();
        $scope.nuevo = {};
        $scope.nuevo.tipoDoc = 1;
        $scope.nuevo.paisNac = 1;
        $scope.nuevo.profesion = 1;
        $scope.nuevo.paisRes = 1;
        $scope.nuevo.provincia = 1;
        $scope.nuevo.laboratorio = 1;
        
        $scope.checkPais = function (){
            if ($scope.nuevo.paisRes == 1){
                $scope.nuevo.provincia = 1;
            }else{
                $scope.nuevo.provincia = "";
            }
        };
        
        $scope.submitForm = function (){
            if ($scope.nuevo.paisRes == 1){
                for (i=1;i< $scope.provincias.length ; i++){
                    if ($scope.provincias[i].value == $scope.nuevo.provincia){
                        $scope.nuevo.provincia = $scope.provincias[i].label;
                        break;
                    }
                }
            }
            NuevoSave.save($scope.nuevo);
        };
    }]);

inscControllers.controller('adminCtrl', ['$scope', 'Inscriptos', function($scope, Inscriptos) {
        $scope.inscriptos = Inscriptos.query();

        $scope.borrarInsc = function(insc) {
            Inscriptos.borrar({id: insc.ID}, function (success) {
                $scope.inscriptos = Inscriptos.query();
        });};

    }]);

inscControllers.controller('editCtrl', ['$scope', '$location', 'Inscriptos', 'Paises', 'Profesiones', 'Laboratorios', 'TiposDoc', function($scope, $location, Inscriptos, Paises, Profesiones, Laboratorios, TiposDoc) {
        $scope.paisesNac = Paises.query();
        $scope.paisesRes = Paises.query();
        $scope.profesiones = Profesiones.query();
        $scope.laboratorios = Laboratorios.query();
        $scope.tiposDoc = TiposDoc.query();


    }]);