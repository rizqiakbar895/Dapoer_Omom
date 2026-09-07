<?php
require_once "config.php";
function require_login(){
 if(empty($_SESSION["user"])){header("Location: login.php");exit;}
}
function require_admin(){
 require_login();
 if($_SESSION["user"]["role"]!=="admin"){header("Location: index.php");exit;}
}
?>