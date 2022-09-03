<!DOCTYPE html>
<html>
  <head>
    <title>写留言</title>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/mycss.css" rel="stylesheet">
    <script src="/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
      textarea{
        background: url(https://gimg2.baidu.com/image_search/src=http%3A%2F%2Fpic.51yuansu.com%2Fbackgd%2Fcover%2F00%2F43%2F44%2F5bf2a818b7c34.jpg%21%2Ffw%2F780%2Fquality%2F90%2Funsharp%2Ftrue%2Fcompress%2Ftrue&refer=http%3A%2F%2Fpic.51yuansu.com&app=2002&size=f9999,10000&q=a80&n=0&g=0n&fmt=auto?sec=1664767537&t=e316c62e8e02e235d58ee62fda754718) no-repeat right bottom/100% 100%;
      }
    </style>
    <script>
        // 旧标题
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
            //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            // IE6, IE5 浏览器执行代码
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("biaoti").value=xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","/change_title.txt",true);
        xmlhttp.send();

        // 旧文本
        var xmlhttp1;
        if (window.XMLHttpRequest)
        {
            //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
            xmlhttp1=new XMLHttpRequest();
        }
        else
        {
            // IE6, IE5 浏览器执行代码
            xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp1.onreadystatechange=function()
        {
            if (xmlhttp1.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("zhengwen").innerHTML=xmlhttp1.responseText;
            }
        }
        xmlhttp1.open("GET","/change_content.txt",true);
        xmlhttp1.send();        
    </script>
  </head>
  <body>
    <div class="bkg"></div>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" id="menu">
        <div class="container-fluid">
        <a class="navbar-brand" href="loginsuc.php">首页</a>
          <a class="navbar-brand" href="board.php">留言板</a>
          <a class="navbar-brand" href="write.php">写留言</a>
          <a class="navbar-brand" href="mycmt.php">我的留言</a>
          <a class="navbar-brand" href="myinfo.php">个人信息</a>
            <form id="loginbtn">
              <a href="quit.php"><button class="btn btn-primary" type="button" >登出</button></a>
            </form>
        </div>
        <div id="sousuo">
        <form class="d-flex"  action="search.php" method="GET">
                <input class="form-control me-2" type="text" name="search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <form action="editcmt.php" method="POST">
      <div class="input-group mb-3">
          <span class="input-group-text">标题</span>
          <input type="text" name="title" id="biaoti" value="">
      </div>
      <div class="mypost">
        <textarea cols="100" rows="22" name="content" id="zhengwen"></textarea>
      </div>
          <button type="submit" class="btn btn-success">修改</button>
      </body>
  </form>

</html>


<?php
//  修改留言
session_start();
include("db.php");
$select = mysqli_select_db($conn,"comments");
$user = $_SESSION["uname"];
$email = $_SESSION["email"];
if(empty($user)){
  header('location:login.php');
  exit;
}

if(isset($_GET['title'])) {
    $title=$_GET['title'];
    $sql = "SELECT title, content FROM comments where title = '" . $title . "' and email = '" . $email . "'"; 
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // 写入旧标题
    $myfile_1 = fopen("change_title.txt", "w") or die("Unable to open file!");
    fwrite($myfile_1, $title);
    fclose($myfile_1);
    // 写入旧文本
    $content = $row['content'];
    $myfile_2 = fopen("change_content.txt", "w") or die("Unable to open file!");
    fwrite($myfile_2, $content);
    fclose($myfile_2);
}
if(isset($_POST['title']) && isset($_POST['content'])){
    $ex_title = file_get_contents('change_title.txt');
    $newtitle=$_POST['title'];
    $newcontent=$_POST['content'];
    $sql = "UPDATE comments SET title='" . $newtitle . "', content='" . $newcontent . "' WHERE title='" . $ex_title . "' and email='" . $email . "'";
    mysqli_query($conn,$sql);
    header('location:comment.php?title=' . $newtitle . '&email=' . $email);
}

mysqli_close($conn);
?>