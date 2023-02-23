<?php
error_reporting(0);
header("Content-type: text/html; charset=utf-8");	
/**
 * 检验私密页面的密码
 *
 * 使用方法,在有需要的加密的页面最开始补充下面这行代码
 *
 * <?php
 *  include('pass.php');
 * ?>
 *
 * 然后把本页代码命名为pass.php即可.
 *  
 *  PS:需要退出登录就直接在页面的后面加入请求password.php?action=logout
 */
$page_pwd = md5('y362227'); //你要设置的密码
$page_cookname = 'my-page-password'; //你要设置的cookie名
$page_now = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
$action = @$_GET['action'];
$page_postpwd = @$_POST['page_pwd'];
$page_cookiepwd = @$_COOKIE["$page_cookname"];
$page_cookietime = time() + 60 * 60 * 24 * 120; //120天
//输出网页的头部
$head =  '
    <head>
    <meta charset="utf-8">
    <title>管理员验证丨游客禁止访问</title>
    
    <script src="https://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script>
$(function() {

    var myDate = new Date;
    var date = myDate.getDate();
    console.log(date);
    if(date==4){
        $("#xiaojiang").html("html{-webkit-filter:grayscale(100%);-moz-filter:grayscale(100%);-ms-filter:grayscale(100%);-o-filter:grayscale(100%)}");
    }
   
})
</script>
<style id="xiaojiang"></style>
    <meta content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no,minimal-ui" name="viewport" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta content="telephone=no" name="format-detection" />  
    <meta content="email=no" name="format-detection" />
    <meta name="apple-mobile-web-app-title" content="私人页面"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta content="telephone=no" name="format-detection"/>
    <style>
	  .vaptcha-init-main {
	    display: table;
	    width: 100%;
	    height: 100%;
	    background-color: #EEEEEE;
	  }
	
	  .vaptcha-init-loading {
	    display: table-cell;
	    vertical-align: middle;
	    text-align: center
	  }
	
	  .vaptcha-init-loading>a {
	    display: inline-block;
	    width: 18px;
	    height: 18px;
	    border: none;
	  }
	
	  .vaptcha-init-loading>a img {
	    vertical-align: middle
	  }
	
	  .vaptcha-init-loading .vaptcha-text {
	    font-family: sans-serif;
	    font-size: 12px;
	    color: #CCCCCC;
	    vertical-align: middle
	  }
	</style>
    <style>
    .botCenter{width:100%; height:35px; line-height:35px; background:#4ca6af00; position:fixed; bottom:0px; left:0px; font-size:12px; color:#000; text-align:center;}
    body{
    	background:url(/bg.png);
    }
    </style>
        <link rel="stylesheet" href="./pass.css">
        <script src="https://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
        <script src="https://lib.sinaapp.com/js/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">body,button,input,select,textarea,h1,h2,h3,h4,h5,h6 {
            font-family: Microsoft YaHei, "宋体", Tahoma, Helvetica, Arial, "\5b8b\4f53", sans-serif;
        }
    </style>
';

//退出登录
if ($action == "logout") {
    setcookie($page_cookname, "", time() - 1);
    echo '
    <meta http-equiv="refresh" content="1";URL='.$page_now.'>

    </head>
    <body>
    <div class="container-fluid">

    <p>退出成功,1秒后自动跳转</p>
    <a role="button" class="btn btn-success" href='.$page_now.'>点此马上跳转</a>

    </div>
    </body>
    </html>
    ';
    exit;
}

//有输入密码
if ($page_postpwd != "") {
    //密码错误
  if (md5("$page_postpwd") != $page_pwd) {
      echo $head;
      echo '

            <meta http-equiv="refresh" content="1";URL='.$page_now.'>
            </head>
            <body>
            <div class="container-fluid"><center><br><br>
             <a role="button" class="btn btn-danger" >密码错误,1秒后自动跳转</a>
                </center>
            </div>
            </body>
            </html>
            ';
        exit;
    }
    //密码正确
    else {
        //设置Cookies
        setcookie($page_cookname, md5("$page_postpwd"), $page_cookietime);
        echo $head;
        echo '
            <meta http-equiv="refresh" content="1";URL='.$page_now.'>
            </head>
            <body>
            <div class="container-fluid"><center><br><br>
             <a role="button" class="btn btn-success" >密码正确,1秒后自动跳转</a>
                </center>
            </div>
            </body>
            </html>
            ';
        exit;
    }
}
//没输入密码
if ($page_cookiepwd != $page_pwd) {
    echo $head;
    echo '
        </head>
        <body scroll="no" style="overflow-x:hidden;overflow-y:hidden;">
        <div class="row text-center vertical-middle-sm">
        <div class="col-sm-12">
        <div class="container-fluid">
        <br> <br> <br>
      
              <h5 id="mmts">本站仅做测试暂不对外开放</h5>
        <br>
        <form method="POST">
            <div class="form-group">
        <input type="text" class="form-control" name="page_pwd" placeholder="请输入管理员密码">
		<br/>
        <button type="submit" class="btn btn-success" >确认</button>
        </div>
        </div>
        </div>
        </form>
        </div>
        <div id="dibu" class="botCenter">
        2021-2022
		</div>
		<script>
		 function updatas(){
			$("#mmts").html(unescape("%3Ch4%3EAPP%u7528%u6237%u4E13%u4EAB%u63D0%u793A%3C/h4%3E%u6700%u65B0%u5BC6%u7801%uFF1A666"));
		  }
		</script>
        </body>
        </html>
        ';
    exit;
}
?>







<a class="anniu1" align="left" href="http://207.246.87.236:8088/?pgsql=207.246.87.236&username=dbadmin&db=%E7%99%BE%E5%BA%A6%E7%BD%91%E7%9B%98&ns=public&sql=">
        后台管理
</a>

 



<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    
    
    
<title>百度网盘数据库查询</title>
	
	

	
	
	
 
	
	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript">
    //记忆刷新页面之前的选择
src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"
 
        getTitleData=function(){
            var 账户 = $("#账户").val();
            var 账户 = $.trim(账户);
 
           // window.location = 'history.php?id=' + mvorlive;
            document.cookie = "id=" + 账户;    //将select选中的value写入cookie中
        };
        
        selectIndex=function(){
            var id = 0;
            var coosStr = document.cookie;    //获取cookie中的数据
            var coos=coosStr.split("; ");     //多个值之间用; 分隔
            for(var i=0;i<coos.length;i++){   //获取select写入的id
                var coo=coos[i].split("=");
                if("id"==coo[0]){
                 id=coo[1];
              }
            }
            var stitle=document.getElementById("账户");
            if(stitle == 0){
                stitle.selectedIndex = 0;
            }
            else{    //如果从cookie中获取的id和select中的一致则设为默认状态
                var len = stitle.options.length;
                for(var i=0;i<len;i++){
                    if(stitle.options[i].value == id){
                        stitle.selectedIndex=i;
                        break;
                    }
                }
            }
           
        }
 
      </script>	
	
	
	
	
	
	
	
	
	
	
	
 
	
	
	
	
	
	
	

	
 <style>
input::-webkit-input-placeholder,
textarea::-webkit-input-placeholder {
    border-radius: 15px;

    color: #aab2bd;
    font-size: 11px;  
}
</style>

	
<style>
body{
	background-color:#EAECEE;
	font-family:Arial;
	color:black;
}
.box{
    border-radius: 5px;
	border: 1px solid;
	min-width:50px;
	margin:auto;
}

        label{
            cursor: pointer;
            display: inline-block;
            padding: 3px 6px;
            vertical-align:middle;
            text-align: right;
	    min-width:150px;
            vertical-align: top;
        }

        
.button::-moz-focus-inner{
  border: 0;
  padding: 0;
}

.button{
  display: inline-block;
  *display: inline;
  zoom: 1;
  padding: 6px 20px;
  margin: 0;
  cursor: pointer;
  border: 1px solid #bbb;
  overflow: visible;
  font: bold 13px arial, helvetica, sans-serif;
  text-decoration: none;
  white-space: nowrap;
  color: #555;
  
  background-color: #ddd;
  background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255,255,255,1)), to(rgba(255,255,255,0)));
  background-image: -webkit-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
  background-image: -moz-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
  background-image: -ms-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
  background-image: -o-linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
  background-image: linear-gradient(top, rgba(255,255,255,1), rgba(255,255,255,0));
  
  -webkit-transition: background-color .2s ease-out;
  -moz-transition: background-color .2s ease-out;
  -ms-transition: background-color .2s ease-out;
  -o-transition: background-color .2s ease-out;
  transition: background-color .2s ease-out;
  background-clip: padding-box; /* Fix bleeding */
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  -moz-box-shadow: 0 1px 0 rgba(0, 0, 0, .3), 0 2px 2px -1px rgba(0, 0, 0, .5), 0 1px 0 rgba(255, 255, 255, .3) inset;
  -webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, .3), 0 2px 2px -1px rgba(0, 0, 0, .5), 0 1px 0 rgba(255, 255, 255, .3) inset;
  box-shadow: 0 1px 0 rgba(0, 0, 0, .3), 0 2px 2px -1px rgba(0, 0, 0, .5), 0 1px 0 rgba(255, 255, 255, .3) inset;
  text-shadow: 0 1px 0 rgba(255,255,255, .9);
  
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.button:hover{
  background-color: #eee;
  color: #555;
}

