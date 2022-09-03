<?php
//  退出时清除session，并返回登录界面
session_start();
unset($_SESSION["uname"]);
header("location:login.php");
?>