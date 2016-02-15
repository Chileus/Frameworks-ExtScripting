<!DOCTYPE html>
<html>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<header>
		<h1><?php
			session_start();
			echo $_SESSION['username'];
		?></h1>
	</header>
	<body>
		<div ng-app="myApp" ng-controller="myCtrl">
			<button ng-click="count = count + 1">Click Me!</button>
			<div>{{count}}</div>
			<ul>
				 <li ng-repeat="data in dataArray">
				  <a href="#">{{data.UserName}}</a>
				   <a href="#">{{data.UserPass}}</a>
				</li>
			</ul>
			<buttontest></buttontest>
			<div id="page">
				test
			</div>
			<div svg></div>
		</div>
		<script>
		var app = angular.module('myApp', []);
		app.controller('myCtrl', function($scope) {
			$scope.count = 0;
		});

		app.directive("buttontest", function($compile){
			return {
				restrict: "E",
				template: "<button addbuttons>Click to add buttons</button>",
				link: function(scope, element, attrs){
					var html = `<div>Test02</div>`,
					compiledElement = $compile(html)(scope);

					element.on('click', function(event){
							var pageElement = angular.element(document.getElementById("page"));
							pageElement.empty();
							pageElement.append(compiledElement);

							/*var svg = angular.element('<p> test</p>');
							element.append(svg)*/

					})
				}
			}
		});

		app.directive("svg",function(){
			return{
				link: function(scope,element,attrs){
					var svg = angular.element('<p> test</p>');
					element.append(svg)
				}
			}
		})



		app.controller('myCtrl', function($scope, $http) {
			$scope.dataArray = [];
			$http.get("data.php")
			.success(function (data) {
				for (var i=0;i<data.length;i++){
					$scope.dataArray.push(data[i]);
					console.log($scope.dataArray[i]);
				}
			})
			.error(function(data){
				 console.log(data);
			 });

		});

		</script>
	</body>
</html>