.button:active{
  background: #e9e9e9;
  position: relative;
  top: 1px;
  text-shadow: none;
  -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, .3) inset;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .3) inset;
  box-shadow: 0 1px 1px rgba(0, 0, 0, .3) inset;
}

.button[disabled], .button[disabled]:hover, .button[disabled]:active{
  border-color: #eaeaea;
  background: #fafafa;
  cursor: default;
  position: static;
  color: #999;
  /* Usually, !important should be avoided but here it's really needed :) */
  -moz-box-shadow: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  text-shadow: none !important;
}

/* Smaller buttons styles */

.button.small{
  padding: 4px 12px;
}

/* Larger buttons styles */

.button.large{
  padding: 12px 30px;
  text-transform: uppercase;
}

.button.large:active{
  top: 2px;
}

/* Colored buttons styles */

.button.green, .button.red, .button.blue {
  color: #fff;
  text-shadow: 0 1px 0 rgba(0,0,0,.2);
  
  background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255,255,255,.3)), to(rgba(255,255,255,0)));
  background-image: -webkit-linear-gradient(top, rgba(255,255,255,.3), rgba(255,255,255,0));
  background-image: -moz-linear-gradient(top, rgba(255,255,255,.3), rgba(255,255,255,0));
  background-image: -ms-linear-gradient(top, rgba(255,255,255,.3), rgba(255,255,255,0));
  background-image: -o-linear-gradient(top, rgba(255,255,255,.3), rgba(255,255,255,0));
  background-image: linear-gradient(top, rgba(255,255,255,.3), rgba(255,255,255,0));
}

