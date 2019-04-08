

app.config(function($routeProvider) {
    $routeProvider
    .when("/lists/:id", {
      templateUrl : "./template/todo.template.html",
      controller:'todoController'
    }) .otherwise({
        redirectTo:($routeParams,listService)=>{

            if(typeof $routeParams === 'undefined')
            {
                return listService.get_first()
            }          
        }
    });
});

app.controller('todoController', function($scope,$routeParams) {
    
    console.log($routeParams.id)
    $scope.isAvail=true;
    $scope.data={
        title:'',
        size:0
    }
    $scope.hide=()=>{

    };
    $scope.delete=()=>{

    }

    
});

