var inscServices = angular.module('inscServices', ['ngResource']);
 
inscServices.factory('Inscriptos', ['$resource',
  function($resource){
    return $resource('../rest/inscriptos.php', {}, {
      query: {method:'GET', isArray:true},
      get: {method:'GET'}
    });
  }]);
  
inscServices.factory('Paises', ['$resource',
  function($resource){
    return $resource('../json/paises.json', {}, {
      query: {method:'GET', isArray:true}
    });
  }]);
  
inscServices.factory('Profesiones', ['$resource',
  function($resource){
    return $resource('../json/profesiones.json', {}, {
      query: {method:'GET', isArray:true}
    });
  }]);
  
inscServices.factory('Laboratorios', ['$resource',
  function($resource){
    return $resource('../json/laboratorios.json', {}, {
      query: {method:'GET', isArray:true}
    });
  }]);
  
 inscServices.factory('TiposDoc', ['$resource',
  function($resource){
    return $resource('../json/tiposDoc.json', {}, {
      query: {method:'GET', isArray:true}
    });
  }]);
  
  inscServices.factory('Provincias', ['$resource',
  function($resource){
    return $resource('../json/provincias.json', {}, {
      query: {method:'GET', isArray:true}
    });
  }]);
  
  inscServices.factory('Categorias', ['$resource',
  function($resource){
    return $resource('../json/categorias.json', {}, {
      query: {method:'GET', isArray:true}
    });
  }]);
  
inscServices.factory('NuevoSave', ['$resource',
  function($resource){
    return $resource('save.php', {}, {
      save: {method:'POST'}
    });
  }]);