/* */

.button.green{
  background-color: #57a957;
  border-color: #57a957;
}

.button.green:hover{
  background-color: #62c462;
}

.button.green:active{
  background: #57a957;
}

/* */

.button.red{
  background-color: #ca3535;
  border-color: #c43c35;
}

.button.red:hover{
  background-color: #ee5f5b;
}

.button.red:active{
  background: #c43c35;
}

/* */

.button.blue{
  background-color: #269CE9;
  border-color: #269CE9;
}

.button.blue:hover{
  background-color: #70B9E8;
}

.button.blue:active{
  background: #269CE9;
}

/* */

.green[disabled], .green[disabled]:hover, .green[disabled]:active{
  border-color: #57A957;
  background: #57A957;
  color: #D2FFD2;
}

.red[disabled], .red[disabled]:hover, .red[disabled]:active{
  border-color: #C43C35;
  background: #C43C35;
  color: #FFD3D3;
}

.blue[disabled], .blue[disabled]:hover, .blue[disabled]:active{
  border-color: #269CE9;
  background: #269CE9;
  color: #93D5FF;
}

/* Group buttons */

.button-group,
.button-group li{
  display: inline-block;
  *display: inline;
  zoom: 1;
}

.button-group{
  font-size: 0; /* Inline block elements gap - fix */
  margin: 0;
  padding: 0;
  background: rgba(0, 0, 0, .1);
  border-bottom: 1px solid rgba(0, 0, 0, .1);
  padding: 7px;
  -moz-border-radius: 7px;
  -webkit-border-radius: 7px;
  border-radius: 7px;
}

