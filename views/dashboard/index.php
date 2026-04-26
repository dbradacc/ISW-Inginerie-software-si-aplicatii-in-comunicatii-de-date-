<?php include __DIR__.'/../templates/header.php'; ?>
<h1>Dashboard</h1>

<div class="row text-center mb-4">
  <div class="col-md-4">
    <div class="card bg-light">
      <div class="card-body">
        <h2><?= $totalStudents ?></h2>
        <p class="text-muted">Studenți</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card bg-light">
      <div class="card-body">
        <h2><?= $totalCourses ?></h2>
        <p class="text-muted">Cursuri</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card bg-light">
      <div class="card-body">
        <h2><?= $totalPresence ?></h2>
        <p class="text-muted">Prezențe înregistrate</p>
      </div>
    </div>
  </div>
</div>

<canvas id="chart" height="100"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = <?= json_encode(array_column($attendance,'Student')) ?>;
const sem1   = <?= json_encode(array_column($attendance,'Sem1')) ?>;
const sem2   = <?= json_encode(array_column($attendance,'Sem2')) ?>;

new Chart(document.getElementById('chart'),{
  type:'bar',
  data:{ labels:labels,
         datasets:[
           { label:'Sem 1', data:sem1 },
           { label:'Sem 2', data:sem2 }
         ] },
  options:{ scales:{ y:{ beginAtZero:true, max:14 } } }
});
</script>

<?php include __DIR__.'/../templates/footer.php'; ?>