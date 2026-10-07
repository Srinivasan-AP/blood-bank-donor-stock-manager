<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
$notice = take_flash();
$current = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= e($pageTitle ?? 'Dashboard') ?> · LifeLine Blood Bank</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="demo-banner">Educational demo · Sample data only · Not for real medical use</div>
<header class="topbar"><a class="brand" href="index.php"><span class="brand-mark">✚</span><span>LifeLine<small>Blood Bank Manager</small></span></a>
<button class="menu-toggle" aria-label="Toggle navigation" aria-expanded="false">☰</button>
<nav class="nav-links"><a class="<?= $current==='index.php'?'active':'' ?>" href="index.php">Dashboard</a><a class="<?= $current==='donors.php'?'active':'' ?>" href="donors.php">Donors</a><a class="<?= $current==='stock.php'?'active':'' ?>" href="stock.php">Blood stock</a><a class="<?= $current==='requests.php'?'active':'' ?>" href="requests.php">Requests</a><a class="<?= $current==='about.php'?'active':'' ?>" href="about.php">About</a></nav></header>
<main class="container">
<?php if ($notice): ?><div class="alert <?= e($notice['type']) ?>"><?= e($notice['message']) ?></div><?php endif; ?>
