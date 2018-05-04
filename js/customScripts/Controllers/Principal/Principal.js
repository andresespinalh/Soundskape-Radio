'use strict'

angular.module('SoundskapeApp')

	.controller('PrincipalController', ['$scope','$location','$http', function($scope, $location, $http){
        $scope.viewlistageneros=true;
        $scope.viewcanciones=false;
        $http.get("php/dbcantidadgenero.php")
                     .then(function (response) {$scope.names = response.data.records;});        


        $scope.abrirgenero = function(id_genero,genero){
            $scope.viewlistageneros=false;
            $scope.viewcanciones=true;
            $scope.id_genero=id_genero;
            $scope.genero=genero;

            $http.post("php/dbobtenercanciones.php", {
                                        'id_genero':id_genero                                                                        
                        }).then(function successCallback(response) {  
                   
                    $scope.songs = response.data.records;                 
                 });

        }
        $scope.abrircanciones = function(){
            $scope.viewcanciones=false;
            $scope.viewlistageneros=true;
              

        }

        $scope.stopsong = function(){
            
           var sound = document.getElementById("audio");
            sound.pause();
            sound.currentTime = 0;
     /*       sound.src =""; 
            sound.load();*/
        }
        $scope.playsong = function(titulo,nombre_artistico,duracion,direccion){
            
           var sound = document.getElementById("audio");
           $scope.titulo=titulo;
           $scope.nombre_artistico=nombre_artistico;
           $scope.duracion=duracion;
           
            sound.play();
            sound.currentTime = 0;
        }
























        $(function () {
            //Widgets count
            $('.count-to').countTo();
        
            //Sales count to
            $('.sales-count-to').countTo({
                formatter: function (value, options) {
                    return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
                }
            });
        
            initRealTimeChart();
            initDonutChart();
            initSparkline();
        });
        
        var realtime = 'on';
        function initRealTimeChart() {
            //Real time ==========================================================================================
            var plot = $.plot('#real_time_chart', [getRandomData()], {
                series: {
                    shadowSize: 0,
                    color: 'rgb(0, 188, 212)'
                },
                grid: {
                    borderColor: '#f3f3f3',
                    borderWidth: 1,
                    tickColor: '#f3f3f3'
                },
                lines: {
                    fill: true
                },
                yaxis: {
                    min: 0,
                    max: 100
                },
                xaxis: {
                    min: 0,
                    max: 100
                }
            });
        
            function updateRealTime() {
                plot.setData([getRandomData()]);
                plot.draw();
        
                var timeout;
                if (realtime === 'on') {
                    timeout = setTimeout(updateRealTime, 320);
                } else {
                    clearTimeout(timeout);
                }
            }
        
            updateRealTime();
        
            $('#realtime').on('change', function () {
                realtime = this.checked ? 'on' : 'off';
                updateRealTime();
            });
            //====================================================================================================
        }
        
        function initSparkline() {
            $(".sparkline").each(function () {
                var $this = $(this);
                $this.sparkline('html', $this.data());
            });
        }
        
        function initDonutChart() {
            Morris.Donut({
                element: 'donut_chart',
                data: [{
                    label: 'Chrome',
                    value: 37
                }, {
                    label: 'Firefox',
                    value: 30
                }, {
                    label: 'Safari',
                    value: 18
                }, {
                    label: 'Opera',
                    value: 12
                },
                {
                    label: 'Other',
                    value: 3
                }],
                colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(96, 125, 139)'],
                formatter: function (y) {
                    return y + '%'
                }
            });
        }
        
        var data = [], totalPoints = 110;
        function getRandomData() {
            if (data.length > 0) data = data.slice(1);
        
            while (data.length < totalPoints) {
                var prev = data.length > 0 ? data[data.length - 1] : 50, y = prev + Math.random() * 10 - 5;
                if (y < 0) { y = 0; } else if (y > 100) { y = 100; }
        
                data.push(y);
            }
        
            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]]);
            }
        
            return res;
        }	 

	}]);
