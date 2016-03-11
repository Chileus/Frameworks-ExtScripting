'use strict';

var app = require('angular').module('myApp');

app.controller('modalController', require('./controller/modalController'));
app.directive('modalDirective', require('./directive/modalDirective'));
