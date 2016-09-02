var app = angular.module('myApp', []);

app.controller("Conpermisos", function($scope,$http){
	

   $http.post('usuarios_no_admin_json', {}).
	  	success(function(data, status, headers, config) {
	    	$scope.usuarios = data;
	  	}).error(function(data, status, headers, config) {
	    	alert("Upss Error Cargando lista de usuarios");
	  	});


}); 