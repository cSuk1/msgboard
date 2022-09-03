<!DOCTYPE html>
<html>
<head>
    <title>登录</title>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/mycss.css" rel="stylesheet">
    <script src="/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="bkg"></div>
<div class="mt-4 p-5 bg-primary text-white rounded" id="login">
  <h2>登录</h2>
  <p>还没有账号？<a href="reg.php">点我注册</a>。</p>
	<form action="login.php" class="was-validated">
	  <div class="form-group">
		<label for="uname">Username:</label>
		<input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
		<div class="invalid-feedback">请输入用户名！</div>
	  </div>
      <div class="form-group">
		<label for="pwd">email:</label>
		<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
		<div class="invalid-feedback">请输入正确格式的邮箱！</div>
	  </div>
	  <div class="form-group">
		<label for="pwd">Password:</label>
		<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
		<div class="invalid-feedback">请输入密码！</div>
	  </div>
	  <div class="form-group form-check">
		<label class="form-check-label">
		  <input class="form-check-input" type="checkbox" name="remember" required> 同意<a href="xieyi.html">协议</a>
		  <div class="invalid-feedback">同意协议能登录！</div>
		</label>
	  </div>
	  <button type="submit" class="btn btn-primary">登录</button>
	</form>
</div>

</body>
</html>


<?php

header("Content-type:text/html;charset=utf-8"); //设置编码
session_start(); //创建session
include("db.php");

$uname = $_GET['uname'];
$email = $_GET['email'];
$pswd = $_GET['pswd'];


// 检测连接
if($conn){
    $uname = $_GET['uname'];
    $email = $_GET['email'];
    $pswd = $_GET['pswd'];
    //数据库连接成功
    $select = mysqli_select_db($conn,"comments");	
    if($select && isset($_GET['remember'])) {
        // sql语句
        $sql_select = "select uname, email, pswd from user where uname = '$uname' and email = '$email' and pswd = '$pswd'";

        //设置编码
        mysqli_query($conn, 'SET NAMES UTF8');
        //执行sql语句
        $ret = mysqli_query($conn, $sql_select);
        
        if (!$ret) {
            printf("Error: %s\n", mysqli_error($conn));
            exit();
        }

		$row = mysqli_fetch_array($ret); 

        if($uname == $row['uname'] && $pswd == $row['pswd'] && $email == $row['email'] && $ret->num_rows > 0){
            //跳转登陆成功页面
            $_SESSION['uname'] = $uname;
            $_SESSION['email'] = $email;
            header('location:loginsuc.php');
        }else{
            //跳转登陆失败页面
            echo '<script>alert("用户名或者密码错误")</script>';
        }  
        mysqli_close($conn);
    }
}else{		
    //连接错误处理
    die('Could not connect:'.mysql_error());
}	

?>