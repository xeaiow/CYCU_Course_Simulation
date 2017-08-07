<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="CYCU Simulation">
    <meta name="og:description" content="每學期選課前，總是要手動列出欲選課清單，但往往沒想像中順利，得預備許多課表組合，因此誕生了此系統，希望能幫助到大家。" />
    <meta property="og:title" content="{{ $data['title'] }}"/>
    <meta property="og:site_name" content="{{ $data['title'] }}"></meta>
    <meta property="og:type" content="模擬選課"/>
    <meta property="og:url" content="{{ Request::url() }}"/> 
    <meta property="og:image" content="https://i.imgur.com/QEobY1P.png"/>
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
    <link rel="stylesheet" href="{{ asset('/semantic.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/themes/facebook/facebook.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/toastr.min.css') }}">
    <title>{{ ( $data['title'] == null ? "模擬中原" : $data['title'] ) }} - 模擬中原 CYCU Simulation</title>
</head>

<body ng-app="myApp" ng-controller="ListController" ng-cloak>

    <div class="ui container">
        <div class="ui stackable one column grid" ng-init="load_open_course({{ request()->route('id') }})">
            <div class="column course_scroll">
                <table class="ui unstackable celled inverted table" id="course_exports">
                    <thead>
                        <tr class="center aligned">
                            <th></th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                            <th>Sun</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="08:10 ~ 09:00" data-position="top left">1</td>
                        <td class="course_block" data-tooltip="<% course_date[0].teacher %>" data-position="top left">
                            <% course_date[0].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[1].teacher %>" data-position="top left">
                            <% course_date[1].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[2].teacher %>" data-position="top left">
                            <% course_date[2].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[3].teacher %>" data-position="top left">
                            <% course_date[3].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[4].teacher %>" data-position="top left">
                            <% course_date[4].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[5].teacher %>" data-position="top left">
                            <% course_date[5].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[6].teacher %>" data-position="top left">
                            <% course_date[6].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="09:10 ~ 10:00" data-position="top left">2</td>
                        <td class="course_block" data-tooltip="<% course_date[7].teacher %>" data-position="top left">
                            <% course_date[7].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[8].teacher %>" data-position="top left">
                            <% course_date[8].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[9].teacher %>" data-position="top left">
                            <% course_date[9].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[10].teacher %>" data-position="top left">
                            <% course_date[10].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[11].teacher %>" data-position="top left">
                            <% course_date[11].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[12].teacher %>" data-position="top left">
                            <% course_date[12].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[13].teacher %>" data-position="top left">
                            <% course_date[13].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="10:10 ~ 11:00" data-position="top left">3</td>
                        <td class="course_block" data-tooltip="<% course_date[14].teacher %>" data-position="top left">
                            <% course_date[14].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[15].teacher %>" data-position="top left">
                            <% course_date[15].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[16].teacher %>" data-position="top left">
                            <% course_date[16].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[17].teacher %>" data-position="top left">
                            <% course_date[17].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[18].teacher %>" data-position="top left">
                            <% course_date[18].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[19].teacher %>" data-position="top left">
                            <% course_date[19].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[20].teacher %>" data-position="top left">
                            <% course_date[20].id %>
                        </td>

                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="11:10 ~ 12:00" data-position="top left">4</td>
                        <td class="course_block" data-tooltip="<% course_date[21].teacher %>" data-position="top left">
                            <% course_date[21].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[22].teacher %>" data-position="top left">
                            <% course_date[22].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[23].teacher %>" data-position="top left">
                            <% course_date[23].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[24].teacher %>" data-position="top left">
                            <% course_date[24].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[25].teacher %>" data-position="top left">
                            <% course_date[25].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[26].teacher %>" data-position="top left">
                            <% course_date[26].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[27].teacher %>" data-position="top left">
                            <% course_date[27].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="12:10 ~ 13:00" data-position="top left">B</td>
                        <td class="course_block" data-tooltip="<% course_date[28].teacher %>" data-position="top left">
                            <% course_date[28].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[29].teacher %>" data-position="top left">
                            <% course_date[29].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[30].teacher %>" data-position="top left">
                            <% course_date[30].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[31].teacher %>" data-position="top left">
                            <% course_date[31].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[32].teacher %>" data-position="top left">
                            <% course_date[32].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[33].teacher %>" data-position="top left">
                            <% course_date[33].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[34].teacher %>" data-position="top left">
                            <% course_date[34].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="13:10 ~ 14:00" data-position="top left">5</td>
                        <td class="course_block" data-tooltip="<% course_date[35].teacher %>" data-position="top left">
                            <% course_date[35].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[36].teacher %>" data-position="top left">
                            <% course_date[36].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[37].teacher %>" data-position="top left">
                            <% course_date[37].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[38].teacher %>" data-position="top left">
                            <% course_date[38].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[39].teacher %>" data-position="top left">
                            <% course_date[39].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[40].teacher %>" data-position="top left">
                            <% course_date[40].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[41].teacher %>" data-position="top left">
                            <% course_date[41].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="14:10 ~ 15:00" data-position="top left">6</td>
                        <td class="course_block" data-tooltip="<% course_date[42].teacher %>" data-position="top left">
                            <% course_date[42].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[43].teacher %>" data-position="top left">
                            <% course_date[43].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[44].teacher %>" data-position="top left">
                            <% course_date[44].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[45].teacher %>" data-position="top left">
                            <% course_date[45].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[46].teacher %>" data-position="top left">
                            <% course_date[46].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[47].teacher %>" data-position="top left">
                            <% course_date[47].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[48].teacher %>" data-position="top left">
                            <% course_date[48].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="15:10 ~ 16:00" data-position="top left">7</td>
                        <td class="course_block" data-tooltip="<% course_date[49].teacher %>" data-position="top left">
                            <% course_date[49].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[50].teacher %>" data-position="top left">
                            <% course_date[50].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[51].teacher %>" data-position="top left">
                            <% course_date[51].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[52].teacher %>" data-position="top left">
                            <% course_date[52].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[53].teacher %>" data-position="top left">
                            <% course_date[53].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[54].teacher %>" data-position="top left">
                            <% course_date[54].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[55].teacher %>" data-position="top left">
                            <% course_date[55].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="16:10 ~ 17:00" data-position="top left">8</td>
                        <td class="course_block" data-tooltip="<% course_date[56].teacher %>" data-position="top left">
                            <% course_date[56].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[57].teacher %>" data-position="top left">
                            <% course_date[57].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[58].teacher %>" data-position="top left">
                            <% course_date[58].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[59].teacher %>" data-position="top left">
                            <% course_date[59].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[60].teacher %>" data-position="top left">
                            <% course_date[60].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[61].teacher %>" data-position="top left">
                            <% course_date[61].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[62].teacher %>" data-position="top left">
                            <% course_date[62].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="17:05 ~ 17:55" data-position="top left">C</td>
                        <td class="course_block" data-tooltip="<% course_date[63].teacher %>" data-position="top left">
                            <% course_date[63].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[64].teacher %>" data-position="top left">
                            <% course_date[64].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[65].teacher %>" data-position="top left">
                            <% course_date[65].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[66].teacher %>" data-position="top left">
                            <% course_date[66].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[67].teacher %>" data-position="top left">
                            <% course_date[67].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[68].teacher %>" data-position="top left">
                            <% course_date[68].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[69].teacher %>" data-position="top left">
                            <% course_date[69].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="18:00 ~ 18:50" data-position="top left">D</td>
                        <td class="course_block" data-tooltip="<% course_date[70].teacher %>" data-position="top left">
                            <% course_date[70].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[71].teacher %>" data-position="top left">
                            <% course_date[71].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[72].teacher %>" data-position="top left">
                            <% course_date[72].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[73].teacher %>" data-position="top left">
                            <% course_date[73].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[74].teacher %>" data-position="top left">
                            <% course_date[74].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[75].teacher %>" data-position="top left">
                            <% course_date[75].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[76].teacher %>" data-position="top left">
                            <% course_date[76].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="18:55 ~ 19:45" data-position="top left">E</td>
                        <td class="course_block" data-tooltip="<% course_date[77].teacher %>" data-position="top left">
                            <% course_date[77].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[78].teacher %>" data-position="top left">
                            <% course_date[78].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[79].teacher %>" data-position="top left">
                            <% course_date[79].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[80].teacher %>" data-position="top left">
                            <% course_date[80].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[81].teacher %>" data-position="top left">
                            <% course_date[81].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[82].teacher %>" data-position="top left">
                            <% course_date[82].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[83].teacher %>" data-position="top left">
                            <% course_date[83].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="19:50 ~ 20:40" data-position="top left">F</td>
                        <td class="course_block" data-tooltip="<% course_date[84].teacher %>" data-position="top left">
                            <% course_date[84].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[85].teacher %>" data-position="top left">
                            <% course_date[85].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[86].teacher %>" data-position="top left">
                            <% course_date[86].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[87].teacher %>" data-position="top left">
                            <% course_date[87].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[88].teacher %>" data-position="top left">
                            <% course_date[88].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[89].teacher %>" data-position="top left">
                            <% course_date[89].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[90].teacher %>" data-position="top left">
                            <% course_date[90].id %>
                        </td>
                    </tr>
                    <tr class="center aligned">
                        <td class="course_block_schedule" data-tooltip="20:45 ~ 21:35" data-position="top left">G</td>
                        <td class="course_block" data-tooltip="<% course_date[91].teacher %>" data-position="top left">
                            <% course_date[91].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[92].teacher %>" data-position="top left">
                            <% course_date[92].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[93].teacher %>" data-position="top left">
                            <% course_date[93].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[94].teacher %>" data-position="top left">
                            <% course_date[94].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[95].teacher %>" data-position="top left">
                            <% course_date[95].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[96].teacher %>" data-position="top left">
                            <% course_date[96].id %>
                        </td>
                        <td class="course_block" data-tooltip="<% course_date[97].teacher %>" data-position="top left">
                            <% course_date[97].id %>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <h4 class="ui horizontal divider header">
                <i class="share icon"></i> 分享這個課表
            </h4>
            <div class="fb-share-button" data-href="{{ Request::url() }}" data-layout="button" data-size="large" data-mobile-iframe="true">
                <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fsimulation.com.tw%2F&amp;src=sdkpreparse"></a>
            </div>

            <!-- courseInfo -->
            <div class="ui card fluid" ng-repeat="item in course_info">
                <div class="content">
                    <div class="header">
                        <a target="_blank" href="https://coursewiki.clouder.today/courses/<% item.id %>">
                            <% item.name %> /
                                <% item.teacher %> /
                                    <% item.com_or_opt %>
                        </a>
                    </div>
                    <div class="description">
                        <p>
                            上課時段：
                            <% item.time_1 %>
                                <% item.time_2 %>
                                    <% item.time_3 %><br /> 開課系級：
                                        <% item.class %>
                        </p>
                    </div>
                </div>
                <div class="extra content">
                    <span class="left floated like">
                            <% item.id %>
                        </span>
                    <span class="right floated star">
                            <% item.point %> 學分
                        </span>
                </div>
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
        });
    </script>

</body>

</html>