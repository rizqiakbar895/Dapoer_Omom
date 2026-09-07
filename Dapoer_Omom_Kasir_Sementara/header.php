<?php require_once "config.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,viewport-fit=cover">
<meta name="theme-color" content="#7d1f19">

<title><?=e($page_title ?? "Dapoer Omom")?></title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="style.css">
</head>

<body>

<header class="navbar">

    <a class="brand" href="index.php">

        <!-- LOGO DAPOER OMOM -->
        <img 
            src="assets/logo-dapoer.png" 
            alt="Logo Dapoer Omom" 
            class="brand-logo"
        >

        <span>
            <b>Dapoer Omom</b>
            <small>Enaknya Bikin Nagih!</small>
        </span>

    </a>

    <nav>
        <a href="index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="about.php">Tentang Kami</a>

        <?php if(!empty($_SESSION["user"]) && $_SESSION["user"]["role"]==="user"): ?>
            <a href="orders.php">Pesanan Saya</a>
        <?php endif; ?>

        <?php if(!empty($_SESSION["user"]) && $_SESSION["user"]["role"]==="admin"): ?>
            <a href="admin.php">Dashboard</a>
            <a href="admin_cashier.php">Kasir</a>
        <?php endif; ?>
    </nav>

    <div class="nav-user">

        <?php if(!empty($_SESSION["user"])): ?>

            <span class="user-name">
                <?=e($_SESSION["user"]["nama"])?>
            </span>

            <a class="nav-cta" href="logout.php">
                Logout
            </a>

        <?php else: ?>

            <a class="nav-cta" href="login.php">
                Login
            </a>

        <?php endif; ?>

    </div>

</header>

<main>