'use strict'

// Alles dat geregeld moet worden voor het bord

var app = require('angular').module('myApp');

app.directive('board', require('./taskBoard'))
app.service('SharedDataService', ['$http', '$q', 'projectService', require('./projectFactory')]);
app.controller('boardController', ['$scope', '$http' ,'SharedDataService','memberservice','dragulaService','projectService', require('./boardController')])
