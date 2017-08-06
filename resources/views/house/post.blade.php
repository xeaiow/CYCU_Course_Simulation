@extends('layout.main') @section('pageTitle', '新增屋子') @section('content')

<div class="ui grid stackable">
    <!-- 標題 -->
    <div class="five wide column">
        <div class="ui form">
            <div class="field">
                <h4 class="ui horizontal divider header">
                    標題
                </h4>
                <input type="text" ng-model="title" placeholder="中原大草皮">
                <p ng-show="postTitle.length > 0" class="ng-hide">字數限制 <span ng-bind="postTitle.length" class="ng-binding"></span>/30</p>
            </div>
        </div>

        <!-- 價格 -->

        <h4 class="ui horizontal divider header">
            資料
        </h4>

        <div class="ui right labeled input fluid">
            <label class="ui label">價格</label>
            <input type="text" ng-model="rent">
            <div class="ui basic label">月</div>
        </div>

        <div class="ui right labeled input fluid margin-20">
            <label class="ui label">樓高</label>
            <input type="text" ng-model="floor">
            <div class="ui basic label">樓</div>
        </div>

        <div class="ui right labeled input fluid margin-20">
            <label class="ui label">戶數</label>
            <input type="text" ng-model="door">
            <div class="ui basic label">戶</div>
        </div>


        <select class="ui fluid dropdown margin-20">
            <option value="">選擇房型</option>
            <option value="1">套房</option>
            <option value="2">雅房</option>
            <option value="3">家庭式</option>
            <option value="4">酒店式公寓</option>
            <option value="5">摩天大樓</option>
            <option value="6">其他</option>
        </select>

        <div class="ui form margin-20">
            <div class="field">
                <h4 class="ui horizontal divider header">
                    地標
                </h4>
                <input type="text" placeholder="21 鐘">
                <p ng-show="postTitle.length > 0" class="ng-hide">字數限制 <span ng-bind="postTitle.length" class="ng-binding"></span>/30</p>
            </div>
        </div>

        <h4 class="ui horizontal divider header">
            規定
        </h4>
        <div class="ui form">
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="example">
                    <label>安全設備 (滅火器、灑水器等)</label>
                </div>
            </div>
        </div>
        <div class="ui form">
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="example">
                    <label>額外費用</label>
                </div>
            </div>
        </div>
        <div class="ui form">
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="example">
                    <label>開伙</label>
                </div>
            </div>
        </div>

        <h4 class="ui horizontal divider header">
            滿意度
        </h4>
        <h4 class="ui header">房東</h4>
        <div class="ui star rating"></div>
        <h4 class="ui header">居住</h4>
        <div class="ui star rating"></div>
    </div>

    <div class="eleven wide column">

        <h1 class="ui header">
            <% title %>
        </h1>
        <table class="ui very basic table">
            <tbody>
                <tr>
                    <td class="table-th">價錢</td>
                    <td>
                        <% rent | number:0 %> / 月</td>
                </tr>
                <tr>
                    <td class="table-th">樓高</td>
                    <td>
                        <% floor %>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">戶數</td>
                    <td>
                        <% door %>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">房東滿意度</td>
                    <td>
                        <rating id="my-rating" size="large" type="heart" ng-model="rating"></rating>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">居住滿意度</td>
                    <td>
                        <rating id="my-rating" size="large" type="heart" ng-model="rating"></rating>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">房東性別</td>
                    <td>男</td>
                </tr>
                <tr>
                    <td class="table-th">附近地標</td>
                    <td>21鐘</td>
                </tr>
                <tr>
                    <td class="table-th">額外費用 (管理費)</td>
                    <td>600</td>
                </tr>
                <tr>
                    <td class="table-th">房屋類型</td>
                    <td>無</td>
                </tr>
                <tr>
                    <td class="table-th">居住人數</td>
                    <td>雙人</td>
                </tr>
                <tr>
                    <td class="table-th">安全設備 (滅火器、逃生口)</td>
                    <td>有</td>
                </tr>
                <tr>
                    <td class="table-th">開伙</td>
                    <td>不可</td>
                </tr>
            </tbody>
        </table>

        <!-- 評論 -->
        <div class="ui piled segment">
            <h4 class="ui header">評論房東</h4>
            <p>
                她兒子會從窗戶跑進房間偷錢。明明不是我的電費，也叫我分攤。常常說謊騙人，環境髒亂，老鼠蟑螂很多。整天大叫罵人。
            </p>
        </div>
        <div class="ui piled segment">
            <h4 class="ui header">居住心得</h4>
            <p>
                很開心
            </p>
        </div>

        <!-- google map -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3617.2859675646937!2d121.23763801821511!3d24.95638338825835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2adee07c063e88d1!2z5Lit5Y6f5aSc5biC!5e0!3m2!1szh-TW!2stw!4v1501491266363"
            width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>

    </div>

    @endsection