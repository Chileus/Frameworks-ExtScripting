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
		</div>
		<script>
		var app = angular.module('myApp', []);
		app.controller('myCtrl', function($scope) {
			$scope.count = 0;
		});

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
