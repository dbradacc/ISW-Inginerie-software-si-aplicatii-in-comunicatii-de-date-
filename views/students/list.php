<?php include __DIR__.'/../templates/header.php'; ?>
<h1>Lista Studenți</h1>

<a href="index.php?resource=students&action=create"
   class="btn btn-primary mb-2">Adaugă student</a>
   
<a href="index.php?resource=export&action=csv&type=students"
   class="btn btn-outline-secondary btn-sm mb-2">CSV</a>
   
   <form class="row g-2 mb-3" method="get" action="">
  <input type="hidden" name="resource" value="students">
  <div class="col-md-6">
    <input name="q" value="<?= htmlspecialchars($_GET['q']??'') ?>"
           class="form-control" placeholder="Caută nume / email…">
  </div>
  <div class="col-md-3">
    <select name="an" class="form-select">
      <option value="">– toate anii –</option>
      <?php for($i=1;$i<=6;$i++): ?>
        <option value="<?= $i ?>" <?= ($_GET['an']??'')==$i?'selected':'' ?>>An <?= $i ?></option>
      <?php endfor; ?>
    </select>
  </div>
  <div class="col-md-3">
    <button class="btn btn-primary w-100">Filtrează</button>
  </div>
</form>

<form class="row g-2 mb-3" method="get" action="">
  <input type="hidden" name="resource" value="students">
  <div class="col-md-6">
    <input name="q" value="<?= htmlspecialchars($_GET['q']??'') ?>"
           class="form-control" placeholder="Caută nume / email…">
  </div>
  <div class="col-md-3">
    <select name="an" class="form-select">
      <option value="">– toate anii –</option>
      <?php for($i=1;$i<=6;$i++): ?>
        <option value="<?= $i ?>" <?= ($_GET['an']??'')==$i?'selected':'' ?>>An <?= $i ?></option>
      <?php endfor; ?>
    </select>
  </div>
  <div class="col-md-3">
    <button class="btn btn-primary w-100">Filtrează</button>
  </div>
</form>

<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th><th>Nume</th><th>An</th><th>Email</th><th>Telefon</th><th>Acțiuni</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($students as $st): ?>
    <tr>
      <td><?= $st['ID_Student'] ?></td>
      <td><?= htmlspecialchars($st['Nume'].' '.$st['Prenume']) ?></td>
      <td><?= $st['An_Studiu'] ?></td>
      <td><?= htmlspecialchars($st['Email']) ?></td>
      <td><?= htmlspecialchars($st['Telefon']) ?></td>
      <td>
        <a href="index.php?resource=students&action=edit&id=<?= $st['ID_Student'] ?>"
           class="btn btn-sm btn-warning">Editează</a>
        <a href="index.php?resource=students&action=delete&id=<?= $st['ID_Student'] ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Ștergi studentul?')">Șterge</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php include __DIR__.'/../templates/footer.php'; ?>