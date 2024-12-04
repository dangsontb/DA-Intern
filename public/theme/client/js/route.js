
var app = angular.module("asmApp", ["ngRoute"]);

app.config(function($routeProvider) {
    $routeProvider
    .when("/home", {
        templateUrl: "home.html",
        // controller: "homeCtrl"
    })
    .when("/login", {
        templateUrl: "views/login.html",
        // controller: "loginCtrl"
    })
    .when("/register", {
        templateUrl: "views/register.html",
        // controller: "registerCtrl"
    })
    .otherwise({
        redirectTo: ""
    });
});