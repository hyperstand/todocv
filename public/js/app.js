
//Dev
// Try Function alter class
// remove function
// return this content
// main.js remove


var app = angular.module('myApp', ["ngRoute"],function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});
// app.constant("CSRF_TOKEN", '{{ csrf_token()}}'); 
app.run(($rootScope)=>{
    $rootScope.lists=[];
});

app.config(function($routeProvider) {
    $routeProvider
    .when("/lists/:id", {
        templateUrl : "./template/todo.template.html",
        controller:'todoController'
      })
      .when("/login", {
        templateUrl : "./template/login.template.html",
        controller:'loginController'
      })
      .when("/register", {
        templateUrl : "./template/register.template.html",
        controller:'registerController'
      })
    .otherwise({
        resolve:{
            load:['listService','$location',function(listService,$location){
                listService.get_first($location)       
            }]
        }
    });
});
app.service('listService', function($http,$rootScope,$location) {

    //with function as template
    function list(data){
        this.title=data.title
        this.url_code=data.code
        this.content_size=data.content_size
    }
    

    this.initialize=()=>{


            $http({
                method: 'POST',
                url: './lists/get/all'
            }).then(function successCallback(response) {

              response.data.forEach((currentValue, index, arr)=>{

                var json={}
                json.title=currentValue.name
                json.code=currentValue.code
                json.content_size=currentValue.task_count

            
                var f=new list(json)
                // console.log(f)
                $rootScope.lists.push(f)

                // try {
                //     // New keyword to access constructor
                //     var bookConstructed = new this.list(json,currentValue.mytodo_count)
                //     console.log(bookConstructed)           
                // } catch (e) {
                //     if (e instanceof TypeError) {
                //         console.log(e, true);
                //     } else {
                //         console.log(e, false);
                //     }
                // }
                // this.content.push(new this.list(json,currentValue.mytodo_count))
              })
               
            }, function errorCallback(response) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
                
            });

            
    }

    //get first todo code if empty or deleted
    this.get_first=()=>{

    function get_from_server(){
        $http({
            method: 'POST',
            url: './lists/getfirst'
        }).then(function successCallback(response) {

            
            $location.path('/lists/'+response.data.data.code);

            }, function errorCallback(response) {

            });
    }

    get_from_server();

    // if(){
            
    // }

        
    }

    //create new todo
    this.set=(array)=>{

        $http({
            method: 'POST',
            url: './lists/create'
        }).then(function successCallback(response) {
            var json={}
            json.title=response.data.todo.name
            json.code=response.data.todo.code
            json.content_size=0

            //using function
            var c=new list(json)
            array.push(c)
            
            }, function errorCallback(response) {
                console.log(array)
        
            });
        }
    //remove a todo
    this.remove=(code,ownservice)=>{
        var found=false;

        $rootScope.lists.forEach((element,index) => {
                if(element.url_code==code)
                {
                    found=index;
                }
        });            

        
        if(found !== false){

        $http({
            method: 'POST',
            url: `./lists/delete/${code}`
        }).then(function successCallback(response) {

            $rootScope.lists.splice(found, 1)
            ownservice.get_first()
                
            }, function errorCallback(response) {
                
            });

        }else
        {
            ownservice.get_first()
        }
    }

    //update todo_name
    this.update_title=(todo_name,todo_id)=>{
        

    }

    //lock todo
    this.locktoggletodo=()=>
    {
         
        // $rootScope.lists.forEach((element,index) => {
        //     if(element.url_code==todo_id)
        //     {
        //         found=index;
        //     }
        // });

        // if(found !== false){
        //     $http({
        //         method: 'POST',
        //         url: `./lists/hideopen/${code}`
        //     }).then(function successCallback(response) {
                        
        //         }, function errorCallback(response) {
                        
        //         });    
        // }
    }

    


    //


});


//Login Controller
app.controller('loginController', function($scope,$http) {

    $scope.error={
        val:false,
        auth:false,
        syntax:false
    }
    $scope.data={
        email:'',
        password:''
    }

    $scope.login=()=>{
      $scope.error.val=false
      $scope.error.auth=false  
      $scope.error.syntax=false
      var email=$scope.data.email|| "A"
      var pass=$scope.data.password  
      var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      console.log(email,pass)

     if(pass.length == 0  || email.length ==0 )
     {
        $scope.error.val=true
     }else if(re.test(email) == false) 
     {
        $scope.error.syntax=true
     }else
     {
        $http({
            method: 'POST',
            url: `./lists/get/${$routeParams.id}`
        }).then((response)=>{
            
        },()=>{
            $scope.error.auth=true
        });
     }
    }
});

//Main Controller
app.controller('mainController',($scope,$rootScope,listService)=>{

    $scope.lists=$rootScope.lists

    //Get all List
    listService.initialize()

    // Adding new todo object
    $scope.createtodo=()=>{
        listService.set($scope.lists)
    }

});

