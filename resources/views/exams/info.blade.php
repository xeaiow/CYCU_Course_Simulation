@extends('layout.main') @section('content') @section('pageTitle', $profile['exams']['title'])

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
            </div>

            <h4 class="ui horizontal divider header">
            <i class="write icon"></i>描述
            </h4>

            <!-- 描述 -->
            <div class="ui piled segment">
                {{ $profile['exams']['description'] }}
            </div>

            <h4 class="ui horizontal divider header">
            <i class="disk outline icon"></i> {{ @count( $profile['exams']['filename'] ) }} 個檔案
            </h4>
            <!-- 取得檔案 -->
            <div class="ui piled segment">
                <div class="ui stackable four column grid">
                <?php $index=1 ?>
                @foreach ( $profile['exams']['url'] as $item)
                    <div class="column">
                        <a target="_blank" href="https://drive.google.com/open?id={{ $item }}"><i class="icon big cloud download"></i> 檔案 {{ $index }}</a>
                        <?php $index++ ?>
                    </div>
                @endforeach
                </div>
            </div>

        </div>
        
        <!-- FB comment -->
        <div class="eight wide column">
            <div class="fb-comments" data-href="{{ url('/exams') }}/{{ $profile['exams']['_id'] }}" data-numposts="5"></div>
        </div>

    </div>

@endsection()