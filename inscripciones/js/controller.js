
var inscControllers = angular.module('inscControllers', []);

inscControllers.controller('inscriptosCtrl', ['$scope','Inscriptos' ,function ($scope, Inscriptos) {
  $scope.inscriptos = Inscriptos.query();
  $scope.borrarInsc = function (id){
      Inscriptos.borrar({id:id});
  };
}]);

inscControllers.controller('paisesCtrl', function ($scope) {
  var paises =[
    {'value':"1", "label": "Argentina"},
    {'value':"2", "label": "Armenia"},
    {'value':"3", "label": "Australia"},
    {'value':"4", "label": "Austria"},
    {'value':"7", "label": "Bélgica"},
    {'value':"5", "label": "Bolivia"},
    {'value':"6", "label": "Brasil"},
    {'value':"8", "label": "Canadá"},
    {'value':"12", "label": "Colombia"},
    {'value':"13", "label": "Costa Rica"},
    {'value':"14", "label": "Croacia"},
    {'value':"15", "label": "Cuba"},
    {'value':"9", "label": "Checoslovaquia"},
    {'value':"10", "label": "Chile"},
    {'value':"11", "label": "China"},
    {'value':"16", "label": "Dinamarca"},
    {'value':"17", "label": "Ecuador"},
    {'value':"18", "label": "El Salvador"},
    {'value':"19", "label": "España"},
    {'value':"20", "label": "Estados Unidos"},
    {'value':"21", "label": "Finlandia"},
    {'value':"22", "label": "Francia"},
    {'value':"23", "label": "Grecia"},
    {'value':"24", "label": "Guatemala"},
    {'value':"25", "label": "Haití"},
    {'value':"26", "label": "Holanda"},
    {'value':"27", "label": "Honduras"},
    {'value':"28", "label": "Hungría"},
    {'value':"29", "label": "Irlanda"},
    {'value':"30", "label": "Islandia"},
    {'value':"31", "label": "Israel"},
    {'value':"32", "label": "Italia"},
    {'value':"33", "label": "Jamaica"},
    {'value':"34", "label": "Japón"},
    {'value':"35", "label": "México"},
    {'value':"36", "label": "Nicaragua"},
    {'value':"37", "label": "Noruega"},
    {'value':"38", "label": "Nueva Zelandia"},
    {'value':"39", "label": "Pakistán"},
    {'value':"40", "label": "Panamá"},
    {'value':"41", "label": "Paraguay"},
    {'value':"42", "label": "Perú"},
    {'value':"43", "label": "Polonia"},
    {'value':"44", "label": "Portugal"},
    {'value':"45", "label": "Puerto Rico"},
    {'value':"46", "label": "Reino Unido"},
    {'value':"47", "label": "República Checa"},
    {'value':"48", "label": "República Dominicana"},
    {'value':"49", "label": "Rumania"},
    {'value':"50", "label": "Rusia"},
    {'value':"51", "label": "Siria"},
    {'value':"52", "label": "Suecia"},
    {'value':"53", "label": "Suiza"},
    {'value':"54", "label": "Taiwan"},
    {'value':"55", "label": "Ucrania"},
    {'value':"56", "label": "Uruguay"},
    {'value':"57", "label": "Venezuela"},
    {'value':"58", "label": "Yugoslavia"}
  ];
    
  $scope.paisesNac = paises;
  $scope.paisesRes = paises;
});

inscControllers.controller('profesionesCtrl', ['$scope','Profesiones' ,function ($scope, Profesiones) {
  $scope.profesiones = [
    {'value':"1", "label": "Médico"},
    {'value':"2", "label": "Bioquímico"},
    {'value':"3", "label": "Educador Terciario"},
    {'value':"4", "label": "Asistente Social"},
    {'value':"5", "label": "Psicólogo"},
    {'value':"6", "label": "Dietista"},
    {'value':"7", "label": "Sociólogo"},
    {'value':"8", "label": "Nutricionista"},
    {'value':"9", "label": "Asistente de endoscopía"}
  ]

}]);

inscControllers.controller('laboratoriosCtrl', ['$scope','Laboratorios' ,function ($scope, Laboratorios) {
  $scope.laboratorios = [
    {'value':"1", "label": "Takeda"},
    {'value':"2", "label": "Roemmers"},
    {'value':"3", "label": "Sanitas"},
    {'value':"4", "label": "Casasco"},
    {'value':"5", "label": "Gador"},
    {'value':"6", "label": "Astrazéneca"},
    {'value':"7", "label": "Domínguez"},
    {'value':"8", "label": "Eurofarma"},
    {'value':"9", "label": "Sidus"},
    {'value':"10", "label": "Ivax"}
  ]
}]);