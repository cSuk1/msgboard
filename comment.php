<!DOCTYPE html>
<html>
  <head>
    <title>留言板</title>
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
  include("db.php");
  $select = mysqli_select_db($conn,"comments");	
  $user = $_SESSION["uname"];
  $title = $_GET['title'];
  $email = $_GET['email'];
  if(empty($user)){
    header('location:login.php');
    exit;
  }
  // 按照最新留言排序
  $sql = "SELECT title, author, time, content FROM comments where title = '" . $title . "' and email = '" . $email . "'"; 
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        echo '<div class="card">
        <div class="card-body">
          <h4 class="card-title">' . $row["title"] . '</h4><br>
          <p class="card-text">' . $row["content"] . '</p><br>
          <mark>留言人：' . $row["author"] . '</mark>
          <mark>留言时间：' . $row["time"] . '</mark>
        </div>
      </div>';
    }
} else {
    echo "<mark>还没有发布留言喔！</mark>";
}
 
mysqli_close($conn);
?>