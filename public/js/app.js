
var app = angular.module('myApp', ['ui.router'],function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.config(($stateProvider)=>{
    $stateProvider
    .state('list', {
        url: '/lists/:listcode',
        name:'lists',
        controller: function($scope, $stateParams) {
            // get the id
            var self=this; 
            self.code = $stateParams.listcode;
        }
    })
    .state('login', {
        url: '/login',
        name:'login',
        controller: function($scope) {

        },
        templateUrl:'./template/login.template.html'
    })
    .state('register', {
        url: '/register',
        name:'register',
        controller: function($scope) {

        },
        templateUrl:'./template/register.template.html'
    })
    .state('forgetpass', {
        url: '/reset',
        name:'reset',
        controller: function($scope) {

        },
        templateUrl:'./template/reset.template.html'
    });
})

//Main Controller
app.controller('mainController',( $scope, $window, $state)=>{

    // $scope.tabs = ['tab1', 'tab2', 'tab3', 'tab4'];
    // // 

    $scope.lists=['qwd'];


    //direct to page
    $scope.goto=(r)=>{
        // alert(r);
        $state.go(r);
    }

    //check if logged in
    $scope.loggedin=()=>{
        var log_stat=true;
        return log_stat;
    };

    //Adding new todo object
    $scope.createtodo=()=>{

    }



});

