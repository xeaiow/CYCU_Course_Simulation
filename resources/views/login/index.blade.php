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
    <script src="{{ asset('/js/controller.js') }}"></script>
    <script src="{{ asset('/js/mask.min.js') }}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-animateNumber/0.0.14/jquery.animateNumber.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/semantic.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/facebook/facebook.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/toastr.min.css') }}">
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
                                <p class="story-text">
                                    每學期選課前，總是要手動列出欲選課清單，但往往沒想像中順利，得預備許多課表組合，因此誕生了此系統，希望能幫助到大家。
                                    <h2 class="ui header">
                                        有 <span class="joined">已註冊人數 <% joinedCounts %></span> 位同學正在使用
                                    </h2>
                                </p>
                            </div>
                            <div class="sixteen wide center aligned computer tablet only column">
                                <img src="{{ url('/logo.svg') }}" alt="CYCU Simulation" class="ui image small centered">
                                <h3 class="ui header nothighlight">CYCU Simulation</h3>
                                <p class="story-text">
                                    每學期選課前，總是要手動列出欲選課清單，但往往沒想像中順利，得預備許多課表組合，因此誕生了此系統，希望能幫助到大家。<br />
                                    <h2 class="ui header">
                                        有 <span class="joined"><% joinedCounts %></span> 位同學正在使用
                                    </h2>
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
                                <img src="https://i.imgur.com/CtiwpLR.png" class="ui large image">
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
                                <img src="https://i.imgur.com/QEobY1P.png" class="ui large image">
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

                <!-- Page3 -->
                <div class="ui vertical stripe segment">
                    <div class="ui basic segment stackable grid">
                        <div class="row">
                            <div class="six wide mobile only column">
                                <h3 class="ui header centered">學分計算系統</h3>
                                <div class="ui segment basic center aligned">
                                    <p>
                                        Comming Soon...
                                    </p>
                                </div>
                            </div>
                            <div class="six wide middle aligned computer tablet only column">
                                <h3 class="ui header">學分計算系統</h3>
                                <p>
                                    Comming Soon...
                                </p>
                            </div>
                            <div class="eight wide right floated column">
                                <img src="https://i.imgur.com/MXvMhvk.png" class="ui big image">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page3 End -->

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

            <style media="screen">
                body {
                    background-image: linear-gradient(to right, #eea2a2 0%, #bbc1bf 19%, #57c6e1 42%, #b49fda 79%, #7ac5d8 100%);
                }
                
                #story {
                    padding: 0em 0em;
                }
                
                .ui.vertical.stripe h3 {
                    font-size: 2em;
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


        </div>

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

            $(function() {
                FastClick.attach(document.body);
            });
        </script>

</body>

</html>