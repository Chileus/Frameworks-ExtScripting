<!DOCTYPE html>
<html>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<header>
		<h1><?php
			session_start();
			echo $_SESSION['userId'];
		?></h1>
	</header>
	<body>
		<div class="container">
		<div ng-app="myApp" ng-controller="myCtrl">
			<button ng-click="count = count + 1">Click Me!</button>
			<div>{{count}}</div>
			<ul>
				 <li ng-repeat="data in dataArray">
				  <a href="#">{{data.Username}}</a>
				   <a href="#">{{data.Password}}</a>
				</li>
			</ul>
			<buttontest></buttontest>
			<div id="page">
			</div>
			<button>Hallo</button>
			<div svg></div>
		</div>

			<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
			  Add Project
			</button>
			<p id="message">test</p>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
			      </div>
			      <div class="modal-body">
			        <form role="form" method="post">
						  <div class="form-group">
						    <label for="projectname">Project Name:</label>
						    <input type="projectname" class="form-control" id="projectname" name="projectname">
						  </div>
						  <button type="submit" class="btn btn-default">Submit</button>
						</form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
		<script>
		var app = angular.module('myApp', []);
			app.controller('myCtrl', function($scope) {
				$scope.count = 0;
			});

			app.directive("buttontest", function($compile){
			return {
				restrict: "E",
				template: "<button addbuttons>add Tasks</button>",
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

		app.controller('sign_up', function ($scope, $http) {
			/*
			* This method will be called on click event of button.
			* Here we will read the email and password value and call our PHP file.
			*/
			$scope.check_credentials = function () {

			document.getElementById("message").textContent = "";

			var request = $http({
			    method: "post",
			    url: window.location.href + "login.php",
			    data: {
			        email: $scope.email,
			        pass: $scope.password
			    },
			    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			});

			/* Check whether the HTTP Request is successful or not. */
			request.success(function (data) {
			    document.getElementById("message").textContent = "You have login successfully with email "+data;
			});
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
		<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(empty($_POST['projectname']))
			{
					return false;
			}

			require_once "db_connection.php";
			$projectname = trim($_POST['projectname']);

			$db_conn = getDBInfo('project');
			$db_conn->insert($projectname,$_SESSION['userId']);

			}
		 ?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
