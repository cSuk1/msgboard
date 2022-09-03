<?php
//  删除留言
session_start();
include("db.php");
$select = mysqli_select_db($conn,"comments");
$user = $_SESSION["uname"];
$email = $_SESSION["email"];
if(empty($user)){
  header('location:login.php');
  exit;
}
if(isset($_GET['title'])){
    $title=$_GET['title'];
    $sql = "DELETE FROM comments WHERE title='" . $title . "' and email='" . $email . "'";
    mysqli_query($conn,$sql);
    header("location:mycmt.php");
}
mysqli_close($conn);
?>