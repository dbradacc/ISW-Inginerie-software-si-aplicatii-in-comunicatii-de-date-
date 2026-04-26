<?php include __DIR__ . '/../templates/header.php'; ?>

<h1>Catalog Prezențe</h1>

<a href="index.php?resource=attendance&action=create"
   class="btn btn-primary mb-2">Adaugă prezență</a>
   
   <a href="index.php?resource=export&action=csv&type=attendance"
   class="btn btn-outline-secondary btn-sm mb-2">CSV</a>

<form class="row g-2 mb-3" method="get" action="">
  <input type="hidden" name="resource" value="attendance">
  <div class="col-md-3">
    <input name="student" value="<?= htmlspecialchars($_GET['student']??'') ?>"
           class="form-control" placeholder="Filtru student…">
  </div>
  <div class="col-md-3">
    <input name="curs" value="<?= htmlspecialchars($_GET['curs']??'') ?>"
           class="form-control" placeholder="Filtru curs…">
  </div>
  <div class="col-md-3">
    <select name="sem" class="form-select">
      <option value="">– semestru –</option>
      <option value="1" <?= ($_GET['sem']??'')==1?'selected':'' ?>>Sem 1</option>
      <option value="2" <?= ($_GET['sem']??'')==2?'selected':'' ?>>Sem 2</option>
    </select>
  </div>
  <div class="col-md-3">
    <button class="btn btn-primary w-100">Filtrează</button>
  </div>
</form>

<!---------------------  TABEL  --------------------->
<table class="table table-striped">
  <thead class="table-dark">
    <tr>
      <th>Data</th>
      <th>Sem</th>
      <th>ID Student</th><th>Student</th>
      <th>ID Curs</th>   <th>Curs</th>
      <th>Status</th><th>Acțiuni</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($attendance as $a): ?>
    <tr>
      <td><?= $a['Data'] ?></td>
      <td><?= $a['Semester'] ?></td>

      <td><?= $a['ID_Student'] ?></td>
      <td><?= htmlspecialchars($a['Student']) ?></td>

      <td><?= $a['ID_Curs'] ?></td>
      <td><?= htmlspecialchars($a['Curs']) ?></td>

      <td>
        <?php if ($a['Status'] === 'prezent'): ?>
          <span class="badge bg-success">&nbsp;</span>
        <?php else: ?>
          <span class="badge bg-danger">&nbsp;</span>
        <?php endif; ?>
      </td>

      <td>
        <a href="index.php?resource=attendance&action=edit&id=<?= $a['ID_Prezenta'] ?>"
           class="btn btn-sm btn-warning">Editează</a>
        <a href="index.php?resource=attendance&action=delete&id=<?= $a['ID_Prezenta'] ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Ștergi înregistrarea?')">Șterge</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<!---------------------  GRAFICE  --------------------->
<h2 class="mt-5">Statistici prezență pe semestre</h2>
<canvas id="chart" height="120"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = <?= json_encode(array_column($stats,'Student')) ?>;
const sem1   = <?= json_encode(array_column($stats,'Sem1')) ?>;
const sem2   = <?= json_encode(array_column($stats,'Sem2')) ?>;

new Chart(document.getElementById('chart'), {
  type: 'bar',
  data: {
    labels: labels,
    datasets: [
      { label: 'Semestrul 1 (max 14)', data: sem1 },
      { label: 'Semestrul 2 (max 14)', data: sem2 }
    ]
  },
  options: {
    scales: { y: { beginAtZero: true, max: 14 } },
    responsive: true
  }
});
</script>

<?php include __DIR__ . '/../templates/footer.php'; ?>