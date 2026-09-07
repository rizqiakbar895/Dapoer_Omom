<?php
require "auth.php";require_login();$page_title="Pesanan Saya";
$uid=$_SESSION["user"]["id"];$st=$conn->prepare("SELECT * FROM transaksi WHERE user_id=? ORDER BY id DESC");$st->bind_param("i",$uid);$st->execute();$rows=$st->get_result();require "header.php";
?>
<section class="section"><div class="section-heading"><div><span class="eyebrow">USER</span><h2>Pesanan Saya</h2></div><a class="btn btn-primary" href="menu.php">+ Pesan Lagi</a></div>
<div class="card table-wrap"><table><thead><tr><th>Kode</th><th>Total</th><th>Pembayaran</th><th>Tanggal</th></tr></thead><tbody><?php while($r=$rows->fetch_assoc()):?><tr><td><?=e($r["kode"])?></td><td><?=rupiah($r["total"])?></td><td><?=e($r["metode"])?></td><td><?=e($r["created_at"])?></td></tr><?php endwhile;?></tbody></table></div></section>
<?php require "footer.php"; ?>