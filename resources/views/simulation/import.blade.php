@extends('layout.main') @section('content')

<div class="ui one column stackable center aligned page grid">

    <div class="column sixteen wide">

        <button class="ui button facebook fluid" onclick="window.open('https://itouch.cycu.edu.tw/myfile/student/#!/login?returnRoute=%2FpersonalInformation', '_blank')">登入 iTouch My File</button>

        <div class="ui info message">
            登入 iTouch My File 後，重新整理頁面方可取得已修習之課程代碼。
        </div>

        <div class="ui segment basic">
            <iframe width="100%" ng-src="//itouch.cycu.edu.tw/myfile/student/json/pf_historyOfClass.jsp" frameborder="0"></iframe>
        </div>

        <div class="ui info message">
            請將上方代碼完整複製到下方後按儲存。
        </div>

        <div class="ui form">
            <div class="field">
                <textarea ng-model="history_course"></textarea>
            </div>
        </div>

        <button class="ui button google plus fluid" ng-click="import()">儲存</button>

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