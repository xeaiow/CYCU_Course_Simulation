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
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/js/toastr.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/semantic.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/facebook/facebook.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/toastr.min.css') }}">
    <title>Simulation</title>
</head>

<body ng-app="myApp" ng-controller="ListController" ng-init="loadAddedCourse()">

    <div class="ui stackable inverted menu">

        @if ($profile['username'] != null)

            <div class="item">
                <img src="{{ $profile['photo'] }}">
            </div>
            <a class="item">{{ $profile['username'] }}</a>
            <a class="item"><i class="star icon"></i> <% selectCoursePhase.length %> / 22</a>
            <a class="item"><button class="ui fluid facebook button" ng-click="logout()">登出</button></a>
            <a class="item"><button class="ui fluid facebook button" onclick="window.location.href='{{ url('/import') }}'">匯入已修課程</button></a>
        @else

            <div class="item">
                <button class="ui fluid facebook button" ng-click="loadProfile()"><i class="facebook icon"></i>快速登入</button>
            </div>

        @endif
    </div>  

    <!-- Container -->
    <div class="ui container">

        @yield('content')

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
    </script>

</body>

</html>