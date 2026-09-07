<?php
$host="localhost"; $user="root"; $pass=""; $db="dapoer_omom";
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error){die("Koneksi MySQL gagal: ".$conn->connect_error);}
$conn->set_charset("utf8mb4");
if(session_status()===PHP_SESSION_NONE) session_start();
function e($v){return htmlspecialchars($v ?? "",ENT_QUOTES,"UTF-8");}
function rupiah($n){return "Rp".number_format((int)$n,0,",",".");}
?>