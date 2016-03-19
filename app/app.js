'use strict';

var angular = require('angular');
//require('angular-route');

var app = angular.module('myApp', []);

//app.constant('VERSION', require('../../package.json').version);

require('./components/projects/modal/index');
require('./components/projects/taskBoard/index');



/*app.config(function($routeProvider) {

  $routeProvider.when('/todos', {
    templateUrl: 'components/login/login.php',
    controller: 'login',
  })
  .when('/imprint', {
    templateUrl: '../index.html',
    controller: 'index',
  })
  .otherwise({
    redirectTo: '../index.html',
  });
});*/
