<!DOCTYPE html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <style media="screen">
        .container {
            width: 500px;
            height: 250px;
            padding: 20px;
            border-radius: 7px;
            background-image: repeating-linear-gradient(135deg, #F29B91 0px, #F09290 30px, transparent 30px, transparent 50px, #83B3DB 50px, #84ADCB 80px, transparent 80px, transparent 100px);
        }
        .content {
            width: 500px;
            height: 250px;
            background-color: rgba(255, 255, 255, .9);
            padding: 7px;
        }
        .italic {
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="content">
            <div class="text">
                <p>同學您好：</p>
                <p>恭喜您成功認證身分，請點擊<a href="{{ url('/verify/') }}/{!! $token !!}">{{ url('/verify/') }}/{!! $token !!}</a>啟用</p>
                <p>開通後即可使用更多進階功能！</p>
                <p>如果不曾註冊，請您忽略這封信</p>
                <p class="right">- <span class="italic">xeee</span></p>
            </div>
        </div>
    </div>

</body>
</html>