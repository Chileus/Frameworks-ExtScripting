'use strict'

// verzorgt alle functionaliteiten van de modal en de projectlijst

var app = require('angular').module('myApp');

//var modalDirective = require('./directive/modalDirective')

app.service('projectService', ['$http', '$q', require('./projectService')]);
app.controller('projectController', ['$scope', '$http','SharedDataService','projectService', '$uibModal', '$log', require('./projectController')])
//app.directive('modal', require ('./modalDirective'))

app.controller('ModalInstanceCtrl', ['$scope', '$uibModalInstance', 'items', require('./ModalInstanceCtrl')]) 
