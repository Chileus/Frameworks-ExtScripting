'use strict'

var app = require('angular').module('myApp');
app.directive('board', require('./directive/taskBoard'))
