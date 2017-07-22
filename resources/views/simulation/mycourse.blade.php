@extends('layout.main') @section('content')


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