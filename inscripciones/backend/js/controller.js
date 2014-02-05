
var inscControllers = angular.module('inscControllers', []);

inscControllers.controller('adminCtrl', ['$scope','$filter', 'Inscriptos','ToCSV','Provincias', function($scope, $filter,Inscriptos,ToCSV, Provincias) {
        $scope.provincias = Provincias.query();
        $scope.inscriptos = Inscriptos.query({},function (InscriptosArray){
            for (i=0;i<InscriptosArray.length;i++){
                if (InscriptosArray[i].PaisRes=="Argentina"){
                    provincias = $filter('filter')($scope.provincias, {value:InscriptosArray[i].Provincia});
                    InscriptosArray[i].Provincia=provincias[0].label;
                }
            }
        });

        $scope.borrarInsc = function(insc) {
            var conf = confirm("Seguro que queres borrar?");
            if(!conf){
                return;
            }
            Inscriptos.borrar({id: insc.ID}, function (success) {
                $scope.inscriptos = Inscriptos.query();
        });};
        
        $scope.exportar = function (){
            data= $filter('filter')($scope.inscriptos, $scope.search);
            ToCSV.save(data, function(response){
                var iframe = document.createElement("iframe");
                iframe.setAttribute("src", response.url);
                iframe.setAttribute("style", "display: none");
                document.body.appendChild(iframe);
            });
        };

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
                    $scope.inscripto.esBecado = 1;
                }else {
                    $scope.inscripto.esBecado = 0;

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