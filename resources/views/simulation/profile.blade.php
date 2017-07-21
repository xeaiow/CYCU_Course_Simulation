@extends('layout.main') @section('content') @if ( count($profile['collections']) > 0 )

<div class="ui grid stackable computer only">
    <div class="sixteen wide column profile-bg">
        <div class="ui link cards attached">
            <div class="ui image tiny margin-right-20">
                <img src="{{ $profile['collections']['photo'] }}">
            </div>
            <h1 class="ui header">{{ $profile['collections']['name'] }} - {{ $profile['collections']['identify']['department_name'] }}</h1>
        </div>
    </div>
</div>

<div class="ui grid mobile only">
    <div class="sixteen wide column">
        <div class="ui cards stackable">
            <div class="card">
                <div class="content">
                    <img class="right floated mini ui image" src="{{ $profile['collections']['photo'] }}">
                    <div class="header">
                        {{ $profile['collections']['name'] }}
                    </div>
                    <div class="meta">
                        {{ $profile['collections']['identify']['department_name'] }}
                    </div>
                    <div class="description">
                        {{ $profile['collections']['birthday'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else

<div class="ui grid stackable computer only">
    <div class="sixteen wide column profile-bg">
        <div class="ui link cards attached">
            <div class="ui image tiny margin-right-20">
                <img src="{{ $profile['userdata']['photo'] }}">
            </div>
            <h1 class="ui header">{{ $profile['userdata']['name'] }}</h1>
        </div>
    </div>
</div>

<div class="ui grid">
    <div class="sixteen wide column">
        <h4 class="ui horizontal divider header">
            <i class="icon calculator"></i>選擇您的系所後，即可使用修業計算功能
        </h4>
        <select class="ui fluid dropdown" ng-model="department_id">
            <option value="">選擇系所</option>
            <option value="1">應用數學系</option>
            <option value="2">物理學系</option>
            <option value="3">化學系</option>
            <option value="4">心理學系</option>
            <option value="5">生物科技學系</option>
            <option value="6">化學工程學系</option>
            <option value="7">土木工程學系</option>
            <option value="8">機械工程學系</option>
            <option value="9">生物醫學工程學系</option>
            <option value="10">環境工程學系</option>
            <option value="11">企業管理學系</option>
            <option value="12">國際經營與貿易學系</option>
            <option value="13">會計學系</option>
            <option value="14">資訊管理學系</option>
            <option value="15">財務金融學系</option>
            <option value="16">建築學系</option>
            <option value="17">商業設計學系</option>
            <option value="18">室內設計學系</option>
            <option value="19">景觀學系</option>
            <option value="20">特殊教育學系</option>
            <option value="21">應用外國語文學系</option>
            <option value="22">應用華語學系</option>
            <option value="23">財經法律學系</option>
            <option value="24">工業與系統工程學系</option>
            <option value="25">電子工程學系</option>
            <option value="26">資訊工程學系</option>
            <option value="27">電機工程學系</option>
        </select>

        <div class="ui segment basic">
            <button class="ui button facebook right floated" ng-click="setDepartment()">設定</button>
        </div>
    </div>
</div>
@endif
<div class="ui grid">
    <div class="sixteen wide column">
        @if ( $profile['isImport'] == 0 )
        <h4 class="ui horizontal divider header">
            <i class="icon book"></i>已修習課程
        </h4>

        <div class="ui segment basic">
            <button class="ui google plus button right floated" onclick="window.location.href='{{ url('/import') }}'">匯入</button> @else
        </div>


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
                    <th>類別</th>
                    <th>名稱</th>
                    <th>必選修</th>
                    <th>成績</th>
                    <th>學分數</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="item in history_course_list">
                    <td>
                        <% item.YEAR_TERM %>
                    </td>
                    <td>
                        <% item.DEPT_ABVI_C %>
                    </td>
                    <td>
                        <% item.CURS_NM_C_S %>
                    </td>
                    <td>
                        <% item.OP_STDY_DEPT %>
                    </td>
                    <td>
                        <% item.SCORE_FNAL %>
                    </td>
                    <td>
                        <% item.OP_CREDIT %>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    @endif
</div> @endsection