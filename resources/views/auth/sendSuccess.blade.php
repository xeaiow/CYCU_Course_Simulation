@extends('layout.main')

@section('content')

@section('pageTitle', '已傳送認證信')

<style>
    h2.success{
        font-size:22px;
        color:#8F9945;
        padding:0px;
        margin-bottom:5px
        margin-top:15px;
        font-weight:lighter;
    }
    h2.error{
        font-size:22px;
        color:#DD332E;
        padding:0px;
        margin-bottom:5px;
        margin-top:15px;
        font-weight:lighter;
    }
    p{
        font-size:14px;
        color:#666;
        padding:0px;
        margin:0px;line-height:16px;
    }
    .clear{clear:both;}
    .container{
        width:629px;
        margin-left:auto;
        margin-right:auto;
        margin-top:10%;
    }
    .message-box{
        background:#fff url(https://s3.amazonaws.com/flashypublic/mail-header-bg.png) no-repeat top left;
        padding-top:40px;
        padding-bottom:20px;
        padding-left:20px;
        padding-right:20px;
        border-bottom-left-radius:7px;
        border-bottom-right-radius:7px;
        -moz-border-radius-bottomleft:7px;
        -moz-border-radius-bottomright:7px;
    }
    .message-shadow{
        background:transparent url(https://s3.amazonaws.com/flashypublic/mail-footer-bg.png) no-repeat center top;
        height:24px;
        clear:both;
    }
    .message-icon{
        float:left;
        width:80px;
        display:inline;
        margin-right:25px;
    }
    .message-content{
        float:left;
        display:inline;
        width:484px;
    }
    .logo{
        width:131px;margin-left:auto;
        margin-right:auto;
        padding-bottom:35px;
    }
</style>


<div class="container">
	<div class="logo"></div>
	<div class="message-box">
		<div class="message-icon">
			<img src="https://s3.amazonaws.com/flashypublic/mail-delivery-success.png" width="80" height="81" alt="success">
		</div>
	<div class="message-content">
		<h2 class="success">已傳送認證信！請查收校園信箱</h2>
		<p>
        校園信箱有兩個，請注意您當時填寫的後綴，完成認證後即可使用更多功能。<br />
        <ul>
            <li><a href="https://mail.cycu.edu.tw/indexi2.html">進入 cycu.edu.tw 收信</a></li>
            <li><a href="https://www.google.com/gmail/">進入 cycu.org.tw 收信</a></li>
        </ul>
        </p>
	</div>
	<div class="clear"></div>
	</div>
	<div class="message-shadow"></div>
</div>

@endsection