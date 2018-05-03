'use strict'

angular.module('SoundskapeApp')
	
	.controller('RegistrarseController', ['$scope','$location','$http', function($scope, $location, $http){
	 				              
				$http.get("php/dbobtenerciudad.php")
					 .then(function (response) {$scope.cities = response.data.records;});
				
				$scope.insertuser=function(){
				
				var pass = document.getElementById('pass');

				if(($scope.password==$scope.confirm)&&$scope.terms &&(pass.value.length>=6)){
					 	$http.post("php/dbinsertarusuario.php", {
		                                'namesurname':$scope.namesurname,
		                                'email':$scope.email,
		                                'password':$scope.password,
		                                'city' :$scope.city,
		                                'borndate':$scope.borndate,
		                                'firstname':$scope.firstname,
		                                'secondname':$scope.secondname,
		                                'firstlastname':$scope.firstlastname,
		                                'secondlastname':$scope.secondlastname		                                	                                
		                }).then(function successCallback(response) {  
		           			
						console.log('Send data sucessfully');		              
						$location.url('#/Principal');
		         
		         });
		          }else{ if(!$scope.terms){$scope.messageconfirm='Verificar terminos y condiciones';}else{$scope.messageconfirm='Confirmar Contraseña';}}
          }
          
				

          
	}]);
