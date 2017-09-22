@extends('layout.main') @section('content') @section('pageTitle', $profile['og_title'])

    <div class="ui grid stackable" ng-init="exams_info_ajax('{{Request::segment(2)}}')">
        <div class="eight wide column">

            <!-- 考古題資訊 -->
            <div class="ui segment basic">
                <h2 class="ui header">
                    <i class="bookmark icon"></i>
                    <div class="content">
                        <% exams_info.title %>
                    </div>
                </h2>
            </div>

            <h4 class="ui horizontal divider header">
            <i class="write icon"></i>描述
            </h4>

            <!-- 描述 -->
            <div class="ui piled segment">
               <% exams_info.description %>
            </div>

            <h4 class="ui horizontal divider header">
            <i class="disk outline icon"></i> <% exams_info.filename.length %> 個檔案
            </h4>
            <!-- 取得檔案 -->
            <div class="ui piled segment">
                <div class="ui stackable two column grid">
                    <div class="column" ng-repeat="item in exams_info.filename track by $index">
                        <a target="_blank" href="https://drive.google.com/open?id=<% exams_info.url[$index] %>"><i class="icon big cloud download"></i> <% item %></a>
                    </div>   
                </div>
            </div>

        </div>
        
        <!-- FB comment -->
        <div class="eight wide column">
            <div class="fb-comments" data-href="{{ url('/exams') }}/<% exams_info._id %>" data-numposts="5"></div>
        </div>

    </div>

@endsection()