<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body ng-app="myApp" ng-controller="mainController">
    <div class="side_nav">
        
        {{-- head --}}
        
        <section ng-show="loggedin() == true">
            <h1>Show</h1>
        </section>

        <section ng-show="loggedin() == false">
            <button ng-click="goto('register')">sign up</button>
            <button ng-click="goto('login')">login</button>
        </section>


         {{-- head --}}


         {{-- list --}}
         <ul class="list_body">
             <li class="list create_new">
                 <a ng-click="createtodo()">+ New List</a>
             </li>
             <span ng-repeat="data in lists">
             <li class="list">
                    <a>[[data]]</a>
             </li>
            </span>
         </ul>
         {{-- list --}}




    </div>
    
    <div class="main_box" ui-view>
    </div>

</body>

<script src="js/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.22/angular-ui-router.js"></script>
<script src="js/app.js"></script>

</html>
