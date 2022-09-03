<!DOCTYPE html>
<html>
<head>
    <title>注册</title>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/mycss.css" rel="stylesheet">
    <script src="/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="bkg"></div>
<div class="mt-4 p-5 bg-primary text-white rounded" id="login">
  <h2>注册</h2>
  <p>注册成功？<a href="login.php">点我返回登录界面</a>。</p>
	<form action="reg.php" class="was-validated">
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
		  <div class="invalid-feedback">同意协议能注册！</div>
		</label>
	  </div>
	  <button type="submit" class="btn btn-primary">注册</button>
	</form>
</div>

</body>
</html>

<?php

header("Content-type:text/html;charset=utf-8"); //设置编码
include("db.php");


// 检测连接
if($conn){
    $uname = $_GET['uname'];
    $email = $_GET['email'];
    $pswd = $_GET['pswd'];
    //数据库连接成功
    $select = mysqli_select_db($conn,"comments");	
    if($select && isset($_GET['remember'])) {
        $sql_select = "select email from user where email = '$email'";
        $result = mysqli_query($conn,$sql_select);
		//判断用户名是否已存在
		$num = mysqli_num_rows($result);

        if($num) {
            echo '<script>alert("该用户名或者邮箱已经被注册！")</script>';
        }else{
            $sql_insert = "insert into user(uname,email,pswd) values('$uname','$email','$pswd')";
            $ret = mysqli_query($conn,$sql_insert); 
            echo '<script>alert("注册成功！")</script>';
        }
        mysqli_close($conn);
    }
}else{		
    //连接错误处理
    die('Could not connect:'.mysql_error());
}	

?>