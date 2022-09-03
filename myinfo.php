<!DOCTYPE html>
<html>
  <head>
    <title>关于我</title>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/mycss.css" rel="stylesheet">
    <script src="/js/bootstrap.bundle.min.js"></script>
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

  </body>
</html>

<?php
  session_start();
  header("Content-type:text/html;charset=utf-8"); //设置编码
  include("db.php");
  $select = mysqli_select_db($conn,"comments");	
  $user = $_SESSION["uname"];
  $email = $_SESSION["email"];
  if(empty($user)){
    header('location:login.php');
    exit;
  }else{
    echo '<div class="card" id="myinfo" style="width:400px">
    <img class="card-img-top" src="https://upload-bbs.mihoyo.com/upload/2021/02/21/73745121/889dd95182ad248b035a19fbefe90764_4703068301332017047.png" alt="Card image" style="width:100%">
    <div class="card-body">
      昵称：<h4 class="card-title" id="uname">tsuki</h4>
      邮箱地址：<h4 class="card-text" id="email">652240843@qq.com</p>
      <a href="quit.php" class="btn btn-primary">登出</a>
    </div>';
  }
  mysqli_close($conn);
?>