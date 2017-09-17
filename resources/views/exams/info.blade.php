<!--
                       _oo0oo_
                      o8888888o
                      88" . "88
                      (| -_- |)
                      0\  =  /0
                    ___/`---'\___
                  .' \\|     |// '.
                 / \\|||  :  |||// \
                / _||||| -:- |||||- \
               |   | \\\  -  /// |   |
               | \_|  ''\---/''  |_/ |
               \  .-\__  '-'  ___/-. /
             ___'. .'  /--.--\  `. .'___
          ."" '<  `.___\_<|>_/___.' >' "".
         | | :  `- \`.;`\ _ /`;.`/ - ` : | |
         \  \ `_.   \_ __\ /__ _/   .-` /  /
     =====`-.____`.___ \_____/___.-`___.-'=====
                       `=---='


     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

               佛祖保佑         永無bug
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="CYCU Simulation">
    <meta name="description" content="{{ $profile['exams']['description'] }}" />
    <meta name="og:description" content="{{ $profile['exams']['description'] }}" />
    <meta property="og:title" content="{{ $profile['exams']['title'] }}"/>
    <meta property="og:site_name" content="{{ $profile['exams']['title'] }}"></meta>
    <meta property="og:type" content="考古題"/>
    <meta property="og:url" content="{{ Request::url() }}"/> 
    <meta property="og:image" content="https://i.imgur.com/LlYu678.png"/>
    <meta property="og:image:secure_url" content="https://i.imgur.com/LlYu678.png" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="630">
    <meta property="og:image:height" content="760">
    <meta property="al:android:app_name" content="模擬中原 CYCU Simulation">
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.17/angular.min.js"></script>
    <script src="{{ asset('/js/controller.js') }}"></script>
    <script src="{{ asset('/js/mask.min.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.js"></script>
    <script src="{{ asset('/js/sweetalert2.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/semantic.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/facebook/facebook.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/toastr.min.css') }}">
    <title>{{ ( $profile['exams']['title'] == null ? "考古題" : $profile['exams']['title'] ) }} - 模擬中原 CYCU Simulation</title>
</head>

<body ng-app="myApp" ng-controller="ListController" ng-cloak>

    <div class="ui sidebar inverted vertical menu">
    
        @if ( $profile['username'] != null )

        <div class="item">
            <img class="ui tiny image centered" src="{{ $profile['photo'] }}">
        </div>
        <a class="item" href="{{ url('/my') }}">個人資料</a>
        <a class="item" href="{{ url('/mycourse') }}">我的課表</a>
        <a class="item" href="{{ url('house') }}">租屋評價</a>
        <a class="item" href="{{ url('exams') }}">考古題</a>
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
    

    <div class="ui container">
        <div class="ui grid stackable">
            <div class="eight wide column">

                <!-- 考古題資訊 -->
                <div class="ui segment basic">
                    <h2 class="ui header">
                        <i class="bookmark icon"></i>
                        <div class="content">
                            {{ $profile['exams']['title'] }}
                        </div>
                    </h2>
                </div>

                <h4 class="ui horizontal divider header">
                <i class="write icon"></i>描述
                </h4>

                <!-- 描述 -->
                <div class="ui piled segment">
                    {{ $profile['exams']['description'] }}
                </div>

                <h4 class="ui horizontal divider header">
                <i class="disk outline icon"></i> {{ @count( $profile['exams']['filename'] ) }} 個檔案
                </h4>
                <!-- 取得檔案 -->
                <div class="ui piled segment">
                    <div class="ui stackable four column grid">
                    <?php $index=1 ?>
                    @foreach ( $profile['exams']['url'] as $item)
                        <div class="column">
                            <a target="_blank" href="https://drive.google.com/open?id={{ $item }}"><i class="icon big cloud download"></i> 檔案 {{ $index }}</a>
                            <?php $index++ ?>
                        </div>
                    @endforeach
                    </div>
                </div>

            </div>
            
            <!-- FB comment -->
            <div class="eight wide column">
                <div class="fb-comments" data-href="{{ url('/exams') }}/{{ $profile['exams']['_id'] }}" data-numposts="5"></div>
            </div>

        </div>
    </div>

    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.10&appId=452934435085965";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-103170316-1', 'auto');
        ga('send', 'pageview');
    </script>

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

        $(function() {
            FastClick.attach(document.body);
            console.log("%c(ㆆᴗㆆ) 看一次 5,000 元", "color:#FF0000;font-size:25px;");
        });
    </script>

</body>
</html>