.button-group li{
  margin-right: -1px; /* Overlap each right button border */
}

.button-group .button{
  font-size: 13px; /* Set the font size, different from inherited 0 */
  -moz-border-radius: 0;
  -webkit-border-radius: 0;
  border-radius: 0;
}

.button-group .button:active{
  -moz-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
  -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
  box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
}

.button-group li:first-child .button{
  -moz-border-radius: 3px 0 0 3px;
  -webkit-border-radius: 3px 0 0 3px;
  border-radius: 3px 0 0 3px;
}

.button-group li:first-child .button:active{
  -moz-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
  -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
  box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, -5px 0 5px -3px rgba(0, 0, 0, .2) inset;
}

.button-group li:last-child .button{
  -moz-border-radius: 0 3px 3px 0;
  -webkit-border-radius: 0 3px 3px 0;
  border-radius: 0 3px 3px 0;
}

.button-group li:last-child .button:active{
  -moz-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset;
  -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset;
  box-shadow: 0 0 1px rgba(0, 0, 0, .2) inset, 5px 0 5px -3px rgba(0, 0, 0, .2) inset;
}



/* CSS Document */
.anniu{
display:block;
width:70px;
height:24px;
background-color:#333333;
color:#FFFFFF;
text-align:center;
font-size:12px;
line-height:25px;
border-radius: 25px;
border:none;
box-shadow:none;
text-decoration: none;
transition: box-shadow 0.5s;
-webkit-transition: box-shadow 0.5s;
}
.anniu:hover{
    box-shadow:0px 0px 5px 1px #808080;
}
.anniu:active{
    box-shadow:0px 0px 5px 1px #FF0000;
}




/* CSS Document */
.anniu1{
display:block;
width:70px;
height:24px;
background-color:#d3d3d3;
color:#FFFFFF;
text-align:center;
font-size:12px;
line-height:25px;
border-radius: 25px;
border:none;
box-shadow:none;
text-decoration: none;
transition: box-shadow 0.5s;
-webkit-transition: box-shadow 0.5s;
}
.anniu:hover{
    box-shadow:0px 0px 5px 1px #808080;
}
.anniu:active{
    box-shadow:0px 0px 5px 1px #FF0000;
}


</style>




</head>
<body>
<center>





<p></p>
	



