@extends('layout.main')

@section('content')
@section('pageTitle', '考古題')


<div class="ui grid stackable">
    <div class="seven wide column">
        
        <form ng-cloak action="{{ url('/exams/add') }}" class="ui form" id="exams-upload" method="post" enctype="multipart/form-data">
            
            <div class="ui form">
                <!-- 搜尋列 -->
                <h3 class="ui header blue">1. 搜尋適用課程</h3>
                <div class="ui fluid icon input margin-bottom-20">
                    <input type="text" ng-model="keywords" placeholder="課程 / 老師" press-Enter="search()">
                    <i class="search icon"></i>
                </div>

                {{ csrf_field() }}
                <div class="field">
                    <h3 class="ui header blue">2. 選擇檔案</h3>
                    <input type="file" name="filefield" />
                </div>

                <div class="field">
                    <h3 class="ui header blue">3. 說明</h3>
                    <textarea cols="30" rows="10"></textarea>
                </div>

                <div class="field">
                    <input type="submit" value="完成上傳" class="ui button simulation-theme white" />
                </div>
            </div>
        
        </form>
    </div>
</div>


    <script>

        $(".exams-upload").on('submit', (function(e) {
            e.preventDefault();

            $.ajax({
                url: "//localhost/simulation/public/exams/add",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var response = $.parseJSON(JSON.stringify(response));

                    console.log(response);
                },
                error: function() {

                }
            });
        }));

    </script>

@endsection()