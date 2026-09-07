<?php
require "config.php"; if(!empty($_SESSION["user"])){header("Location: index.php");exit;}
$error="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $nama=trim($_POST["nama"]);$email=trim($_POST["email"]);$pass=$_POST["password"];
 if(strlen($pass)<6)$error="Password minimal 6 karakter.";
 else{
  $check=$conn->prepare("SELECT id FROM users WHERE email=?");$check->bind_param("s",$email);$check->execute();
  if($check->get_result()->num_rows)$error="Email sudah terdaftar.";
  else{$hash=password_hash($pass,PASSWORD_DEFAULT);$st=$conn->prepare("INSERT INTO users(nama,email,password,role) VALUES(?,?,?,'user')");$st->bind_param("sss",$nama,$email,$hash);$st->execute();header("Location: login.php?registered=1");exit;}
 }
}
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Register</title><link rel="stylesheet" href="style.css"></head><body>
<div class="auth-page"><div class="auth-box"><div class="brand-mark auth-logo">DO</div><span class="eyebrow">USER</span><h1>Buat Akun</h1><p>Daftar untuk memesan menu Dapoer Omom.</p><?php if($error):?><div class="alert error"><?=e($error)?></div><?php endif;?>
<form method="post"><label>Nama<input name="nama" required></label><label>Email<input type="email" name="email" required></label><label>Password<input type="password" name="password" minlength="6" required></label><button class="btn btn-primary full" type="submit">Daftar</button></form>
<p class="auth-link">Sudah punya akun? <a href="login.php">Login</a></p><a href="index.php">← Kembali ke website</a></div></div></body></html>