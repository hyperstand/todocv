<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/app.css">
</head>

<body ng-app="myApp">


        <div class="side_nav" ng-controller="mainController">
                {{-- head --}}        
                @guest
                    <a href="register">sign up</a>
                    <a href="login">login</a>
                @endguest
        
                @auth
                 <h1>Show</h1>
                @endauth
                
        
                 {{-- head --}}
        
        
                 {{-- list --}}
                 <ul class="list_body">
                     <li class="list create_new">
                         <a ng-click="createtodo()">+ New List</a>
                     </li>
                     <span ng-repeat="data in lists">
                        <li class="list">
                                <a ng-href="lists/[[data.url]]">[[data.name]]</a>
                                <p>[[data.contentsize]]</p>
                        </li>
                    </span>
                 </ul>
                 {{-- list --}}
        </div>


    @yield('display')    
</body>



<script src="js/angular.min.js"></script>
<script src="js/app.js"></script>
@yield('javascript')