<?php include __DIR__.'/../templates/header.php'; ?>
<h1><?= isset($user)?'Editează':'Adaugă' ?> utilizator</h1>
<form method="post" action="">
  <div class="mb-3">
    <label class="form-label">Username</label>
    <input name="username" value="<?= $user['username']??'' ?>" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Parolă <?= isset($user)?'(lasă gol pentru a păstra)': '' ?></label>
    <input name="password" type="password" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Rol</label>
    <select name="role" class="form-select">
      <?php foreach (['admin','secretar','profesor'] as $r): ?>
        <option value="<?= $r ?>" <?= isset($user)&&$user['Role']==$r?'selected':'' ?>><?= $r ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <button class="btn btn-success">Salvează</button>
</form>
<?php include __DIR__.'/../templates/footer.php'; ?>
