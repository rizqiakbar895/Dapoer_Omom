<?php
require "config.php"; if(!empty($_SESSION["user"])){header("Location: ".($_SESSION["user"]["role"]==="admin"?"admin.php":"index.php"));exit;}
$error="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
 $email=trim($_POST["email"]);$pass=$_POST["password"];
 $st=$conn->prepare("SELECT id,nama,email,password,role FROM users WHERE email=? LIMIT 1");$st->bind_param("s",$email);$st->execute();$u=$st->get_result()->fetch_assoc();
 if($u && password_verify($pass,$u["password"])){unset($u["password"]);$_SESSION["user"]=$u;header("Location: ".($u["role"]==="admin"?"admin.php":"index.php"));exit;}
 $error="Email atau password salah.";
}
?>
<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login</title><link rel="stylesheet" href="style.css"></head><body>
<div class="auth-page"><div class="auth-box"><div class="brand-mark auth-logo">DO</div><span class="eyebrow">LOGIN</span><h1>Selamat Datang</h1><p>Masuk sebagai User atau Admin.</p><?php if($error):?><div class="alert error"><?=e($error)?></div><?php endif;?>
<form method="post"><label>Email<input type="email" name="email" required></label><label>Password<input type="password" name="password" required></label><button class="btn btn-primary full">Login</button></form>
<div class="demo-box"><b>Akun Admin Demo</b><br>admin@dapoeromom.local / admin123<br><br><b>Akun User Demo</b><br>user@dapoeromom.local / user123</div>
<p class="auth-link">Belum punya akun? <a href="register.php">Daftar</a></p><a href="index.php">← Kembali</a></div></div></body></html>