@extends('layout.main')

@section('pageTitle', '匯入已修習課程')

@section('content')

<div class="ui stackable two column grid">

    <div class="column">

        <button class="ui button facebook fluid" onclick="window.open('https://itouch.cycu.edu.tw/myfile/student/#!/login?returnRoute=%2FpersonalInformation', '_blank')">登入 iTouch My File</button>

        <div class="ui segment basic">
            <iframe width="100%" ng-src="//itouch.cycu.edu.tw/myfile/student/json/pf_historyOfClass.jsp" frameborder="0"></iframe>
        </div>

        <div class="ui form">
            <div class="field">
                <textarea ng-model="history_course" placeholder="將代碼貼至此"></textarea>
            </div>
        </div>

        <button class="ui button google plus fluid" ng-click="import()">儲存</button>



    </div>

    <div class="column">

        <div class="ui styled fluid accordion">
            <div class="title">
                <i class="dropdown icon"></i> 如何取得已修習之課程代碼
            </div>
            <div class="content">
                <p>
                    登入 iTouch My File 後，重新整理頁面方可取得已修習之課程代碼。
                </p>
            </div>
            <div class="title">
                <i class="dropdown icon"></i> 為何出現 HTTP Status 401 -
            </div>
            <div class="content">
                <p>
                    如看見 HTTP Status 401 請先登入 <a href="https://itouch.cycu.edu.tw/myfile/student/#!/login">iTouch My File</a>，並重新整理頁面。
                </p>
            </div>
            <div class="title">
                <i class="dropdown icon"></i> 給你修課資訊，安全嗎？
            </div>
            <div class="content">
                <p>
                    資料來源由 iTouch 及 MyFile 經由您的認可方能擷取資料，且本系統與校務校統並無關連，修過的課也不會被盜走，不用擔心啦。
                </p>
            </div>
            <div class="title">
                <i class="dropdown icon"></i> 為何無法複製代碼
            </div>
            <div class="content">
                <p>
                    目前需從電腦版才能複製，這部分日後將做修正。
                </p>
            </div>
        </div>

    </div>
</div>

@endsection