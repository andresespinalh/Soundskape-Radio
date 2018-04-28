'use strict'

angular.module('SoundskapeApp')

	.controller('InicioSesionController', ['$scope','$location','$http', function($scope, $location, $http){
	 	
	 	$scope.IniciarUsuario = function(){
	 		
	 	$http.post("php/dbverificarusuario.php", {
		                                'namesurname':$scope.namesurname,
		                                'password':$scope.password		                                	                                
		                }).then(function successCallback(response) {  
		           
						console.log('Send data sucessfully');		              

		         
		         });
			
	 	}

	 }]);
