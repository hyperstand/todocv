
var app = angular.module('myApp', ['ui.router'],function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.service('listService', function($http) {

    this.list=class{
        constructor(data,v) {
            this.content=v;
            this.title = data.title
            this.url_code=data.code
        }

        get name()
        {
            return this.title
        }

        get url()
        {
            return this.url_code
        }
    
        get contentsize()
        {   
    
            return this.content.length
        }
        addto_list(a)
        {
            this.content.push(a)
        }
    }

        //list of todo
        this.content=new Array();
    

    this.initialize=()=>{
            $http({
                method: 'POST',
                url: './lists/all'
            }).then(function successCallback(response) {
                // this callback will be called asynchronously
                // when the response is available
                }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                });
    }


    //create new todo
    this.set=(name,array)=>{


        function makeid(length) {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
          
            for (var i = 0; i < length; i++)
              text += possible.charAt(Math.floor(Math.random() * possible.length));
          
            return text;
          }

        var json={}
        json.title=name
        json.code=makeid(10)
        this.content.push(new this.list(json,array))
        
    }
    // get all todo info
    this.getall=()=>{
        return this.content;
    }

    //single todo info
    this.getindividual=(code)=>
    {
          var found=false;
            this.content.forEach(element => {
                if(element.url==code)
                {
                    found=element
                }
            });
          return found
    }

    //remove a todo
    this.remove=(code)=>{
        var found=false;
        
        this.content.forEach((element,index) => {

            if(element.url==code)
            {
                found=index;
            }
        });
        this.content.splice(found, 1)
        return true
       
    }
});
app.run(($rootScope)=>{
    $rootScope.logstat=false;
})
// app.constant("CSRF_TOKEN", '{{ csrf_token()}}'); 
app.config(($stateProvider)=>{
    $stateProvider
    .state('list', {
        url: '/lists/:listcode',
        name:'lists',
        controller: function($scope, $stateParams,listService) {
            // get the id
            $scope.isAvail=false 
            $scope.todo=listService.getindividual($stateParams.listcode);
            if($scope.todo != false)
            {
                $scope.isAvail=true;
            }
            
            $scope.remove=(code)=>{
                listService.remove(code)
            }
            
            // $scope.todoname=listService.
        },
        templateUrl:'./template/todo.template.html'
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
app.controller('mainController',($scope,$rootScope,listService,$state)=>{

    //Get all List
    listService.initialize();

    //create new Class to Store Todo
    $scope.lists=listService.getall();

    //direct to page
    $scope.goto=(r)=>{
        $state.go(r);   
    }

    //check if logged in
    $scope.loggedin=()=>{
        return $rootScope.logstat;
    };

    //Adding new todo object
    $scope.createtodo=()=>{
        listService.set('list',new Array())
    }

});

