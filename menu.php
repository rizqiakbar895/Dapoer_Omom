<?php
require "auth.php"; require_login(); $page_title="Menu — Dapoer Omom";
$menus=$conn->query("SELECT * FROM menu WHERE status=1 ORDER BY id DESC");
require "header.php";
?>
<section class="section"><div class="section-heading"><div><span class="eyebrow">MENU FAVORIT</span><h2>Pilih Menu, Harga Langsung Muncul</h2></div><p>Atur jumlah menu yang kamu mau, lalu lanjut ke checkout.</p></div>
<form method="post" action="checkout.php"><div class="menu-grid">
<?php while($m=$menus->fetch_assoc()):
$gambarMenu = [
 "Ricebowl Chicken Pop Ukuran Besar" => "assets/chicken_pop.jpeg",
 "Nasi Ayam Teriyaki Mix Vegetables" => "assets/ayam_teriyaki.jpeg",
 "Nasi Daun Jeruk Ayam Cabe Garam" => "assets/daun_jeruk.jpeg",
 "Spaghetti Bolognese Cheese" => "assets/spaghetti.jpeg",
 "Nasi Ayam Serundeng Mix" => "assets/serundeng.jpeg",
 "Ricebowl Chicken Pop Asam Manis" => "assets/asam_manis.jpeg"
];
$foto = $gambarMenu[$m["nama"]] ?? $m["gambar"];
?><article class="menu-card"><div class="menu-photo"><img src="<?=e($foto)?>" alt="<?=e($m["nama"])?>"></div><div class="menu-info"><div class="menu-tag"><?=e($m["kategori"])?></div><h3><?=e($m["nama"])?></h3><div class="menu-price"><?=rupiah($m["harga"])?></div>
<label class="qty-label">Jumlah<input type="number" name="qty[<?=$m["id"]?>]" value="0" min="0"></label></div></article><?php endwhile; ?></div>
<button class="btn btn-primary" type="submit">🛒 Lanjut ke Kasir</button></form></section>
<?php require "footer.php"; ?>