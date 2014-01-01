var inscServices = angular.module('inscServices', ['ngResource']);
 
inscServices.factory('Inscriptos', ['$resource',
  function($resource){
    return $resource('rest/inscriptos.php', {}, {
      query: {method:'GET', isArray:true},
      borrar: {method:'DELETE'} 
    });
  }]);
  
inscServices.factory('Paises', ['$resource',
  function($resource){
    return $resource('rest/paises.php', {}, {
      query: {method:'GET', isArray:true}
    });
  }]);
  
inscServices.factory('Profesiones', ['$resource',
  function($resource){
    return $resource('rest/profesiones.php', {}, {
      query: {method:'GET', isArray:true}
    });
  }]);
  
inscServices.factory('Laboratorios', ['$resource',
  function($resource){
    return $resource('rest/profesiones.php', {}, {
      query: {method:'GET', isArray:true}
    });
  }]);