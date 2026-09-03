<?php
require_once __DIR__.'/auth.php';
$cfg=require __DIR__.'/../config.php';
$current=basename($_SERVER['PHP_SELF']);
$cartCount=array_sum($_SESSION['cart'] ?? []);
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=e($cfg['site_name'])?></title><link rel="stylesheet" href="assets/style.css"></head><body>
<header><a class="brand" href="index.php">SENTINEL GEAR</a><nav>
<a class="<?=$current==='index.php'?'active':''?>" href="index.php">Home</a>
<a class="<?=$current==='shop.php'?'active':''?>" href="shop.php">Shop</a>
<a class="<?=$current==='orders.php'?'active':''?>" href="orders.php">Orders</a>
<a class="<?=in_array($current,['account.php','login.php','signup.php'])?'active':''?>" href="account.php">Account</a>
<a href="cart.php">Cart (<?=$cartCount?>)</a></nav></header><main>
