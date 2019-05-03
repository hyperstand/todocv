app.controller('todoController', function($scope,$routeParams,listService,$http,$timeout,$rootScope) {
    //still developing

    $scope.isAvail=false;
    $scope.isload=true;
    $scope.data={
        title:'',
        size:0,
        content:[],
        task_value:''
    }

    //need to load lists first 
    var verify_code=$rootScope.lists.map(function(d) { return d['url_code'] }).indexOf($routeParams.id)
    


    //get todo Info

            $http({
                method: 'POST',
                url: `./lists/get/${$routeParams.id}`
            }).then((response)=>{

            let data=response.data.data[0]
            if(data.hide == 0){ 

                if(response.data.status){

                //display info if todo available
                $timeout(()=>{

                    $scope.data.title=data.name
                    $scope.data.content=data.task.map((entity)=>{
                        var json={}
                        json.task_code=entity.id
                        switch(entity.finish)
                        {
                            case 0:
                            json.task_stat=false
                            break;
                            case 1:
                            json.task_stat=true
                            break;
                        }
                        json.task_value= entity.value
                        json.update_task_name=(value,code,oldvalue)=>{
                            if(typeof(value) !='undefined' && value.length !== 0 && oldvalue !== value)
                            {
                                    $http({
                                        method: 'POST',
                                        url: `./task/rename/content/${$routeParams.id}`,
                                        data: {data:{value:value,content_id:code}}
                                    }).then(function successCallback(response) {
                                            var result=response.data;
                                            if(result.status)
                                            {   
                                                
                                            }
                                            
                                        }, function errorCallback(response) {
                                                
                                        });    
                            }else
                            {
                                if(value.length < 1)
                                {
                                   alert() 
                                }
                            }
                        }
                        json.checktoggletask=(stat,code)=>{

                          if(stat == true||stat ==false)  
                          {
                            $http({
                                method: 'POST',
                                url: `./task/hideopen/content/${$routeParams.id}`,
                                data: {data:{status:!stat,content_id:code}}
                            }).then(function successCallback(response) {
                                    var result=response.data;
                                    if(result.status)
                                    {   
                                        
                                    }
                                    
                                }, function errorCallback(response) {
                                        
                                });
                           }


                        }
                        json.deletetask=(code)=>{
                            $scope.data.content.forEach((entity,index)=>{
                                if(entity.task_code == code)
                                {
                                    $http({
                                        method: 'POST',
                                        url: `./task/delete/content/${$routeParams.id}`,
                                        data: {data:{content_id:code}}
                                    }).then(function successCallback(response) {
                                            var result=response.data;
                                            if(result.status)
                                            {   
                                                $scope.data.content.splice(index,1)  
                                                $rootScope.lists.forEach(element => {
                                                    if(element.url_code == $routeParams.id)
                                                    {
                                                        element.content_size--
                                                    }
                                                });
                                                $scope.data.size--
                                            }
                                            
                                        }, function errorCallback(response) {
                                                
                                        });
                                }
                            })
                        }
                        return json
                    })
                    
                    $scope.data.size=$scope.data.content.length;
                    $scope.isAvail=true
                    $scope.isload=false
                },0)

                
                }
                
            }

            },()=>{

                //display not available if todo not available
                $scope.isAvail=false
                $scope.isload=false
            });
   


    //Update Todo Title
    $scope.update=()=>{
        var value=$scope.data.title
       if(value.length != 0 && typeof(value) !== 'undefined'){
        $rootScope.lists.forEach((element,index) => {
            if(element.url_code==$routeParams.id)
            {
                found=index;
            }
        });

        
        if(found !== false){
            $http({
                method: 'POST',
                url: `./lists/rename/${$routeParams.id}`,
                data:{data:{name:value}}
            }).then(function successCallback(response) {
                    if(response.data.status == true)
                    {
                        $rootScope.lists.forEach(element => {
                            if(element.url_code == $routeParams.id)
                            {
                                element.title=value
                            }
                        });
                    }
                }, function errorCallback(response) {
                    
                });    
        }
      }
    }

    //Hide or open Todo Title
    $scope.hide=()=>{
        
       if(1==0)
       {

       }else
       {
           alert('you must be login to hide this')
       } 
    };

    //Delete todo title
    $scope.delete=()=>{
        listService.remove($routeParams.id,listService);
    }

    //Insert New task to todo
    $scope.insert_content=()=>{
        var value=$scope.data.task_value;
        if(value.length != 0 && typeof(value) !== 'undefined')
        {   
            
            if(1== 1){
                // alert()
                $http({
                    method: 'POST',
                    url: `./task/add/content/${$routeParams.id}`,
                    data: {data:{value:value}}
                }).then(function successCallback(response) {
                        var result=response.data;
                        if(result.status)
                        {   
                            var json={}
                            json.task_code=result.task.id
                            switch(result.task.finish)
                            {
                                case 0:
                                json.task_stat=false
                                break;
                                case 1:
                                json.task_stat=true
                                break;
                            }
                            json.task_value= result.task.value
                            json.update_task_name=(value,code,oldvalue)=>{
                                if(typeof(value) !='undefined' && value.length !== 0 && oldvalue !== value)
                                {
                                        $http({
                                            method: 'POST',
                                            url: `./task/rename/content/${$routeParams.id}`,
                                            data: {data:{value:value,content_id:code}}
                                        }).then(function successCallback(response) {
                                                var result=response.data;
                                                if(result.status)
                                                {   
                                                    
                                                }
                                                
                                            }, function errorCallback(response) {
                                                    
                                            });    
                                }else
                                {
                                    if(value.length < 1)
                                    {
                                       alert() 
                                    }
                                }
                            }
                            json.checktoggletask=(stat,code)=>{
    
                              if(stat == true||stat ==false)  
                              {
                                $http({
                                    method: 'POST',
                                    url: `./task/hideopen/content/${$routeParams.id}`,
                                    data: {data:{status:!stat,content_id:code}}
                                }).then(function successCallback(response) {
                                        var result=response.data;
                                        if(result.status)
                                        {   
                                            
                                        }
                                        
                                    }, function errorCallback(response) {
                                            
                                    });
                               }
    
    
                            }
                            json.deletetask=(code)=>{
                                $scope.data.content.forEach((entity,index)=>{
                                    if(entity.task_code == code)
                                    {
                                        $http({
                                            method: 'POST',
                                            url: `./task/delete/content/${$routeParams.id}`,
                                            data: {data:{content_id:code}}
                                        }).then(function successCallback(response) {
                                                var result=response.data;
                                                if(result.status)
                                                {   
                                                    $scope.data.content.splice(index,1)  
                                                    $rootScope.lists.forEach(element => {
                                                        if(element.url_code == $routeParams.id)
                                                        {
                                                            element.content_size--
                                                        }
                                                    });
                                                    $scope.data.size--
                                                }
                                                
                                            }, function errorCallback(response) {
                                                    
                                            });
                                    }
                                })
                            }

                            $scope.data.content.push(json)
                            $scope.data.task_value=''
                            $scope.data.size++
                            $rootScope.lists.forEach(element => {
                                if(element.url_code == $routeParams.id)
                                {
                                    element.content_size++
                                }
                            });
                        }
                    }, function errorCallback(response) {
                            
                    });    
                }     

        }
    }
    
});

