<?php 
$page_title="Dapoer Omom — Home"; 
require "header.php"; 
?>

<section id="home" class="hero">

<div class="hero-copy">

<span class="eyebrow">
DAPOER OMOM • FRESH • LEZAT • HIGIENIS
</span>

<h1>
Enaknya<br>
<em>Bikin Nagih!</em>
</h1>

<p>
Menu rumahan favorit keluarga yang cocok untuk makan siang, acara, sajian Jumat berkah, ulang tahun, dan berbagai momen spesial.
</p>


<div class="hero-actions">

<a class="btn btn-primary" href="menu.php">
Lihat Menu
</a>


<?php if(!empty($_SESSION["user"]) && $_SESSION["user"]["role"]==="admin"): ?>

<a class="btn btn-light" href="admin.php">
Dashboard Admin
</a>


<?php elseif(!empty($_SESSION["user"])): ?>

<a class="btn btn-light" href="menu.php">
Mulai Pesan
</a>


<?php else: ?>

<a class="btn btn-light" href="login.php">
Login untuk Pesan
</a>

<?php endif; ?>

</div>



<div class="hero-badges">

<span>🍗 Bahan segar</span>
<span>🍝 Rasa mantap</span>
<span>🛡️ Higienis</span>

</div>


</div>



<div class="hero-art">

<div class="poster-frame">

<img src="assets/posterr.jpg" alt="Poster promosi Dapoer Omom">

</div>

</div>


</section>



<section class="section">

<div class="section-heading">

<div>

<span class="eyebrow">
KENAPA KAMI
</span>

<h2>
Masakan rumahan untuk banyak momen.
</h2>

</div>


<p>
Dapoer Omom menggabungkan rasa rumahan dengan sistem digital agar pemesanan dan pengelolaan penjualan lebih praktis.
</p>


</div>



<div class="about-cards">

<div>

<b>01</b>

<span>Fresh</span>

<small>
Bahan segar dan berkualitas.
</small>

</div>


<div>

<b>02</b>

<span>Lezat</span>

<small>
Rasa mantap dan konsisten.
</small>

</div>


<div>

<b>03</b>

<span>Higienis</span>

<small>
Diproses dengan menjaga kebersihan.
</small>

</div>


</div>

</section>




<section class="contact-section section">

<div>

<span class="eyebrow">
HUBUNGI KAMI
</span>

<h2>
Siap pesan makanan favorit?
</h2>

<p>
Pesan melalui website lalu kirim rincian pesanan langsung ke WhatsApp Dapoer Omom.
</p>

</div>



<div class="contact-box">


<div>

<span>
WhatsApp
</span>

<b>
0813-8648-9122
</b>

</div>


<a 
class="btn btn-primary" 
target="_blank" 
href="https://wa.me/6281386489122">

Chat WhatsApp

</a>


</div>


</section>


<?php require "footer.php"; ?>