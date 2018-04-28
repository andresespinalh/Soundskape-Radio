'use strict'

angular.module('SoundskapeApp')
	
	.controller('RegistrarseController', ['$scope','$location','$http', function($scope, $location, $http){
	 				              

			$scope.insertuser=function(){
				

				if(($scope.password==$scope.confirm)&&$scope.terms){
					 	$http.post("php/dbinsertarusuario.php", {
		                                'namesurname':$scope.namesurname,
		                                'email':$scope.email,
		                                'password':$scope.password		                                	                                
		                }).then(function successCallback(response) {  
		           
						console.log('Send data sucessfully');		              

		         
		         });
		          }else{ if(!$scope.terms){$scope.messageconfirm='Verificar terminos y condiciones';}else{$scope.messageconfirm='Confirmar Contraseña';}}
          }
	}]);
