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
  }

  $sql = "SELECT title, author, email, time FROM comments where email='" . $email . "'order by time DESC"; 
  $result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
    // 输出数据
    while($row = mysqli_fetch_assoc($result)) {
        echo '<a href="comment.php?title=' . $row["title"] . '&email=' . $row["email"] . '"><div class="media border p-3">
        <img src="https://upload-bbs.mihoyo.com/upload/2021/02/21/73745121/889dd95182ad248b035a19fbefe90764_4703068301332017047.png" class="mr-3 mt-3 rounded-circle" style="width:60px;">
        <div class="media-body"><h3>标题：' . $row["title"] . '</h3><h6>发布时间：' . $row["time"] . '</h6><h5>留言人：' . $row["author"] . '</h5></div></div></a>
        <a href="editcmt.php?title=' . $row["title"] . '"><button type="button" class="btn btn-info">修改留言</button></a>
        <a href="delete.php?title=' . $row["title"] . '"><button type="button" class="btn btn-warning">删除留言</button></a>';
    }
} else {
    echo "<mark>还没有发布留言喔！</mark>";
}

  mysqli_close($conn);

?>