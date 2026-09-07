<?php
require "auth.php";require_admin();$page_title="Kasir Admin";
$menus=$conn->query("SELECT * FROM menu WHERE status=1 ORDER BY id");$error="";
if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["save_cashier"])){
 $ids=$_POST["id"]??[];$qtys=$_POST["qty"]??[];$items=[];$total=0;
 foreach($ids as $i=>$id){$q=(int)($qtys[$i]??0);$id=(int)$id;if($q<1)continue;$st=$conn->prepare("SELECT * FROM menu WHERE id=? AND status=1");$st->bind_param("i",$id);$st->execute();$m=$st->get_result()->fetch_assoc();if($m){$m["qty"]=$q;$m["subtotal"]=$m["harga"]*$q;$items[]=$m;$total+=$m["subtotal"];}}
 $met=$_POST["metode"];$paid=(int)$_POST["dibayar"];$customer=trim($_POST["pelanggan"])?:'Umum';$note=trim($_POST["catatan"]);
 if($met!=="Cash")$paid=$total;
 if(!$items)$error="Pilih minimal satu menu.";elseif($met==="Cash"&&$paid<$total)$error="Uang dibayar kurang.";else{
  $kode="POS-".date("YmdHis")."-".random_int(10,99);$change=max(0,$paid-$total);$uid=$_SESSION["user"]["id"];
  $st=$conn->prepare("INSERT INTO transaksi(kode,user_id,pelanggan,metode,total,dibayar,kembalian,catatan) VALUES(?,?,?,?,?,?,?,?)");$st->bind_param("sissiiis",$kode,$uid,$customer,$met,$total,$paid,$change,$note);$st->execute();$tid=$conn->insert_id;
  foreach($items as $it){$d=$conn->prepare("INSERT INTO transaksi_detail(transaksi_id,menu_id,nama_menu,harga,qty,subtotal) VALUES(?,?,?,?,?,?)");$d->bind_param("iisiii",$tid,$it["id"],$it["nama"],$it["harga"],$it["qty"],$it["subtotal"]);$d->execute();}
  header("Location: admin_cashier.php?saved=1&kode=".urlencode($kode));exit;
 }
}
require "header.php";
?>
<section class="section cashier-section admin-cashier">
<?php if(isset($_GET["saved"])): ?><div class="alert success">✓ Transaksi <b><?=e($_GET["kode"]??"")?></b> berhasil disimpan ke database.</div><?php endif; ?>
<div class="section-heading"><div><span class="eyebrow">POINT OF SALE ADMIN</span><h2>Kasir Dapoer Omom</h2></div><p>Admin dapat melayani transaksi langsung dari laptop maupun HP.</p></div>
<?php if($error):?><div class="alert error"><?=e($error)?></div><?php endif;?>
<form method="post"><input type="hidden" name="save_cashier" value="1"><div class="cashier-layout">
<div class="card cashier-white"><div class="panel-title"><div><span class="mini-label">MENU</span><h3>Pilih Pesanan</h3></div></div><div class="cashier-menu-grid">
<?php while($m=$menus->fetch_assoc()):?><div class="cashier-item"><div><b><?=e($m["nama"])?></b><small><?=rupiah($m["harga"])?></small></div><input type="hidden" name="id[]" value="<?=$m["id"]?>"><label>Qty<input type="number" name="qty[]" value="0" min="0"></label></div><?php endwhile;?></div></div>
<div class="card"><span class="mini-label">PEMBAYARAN</span><h3>Detail Kasir</h3><label>Pelanggan<input name="pelanggan" placeholder="Nama pelanggan"></label><label>Metode<select name="metode" id="cashMetode"><option>Cash</option><option>QRIS</option><option>Transfer</option></select></label><label>Uang dibayar<input type="number" name="dibayar" id="cashPaid" value="0" min="0"></label><div class="change-box"><span>Total dihitung otomatis saat disimpan</span><strong>Kasir</strong></div><label>Catatan<input name="catatan" placeholder="Contoh: tidak pedas"></label><button class="btn btn-primary full">✓ Simpan Transaksi</button></div>
</div></form></section>
<?php require "footer.php"; ?>