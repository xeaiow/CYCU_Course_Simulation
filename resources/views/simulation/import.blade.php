@extends('layout.main') @section('content')

<div class="ui one column stackable center aligned page grid">
    <div class="column twelve wide">

        <div class="ui large steps fluid">
            <div class="step">
                <div class="content">
                    <div class="title">1. 取得帳號權限以便後續操作</div>
                </div>
            </div>
        </div>

        <button class="ui button facebook" onclick="window.open('https://itouch.cycu.edu.tw/myfile/student/#!/login?returnRoute=%2FpersonalInformation', '_blank')">登入 iTouch</button>
        <button ng-click="import()"></button>
        <div class="ui large steps fluid">
            <div class="link step">
                <div class="content">
                    <div class="title">2. 確認匯入</div>
                </div>
            </div>
        </div>

        <button class="ui button facebook" ng-click="import()">匯入資料</button>

        <iframe id="ss" src="//localhost/simulation/public/added_course" frameborder="0"></iframe>
        
        <!--<div class="ui styled fluid accordion">
            <div class="title">
                <i class="dropdown icon"></i> 給你修課資訊，安全嗎？
            </div>
            <div class="content">
                <p>
                    資料來源由 iTouch 及 MyFile 經由您的認可方能擷取資料，修過的課也不會被盜走，不用擔心啦。
                </p>
            </div>
        </div>-->


    </div>
</div>

@endsection