<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
 <!-- <form action="数据库查询.php" method="get" value="Value-1" target="iframe">   -->
     <!--   <fieldset>  -->
        <p>
         <div style="position:relative;">
         <p>字段：  
 <select name="第一行搜索字段"  style="width: 80px;">字段
        <option value="<?php  echo $_GET['第一行搜索字段']; ?>"><?php  echo $_GET['第一行搜索字段']; ?></option>
        <option value="任意">任意</option>
        <option value="文件名">文件名</option>
        <option value="目录">目录</option>
        <option value="文件大小（字节）>">文件大小></option>
        <option value="文件大小（字节）=">文件大小=</option>
        <option value="文件大小（字节）<">文件大小<</option>
    </select>            <input type="text" id="keyword1" name="keyword1"  value="<?php  echo $_GET['keyword1']; ?>" placeholder="关键词..." align="left" style="font-size:16px; width:30%">
        </p>
    
        
         <p>字段：  
 <select name="第二行搜索字段"  style="width: 80px;">字段
        <option value="<?php  echo $_GET['第二行搜索字段']; ?>"><?php  echo $_GET['第二行搜索字段']; ?></option>
        <option value="任意">任意</option>
        <option value="文件名">文件名</option>
        <option value="目录">目录</option>
        <option value="文件大小（字节）>">文件大小></option>
        <option value="文件大小（字节）=">文件大小=</option>
        <option value="文件大小（字节）<">文件大小<</option>
    </select>            <input type="text" id="keyword2" name="keyword2"  value="<?php  echo $_GET['keyword2']; ?>" placeholder="关键词..." align="left" style="font-size:16px; width:30%">
        </p>
   


         <p>字段：  
 <select name="第三行搜索字段"  style="width:80px;;">字段
        <option value="<?php  echo $_GET['第三行搜索字段']; ?>"><?php  echo $_GET['第三行搜索字段']; ?></option>
        <option value="任意">任意</option>
        <option value="文件名">文件名</option>
        <option value="目录">目录</option>
        <option value="文件大小（字节）>">文件大小></option>
        <option value="文件大小（字节）=">文件大小=</option>
        <option value="文件大小（字节）<">文件大小<</option>
    </select>            <input type="text" id="keyword3" name="keyword3"  value="<?php  echo $_GET['keyword3']; ?>" placeholder="关键词..." align="left" style="font-size:16px; width:30%">
        </p>


         <p>字段：  
 <select name="第四行搜索字段"  style="width: 80px;">字段
        <option value="<?php  echo $_GET['第四行搜索字段']; ?>"><?php  echo $_GET['第四行搜索字段']; ?></option>
        <option value="任意">任意</option>
        <option value="文件名">文件名</option>
        <option value="目录">目录</option>
        <option value="文件大小（字节）>">文件大小></option>
        <option value="文件大小（字节）=">文件大小=</option>
        <option value="文件大小（字节）<">文件大小<</option>
    </select>            <input type="text" id="keyword4" name="keyword4"  value="<?php  echo $_GET['keyword4']; ?>" placeholder="正则表达式..." align="left" style="font-size:16px; width:30%">
        </p>
        


<body>
<a class="anniu" href="%E6%95%B0%E6%8D%AE%E5%BA%93%E6%9F%A5%E8%AF%A2.php?%E7%AC%AC%E4%B8%80%E8%A1%8C%E6%90%9C%E7%B4%A2%E5%AD%97%E6%AE%B5=%E4%BB%BB%E6%84%8F&keyword1=&%E7%AC%AC%E4%BA%8C%E8%A1%8C%E6%90%9C%E7%B4%A2%E5%AD%97%E6%AE%B5=%E4%BB%BB%E6%84%8F&keyword2=&%E7%AC%AC%E4%B8%89%E8%A1%8C%E6%90%9C%E7%B4%A2%E5%AD%97%E6%AE%B5=%E4%BB%BB%E6%84%8F&keyword3=&%E7%AC%AC%E5%9B%9B%E8%A1%8C%E6%90%9C%E7%B4%A2%E5%AD%97%E6%AE%B5=%E4%BB%BB%E6%84%8F&keyword4=&%E8%B4%A6%E6%88%B7=%E4%BB%BB%E6%84%8F&limit=100&res=0">
        清空输入
</a>
</body>
<br>
     
<body>
账号： <body onload="selectIndex();">
        <select class='form-control' name='账户' onchange='getTitleData()' type='text' id='账户'>
        <option value="任意">任意</option>
        <option value="晓天">晓天</option>
        <option value="CVC">CVC</option>
            </select><br>
        </form>
	</body>
	<p></p>


<p>

 
  显示数目：<select name="limit" >显示数目
        <option value="100">100</option>
        <option value="200">200</option>
        <option value="500">500</option>
        <option value="1000">1000</option>
        <option value="2000">2000</option>
        <option value="10">10</option>
    </select>
 </p>  
 
 
 <p hidden><button id="btn" onclick="fun()" class="small button" value="Go Elsewhere" formaction="/elsewhere" target="iframe">显示/隐藏“高级选项”</button></p>
<div id="con" style="display: none">




 
 

</div>

<script type="text/javascript">
    var flag = false;
    var div = document.getElementById("con");

    function fun() {
        if (flag ^= true) {
            div.style.display = "block";    // 显示
        } else {
            div.style.display = "none";     // 隐藏
        }
    }
</script>

        

<p><button id="btn1" class="blue button" onclick="funa()" target="iframe">提交</button></p> <!--提交不会二次刷新的按钮-->

