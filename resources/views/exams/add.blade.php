@extends('layout.main') @section('content') @section('pageTitle', '考古題')


<div class="ui grid stackable">
    <div class="ui active dimmer" id="exams-uploading">
        <div class="ui massive text loader">Uploading...</div>
    </div>
    <div class="eight wide column">

        <form ng-cloak class="ui form exams-upload" method="post" enctype="multipart/form-data">

            <div class="ui form">
                <!-- 搜尋列 -->
                <h3 class="ui header blue">1. 適用課程*</h3>
                <div class="ui fluid input margin-bottom-20">
                    <input type="text" id="title" name="title" placeholder="課程 / 老師">
                </div>

                {{ csrf_field() }}
                <div class="field">
                    <h3 class="ui header blue">2. 選擇檔案*</h3>
                    <input type="file" id="filefield" name="filefield[]" multiple />
                </div>

                <div class="field">
                    <h3 class="ui header blue">3. 簡述</h3>
                    <textarea cols="30" name="description" rows="10"></textarea>
                </div>

                <div class="field">
                    <input type="submit" id="exams-upload-button" value="完成上傳" class="ui button simulation-theme white" />
                </div>
            </div>

        </form>
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
 
    $( document ).ready(function() {
        $("#exams-uploading").hide();
    });

    $(".exams-upload").on('submit', (function(e) {
        e.preventDefault();

        if (!$("#title").val() || !$("#filefield").val())
        {
            swal({
                title: "糟糕",
                text: "請至少填寫適用課程及上傳檔案。",
                type: "error",
                confirmButtonText: "知道了"
            });
            return false;
        }

        $("#exams-uploading").show();
        $("#exams-upload-button").prop("disabled", true); // Lock button

        $.ajax({
            url: "//localhost/simulation/public/exams/post/handle",
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
                    window.location.href = '//localhost/simulation/public/exams/' + response.url;
                }
            },
            error: function() {

            }
        });
    }));
</script>

@endsection()