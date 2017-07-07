<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.17/angular.min.js"></script>
    <script src="{{ asset('/js/controller.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('/js/semantic.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/semantic.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/style.css') }}" />
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/facebook/facebook.css') }}">
    <title>Simulation</title>
</head>

<body ng-app="myApp" ng-controller="ListController" ng-init="loadProfile()">

    <div class="ui inverted menu">
        <a class="active item">模擬器</a>
        <a class="item" click="login()">fb 登入</a>
        <a class="item">Friends</a>
    </div>

    <!-- Container -->
    <div class="ui container">

        @yield('content')

    </div>

</body>

</html>