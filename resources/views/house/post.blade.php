@extends('layout.main') @section('pageTitle', '新增屋子') @section('content')

<div class="ui grid stackable">
    <div class="seven wide column">
        <!-- 標題 -->
        <div class="ui form">
            <div class="field">
                <h3 class="ui header blue">標題</h3>
                <input type="text" ng-model="title" placeholder="中原大草皮">
            </div>
        </div>
        <!-- 地址 -->
        <div class="ui form margin-20">
            <div class="field">
                <h3 class="ui header blue">地址</h3>
                <input type="text" placeholder="桃園市中壢區中北路200號" ng-model="marker">
            </div>
        </div>
        <h3 class="ui header blue">資訊</h3>
        <!--價格-->
        <div class="ui right labeled input fluid">
            <label class="ui label">價格</label>
            <input type="text" ng-model="rent">
            <div class="ui basic label">月</div>
        </div>
        <!--樓高-->
        <div class="ui right labeled input fluid margin-20">
            <label class="ui label">樓高</label>
            <input type="text" ng-model="floor">
            <div class="ui basic label">樓</div>
        </div>
        <!--戶數-->
        <div class="ui right labeled input fluid margin-20">
            <label class="ui label">戶數</label>
            <input type="text" ng-model="door">
            <div class="ui basic label">戶</div>
        </div>
        <!--坪數-->
        <div class="ui right labeled input fluid margin-20">
            <label class="ui label">坪數</label>
            <input type="text" ng-model="space">
            <div class="ui basic label">坪</div>
        </div>
        <!--房東性別-->
        <select class="ui fluid dropdown margin-20" ng-model="landlord_gender">
            <option value="">房東性別</option>
            <option value="1">男</option>
            <option value="2">女</option>
        </select>
        <!--房型-->
        <select class="ui fluid dropdown margin-20" ng-model="house_type">
            <option value="">房型</option>
            <option value="1">套房</option>
            <option value="2">雅房</option>
            <option value="3">家庭式</option>
            <option value="4">酒店式公寓</option>
            <option value="5">摩天大樓</option>
            <option value="6">其他</option>
        </select>
        <!--規定-->
        <h3 class="ui header blue">規定</h3>
        <div class="ui form">
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" ng-model="safe" ng-true-value="1" ng-false-value="0">
                    <label>安全設備 (滅火器、灑水器等)</label>
                </div>
            </div>
        </div>
        <div class="ui form">
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" ng-model="extra_pay" ng-true-value="1" ng-false-value="0">
                    <label>額外費用</label>
                </div>
            </div>
        </div>
        <div class="ui form">
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" ng-model="cooking" ng-true-value="1" ng-false-value="0">
                    <label>開伙</label>
                </div>
            </div>
        </div>
        <!--滿意度-->
        <h3 class="ui header blue">滿意度</h3>
        <div class="ui right labeled input fluid margin-20">
            <label class="ui label">房東</label>
            <input type="text" ng-model="landlord_score" ui-mask="9">
            <div class="ui basic label">/ 9</div>
        </div>
        <div class="ui right labeled input fluid margin-20">
            <label class="ui label">居住</label>
            <input type="text" ng-model="live_score" ui-mask="9">
            <div class="ui basic label">/ 9</div>
        </div>
        <!-- 評論 -->
        <h3 class="ui header blue">評論房東</h3>
        <div class="ui form">
            <div class="field">
                <textarea ng-model="landlord_comment"></textarea>
            </div>
        </div>
        <!-- 評論 -->
        <h3 class="ui header blue">居住心得</h3>
        <div class="ui form">
            <div class="field">
                <textarea ng-model="live_comment"></textarea>
            </div>
        </div>

        <h3 class="ui header blue">圖片 (可多張)</h3>
        <button class="ui button fluid simulation-theme" id="house-browser-images"><i class="file white image outline icon"></i></button>
       
        <form ng-cloak method="post" class="house-imgur" enctype="multipart/images">
            {{ csrf_field() }}
            <input name="userImage" id="house-choose-image" type="file" accept="image/*">
            <input type="submit" id="house-upload-image" class="ui button blue" value="上傳">
        </form>

    </div>

    <!-- 弱弱的隔開 -->
    <div class="one wide column">
    </div>

    <div class="eight wide column">

        <h2 class="ui header">
            <i class="bookmark icon"></i>
            <div class="content">
                <% title %>
            </div>
        </h2>
        <h2 class="ui header">
            <i class="marker icon"></i>
            <div class="content">
                <% marker %>
            </div>
        </h2>
        <table class="ui very basic table">
            <tbody>
                <tr>
                    <td class="table-th">價錢</td>
                    <td>
                        <% rent | number:0 %> / 月</td>
                </tr>
                <tr>
                    <td class="table-th">樓高</td>
                    <td>
                        <% floor %>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">戶數</td>
                    <td>
                        <% door %>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">房東性別</td>
                    <td>
                        <% landlord_gender | landlord_gender %>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">坪數</td>
                    <td>
                        <% space %>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">房型</td>
                    <td>
                        <% house_type | house_type %>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">安全設備 (滅火器、逃生口)</td>
                    <td>
                        <% safe | checkbox %>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">額外費用 (管理費)</td>
                    <td>
                        <% extra_pay | checkbox %>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">開伙</td>
                    <td>
                        <% cooking | checkbox %>
                    </td>
                </tr>
                <tr>
                    <td class="table-th">房東滿意度</td>
                    <td>
                        <% landlord_score %> / 9
                    </td>
                </tr>
                <tr>
                    <td class="table-th">居住滿意度</td>
                    <td>
                        <% live_score %> / 9
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- 評論 -->
        <div class="ui piled segment">
            <h4 class="ui header">評論房東</h4>
            <p class="marker-text">
                <% landlord_comment %>
            </p>
        </div>
        <div class="ui piled segment">
            <h4 class="ui header">居住心得</h4>
            <p class="marker-text">
                <% live_comment %>
            </p>
        </div>

        <!-- 圖片 -->
        <div class="ui basic segment stackable four column grid" id="image-result"></div>

    </div>
    <div class="ui segment basic">
        <button class="ui button simulation-theme white fluid">發布</button>
    </div>
    

    <script>
        var images = new Array(); // 存放 imgur 回傳網址

        $(".house-imgur").on('submit', (function(e) {
            e.preventDefault();

            $.ajax({
                url: "//localhost/simulation/public/upload/image",
                type: "POST",
                dataType: 'json',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    var response = $.parseJSON(JSON.stringify(response));
                    
                    // 將網址存回陣列
                    images[images.length] = response;
                    $("#image-result").append(
                        '<div class="column" id="view-images-' + images.length + '">'+
                            '<div class="ui card fluid">'+
                                '<a class="ui left corner label">'+
                                    '<i class="remove red icon remove-image" id="' + images.length + '"></i>'+
                                '</a>'+
                                '<a class="ui">'+
                                    '<div class="image-square bordered ui image" style="background-image: url('+response+')"></div>'+
                                '</a>'+
                            '</div>'+
                        '</div>'
                    );
                    toastr["success"](" ", "上傳成功！")
                    console.log(images);
                },
                error: function() {
                    
                }
            });
        }));

        // auto choose image and upload
        $("#house-browser-images").click(function(){
            $("#house-choose-image").click();
        });
        
        $("#house-choose-image").change(function(){
            $("#house-upload-image").click();
            toastr["success"](" ", "上傳中！")
        });

        // remove image arrays el
        $(document).on('click', '.remove-image', function(){

            delete images[$(this).attr('id')-1];
            console.log(images);
            $("#view-images-"+$(this).attr('id')).remove();
        });
    </script>

    @endsection