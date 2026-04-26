<?php include __DIR__.'/../templates/header.php'; ?>
<h1><?= isset($student)?'Editează':'Adaugă' ?> student</h1>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post" action="">
  <div class="row">
    <div class="col-md-6 mb-3">
      <label class="form-label">Nume</label>
      <input name="nume" value="<?= $student['Nume'] ?? '' ?>"
             class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
      <label class="form-label">Prenume</label>
      <input name="prenume" value="<?= $student['Prenume'] ?? '' ?>"
             class="form-control" required>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input name="email" type="email"
           value="<?= $student['Email'] ?? '' ?>" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Telefon</label>
    <input name="telefon" type="tel" maxlength="10"
           pattern="^\d{1,10}$"
           value="<?= $student['Telefon'] ?? '' ?>"
           class="form-control" required>
    <div class="form-text">Doar cifre, maxim 10.</div>
  </div>

  <div class="mb-3">
    <label class="form-label">An studiu</label>
    <input name="an_studiu" type="number" min="1" max="6"
           value="<?= $student['An_Studiu'] ?? '' ?>" class="form-control" required>
  </div>

  <button class="btn btn-success">
    <?= isset($student)?'Salvează':'Adaugă' ?>
  </button>
</form>
<?php include __DIR__.'/../templates/footer.php'; ?>