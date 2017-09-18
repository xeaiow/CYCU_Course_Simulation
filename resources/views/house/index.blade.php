@extends('layout.main') @section('pageTitle', '找屋子') @section('content')

<div class="ui grid stackable">

    <div class="seven wide column mobile only">

        <!-- 搜尋列 -->
        <div class="twelve wide column mobile only">
            <div class="ui fluid icon input">
                <input type="text" ng-model="keywords" placeholder="路段 / 地標" press-Enter="search_house()">
                <i class="search icon"></i>
            </div>
        </div>

        <!-- 搜尋結果 -->
        <div class="lists-max-height">

            <div class="ui card fluid view-house" ng-repeat="item in houseInfo" ng-click="view_house_mobile(item._id)">
                <div class="content">
                    <div class="header">
                        <% item.title %>
                    </div>
                    <div class="description">
                        <img class="ui image samll" ng-src="<% item.pictures[0] | pictures %>" alt="">
                    </div>
                </div>
                <div class="ui segment basic margin-bottom-less-30">
                    <span class="left floated like"><i class="icon marker"></i><% item.marker %></span>
                </div>
                <div class="ui segment basic">
                    <span class="left floated like"><i class="icon dollar"></i><% item.rent_price %> / 月</span>
                    <span class="right floated like"><i class="star icon"></i>
                                            <% (item.landlord_score+item.live_score)/2 %></span>
                </div>
            </div>
        </div>
    </div>

    <div class="seven wide column computer only">

        <!-- 搜尋列 -->
        <div class="twelve wide column">
            <div class="ui fluid icon input">
                <input type="text" ng-model="keywords" placeholder="路段 / 地標" press-Enter="search_house()">
                <i class="search icon"></i>
            </div>
        </div>

        <!-- 搜尋結果 -->
        <div class="lists-max-height">

            <div ng-repeat="item in houseInfo">
                <div class="ui card fluid view-house margin-bottom-zero" ng-click="view_house($index)">
                    <div class="content">
                        <div class="header">
                            <% item.title %>
                        </div>
                        <div class="description">
                            <img class="ui image samll" ng-src="<% item.pictures[0] | pictures %>" alt="">
                        </div>
                    </div>
                    <div class="ui segment basic margin-bottom-less-30">
                        <span class="left floated like"><i class="icon marker"></i><% item.marker %></span>
                    </div>
                    <div class="ui segment basic">
                        <span class="left floated like"><i class="icon dollar"></i><% item.rent_price %> / 月</span>
                        <span class="right floated like"><i class="star icon"></i>
                                <% (item.landlord_score+item.live_score)/2 %></span>
                    </div>
                </div>
                <div class="content house-check-info">
                    <a href="{{ url('/house') }}/<% item._id %>">
                        <div class="ui bottom attached button"><i class="ui icon hand pointer"></i>查看完整資訊</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="one wide column"></div>

    <div class="eight wide column computer only">

        <!-- 新增房屋資訊 -->
        <div class="ui grid">
            <div class="sixteen wide column">
                <button class="ui simulation-theme white button right floated" onclick="window.location.href='{{ url('/house/post') }}'">發布</button>
            </div>
        </div>

        <div ng-if="houseIndex != null">
            <h2 class="ui header">
                <i class="bookmark icon"></i>
                <div class="content">
                    <% houseInfo[houseIndex].title %>
                </div>
            </h2>
            <h2 class="ui header">
                <i class="marker icon"></i>
                <div class="content">
                    <% houseInfo[houseIndex].marker %>
                </div>
            </h2>
            <table class="ui very basic table">
                <tbody>
                    <tr>
                        <td class="table-th">價錢</td>
                        <td>
                            <% houseInfo[houseIndex].rent_price | number:0 %> / 月</td>
                    </tr>
                    <tr>
                        <td class="table-th">樓高</td>
                        <td>
                            <% houseInfo[houseIndex].floor %>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">戶數</td>
                        <td>
                            <% houseInfo[houseIndex].door %>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">房東性別</td>
                        <td>
                            <% houseInfo[houseIndex].landlord_gender.toString() | landlord_gender %>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">坪數</td>
                        <td>
                            <% houseInfo[houseIndex].space %>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">房型</td>
                        <td>
                            <% houseInfo[houseIndex].house_type.toString() | house_type %>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">安全設備 (滅火器、逃生口)</td>
                        <td>
                            <% houseInfo[houseIndex].safe | postcheckbox %>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">額外費用 (管理費)</td>
                        <td>
                            <% houseInfo[houseIndex].extra_pay | postcheckbox %>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">開伙</td>
                        <td>
                            <% houseInfo[houseIndex].cooking | postcheckbox %>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">房東滿意度</td>
                        <td>
                            <% houseInfo[houseIndex].landlord_score %> / 9
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">居住滿意度</td>
                        <td>
                            <% houseInfo[houseIndex].live_score %> / 9
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- 評論 -->
            <div class="ui piled segment">
                <h4 class="ui header">評論房東</h4>
                <p class="marker-text">
                    <% houseInfo[houseIndex].landlord_comment %>
                </p>
            </div>
            <div class="ui piled segment">
                <h4 class="ui header">居住心得</h4>
                <p class="marker-text">
                    <% houseInfo[houseIndex].live_comment %>
                </p>
            </div>

            <!-- 圖片 -->
            <div class="ui basic segment stackable three column grid">
                <div class="column" ng-repeat="pic in houseInfo[houseIndex].pictures">
                    <div class="ui card fluid">
                        <a class="ui" ng-click="house_view_images(pic)">
                            <div class="image-square bordered ui image" style="background-image: url(<% pic %>)"></div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="ui basic modal" id="house-view-images">
    <i class="close icon"></i>
    <div class="image content">
        <div class="ui Massive image centered">
            <img ng-src="<% image_zoom %>">
        </div>
    </div>
</div>

@endsection