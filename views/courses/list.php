<?php include __DIR__.'/../templates/header.php'; ?>
<h1>Lista Cursuri</h1>
<a href="index.php?resource=courses&action=create"
   class="btn btn-primary mb-2">Adaugă curs</a>
   
   <a href="index.php?resource=export&action=csv&type=courses"
   class="btn btn-outline-secondary btn-sm mb-2">CSV</a>

<form class="row g-2 mb-3" method="get" action="">
  <input type="hidden" name="resource" value="courses">
  <div class="col-md-6">
    <input name="q" value="<?= htmlspecialchars($_GET['q']??'') ?>"
           class="form-control" placeholder="Caută denumire / profesor…">
  </div>
  <div class="col-md-3">
    <select name="sem" class="form-select">
      <option value="">– toate semestrele –</option>
      <option value="1" <?= ($_GET['sem']??'')==1?'selected':'' ?>>Sem 1</option>
      <option value="2" <?= ($_GET['sem']??'')==2?'selected':'' ?>>Sem 2</option>
    </select>
  </div>
  <div class="col-md-3">
    <button class="btn btn-primary w-100">Filtrează</button>
  </div>
</form>

<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th><th>Denumire</th><th>Profesor</th>
      <th>Credite</th><th>Semestru</th><th>Acțiuni</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($courses as $c): ?>
    <tr>
      <td><?= $c['ID_Curs'] ?></td>
      <td><?= htmlspecialchars($c['Denumire']) ?></td>
      <td><?= htmlspecialchars($c['Profesor_Titular']) ?></td>
      <td><?= $c['Nr_Credite'] ?></td>
      <td><?= $c['Semester'] ?></td>
      <td>
        <a href="index.php?resource=courses&action=edit&id=<?= $c['ID_Curs'] ?>"
           class="btn btn-sm btn-warning">Editează</a>
        <a href="index.php?resource=courses&action=delete&id=<?= $c['ID_Curs'] ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Ștergi cursul?')">Șterge</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php include __DIR__.'/../templates/footer.php'; ?>