<p hidden><button id="btn1" class="blue button"  onclick="href='数据库查询.php'">提交</button></p>  <!--提交会刷新-->
<div1 id="abc" style="display: none">



        <p>正在查询中，请等待... </p>





</div1>

<script type="text/javascript">
    var flag = false;
    var div1 = document.getElementById("abc");

    function funa() {
        if (flag ^= true) {
            div1.style.display = "block";    // 显示
        } else {
            div1.style.display = "none";     // 隐藏
        }
    }
</script>
<iframe name="iframe" style="display:none"></iframe> 
      <!-- </fieldset>-->
</form>

</body>


 



<?php
header("Content-type: text/html; charset=utf-8");	
$账户 = $_GET['账户'];  
$第一行搜索字段 = $_GET['第一行搜索字段'];  
$第二行搜索字段 = $_GET['第二行搜索字段'];  
$第三行搜索字段 = $_GET['第三行搜索字段']; 
$第四行搜索字段 = $_GET['第四行搜索字段']; 


$keyword1 = $_GET['keyword1'];  
$keyword2 = $_GET['keyword2'];  
$keyword3 = $_GET['keyword3']; 
$keyword4 = $_GET['keyword4'];

$limit = $_GET['limit'];
$res = $_GET['res'];
if ($res == "0") {exit;}


    function formatSizeUnits($bytes) //MB、GB、TB、KB转字节
    {
        
        $numb = preg_replace('/(^\d+(\.\d{1,})$|(^[1-9]\d*$)) *(GB|KB|TB|MB)$/i','$1', $bytes);
        $unit = preg_replace('/(^\d+(\.\d{1,})$|(^[1-9]\d*$)) *(GB|KB|TB|MB)$/i','$2', $bytes);
        
        if (strpos($unit,'K') !== false || strpos($unit,'k') !== false) 
        {
            $bytes = $numb * 1024;
        }
         if (strpos($unit,'M') !== false || strpos($unit,'m') !== false) 
        {
            $bytes = $numb * 1024 * 1024;
        }
         if (strpos($unit,'G') !== false || strpos($unit,'g') !== false) 
        {
            $bytes = $numb * 1024 * 1024 * 1024;
        }
         if (strpos($unit,'T') !== false || strpos($unit,'t') !== false) 
        {
            $bytes = $numb * 1024 * 1024 * 1024 * 1024;
        }
         
        return $bytes;
}

 


if ($账户 == "任意") {$account = "";}
if ($账户 == "晓天") {$account = "\"账户\" ILIKE '%晓天%' AND";}
if ($账户 == "CVC") {$account = "\"账户\" ILIKE '%CVC%' AND";}

if ($第一行搜索字段 == "任意") {$search1 = "\"账户\" ILIKE '%$keyword1%' OR \"目录\" ILIKE '%$keyword1%' OR \"文件名\" ILIKE '%$keyword1%' OR \"文件大小（字节）\" ILIKE '%$keyword1%' OR \"文件大小\" ILIKE '%$keyword1%'";}
if ($第一行搜索字段 == "目录") {$search1 = "\"目录\" ILIKE '%$keyword1%'";}
if ($第一行搜索字段 == "文件名") {$search1 = "\"文件名\" ILIKE '%$keyword1%'";}
if ($第一行搜索字段 == "文件大小（字节）>") {$keyword1 = formatSizeUnits($keyword1);$search1 = "\"文件大小（字节）\"::FLOAT > $keyword1";}
if ($第一行搜索字段 == "文件大小（字节）=") {$keyword1 = formatSizeUnits($keyword1);$search1 = "\"文件大小（字节）\"::FLOAT = $keyword1";}
if ($第一行搜索字段 == "文件大小（字节）<") {$keyword1 = formatSizeUnits($keyword1);$search1 = "\"文件大小（字节）\"::FLOAT < $keyword1";}

