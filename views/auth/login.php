<?php include __DIR__ . '/../templates/header.php'; ?>

<h1>Autentificare</h1>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post" action="index.php?resource=auth&action=login" class="w-25">
  <div class="mb-3">
    <label class="form-label">Utilizator</label>
    <input name="username" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Parolă</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button class="btn btn-primary">Log in</button>
</form>

<?php include __DIR__ . '/../templates/footer.php'; ?>
