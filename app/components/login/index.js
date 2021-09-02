'use strict'

// alles dat nodig is voor login

var app = require('angular').module('myApp');

app.controller('sign_up', ['$scope', '$http','$window', '$location' , require ('./home')]);
