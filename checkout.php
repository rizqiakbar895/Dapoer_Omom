<?php
require "auth.php"; 
require_login(); 

$page_title="Checkout — Dapoer Omom";


if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["qty"])){
    $_SESSION["cart"]=$_POST["qty"];
}


$cart=$_SESSION["cart"]??[];
$items=[];
$total=0;


foreach($cart as $id=>$qty){

    $qty=(int)$qty;

    if($qty<1) continue;

    $id=(int)$id;


    $st=$conn->prepare(
        "SELECT * FROM menu WHERE id=? AND status=1"
    );

    $st->bind_param("i",$id);

    $st->execute();


    $m=$st->get_result()->fetch_assoc();


    if($m){

        $m["qty"]=$qty;

        $m["subtotal"]=$m["harga"]*$qty;

        $items[]=$m;

        $total += $m["subtotal"];

    }

}




if(isset($_POST["submit_order"])){

    if(!$items){

        $error="Keranjang masih kosong.";

    }else{


        $pelanggan =
        trim($_POST["pelanggan"])
        ?:$_SESSION["user"]["nama"];


        $metode=$_POST["metode"];

        $catatan=trim($_POST["catatan"]);


        $tujuan="";



        // upload bukti QRIS

        if($metode==="QRIS"){


            if(empty($_FILES["bukti"]["name"])){

                $error="Silahkan upload bukti pembayaran QRIS.";

            }else{


                $namaFile=time()."_".$_FILES["bukti"]["name"];

                $tujuan="uploads/bukti/".$namaFile;


                move_uploaded_file(
                    $_FILES["bukti"]["tmp_name"],
                    $tujuan
                );


            }


        }




        if(empty($error)){



            $dibayar=$total;

            $kembalian=0;



            $kode =
            "DO-".date("YmdHis")."-".random_int(10,99);



            $uid=$_SESSION["user"]["id"];



            $st=$conn->prepare(

            "INSERT INTO transaksi
            (kode,user_id,pelanggan,metode,total,dibayar,kembalian,catatan)
            VALUES(?,?,?,?,?,?,?,?)"

            );



            $st->bind_param(

            "sissiiis",

            $kode,
            $uid,
            $pelanggan,
            $metode,
            $total,
            $dibayar,
            $kembalian,
            $catatan

            );


            $st->execute();


            $tid=$conn->insert_id;



            foreach($items as $it){


                $d=$conn->prepare(

                "INSERT INTO transaksi_detail
                (transaksi_id,menu_id,nama_menu,harga,qty,subtotal)
                VALUES(?,?,?,?,?,?)"

                );


                $d->bind_param(

                "iisiii",

                $tid,
                $it["id"],
                $it["nama"],
                $it["harga"],
                $it["qty"],
                $it["subtotal"]

                );


                $d->execute();


            }
                        $msg="Halo Dapoer Omom!\n\nSaya mau pesan:\n\n";


            foreach($items as $i=>$it){

                $msg.=($i+1).
                ". ".$it["nama"].
                " x".$it["qty"].
                " — ".
                rupiah($it["subtotal"]).
                "\n";

            }



            $msg.="\nTotal: ".rupiah($total);

            $msg.="\nNama: ".$pelanggan;

            $msg.="\nMetode: ".$metode;



            if($catatan){

                $msg.="\nCatatan: ".$catatan;

            }



            $msg.="\n\nTerima kasih!";



            unset($_SESSION["cart"]);



            $wa =
            "https://wa.me/6281386489122?text="
            .rawurlencode($msg);



            header(

            "Location: success.php?kode="
            .urlencode($kode)
            ."&wa="
            .urlencode($wa)
            ."&bukti="
            .urlencode($tujuan)

            );



            exit;


        }

    }

}

require "header.php";

?>

<section class="section">

<div class="cashier-layout">


<div class="card">


<div class="panel-title">

<div>

<span class="mini-label">
PESANAN
</span>

<h3>
Detail Order
</h3>

</div>


<a class="text-btn" href="menu.php">
← Ubah Menu
</a>


</div>



<?php foreach($items as $it): ?>


<div class="cart-item static">


<div>

<h4>
<?=e($it["nama"])?>
</h4>


<small>
<?=rupiah($it["harga"])?> × <?=$it["qty"]?>
</small>


</div>


<div class="item-total">

<?=rupiah($it["subtotal"])?>

</div>


</div>


<?php endforeach; ?>



<div class="summary">


<div>

<span>
Subtotal
</span>

<strong>
<?=rupiah($total)?>
</strong>

</div>



<div class="grand">

<span>
Total
</span>


<strong>
<?=rupiah($total)?>
</strong>


</div>


</div>


</div>





<form method="post"
enctype="multipart/form-data"
class="card payment-panel">


<input type="hidden" name="submit_order" value="1">


<span class="mini-label">
PEMBAYARAN
</span>


<h3>
Pilih Pembayaran
</h3>




<label>

Nama pelanggan


<input

name="pelanggan"

value="<?=e($_SESSION["user"]["nama"])?>"

required>

</label>





<label>

Metode pembayaran


<select name="metode" id="metode">


<option value="Cash">
Cash
</option>



<option value="QRIS">
QRIS
</option>



</select>


</label>





<div id="qris-box" style="display:none;text-align:center;">



<img src="assets/qris.jpeg" width="250">



<p>
Scan QRIS untuk melakukan pembayaran
</p>



<label>

Upload Bukti Pembayaran


<input

type="file"

name="bukti"

accept="image/*">


</label>



</div>





<label>

Catatan


<input

name="catatan"

placeholder="Contoh: tidak pedas">


</label>





<button class="btn btn-primary full">

✓ Beli Sekarang & WhatsApp

</button>


</form>


</div>

</section>




<script>


const metode=document.getElementById('metode');

const qris=document.getElementById('qris-box');



metode.addEventListener('change',()=>{


if(metode.value==="QRIS"){

qris.style.display="block";

}else{

qris.style.display="none";

}


});


</script>



<?php require "footer.php"; ?>