if (strlen($keyword2) > 0)
{
if ($第二行搜索字段 == "任意") {$search2 = " AND (\"账户\" ILIKE '%$keyword2%' OR \"目录\" ILIKE '%$keyword2%' OR \"文件名\" ILIKE '%$keyword2%' OR \"文件大小（字节）\" ILIKE '%$keyword2%' OR \"文件大小\" ILIKE '%$keyword2%' )";}
if ($第二行搜索字段 == "目录") {$search2 = " AND (\"目录\" ILIKE '%$keyword2%')";}
if ($第二行搜索字段 == "文件名") {$search2 = "AND (\"文件名\" ILIKE '%$keyword2%')";}
if ($第二行搜索字段 == "文件大小（字节）>") {$keyword2 = formatSizeUnits($keyword2);$search2 = "AND (\"文件大小（字节）\"::FLOAT > '$keyword2')";}
if ($第二行搜索字段 == "文件大小（字节）=") {$keyword2 = formatSizeUnits($keyword2);$search2 = "AND (\"文件大小（字节）\"::FLOAT = '$keyword2')";}
if ($第二行搜索字段 == "文件大小（字节）<") {$keyword2 = formatSizeUnits($keyword2);$search2 = "AND (\"文件大小（字节）\"::FLOAT < '$keyword2')";}
}

if (strlen($keyword3) > 0)

{
if ($第三行搜索字段 == "任意") {$search3 = " AND (\"账户\" ILIKE '%$keyword3%' OR \"目录\" ILIKE '%$keyword3%' OR \"文件名\" ILIKE '%$keyword3%' OR \"文件大小（字节）\" ILIKE '%$keyword3%' OR \"文件大小\" ILIKE '%$keyword3%' )";}
if ($第三行搜索字段 == "目录") {$search3 = " AND (\"目录\" ILIKE '%$keyword3%')";}
if ($第三行搜索字段 == "文件名") {$search3 = "AND (\"文件名\" ILIKE '%$keyword3%')";}
if ($第三行搜索字段 == "文件大小（字节）>") {$keyword3 = formatSizeUnits($keyword3);$search3 = "AND (\"文件大小（字节）\"::FLOAT > '$keyword3')";}
if ($第三行搜索字段 == "文件大小（字节）=") {$keyword3 = formatSizeUnits($keyword3);$search3 = "AND (\"文件大小（字节）\"::FLOAT = '$keyword3')";}
if ($第三行搜索字段 == "文件大小（字节）<") {$keyword3 = formatSizeUnits($keyword3);$search3 = "AND (\"文件大小（字节）\"::FLOAT < '$keyword3')";}
}
 
