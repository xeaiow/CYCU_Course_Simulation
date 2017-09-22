@extends('layout.main') @section('pageTitle', '認證') @section('content')

<div class="ui grid stackable">
    <div class="eight wide column">
        <form class="ui form" method="POST" action="{{ url('/verify') }}">

            {{ csrf_field() }}

            <div class="field">
                <label>校園信箱</label>
                <input type="email" name="email">
            </div>

            @if ( $errors->first('email') )
            <div class="ui negative message">
                <i class="close icon"></i>
                <div class="header">
                    {{ $errors->first('email') }}！
                </div>
            </div>
            @endif

            <input class="ui button simulation-theme white fluid" type="submit" value="認證" onclick="this.disabled=true;this.form.submit();">
        </form>
    </div>

    <div class="eight wide column">
        <div class="ui styled accordion">
            <div class="active title">
                <i class="dropdown icon"></i> 為什麼要認證？
            </div>
            <div class="active content">
                <p>
                    由於只開放中原大學周邊租屋，由該校學生張貼為主，透過認證後，資訊才有一定真實度。<br />
                    <ul>
                        <li>校園信箱格式：s+學號@cycu.edu.tw</li>
                        <li>校園 gmail 信箱格式：自訂+cycu.org.tw</li>
                        <li>一組校園信箱只能認證乙次</li>
                        <li><a href="https://mail.cycu.edu.tw/indexi2.html">進入校園信箱</a></li>
                        <li><a href="https://www.google.com/gmail/">進入校園 gmail 信箱</a></li>
                    </ul>
                </p>
            </div>
            <div class="title">
                <i class="dropdown icon"></i> 認證後我能看見什麼？
            </div>
            <div class="content">
                <p>經過校園信箱認證後，您可預覽大家提供的資訊，當然您也能參與張貼租屋資訊</p>
            </div>
            <div class="title">
                <i class="dropdown icon"></i> 該網站的資訊可信度？
            </div>
            <div class="content">
                <p>
                    本網站僅提供空間展示租屋資訊及心得，不保證資訊完全正確，但會定期審查租屋資訊是否確實。
                    <br />
                    <ul>
                        <li>賃租者覺得房東人不錯，剛好要搬離，想推廣或找人接手</li>
                        <li>對於房東或房屋有些心得，想分享給大家</li>
                        <li>對於該房東行為有所不滿，避免其他同學遭害</li>
                    </ul>
                </p>
            </div>
            <div class="title">
                <i class="dropdown icon"></i> 為何收不到信？
            </div>
            <div class="content">
                <p>
                    收不到信的原因可能為以下幾種：
                    <br />
                    <ul>
                        <li>校園信箱後綴分為兩種 "cycu.org.tw" 及 "cycu.edu.tw" 請仔細檢查是否輸入錯誤</li>
                        <li>校園信箱信件已滿，請騰出空間</li>
                        <li>尚未設定校園信箱功能，請參考 <a target="_blank" href="http://fm.cycu.edu.tw/main_n_04.html?type=B">新生 1 網通</a></li>
                    </ul>
                </p>
            </div>
        </div>
    </div>

</div>

@endsection