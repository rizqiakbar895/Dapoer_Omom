<?php 
require "auth.php"; 
require_login(); 

$page_title="Pesanan Berhasil"; 

require "header.php"; 
?>


<section class="auth-page inline-auth">

<div class="auth-box">


<div class="success-icon">
✓
</div>


<span class="eyebrow">
PESANAN TERSIMPAN
</span>


<h1>
Berhasil!
</h1>



<p>
Transaksi 
<b>
<?=e($_GET["kode"]??"")?>
</b> 
sudah masuk ke sistem.
</p>



<?php if(!empty($_GET["bukti"])): ?>


<div style="margin:20px 0;">


<h3>
Bukti Pembayaran QRIS
</h3>


<img 
src="<?=e($_GET["bukti"])?>" 
style="
max-width:100%;
width:300px;
border-radius:12px;
margin-top:10px;
">


<p style="font-size:13px;color:#777;">
Bukti pembayaran berhasil diupload
</p>


</div>


<?php endif; ?>





<a 
class="btn btn-whatsapp full" 
target="_blank" 
href="<?=e($_GET["wa"]??"#")?>">
💬 Buka WhatsApp Penjual
</a>



<a 
class="text-btn" 
href="orders.php">
Lihat Pesanan Saya
</a>



</div>


</section>



<?php require "footer.php"; ?>