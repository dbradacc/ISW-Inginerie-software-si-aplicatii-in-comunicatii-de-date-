<?php
/*  /views/audit/list.php  */
?>
<?php include __DIR__ . '/../templates/header.php'; ?>

<h1>Audit log</h1>

<div class="table-responsive">
  <table class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>User</th>
        <th>IP</th>
        <th>Acțiune</th>
        <th>Tabel</th>
        <th>ID</th>
        <th>Info</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($logs as $l): ?>
        <tr>
          <td><?= $l['ID_Audit'] ?></td>
          <td><?= htmlspecialchars($l['username']) ?></td>
          <td><?= $l['IP'] ?></td>
          <td><?= $l['Actiune'] ?></td>
          <td><?= $l['Entitate'] ?></td>
          <td><?= $l['ID_Ent'] ?? '-' ?></td>
          <td style="white-space: pre-wrap; max-width: 300px;">
            <?php if (!empty($l['Info'])): ?>
              <code><?= htmlspecialchars($l['Info']) ?></code>
            <?php else: ?>
              &ndash;
            <?php endif; ?>
          </td>
          <td><?= $l['Created_at'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>