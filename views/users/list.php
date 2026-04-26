<?php include __DIR__.'/../templates/header.php'; ?>
<h1>Utilizatori</h1>
<a href="index.php?resource=users&action=create" class="btn btn-primary mb-2">Adaugă</a>
<table class="table table-striped">
  <thead><tr><th>ID</th><th>Username</th><th>Rol</th><th>Acțiuni</th></tr></thead>
  <tbody>
  <?php foreach ($users as $u): ?>
   <tr>
    <td><?= $u['ID_User'] ?></td>
    <td><?= htmlspecialchars($u['username']) ?></td>
    <td><?= $u['Role'] ?></td>
    <td>
      <a href="index.php?resource=users&action=edit&id=<?= $u['ID_User'] ?>" class="btn btn-sm btn-warning">Editează</a>
      <a href="index.php?resource=users&action=delete&id=<?= $u['ID_User'] ?>" class="btn btn-sm btn-danger"
         onclick="return confirm('Ștergi userul?')">Șterge</a>
    </td>
   </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php include __DIR__.'/../templates/footer.php'; ?>
