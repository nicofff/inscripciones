
var inscControllers = angular.module('inscControllers', []);

inscControllers.controller('adminCtrl', ['$scope', 'Inscriptos', function($scope, Inscriptos) {
        $scope.inscriptos = Inscriptos.query();

        $scope.borrarInsc = function(insc) {
            Inscriptos.borrar({id: insc.ID}, function (success) {
                $scope.inscriptos = Inscriptos.query();
        });};

    }]);

inscControllers.controller('editCtrl', ['$scope','$location', '$routeParams', 'Inscriptos', 'Paises', 'Profesiones', 'Laboratorios', 'TiposDoc', 'Provincias','EditSave', function($scope, $location, $routeParams, Inscriptos, Paises, Profesiones, Laboratorios, TiposDoc, Provincias, EditSave) {
        $scope.paisesNac = Paises.query();
        $scope.paisesRes = Paises.query();
        $scope.profesiones = Profesiones.query();
        $scope.laboratorios = Laboratorios.query();
        $scope.tiposDoc = TiposDoc.query();
        $scope.provincias = Provincias.query();
        $scope.inscripto = Inscriptos.get({id:$routeParams.inscId},
            function(insc){
                if (insc.paisRes == 1){
                    for (i=0;i< $scope.provincias.length ; i++){
                        if ($scope.provincias[i].label == insc.provincia){
                            insc.provincia = $scope.provincias[i].value;
                            break;
                        }
                    }
                }
                if (insc.laboratorio!=0){
                    $scope.becadoCheck = 1;
                }else {
                    $scope.becadoCheck = 0;

                }
            }
        );

        
        $scope.checkPais = function (){
            if ($scope.inscripto.paisRes == 1){
                $scope.inscripto.provincia = 1;
            }else{
                $scope.inscripto.provincia = "";
            }
        };
        
        $scope.submitForm = function (){
            if ($scope.inscripto.paisRes == 1){
                for (i=1;i< $scope.provincias.length ; i++){
                    if ($scope.provincias[i].value == $scope.inscripto.provincia){
                        $scope.inscripto.provincia = $scope.provincias[i].label;
                        break;
                    }
                }
            }
            EditSave.save($scope.inscripto, function (data){
                if (data.success){
                    $location.path("/");
                }
            });
        };
    }]);