<?php
require "auth.php";require_admin();
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header('Content-Disposition: attachment; filename="Rekap_Dapoer_Omom_'.date("Y-m-d").'.xls"');
echo "<table border='1'><tr><th>Kode</th><th>Tanggal</th><th>Pelanggan</th><th>User</th><th>Metode</th><th>Total</th><th>Dibayar</th><th>Kembalian</th><th>Catatan</th></tr>";
$r=$conn->query("SELECT t.*,u.nama user_nama FROM transaksi t LEFT JOIN users u ON u.id=t.user_id ORDER BY t.id DESC");
while($x=$r->fetch_assoc()){echo "<tr><td>".e($x["kode"])."</td><td>".e($x["created_at"])."</td><td>".e($x["pelanggan"])."</td><td>".e($x["user_nama"]??"-")."</td><td>".e($x["metode"])."</td><td>".$x["total"]."</td><td>".$x["dibayar"]."</td><td>".$x["kembalian"]."</td><td>".e($x["catatan"])."</td></tr>";}
echo "</table>";?>