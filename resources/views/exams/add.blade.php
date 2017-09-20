@extends('layout.main') @section('content') @section('pageTitle', '考古題')


<div class="ui grid stackable">
    
    <div class="eight wide column">

        <h4 class="ui horizontal divider header">
        <i class="cloud download icon"></i>檔案
        </h4>
        <!-- 檔案 -->
        <form ng-cloak class="ui form exams-upload" method="post" enctype="multipart/form-data">
            <div class="ui active dimmer" id="exams-uploading">
                <div class="ui tiny text loader">上傳中，請先填寫其他項目。</div>
            </div>
            {{ csrf_field() }}
            <div class="field exams-gd">
                <input type="file" id="filefield" name="filefield[]" multiple />
                <input type="submit" id="exams-upload-button" value="上傳" class="ui button simulation-theme white fluid" />
            </div>
        </form>

        <div class="ui form margin-top-less-80">
            <button class="ui button fluid grey" id="exams-browser-images"><i class="folder open white icon"></i></button>
        </div>
        
        <!-- 取得檔案 -->
        <div class="ui piled segment margin-top-less-10">
            <div class="ui stackable four column grid" id="file-result"></div>
        </div>

        <h4 class="ui horizontal divider header">
        <i class="book icon"></i>適用課程
        </h4>
        <div class="ui form">
            <!-- 選擇關鍵字 -->
            <div class="ui fluid input margin-bottom-20">
                <input type="text" id="title" ng-model="title" placeholder="課程 / 老師">
            </div>
        </div>

        <!-- 簡述 -->
        <h4 class="ui horizontal divider header">
        <i class="write icon"></i>簡述
        </h4>
        <div class="ui form">
            <div class="field">
                <textarea cols="30" ng-model="description" rows="10"></textarea>
            </div>
        </div>

         <div class="ui form margin-50">
            <div class="ui field">
                <button class="ui button simulation-theme white fluid" ng-click="exam_post()">發布</button>
            </div>
        </div>

    </div>

    <div class="eight wide column">
        <div class="ui styled accordion">
            <div class="active title">
                <i class="dropdown icon"></i> 何謂適用課程？
            </div>
            <div class="active content">
                <p>
                    欲上傳之考古題可能適用的課程，例如：程式、會計、電學..<br />
                    <ul>
                        <li>如有多種可能是用之課程，請用 | 隔開</li>
                        <li>例如：程式 | 會計 | 電學</li>
                    </ul>
                </p>
            </div>
            <div class="title">
                <i class="dropdown icon"></i> 上傳能幹嘛？
            </div>
            <div class="content">
                <p>造福學弟妹。</p>
            </div>
            <div class="title">
                <i class="dropdown icon"></i> 可以上傳那些格式？
            </div>
            <div class="content">
                <p>
                    任何格式皆可，且能批次上傳，以 PDF、DOC、XLS、PPT 為主
                </p>
            </div>
            <div class="title">
                <i class="dropdown icon"></i> 本功能宣告
            </div>
            <div class="content">
                <p>
                    本網站僅提供空間顯示資訊，不保證資訊完全正確，但會定期審查考古題資訊是否確實。
                </p>
            </div>
        </div>
    </div>

</div>


<script>
 
    // hide loading icon
    $( document ).ready(function() {
        $("#exams-uploading").hide();
    });

    // 上傳後回傳的檔案資訊
    var filename = new Array();
    var fileurl  = new Array();

    // ajax upload google driver api
    $(".exams-upload").on('submit', (function(e) {
        e.preventDefault();

        $.ajax({
            url: "//localhost/simulation/public/exams/img/post/handle",
            type: "POST",
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                var response = $.parseJSON(JSON.stringify(response));

                if (response.status === true)
                {
                    
                    $("#exams-uploading").hide();

                    $.each(response.url, function(i) {

                        $("#file-result").append(
                            '<div class="column">' + 
                                '<a target="_blank" href="https://drive.google.com/open?id=' + response.url[i] + '"><i class="icon big cloud download"></i> ' + response.filename[i] + '</a>'+
                            '</div>'
                        );

                        // 注入回傳的檔名跟網址結果
                        filename[i] = response.filename[i];
                        fileurl[i]  = response.url[i];
                    });
                    $("#filefield").val('');
                }
            },
            error: function() {

            }
        });
    }));

    // auto choose image and upload
    $("#exams-browser-images").click(function() {
        $("#filefield").click();
    });

    $("#filefield").change(function() {
        $("#exams-upload-button").click();
        $("#exams-uploading").show(); // show loading icon
    });

</script>

@endsection()