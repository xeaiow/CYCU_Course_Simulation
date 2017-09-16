@extends('layout.main') @section('content') @section('pageTitle', '考古題')


<div class="ui grid stackable">
    <div class="eight wide column">

        <!-- 考古題資訊 -->
        <div class="ui segment basic">
            <h2 class="ui header">
                <i class="bookmark icon"></i>
                <div class="content">
                    {{ $profile['exams']['title'] }}
                </div>
            </h2>
            <h2 class="ui header">
                <i class="cloud download icon"></i>
                <div class="content">
                    {{ @count( $profile['exams']['filename'] ) }} 個檔案
                </div>
            </h2>
        </div>

        <!-- 描述 -->
        <div class="ui piled segment">
            描述：{{ $profile['exams']['description'] }}
        </div>

        <!-- 取得檔案 -->
        <div class="ui piled segment">
            <div class="ui stackable four column grid">
            <?php $index=1 ?>
            @foreach ( $profile['exams']['url'] as $item)
                <div class="column">
                    <a href="https://drive.google.com/open?id={{ $item }}"><i class="icon big cloud download"></i> 檔案 {{ $index }}</a>
                    <?php $index++ ?>
                </div>
            @endforeach
            </div>
        </div>

        <!-- 掃毒提示 -->
        <div class="ui warning message">
            <i class="close icon"></i>
            下載檔案後務必掃毒。
        </div>

    </div>
    
    <!-- FB comment -->
    <div class="eight wide column">
        <div class="fb-comments" data-href="{{ url('/exams') }}/{{ $profile['exams']['_id'] }}" data-numposts="5"></div>
    </div>

</div>

@endsection()