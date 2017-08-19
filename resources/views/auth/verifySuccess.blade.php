@extends('layout.main') @section('content') @section('pageTitle', '認證啟用成功')

<div class="ui grid stackable">
    <div class="sixteen wide column">

        <h2 class="ui center aligned icon header">
            <i class="handshake icon"></i> 您現在可以使用更多功能了！
        </h2>

        <h4 class="ui horizontal divider header"><i class="ui icon mouse pointer"></i></h4>

        <div class="ui grid">
            <div class="five wide column">
                <h2 class="ui header">
                    <i class="home icon"></i>
                    <div class="content">
                        <a href="{{ url('/house') }}">租屋資訊</a>
                    </div>
                </h2>
                <div class="ui bulleted list">
                    <div class="item">瀏覽其他同學分享的租屋資訊</div>
                    <div class="item">分享曾經租屋經驗</div>
                    <div class="item">評論租屋資訊</div>
                </div>
            </div>
            <div class="five wide column">
                <h2 class="ui header">
                    <i class="bookmark icon"></i>
                    <div class="content">
                        <a href="{{ url('/') }}">考古題</a>
                    </div>
                </h2>
                <div class="ui bulleted list">
                    <div class="item">關鍵字搜尋想要的科目</div>
                    <div class="item">提供您覺得值得參考的重點</div>
                    <div class="item">請求想要的考古題</div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection