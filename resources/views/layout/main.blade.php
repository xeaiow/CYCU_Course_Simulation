<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.17/angular.min.js"></script>
    <script src="{{ asset('/js/controller.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('/js/semantic.min.js') }}"></script>
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/js/toastr.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
    <script src="{{ asset('js/html2canvas.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/semantic.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/facebook/facebook.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/toastr.min.css') }}">
    <title>Simulation</title>
</head>

<body ng-app="myApp" ng-controller="ListController">

    <div class="ui sidebar inverted vertical menu">
    
        @if ( $profile['username'] != null )

        <div class="item">
            <img class="ui tiny image centered" src="{{ $profile['photo'] }}">
        </div>
        <a class="item" href="{{ url('/my') }}">個人資料</a>
        <a class="item" href="{{ url('/mycourse') }}">我的課表</a>
        <a class="item">找工作</a>
        <a class="item">找物品</a>
        <a class="item">找房子</a>

        <div class="right menu">
            <a class="item"><button class="ui fluid grey button" ng-click="logout()">登出</button></a>
        </div>

        @else

        <div class="item">
            <button class="ui fluid facebook button" ng-click="loadProfile()"><i class="facebook icon"></i>快速登入</button>
        </div>

        @endif
    </div>

    <div class="pusher">

        <div class="ui inverted menu">
            <a class="item" href="{{ url('/') }}">模擬中原</a>
            <a class="item" ng-click="openSidebar()"><i class="icon sidebar"></i></a>
        </div>

        <!-- Container -->
        <div class="ui container">

            @yield('content')

        </div>
        <!-- Site content !-->
    </div>

    <script src="https://www.gstatic.com/firebasejs/4.1.3/firebase.js"></script>
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyBzSbVjSh0HcmjeOlIjCgUHy2hCNwn9QNo",
            authDomain: "simulation-7b9ca.firebaseapp.com",
            databaseURL: "https://simulation-7b9ca.firebaseio.com",
            projectId: "simulation-7b9ca",
            storageBucket: "simulation-7b9ca.appspot.com",
            messagingSenderId: "754253323975"
        };
        firebase.initializeApp(config);

        $('.activating.element').popup();
        $('.menu .item').tab();
        $('.ui.accordion').accordion();
        $('.ui.dropdown').dropdown();

        $(function() {
            FastClick.attach(document.body);
        });
         
    </script>

</body>

</html>