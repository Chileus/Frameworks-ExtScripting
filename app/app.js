'use strict';

// benodigde modules

var angular = require('angular');
require('angular-route');
var angularDragula = require('angular-dragula');
require('angular-ui-bootstrap' );

// Dit is waar de app word aangemaakt

var app = angular.module('myApp',[
  'ngRoute',
  angularDragula(angular),
  'ui.bootstrap'
]);

//require alles alle index bestanden

require('./components/projects/index');
require('./components/taskBoard/index');
require('./components/login/index');
require('./components/register/index');
require('./components/memberlist/index');

// routeProvider doet wat het doet Angular OP!!

app.config(function($routeProvider) {
  $routeProvider.when('/login', {
    templateUrl: 'app/components/login/login.html',
    controller: 'sign_up'
  })
  .when('/', {
    templateUrl: 'app/components//home.html'
  })
  .when('/register', {
    templateUrl: 'app/components/register/directive/register.html',
    controller: 'registerController'
  })
  .otherwise({
    redirectTo: 'app/components/login/login.html'
  })
});
