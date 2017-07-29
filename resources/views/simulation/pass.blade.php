@extends('layout.main')
@section('pageTitle', "已修習課程")
@section('content')

<div class="ui grid">
    <div class="sixteen wide column">

        <h2 class="ui icon header center aligned">
            <i class="bookmark icon"></i>
            <div class="content">
                已修習課程
            </div>
        </h2>

        <table class="ui tablet unstackable table" ng-init="loadHistory()">
            <thead>
                <tr>
                    <th>學年期</th>
                    <th>名稱</th>
                    <th>必選修</th>
                    <th>學分數</th>
                    <th>性質</th>
                    <th>分數</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="item in history_course_list">
                    <td>
                        <% item.year %>
                    </td>
                    <td>
                        <% item.course_name %>
                    </td>
                    <td>
                       <% item.com_or_opt %>
                    </td>
                    <td>
                        <% item.point %>
                    </td>
                    <td>
                       <% item.nature %>
                    </td>
                    <td>
                        <% item.score %>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@endsection