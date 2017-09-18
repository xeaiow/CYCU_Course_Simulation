@extends('layout.main') @section('content') @section('pageTitle', '考古題')


<div class="ui grid stackable">
    <div class="eight wide column">
    
        <!-- 搜尋列 -->
        <div class="twelve wide column mobile only">

            <div class="ui fluid icon input">
                <input type="text" ng-model="examms_keywords" placeholder="課程 / 老師" press-Enter="search_exams()">
                <i class="search icon"></i>
            </div>

            <!-- 搜尋結果列 -->
            <div class="lists-max-height">
                <div class="ui card fluid" ng-repeat="item in exams">
                    <div class="content">
                        <div class="header">
                            <a>
                                <% item.title %>
                            </a>
                        </div>
                        <div class="description">
                            <p>
                                描述：
                                <% item.description | strcut %>
                            </p>
                        </div>
                    </div>
                    <div class="extra content">
                        <span class="left floated like">
                            <% item.created_at %> 上傳
                        </span>
                        <span class="right floated like">
                            <% item.filename.length %> 個檔案
                        </span>
                    </div>
                    <div class="ui bottom attached button" ng-click="viewExamms(item._id)">
                        <i class="unhide icon green"></i>查看
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="eight wide column">

        <!-- 新增考古題資訊 -->
        <div class="ui grid">
            <div class="sixteen wide column fix-exams-post-button">
                <button class="ui simulation-theme white button right floated" onclick="window.location.href='{{ url('/exams/post') }}'">發布</button>
            </div>
        </div>

        <h2 class="ui header">
            <i class="cloud icon"></i>
            <div class="content">
                最近上傳的考古題
            </div>
        </h2>
        <div class="ui inverted segment">
            <div class="ui inverted relaxed divided list" ng-init="exams_news()">
                <div class="item view-house" ng-repeat="item in exams_news" ng-click="view_exams(item._id)">
                    <div class="content">
                    <div class="header"><i class="icon bookmark"></i> <% item.title %> / <% item.filename.length %> 個檔案</div>
                        <% item.description | strcut %>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection()