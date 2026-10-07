<?php
require_once __DIR__ . '/config.php';
$pageTitle = 'Dashboard';
try {
    $pdo = db();
    $donorCount = (int)$pdo->query('SELECT COUNT(*) FROM donors')->fetchColumn();
    $totalUnits = (int)$pdo->query('SELECT COALESCE(SUM(units),0) FROM blood_stock')->fetchColumn();
    $pendingCount = (int)$pdo->query("SELECT COUNT(*) FROM blood_requests WHERE status='Pending'")->fetchColumn();
    $stock = $pdo->query('SELECT * FROM blood_stock ORDER BY FIELD(blood_group,"A+","A-","B+","B-","AB+","AB-","O+","O-")')->fetchAll();
    $recent = $pdo->query('SELECT requester_name,blood_group,units,status,created_at FROM blood_requests ORDER BY created_at DESC LIMIT 5')->fetchAll();
} catch (Throwable $ex) { http_response_code(500); exit('Database is not ready. Import database/blood_bank.sql and check config.php.'); }
require __DIR__ . '/includes/header.php';
?>
<section class="page-head"><div><div class="eyebrow">Overview</div><h1>Good day, blood bank team</h1><p class="subtext">Here is the current activity across your sample blood bank.</p></div><a class="btn" href="requests.php?new=1">＋ New blood request</a></section>
<section class="grid stats">
<article class="card stat"><div class="stat-top">Registered donors <span class="stat-icon">♙</span></div><strong><?= $donorCount ?></strong><small>Fictional demo records</small></article>
<article class="card stat"><div class="stat-top">Available units <span class="stat-icon">✚</span></div><strong><?= $totalUnits ?></strong><small>Across all blood groups</small></article>
<article class="card stat"><div class="stat-top">Pending requests <span class="stat-icon">◷</span></div><strong><?= $pendingCount ?></strong><small>Waiting for staff review</small></article>
<article class="card stat"><div class="stat-top">Low stock groups <span class="stat-icon">!</span></div><strong><?= count(array_filter($stock, fn($s) => (int)$s['units'] < (int)$s['low_stock_threshold'])) ?></strong><small>Below the sample threshold</small></article>
</section>
<section class="grid two-col"><div class="panel"><div class="panel-title"><h2>Blood stock</h2><a class="btn secondary small" href="stock.php">Manage stock →</a></div><div class="blood-grid">
<?php foreach ($stock as $item): $units=(int)$item['units']; $threshold=(int)$item['low_stock_threshold']; $pct=min(100, (int)round($units/ max($threshold*2,1)*100)); ?>
<div class="blood-cell <?= $units < $threshold ? 'stock-low' : '' ?>"><div class="blood-type"><?= e($item['blood_group']) ?></div><div class="blood-units"><?= $units ?></div><small>units available<?= $units < $threshold ? ' · Low stock' : '' ?></small><div class="progress"><i style="width:<?= $pct ?>%"></i></div></div>
<?php endforeach; ?></div></div>
<div class="panel"><div class="panel-title"><h2>Quick actions</h2></div><p class="subtext">Keep the sample records up to date.</p><p><a class="btn" href="donors.php?new=1">＋ Add donor</a></p><p><a class="btn secondary" href="stock.php">↻ Update blood stock</a></p><div class="callout">This dashboard uses fictional records for a college project. It is not a live blood availability service.</div></div></section>
<section class="panel"><div class="panel-title"><h2>Latest requests</h2><a class="btn secondary small" href="requests.php">View all →</a></div><?php if (!$recent): ?><div class="empty">No requests have been recorded yet.</div><?php else: ?><div class="table-wrap"><table><thead><tr><th>Requester</th><th>Blood group</th><th>Units</th><th>Status</th><th>Received</th></tr></thead><tbody><?php foreach($recent as $r): ?><tr><td><?= e($r['requester_name']) ?></td><td><span class="badge danger"><?= e($r['blood_group']) ?></span></td><td><?= (int)$r['units'] ?></td><td><span class="badge <?= $r['status']==='Fulfilled'?'success':($r['status']==='Pending'?'warning':'') ?>"><?= e($r['status']) ?></span></td><td><?= e(date('d M Y', strtotime($r['created_at']))) ?></td></tr><?php endforeach; ?></tbody></table></div><?php endif; ?></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
