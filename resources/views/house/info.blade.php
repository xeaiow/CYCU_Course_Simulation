@extends('layout.main') @section('pageTitle', $profile['house']['title']) @section('content')

<div class="ui grid stackable">
    <div class="ui eight wide column">
        <div class="ui segment basic">
            <h2 class="ui header">
                <i class="bookmark icon"></i>
                <div class="content">
                    {{ $profile['house']['title'] }}
                </div>
            </h2>
            <h2 class="ui header">
                <i class="marker icon"></i>
                <div class="content">
                    {{ $profile['house']['marker'] }}
                </div>
            </h2>
            <table class="ui very basic table">
                <tbody>
                    <tr>
                        <td class="table-th">價錢</td>
                        <td>
                            {{ $profile['house']['rent_price'] }} / 月
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">樓高</td>
                        <td>
                            {{ $profile['house']['floor'] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">戶數</td>
                        <td>
                            {{ $profile['house']['door'] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">坪數</td>
                        <td>
                            {{ $profile['house']['space'] }}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">房東性別</td>
                        <td>
                            {{ ( $profile['house']['landlord_gender'] == 1 ? "男" : "女" ) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">房型</td>
                        <td>
                            @php
                                switch ( $profile['house']['house_type'] ) {
                                    case 1:
                                        echo "套房";
                                        break;
                                    case 2:
                                        echo "雅房";
                                        break;
                                    case 3:
                                        echo "家庭式";
                                        break;
                                    case 4:
                                        echo "酒店式公寓";
                                        break;
                                    case 5:
                                        echo "摩天大樓";
                                        break;
                                    case 6:
                                        echo "其他";
                                        break;
                                    default:
                                        
                                    break;
                                }
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">安全設備 (滅火器、逃生口)</td>
                        <td>
                            {{ ( $profile['house']['safe'] == true ? "是" : "否" ) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">額外費用 (管理費)</td>
                        <td>
                            {{ ( $profile['house']['extra_pay'] == true ? "是" : "否" ) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">開伙</td>
                        <td>
                            {{ ( $profile['house']['cooking'] == true ? "是" : "否" ) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">房東滿意度</td>
                        <td>
                            @for ($i = 0; $i < $profile['house']['landlord_score']; $i++) 
                                ✦
                            @endfor
                        </td>
                    </tr>
                    <tr>
                        <td class="table-th">居住滿意度</td>
                        <td>
                            @for ($i = 0; $i < $profile['house']['live_score']; $i++) 
                                ✦
                            @endfor
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="eight wide column">
        <div class="fb-comments" data-href="{{ url('/house') }}/{{ $profile['house']['_id'] }}" data-numposts="5"></div>
        <div class="fb-like" data-href="{{ url('/house') }}/{{ $profile['house']['_id'] }}" data-layout="button" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
    </div>
    

    <h4 class="ui horizontal divider header"><i class="map pin icon"></i>地圖</h4>
    <!-- 地圖 -->
    <div class="sixteen wide column">
        <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=http://maps.google.com.tw/maps?f=q&hl=zh-TW&geocode=&q={{ $profile['house']['marker'] }}&z=16&output=embed&t=></iframe>
    </div>

    <h4 class="ui horizontal divider header"><i class="comments icon"></i>心得</h4>
    <!-- 心得 -->
    <div class="sixteen wide column">
        <div class="ui piled segment">
            <h4 class="ui header">評論房東</h4>
            <p class="marker-text">
                {{ $profile['house']['landlord_comment'] }}
            </p>
        </div>
        <div class="ui piled segment">
            <h4 class="ui header">居住心得</h4>
            <p class="marker-text">
                {{ $profile['house']['live_comment'] }}
            </p>
        </div>

        <h4 class="ui horizontal divider header"><i class="image icon"></i>照片</h4>
        
        <!-- 圖片 -->
        <div class="ui basic segment stackable two column grid">
        @if ($profile['house']['pictures'])
            @foreach ($profile['house']['pictures'] as $img)
                <div class="column">
                    <div class="ui card fluid" ng-click="house_view_images('{{ $img }}')">
                        <a class="ui">
                            <div class="image-square bordered ui image" style="background-image: url({{ $img }})"></div>
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="ui info message">
                <div class="header">
                    很抱歉，本資訊尚未提供圖片。
                </div>
            </div>
        @endif
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

<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.10&appId=452934435085965";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

@endsection