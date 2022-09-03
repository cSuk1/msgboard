<?php
	//连接数据库服务器
	//此处加@是为了不显示错误信息
     $conn=mysqli_connect("localhost","root","root") or die("数据库服务器连接错误".mysql_error()); 
	 mysqli_set_charset($conn,'utf8'); //设定字符集 
?>
