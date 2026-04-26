<?php include __DIR__ . '/../templates/header.php'; ?>

<h1><?= isset($enrollment) ? 'Editează înscriere' : 'Adaugă înscriere' ?></h1>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post" action="">

  <!-- Student dropdown -->
  <div class="mb-3">
    <label class="form-label">Student</label>
    <select name="id_student" class="form-select" required>
      <option value="">— selectează student —</option>
      <?php foreach ($students as $st): ?>
        <?php $sel = (isset($enrollment) && $enrollment['ID_Student'] == $st['ID_Student']) ? 'selected' : ''; ?>
        <option value="<?= $st['ID_Student'] ?>" <?= $sel ?>>
          <?= $st['ID_Student'] ?> — <?= htmlspecialchars($st['Nume'].' '.$st['Prenume']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Curs dropdown -->
  <div class="mb-3">
    <label class="form-label">Curs</label>
    <select name="id_curs" class="form-select" required>
      <option value="">— selectează curs —</option>
      <?php foreach ($courses as $c): ?>
        <?php $sel = (isset($enrollment) && $enrollment['ID_Curs'] == $c['ID_Curs']) ? 'selected' : ''; ?>
        <option value="<?= $c['ID_Curs'] ?>" <?= $sel ?>>
          <?= $c['ID_Curs'] ?> — <?= htmlspecialchars($c['Denumire']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Notă -->
  <div class="mb-3">
    <label class="form-label">Notă</label>
    <input name="nota" type="number" step="0.1" min="1" max="10"
           value="<?= $enrollment['Nota_Finala'] ?? '' ?>" class="form-control" required>
  </div>

  <button class="btn btn-success">
    <?= isset($enrollment) ? 'Salvează' : 'Adaugă' ?>
  </button>
</form>

<?php include __DIR__ . '/../templates/footer.php'; ?>