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
    <form action="write.php" method="POST">
      <div class="input-group mb-3">
          <span class="input-group-text">标题</span>
          <input type="text" name="title">
      </div>
      <div class="mypost">
        <textarea cols="100" rows="22" name="content"></textarea>
      </div>
          <button type="submit" class="btn btn-success">发布</button>
      </body>
  </form>

</html>

<?php
  session_start();
  include("db.php");
  $select = mysqli_select_db($conn,"comments");	
  $user = $_SESSION["uname"];
  $email = $_SESSION["email"];
  if(empty($user)){
    header('location:login.php');
    exit;
  }
  echo $_POST['title'];
  if(isset($_POST['title']) && isset($_POST['content']) && $select) {
    $time = new DateTime();
    $time = $time->format('Y-m-d H:i:s');
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = "INSERT INTO comments (title, author, email, content, time) VALUES ('" . $title . "','" . $user . "','" . $email . "','" . $content . "','" . $time . "')";
    if ($conn->query($sql) === TRUE) {
      echo '<script>alert("发布成功！")</script>';
    } else {
        echo '<script>alert("输入字数超出限度！")</script>';
    }
  }

  mysqli_close($conn);
?>