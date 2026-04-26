<?php include __DIR__.'/../templates/header.php'; ?>
<h1><?= isset($course)?'Editează':'Adaugă' ?> curs</h1>

<form method="post" action="">
  <div class="mb-3">
    <label class="form-label">Denumire</label>
    <input name="denumire" class="form-control"
           value="<?= $course['Denumire'] ?? '' ?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Profesor titular</label>
    <input name="profesor" class="form-control"
           value="<?= $course['Profesor_Titular'] ?? '' ?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Nr. credite</label>
    <input name="nr_credite" type="number" min="1" max="30"
           value="<?= $course['Nr_Credite'] ?? '' ?>" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Semestru</label>
    <select name="semester" class="form-select" required>
      <?php for ($s=1;$s<=2;$s++): ?>
        <option value="<?= $s ?>"
          <?= isset($course)&&$course['Semester']==$s?'selected':'' ?>><?= $s ?></option>
      <?php endfor; ?>
    </select>
  </div>

  <button class="btn btn-success"><?= isset($course)?'Salvează':'Adaugă' ?></button>
</form>
<?php include __DIR__.'/../templates/footer.php'; ?>
