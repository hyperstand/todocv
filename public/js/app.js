
var app = angular.module('myApp', ["ngRoute"],function($interpolateProvider) {
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

    this.get_first=()=>{
        var url='/lists/'
        $http({
            method: 'POST',
            url: './lists/getfirst'
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
        var json={}

        $http({
            method: 'POST',
            url: './lists/create'
        }).then(function successCallback(response) {
            json.title=name
            json.code=makeid(10)
            this.content.push(new this.list(json,array))
            }, function errorCallback(response) {

            });

        
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

// app.constant("CSRF_TOKEN", '{{ csrf_token()}}'); 

//Main Controller
app.controller('mainController',($scope,$rootScope,listService)=>{

    //Get all List
    listService.initialize();

    //create new Class to Store Todo
    $scope.lists=listService.getall();




    //Adding new todo object
    $scope.createtodo=()=>{
        listService.set('list',new Array())
    }

});

