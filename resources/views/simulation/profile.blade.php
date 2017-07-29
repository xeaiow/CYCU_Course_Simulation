@extends('layout.main') @section('pageTitle', $profile['userdata']['name']) @section('content') 

<div class="ui secondary pointing menu">
    <a class="active item"><i class="icon user"></i> 我</a>
    <a class="item" href="{{ url('/pass') }}"><i class="icon book"></i>學分計算</a>
    <a class="item"></a>
</div>

<!-- 已設定過 -->
@if ( count($profile['collections']) > 0 )

<!-- computer -->
<div class="ui stackable one column grid computer tablet only">
    <div class="column bg-1">
        <div class="ui grid">
            <div class="two wide column">
                <img class="ui small circular bordered image" src="{{ $profile['userdata']['photo'] }}">
            </div>
            <div class="fourteen wide column">
                <h2 class="ui header">
                    {{ $profile['userdata']['name'] }}
                </h2>
                <a href="https://fb.com/{{ $profile['userdata']['fb_id'] }}" target="_blank"><button class="ui circular basic icon button"><i class="facebook icon"></i></button></a>
                
                @if ( $profile['userdata']['email'] != null )
                    <a><button class="ui circular basic icon button"><i class="mail icon"></i> {{ $profile['userdata']['email'] }}</button></a>
                @endif

                @if ( $profile['userdata']['birthday'] != null )
                    <a><button class="ui circular basic icon button"><i class="birthday icon"></i> {{ $profile['userdata']['birthday'] }}</button></a>
                @endif

                <a><button class="ui circular basic icon button"><i class="tag icon"></i> {{ $profile['userdata']['identify']['department_name'] }}</button></a>
            </div>
        </div>
    </div>
</div>

<!-- mobile -->
<div class="ui grid mobile only">
    <div class="sixteen wide column">
        <div class="ui cards stackable">
            <div class="card">
                <div class="content">
                    <img class="right floated mini ui image" src="{{ $profile['collections']['photo'] }}">
                    <div class="header">

                        {{ $profile['collections']['name'] }} 

                        @if ( $profile['collections']['birthday'] != null )

                           / {{ $profile['collections']['birthday'] }}

                        @endif

                    </div>
                    <div class="meta">
                        {{ $profile['collections']['identify']['department_name'] }}
                    </div>
                    <div class="description">               
                        {{ $profile['collections']['email'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@else
<!-- 未設定過 -->
<div class="ui stackable one column grid computer tablet only">

    <div class="column bg-1">
        <div class="ui grid">
            <div class="two wide column">
                <img class="ui small circular bordered image" src="{{ $profile['userdata']['photo'] }}">
            </div>
            <div class="fourteen wide column">
                <h2 class="ui header">
                    {{ $profile['userdata']['name'] }}
                </h2>
                <a href="https://fb.com/{{ $profile['userdata']['fb_id'] }}" target="_blank"><button class="ui circular basic icon button"><i class="facebook icon"></i></button></a>
                
                @if ( $profile['userdata']['email'] != null )
                    <a><button class="ui circular basic icon button"><i class="mail icon"></i> {{ $profile['userdata']['email'] }}</button></a>
                @endif

                @if ( $profile['userdata']['birthday'] != null )
                    <a><button class="ui circular basic icon button"><i class="birthday icon"></i> {{ $profile['userdata']['birthday'] }}</button></a>
                @endif

            </div>
        </div>
    </div>  
</div>

<!-- mobile -->
<div class="ui grid mobile only">
    <div class="sixteen wide column">
        <div class="ui cards stackable">
            <div class="card">
                <div class="content">
                    <img class="right floated mini ui image" src="{{ $profile['userdata']['photo'] }}">
                    <div class="header">
                        {{ $profile['userdata']['name'] }}
                    </div>
                    <div class="meta">
                        {{ $profile['userdata']['birthday'] }}
                    </div>
                    <div class="description">
                        {{ $profile['userdata']['email'] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 設定系所 -->
<div class="column bg-1">
    <div class="ui grid">
        <div class="sixteen wide column">
            <h4 class="ui horizontal divider header">
                選擇系所後，方可使用修業計算功能
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
</div>

@endif

@endsection