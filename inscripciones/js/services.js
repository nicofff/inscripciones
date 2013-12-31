var inscServices = angular.module('inscServices', ['ngResource']);
 
inscServices.factory('Inscriptos', ['$resource',
  function($resource){
    return $resource('rest/inscriptos.php', {}, {
      query: {method:'GET', params:{inscriptoID:'ID'}, isArray:true}
    });
  }]);