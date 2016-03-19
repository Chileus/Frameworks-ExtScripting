'use strict'

var app = require('angular').module('myApp');

var test = require('./controller/test')
var modalController = require('./controller/modalController');
//var modalDirective = require('./directive/modalDirective')

app.controller('modalController', ['$scope', '$http', modalController])
app.directive('modal', require ('./directive/modalDirective'))
