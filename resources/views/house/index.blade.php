@extends('layout.main') @section('pageTitle', '找屋子') @section('content')

<div class="ui grid stackable">
    <div class="seven wide column">

        <!-- 搜尋列 -->
        <div class="ui fluid icon input">
            <input type="text" ng-model="keywords" placeholder="路段 / 地標" press-Enter="search()">
            <i class="search icon"></i>
        </div>

        <!-- 搜尋結果 -->
        <div class="lists-max-height">
            <div class="ui card fluid">
                <div class="content">
                    <div class="header">
                        中原校門大草皮 /
                        <div class="ui rating" data-max-rating="3"></div>
                    </div>
                    <div class="description">
                        <img src="http://thumb.s3.hicloud.net.tw/0017388/A1.jpg" alt="">
                    </div>
                </div>
                <div class="extra content">
                    <span class="left floated like">
                            <i class="marker icon"></i>桃園市中壢區新中北路一段
                        </span>
                    <span class="right floated star">
                            $2,000 / 月
                        </span>
                </div>
                <div class="ui bottom attached button" ng-click="addCourse(item.course_id , item.course_name, item.teacher, item.time_1, item.time_2, item.time_3, item.com_or_opt, item.point, item.class)">
                    <i class="hand pointer icon"></i>看看
                </div>
            </div>
        </div>

    </div>
    <div class="nine wide column">

        <h1 class="ui header">中原校門大草皮</h1>
        <table class="ui very basic table">
            <tbody>
                <tr>
                    <td class="table-th">價錢</td>
                    <td>$6,500 / 月</td>
                </tr>
                <tr>
                    <td class="table-th">樓高</td>
                    <td>7</td>
                </tr>
                <tr>
                    <td class="table-th">戶數</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td class="table-th">房東滿意度</td>
                    <td>
                        <div class="ui star rating" data-rating="3"></div>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">居住滿意度</td>
                    <td>
                        <div class="ui star rating" data-rating="2"></div>
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
</div>

<script>
    $('.ui.rating').rating({
        initialRating: 3,
        maxRating: 5,
        interactive: false
    });
</script>

@endsection