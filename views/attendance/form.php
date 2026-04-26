<?php include __DIR__.'/../templates/header.php'; ?>
<h1><?= isset($item)?'Editează':'Adaugă' ?> prezență</h1>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post" action="">
  <div class="row">
    <div class="col-md-3 mb-3">
      <label class="form-label">Data</label>
      <input name="data" type="date"
             value="<?= $item['Data'] ?? date('Y-m-d') ?>"
             class="form-control" required>
    </div>

    <div class="col-md-3 mb-3">
      <label class="form-label">Semestru</label>
      <select name="semester" class="form-select" required>
        <?php for ($s=1;$s<=2;$s++): ?>
          <option value="<?= $s ?>"
            <?= isset($item)&&$item['Semester']==$s?'selected':'' ?>><?= $s ?></option>
        <?php endfor; ?>
      </select>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 mb-3">
      <label class="form-label">Student</label>
      <select name="id_student" class="form-select" required>
        <?php foreach ($students as $st): ?>
          <option value="<?= $st['ID_Student'] ?>"
            <?= isset($item)&&$item['ID_Student']==$st['ID_Student']?'selected':'' ?>>
            <?= $st['ID_Student'] ?> — <?= htmlspecialchars($st['Nume'].' '.$st['Prenume']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-4 mb-3">
      <label class="form-label">Curs</label>
      <select name="id_curs" class="form-select" required>
        <?php foreach ($courses as $c): ?>
          <option value="<?= $c['ID_Curs'] ?>"
            <?= isset($item)&&$item['ID_Curs']==$c['ID_Curs']?'selected':'' ?>>
            <?= $c['ID_Curs'] ?> — <?= htmlspecialchars($c['Denumire']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" required>
      <option value="prezent" <?= isset($item)&&$item['Status']=='prezent'?'selected':'' ?>>Prezent</option>
      <option value="absent"  <?= isset($item)&&$item['Status']=='absent' ?'selected':'' ?>>Absent</option>
    </select>
  </div>

  <button class="btn btn-success">Salvează</button>
  <a href="index.php?resource=attendance" class="btn btn-secondary">Renunță</a>
</form>
<?php include __DIR__.'/../templates/footer.php'; ?>
