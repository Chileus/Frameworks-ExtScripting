'use strict'

// Hier koppel ik alle member benodigheden aan de app

require('angular').module('myApp')

.service('memberservice', ['$http', '$q', require ('./membersService')])
.controller('membersController', ['$scope', '$http' ,'SharedDataService','memberservice','projectService', require ('./membersController')])
.directive('memberlist', require ('./membersDirective'))
