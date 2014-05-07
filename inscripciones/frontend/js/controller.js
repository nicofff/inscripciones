
var inscControllers = angular.module('inscControllers', []);


inscControllers.controller('nuevoCtrl', ['$scope','$window', 'Paises', 'Profesiones', 'Laboratorios', 'TiposDoc', 'Provincias', 'Categorias', 'NuevoSave', function($scope, $window, Paises, Profesiones, Laboratorios, TiposDoc, Provincias, Categorias, NuevoSave) {
        $scope.paisesNac = Paises.query();
        $scope.paisesRes = Paises.query();
        $scope.profesiones = Profesiones.query();
        $scope.laboratorios = Laboratorios.query();
        $scope.tiposDoc = TiposDoc.query();
        $scope.provincias = Provincias.query();
        $scope.categorias = Categorias.query();
        $scope.showErrors=0;
        $scope.nuevo = {};
        $scope.nuevo.tipoDoc = 1;
        $scope.nuevo.paisNac = 1;
        $scope.nuevo.profesion = 1;
        $scope.nuevo.paisRes = 1;
        $scope.nuevo.provincia = 1;
        $scope.nuevo.laboratorio = 0;
        $scope.nuevo.rol = 3;
        
        $scope.checkPais = function (){
            if ($scope.nuevo.paisRes == 1){
                $scope.nuevo.provincia = 1;
            }else{
                $scope.nuevo.provincia = "";
            }
        };
        
        $scope.submitForm = function (){
            if ($scope.nuevoInsc.$invalid || !$scope.nuevo.categoria){
                $scope.showErrors=1;
                return false;
            }
            
            if($scope.nuevo.categoria == 1 && $scope.nuevo.laboratorio == 0){
                $scope.showErrors=1;
                return false;
            }
            
            if($scope.nuevo.categoria == 2){
                $scope.nuevo.categoria = $scope.nuevo.rol;
            }
            
            
            if ($scope.nuevo.paisRes == 1){
                for (i=1;i< $scope.provincias.length ; i++){
                    if ($scope.provincias[i].value == $scope.nuevo.provincia){
                        $scope.nuevo.provincia = $scope.provincias[i].label;
                        break;
                    }
                }
            }
            NuevoSave.save($scope.nuevo, function (data){
                if (data.success){
                    $window.location.href = data.redirect;
                }
            });
        };
    }]);