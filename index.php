<!DOCTYPE html>
<html>
	<head>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	</head>
	<body>
		<header>
			<h1>
				<?php
					session_start();
					echo $_SESSION['userId'];
				?>
			</h1>
		</header>
		<div class="container">
			<div ng-app="myApp" ng-controller="myCtrl">
				<ul>
					<li ng-repeat="data in dataArray">
						<button class="btn btn-default" ng-click="getBoard(data.ProjectID)">
					  	<a href="#">{{data.Name}}</a>
						</button>
					</li>
					<li>
						<button ng-click="toggleModal()" class="btn btn-default">Create Project</button>
					</li>
				</ul>
				<div class="container">
					<modal title="Login form" visible="showModal">
			    	<form role="form" method="post">
			      	<div class="form-group">
			      		<label for="email">Project Name</label>
			      		<input class="form-control" ng-model="projectName" id="email" placeholder="Enter project name" />
			      	</div>
			      	<button type="submit" ng-click="toggleModal(projectName)" class="btn btn-default">Submit</button>
			    	</form>
		  		</modal>
				</div>
			</div>
		</div>
		<script>

		var app = angular.module('myApp', [])

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
		<script src="modalTmp.js"></script>
	</body>
</html>
