@extends('layout.main') @section('pageTitle', '我的課表') @section('content')


<div class="ui success message" ng-if="mySaveCourse.length == 0">
    <div class="header">
        還沒有建立過課表呢。
    </div>
    <ul class="list">
        <li>加選完，在課表右上方點選儲存即可。</li>
        <li>課表還能分享給同學看。</li>
    </ul>
</div>

<div class="ui stackable four column grid" ng-init="load_my_course()">

    <div class="column" ng-repeat="item in mySaveCourse">
        <div class="ui cards stackable">
            <div class="card">
                <div class="content">
                    <% item.title %> /
                        <% item.point %> 學分
                            <div>
                                <ul>
                                    <li ng-repeat="course in item.course">
                                        <% course.name %>
                                    </li>
                                </ul>
                            </div>
                </div>
                <div class="ui bottom attached button facebook" ng-click="link_course(item.url)">
                    <i class="external icon"></i> 查看課表
                </div>
            </div>
        </div>
    </div>

</div>

@endsection