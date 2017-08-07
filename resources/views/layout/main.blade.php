<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="CYCU Simulation">
    <meta name="article:author" content="CYCU Simulation">
    <meta name="og:description" content="每學期選課前，總是要手動列出欲選課清單，但往往沒想像中順利，得預備許多課表組合，因此誕生了此系統，希望能幫助到大家。" />
    <meta property="og:title" content="模擬中原 - CYCU Simulation"/>
    <meta property="og:type" content="模擬選課"/>
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:image" content="//i.imgur.com/QEobY1P.png"/>
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="630">
    <meta property="og:image:height" content="760">
    <meta property="og:image:secure_url" content="https://i.imgur.com/QEobY1P.png" />
    <title>@yield('pageTitle') - CYCU Simulation</title>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.17/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.js"></script>
    <script src="{{ asset('/js/controller.js') }}"></script>
    <script src="{{ asset('/js/mask.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/semantic.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/facebook/facebook.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/toastr.min.css') }}">
</head>

<body ng-app="myApp" ng-controller="ListController"  ng-cloak>

    <div class="ui sidebar inverted vertical menu">
    
        @if ( $profile['username'] != null )

        <div class="item">
            <img class="ui tiny image centered" src="{{ $profile['photo'] }}">
        </div>
        <a class="item" href="{{ url('/my') }}">個人資料</a>
        <a class="item" href="{{ url('/mycourse') }}">我的課表</a>
        <a class="item">找工作</a>
        <a class="item">找物品</a>
        <a class="item" href="{{ url('house') }}">找屋子</a>
        <a class="item" href="//fb.me/cycusimulation">Fans</a>
        <a class="item" href="//m.me/cycusimulation">feedback</a>

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

        <div class="ui inverted menu simulation-theme simulation-menu fixed">
            <a class="item" href="{{ url('/start') }}">模擬中原</a>
            <a class="item" ng-click="openSidebar()"><i class="icon sidebar"></i></a>
        </div>

        <!-- Container -->
        <div class="ui container margin-60">

            @yield('content')

        </div>
        <!-- Site content !-->
    </div>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-103170316-1', 'auto');
        ga('send', 'pageview');
    </script>
    <script src="https://www.gstatic.com/firebasejs/4.2.0/firebase.js"></script>
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