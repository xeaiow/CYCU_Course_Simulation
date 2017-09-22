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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="CYCU Simulation">
    <meta name="og:description" content="每學期選課前，總是要手動列出欲選課清單，但往往沒想像中順利，得預備許多課表組合，因此誕生了此系統，希望能幫助到大家。" />
    <meta property="og:title" content="模擬中原 - CYCU Simulation" />
    <meta property="og:type" content="模擬選課" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:image" content="https://i.imgur.com/QEobY1P.png" />
    <meta property="og:image:secure_url" content="https://i.imgur.com/QEobY1P.png" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="630">
    <meta property="og:image:height" content="760">
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.17/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-animateNumber/0.0.14/jquery.animateNumber.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/semantic.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/style.css') }}" />
    <title>模擬中原 - CYCU Simulation</title>
</head>

<body ng-app="myApp" ng-controller="ListController" ng-cloak>

    <div class="ui secondary pointing menu fixed">
        <a class="active item" href="{{ url('/') }}">CYCU Simulation</a>
        <div class="right menu">
            <a class="ui item" ng-click="loadProfile()">登入</a>
        </div>
    </div>


    <div class="ui container">

        <div class="ui grid stackable container">

            <div class="ui sixteen wide column">

                <!-- Story -->
                <div class="ui vertical stripe segment" id="story" ng-init="load_joined()">
                    <div class="ui basic segment stackable grid">
                        <div class="row">
                            <div class="sixteen wide center aligned mobile only column">
                                <img src="{{ url('/logo.svg') }}" alt="CYCU Simulation" class="ui image small centered">
                                <h3 class="ui header nothighlight">CYCU Simulation</h3>
                                <h2 class="ui header">
                                    有 <span class="joined"><% joinedCounts %></span> 位同學正在使用
                                </h2>
                                <p class="story-text">
                                    模擬選課<br />學分計算<br />租屋資訊<br />考古題
                                </p>
                            </div>
                            <div class="sixteen wide computer tablet only column">
                                <img src="{{ url('/logo.svg') }}" alt="CYCU Simulation" class="ui image small centered">
                                <h3 class="ui header center aligned nothighlight">CYCU Simulation</h3>
                                <h2 class="ui header center aligned">
                                    有 <span class="joined"><% joinedCounts %></span> 位同學正在使用
                                </h2>
                                <p class="story-text">
                                    <span class="highlight">模擬選課</span>：每學期選課前，總是要手動列出欲選課清單，但往往沒想像中順利，得預備許多課表組合，因此誕生了此系統。<br />
                                    <span class="highlight">租屋資訊</span>：期望每個人把租屋經驗及心得記錄下來，日後他人租屋時，能更精確找到心目中的異鄉屋。<br />
                                    <span class="highlight">考古題</span>：考試總是抓不住重點，如能有個參考範例，朝著範圍前進，想必能得心應手。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Story End -->

                <!-- Slogan -->
                <div class="ui vertical segment">
                    <div class="ui basic segment stackable grid">
                        <div class="row">
                            <div class="six wide mobile only column">
                                <div class="ui segment basic center aligned">
                                    <div class="ui solgan">

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">模擬真實情境</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">關鍵字搜尋課程</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">結合中原大全</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">儲存課表</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">衝堂及學分上限</div>
                                        </h2>

                                    </div>
                                </div>
                            </div>
                            <div class="eight wide middle aligned computer tablet only column">

                                <div class="ui slogan">

                                    <h2 class="ui header">
                                        <i class="black checkmark box icon"></i>
                                        <div class="content">模擬真實情境</div>
                                    </h2>

                                    <h2 class="ui header">
                                        <i class="black checkmark box icon"></i>
                                        <div class="content">關鍵字搜尋課程</div>
                                    </h2>

                                    <h2 class="ui header">
                                        <i class="black checkmark box icon"></i>
                                        <div class="content">結合中原大全</div>
                                    </h2>

                                    <h2 class="ui header">
                                        <i class="black checkmark box icon"></i>
                                        <div class="content">儲存課表</div>
                                    </h2>

                                    <h2 class="ui header">
                                        <i class="black checkmark box icon"></i>
                                        <div class="content">衝堂及學分上限</div>
                                    </h2>

                                </div>
                            </div>
                            <div class="six wide right floated column">
                                <img src="https://i.imgur.com/Co0EZgy.png" class="ui large image">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slogan End -->

                <!-- Page1 -->
                <div class="ui vertical stripe segment">
                    <div class="ui basic segment stackable grid">
                        <div class="row">
                            <div class="six wide mobile only column">
                                <div class="ui segment basic center aligned">
                                    <div class="ui slogan">

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">視覺化課表</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">仿真時程表</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">分享課表</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">下載課表</div>
                                        </h2>

                                    </div>
                                </div>
                            </div>
                            <div class="eight wide column">
                                <img src="https://i.imgur.com/wQe8Y3N.png" class="ui large image">
                            </div>
                            <div class="six wide middle aligned right floated computer tablet only column">
                                <p>
                                    <div class="ui slogan">

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">視覺化課表</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">仿真時程表</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">分享課表</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">下載課表</div>
                                        </h2>

                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page1 End -->

                <!-- Page2 -->
                <div class="ui vertical stripe segment">
                    <div class="ui basic segment stackable grid">
                        <div class="row">
                            <div class="six wide mobile only column">
                                <h3 class="ui header centered">修課計算系統</h3>
                                <div class="ui segment basic center aligned">
                                    <p>
                                        <div class="ui slogan">

                                            <h2 class="ui header">
                                                <i class="black checkmark box icon"></i>
                                                <div class="content">一鍵匯入</div>
                                            </h2>

                                            <h2 class="ui header">
                                                <i class="black checkmark box icon"></i>
                                                <div class="content">修習過的課程</div>
                                            </h2>

                                            <h2 class="ui header">
                                                <i class="black checkmark box icon"></i>
                                                <div class="content">尚未修習之課程</div>
                                            </h2>

                                        </div>
                                    </p>
                                </div>
                            </div>
                            <div class="six wide middle aligned computer tablet only column">
                                <h3 class="ui header">修課計算系統</h3>
                                <p>
                                    <div class="ui slogan">

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">一鍵匯入</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">修習過的課程</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">尚未修習之課程</div>
                                        </h2>

                                    </div>
                                </p>
                            </div>
                            <div class="eight wide right floated column">
                                <img src="https://i.imgur.com/4SG9aik.png" class="ui big image">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page2 End -->

                <!-- Page3 -->
                <div class="ui vertical stripe segment">
                    <div class="ui basic segment stackable grid">
                        <div class="row">
                            <div class="six wide mobile only column">
                            <h3 class="ui header centered">租屋資訊</h3>
                                <div class="ui segment basic center aligned">
                                    <div class="ui slogan">

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">地標搜尋</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">言論自由</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">詳細且真實</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">多圖預覽</div>
                                        </h2>

                                    </div>
                                </div>
                            </div>
                            <div class="eight wide column">
                                <img src="https://i.imgur.com/aNFUbor.png" class="ui large image">
                            </div>
                            <div class="six wide middle aligned right floated computer tablet only column">
                                <h3 class="ui header">租屋資訊</h3>
                                <p>
                                    <div class="ui slogan">

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">地標搜尋</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">言論自由</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">詳細且真實</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">多圖預覽</div>
                                        </h2>

                                    </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page3 End -->

                <!-- Page4 -->
                <div class="ui vertical stripe segment">
                    <div class="ui basic segment stackable grid">
                        <div class="row">
                            <div class="six wide mobile only column">
                                <h3 class="ui header centered">考古題分享</h3>
                                <div class="ui segment basic center aligned">
                                    <p>
                                        <div class="ui slogan">

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">穩定雲端下載</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">出外靠朋友</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">共享精隨</div>
                                        </h2>

                                    </div>
                                    </p>
                                </div>
                            </div>
                            <div class="six wide middle aligned computer tablet only column">
                                <h3 class="ui header">考古題分享</h3>
                                <p>
                                    <div class="ui slogan">

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">穩定雲端下載</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">出外靠朋友</div>
                                        </h2>

                                        <h2 class="ui header">
                                            <i class="black checkmark box icon"></i>
                                            <div class="content">共享精隨</div>
                                        </h2>

                                    </div>
                                </p>
                            </div>
                            <div class="eight wide right floated column">
                                <img src="https://i.imgur.com/NGPfDxJ.png" class="ui big image">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page4 End -->
                <div class="ui vertical stripe segment">
                    <div class="ui basic segment stackable grid">
                        <div class="row">
                            <div class="sixteen wide column center aligned">
                                <button ng-click="loadProfile()" type="button" class="ui button facebook massive nav-blue notinverted"><i class="facebook icon"></i>快速登入 / 註冊</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style media="screen">
        body {
            background-image: linear-gradient(to right, #eea2a2 0%, #bbc1bf 19%, #57c6e1 42%, #b49fda 79%, #7ac5d8 100%);
        }
        
        #story {
            padding: 1em 0em;
        }
        
        .ui.vertical.stripe h3 {
            font-size: 2em;
            color: #183346;
            text-shadow: 0px 0px 26px rgba(247, 217, 44, .7);
        }

        .highlight {
            font-size: 1em;
            color: #183346;
            text-shadow: 0px 0px 26px rgba(247, 217, 44, .7);
        }
        
        .ui.vertical.stripe .button+h3,
        .ui.vertical.stripe p+h3 {
            margin-top: 3em;
        }
        
        .ui.vertical.stripe .floated.image {
            clear: both;
        }
        
        .ui.vertical.stripe p {
            font-size: 1.3em;
            margin-top: 15px;
            line-height: 2em;
        }
    </style>

    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

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

        var app = angular.module('myApp', []);

        app.controller('ListController', function($scope, $http) {

            $scope.baseUrl = "//localhost/simulation/public/";
            $scope.joinedCounts = 0;

            $scope.load_joined = function() {
                $http({
                        url: $scope.baseUrl + 'load_joined',
                        method: "GET",
                    })
                    .success(function(data, status, headers, config) {

                        $(".joined").animateNumber({ number: data });
                    })
                    .error(function(data, status, headers, config) {

                    });
            }

            // login
            $scope.fbProfile = [];
            $scope.loadProfile = function() {

                var provider = new firebase.auth.FacebookAuthProvider();
                provider.setCustomParameters({
                    'display': 'page'
                });

                firebase.auth().signInWithPopup(provider).then(function(result) {

                    $scope.fbProfile.fb_id = result.additionalUserInfo.profile.id;
                    $scope.fbProfile.birthday = result.additionalUserInfo.profile.birthday;
                    $scope.fbProfile.name = result.additionalUserInfo.profile.name;
                    $scope.fbProfile.gender = result.additionalUserInfo.profile.gender;
                    $scope.fbProfile.photo = 'https://graph.facebook.com/' + result.additionalUserInfo.profile.id + '/picture?type=large';
                    $scope.fbProfile.email = result.user.providerData[0].email;

                    $http({
                            url: $scope.baseUrl + 'profile/save',
                            method: "POST",
                            data: $.param({
                                "fb_id": $scope.fbProfile.fb_id,
                                "birthday": $scope.fbProfile.birthday,
                                "name": $scope.fbProfile.name,
                                "gender": $scope.fbProfile.gender,
                                "photo": $scope.fbProfile.photo,
                                "email": $scope.fbProfile.email
                            }),
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                            },
                        })
                        .success(function(data, status, headers, config) {

                            window.location.href = $scope.baseUrl + 'start';
                        })
                        .error(function(data, status, headers, config) {

                            console.log('login failed');
                        });

                }).catch(function(error) {

                    window.location.href = $scope.baseUrl + 'start';
                });
            }
        });
    </script>
    

</body>

</html>