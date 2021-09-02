'use strict'

// alles nodig voor register

var app = require('angular').module('myApp');

app.controller('registerController', ['$scope', '$http','$window', '$location' , require ('./registerController')]);