if (strlen($keyword4) > 0)
{
if ($第四行搜索字段 == "任意") {$search4 = " AND (\"账户\" ~* '$keyword4' OR \"目录\" ~* '$keyword4' OR \"文件名\" ~* '$keyword4' OR \"文件大小（字节）\" ~* '$keyword4' OR \"文件大小\" ~* '$keyword4' )";}
if ($第四行搜索字段 == "目录") {$search4 = " AND (\"目录\" ~* '$keyword4')";}
if ($第四行搜索字段 == "文件名") {$search4 = "AND (\"文件名\" ~* '$keyword4')";}
if ($第四行搜索字段 == "文件大小（字节）>") {$keyword4 = formatSizeUnits($keyword4);$search4 = "AND (\"文件大小（字节）\"::FLOAT > '$keyword4')";}
if ($第四行搜索字段 == "文件大小（字节）=") {$keyword4 = formatSizeUnits($keyword4);$search4 = "AND (\"文件大小（字节）\"::FLOAT = '$keyword4')";}
if ($第四行搜索字段 == "文件大小（字节）<") {$keyword4 = formatSizeUnits($keyword4);$search4 = "AND (\"文件大小（字节）\"::FLOAT < '$keyword4')";}
}
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://207.246.87.236:8088/?pgsql=207.246.87.236&username=dbadmin&db=%E7%99%BE%E5%BA%A6%E7%BD%91%E7%9B%98&ns=public&sql=SELECT%20*%0AFROM%20%22%E6%80%BB%E8%A1%A8%22%0AWHERE%20%22%E8%B4%A6%E6%88%B7%22%20ILIKE%20%27%25%E6%99%93%E5%A4%A9%25%27%20AND%20(%22%E8%B4%A6%E6%88%B7%22%20ILIKE%20%27%25screen%25%27%20OR%20%22%E7%9B%AE%E5%BD%95%22%20ILIKE%20%27%25screen%25%27%20OR%20%22%E6%96%87%E4%BB%B6%E5%90%8D%22%20ILIKE%20%27%25screen%25%27%20OR%20%22%E6%96%87%E4%BB%B6%E5%A4%A7%E5%B0%8F%EF%BC%88%E5%AD%97%E8%8A%82%EF%BC%89%22%20ILIKE%20%27%25screen%25%27%20OR%20%22%E6%96%87%E4%BB%B6%E5%A4%A7%E5%B0%8F%22%20ILIKE%20%27%25screen%25%27)%0ALIMIT%2050');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryu0pFkc6ESe6wkgVA',
]);
curl_setopt($ch, CURLOPT_COOKIE, 'adminer_key=7a89af3ab82bf7fb7d05af62e89b8bfe; adminer_version=4.8.1; adminer_sid=j7ingpupnpm6cii0q7tlt3cgt4; adminer_permanent=cGdzcWw%3D-MjA3LjI0Ni44Ny4yMzY%3D-ZGJhZG1pbg%3D%3D-bWluaWZsdXg%3D%3AV%2FPQQva2dmFE7pYZ31LC42XDrRKfsMWo%2BcGdzcWw%3D-MjA3LjI0Ni44Ny4yMzY%3D-ZGJhZG1pbg%3D%3D-cG9zdGdyZXM%3D%3AjaNmBX%2BAg%2FYUU3DbTbE3MNp0AVWSM5Mn+cGdzcWw%3D-MjA3LjI0Ni44Ny4yMzY%3D-ZGJhZG1pbg%3D%3D-cG9zdGdyZXM%3D%3AjaNmBX%2BAg%2FYUU3DbTbE3MNp0AVWSM5Mn');
curl_setopt($ch, CURLOPT_POSTFIELDS, "------WebKitFormBoundaryu0pFkc6ESe6wkgVA\r\nContent-Disposition: form-data; name=\"query\"\r\n\r\nSELECT *\r\nFROM \"总表\"\r\nWHERE $account ( $search1 ) $search2  $search3 $search4 \r\nLIMIT $limit \r\n------WebKitFormBoundaryu0pFkc6ESe6wkgVA\r\nContent-Disposition: form-data; name=\"limit\"\r\n\r\n\r\n------WebKitFormBoundaryu0pFkc6ESe6wkgVA\r\nContent-Disposition: form-data; name=\"token\"\r\n\r\n369511:864342\r\n------WebKitFormBoundaryu0pFkc6ESe6wkgVA--\r\n");

$res = curl_exec($ch);

$res = preg_replace('/[\s\S]*?\<p class\=\'message\'\>无数据。[\s\S]*/','<br><h3>无数据</h3>', $res);
$res = preg_replace('/[\s\S]*?查询出错\: ERROR[\s\S]*/','', $res);
$res = preg_replace('/[\s\S]*?(\<table cellspacing[\s\S]*)/','$1', $res);
$res = preg_replace('/([\s\S]*?)\<form action\=\'\' method\=\'post\'\>[\s\S]*/','$1', $res);
echo '
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
<style type="text/css">
/*
	td{
	    white-space: nowrap;
	}
*/


	table tr:nth-child(odd){
    background: #efefef;
}


table
{
    border-collapse:collapse;
};



table {
    border-collapse: collapse;
}
th, td {
    border: 1px solid #868686;
};



{field: "remark", title: __(""Remark"), operate: false,
    formatter : function(value, row, index, field){
        return "<span style="display: block;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"" title=" + row.remark + "">" + value + "</span>";
    },
    cellStyle : function(value, row, index, field){
        return {
            css: {
                "white-space": "nowrap",
                "text-overflow": "ellipsis",
                "overflow": "hidden",
                "max-width":"150px"
            }
        };
    }


main{
min-height: calc(100vh - 200px); /* 这个200px是header和footer的高度 */
}
header,footer{
height: 100px;
line-height: 100px;
}

 
div{
float:right;
bottom:0px;
}
</style>';
echo $res;  

?>








 

 


	

 
