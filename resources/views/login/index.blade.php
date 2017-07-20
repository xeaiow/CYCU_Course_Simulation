@extends('layout.main') @section('content')

<div class="ui centered grid">
    <div class="row">
        <div class="column center aligned">
            <img src="{{ url('/logo.svg') }}" alt="CYCU Simulation" class="ui image small centered">
            <div class="content">
                <h2 class="ui header">CYCU Simulation</h2>
                <div class="sub header">
                    有感於每次排課都衝堂，因此發展出視覺化排課，衝堂一目瞭然。
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SearchCourse -->
<div class="ui stackable two column grid">
    <div class="row margin-20 course-bg">
        <div class="eight wide column">
            <img src="https://i.imgur.com/CtiwpLR.png" class="ui image large" alt="">
        </div>
        <div class="eight wide column">
            <h2 class="ui center aligned icon header">
                模擬真實情境
            </h2>
            <h2 class="ui center aligned icon header">
                關鍵字搜尋課程
            </h2>
            <h2 class="ui center aligned icon header">
                詳細的課程資訊
            </h2>
            <h2 class="ui center aligned icon header">
                即時顯示加退選
            </h2>
            <h2 class="ui center aligned icon header">
                衝堂立即告知
            </h2>
        </div>
    </div>
</div>

<!-- CourseList -->
<div class="ui stackable two column grid">
    <div class="row margin-50 course-bg">
        <div class="eight wide column">
            <h2 class="ui center aligned icon header">
                視覺化課表
            </h2>
            <h2 class="ui center aligned icon header">
                仿真時程表
            </h2>
            <h2 class="ui center aligned icon header">
                顯示授課老師
            </h2>
            <h2 class="ui center aligned icon header">
                儲存課表
            </h2>
            <h2 class="ui center aligned icon header">
                下載課表
            </h2>
        </div>
        <div class="eight wide column">
            <img src="https://i.imgur.com/QEobY1P.png" class="ui image big" alt="">
        </div>
    </div>
</div>

<div class="ui stackable two column grid">
    <div class="row margin-20">
        <button class="ui facebook button fluid" ng-click="loadProfile()">
            <i class="facebook icon"></i> 使用 Facebook 登入
        </button>
    </div>
</div>
@endsection