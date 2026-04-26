<?php include __DIR__.'/../templates/header.php'; ?>

<style>
  /* Base & Typography */
  body {
    background-color: #f8fafc;
  }
  .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding: 1rem 1.5rem;
    background: #ffffff;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    flex-wrap: wrap;
    gap: 1rem;
  }
  .page-title {
    margin: 0 0 0.15rem 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: -0.01em;
  }
  .page-subtitle {
    margin: 0;
    font-size: 0.85rem;
    color: #64748b;
  }
  .header-actions {
    display: flex;
    gap: 0.75rem;
    align-items: center;
  }
  
  /* Main Cards */
  .admin-card {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02), 0 4px 12px rgba(0, 0, 0, 0.01);
    border: 1px solid #e5e7eb;
    margin-bottom: 1.5rem;
  }
  
  /* Filter Area */
  .filter-wrapper {
    padding: 1rem 1.25rem;
  }
  .filter-form .form-control, .filter-form .form-select {
    border-radius: 6px;
    border: 1px solid #d1d5db;
    font-size: 0.9rem;
    padding: 0.4rem 0.75rem;
    height: 36px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.01);
    color: #111827;
  }
  .filter-form .form-control:focus, .filter-form .form-select:focus {
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    border-color: #3b82f6;
    outline: none;
  }
  
  /* Buttons */
  .btn-dashboard {
    height: 36px;
    padding: 0 1rem;
    font-size: 0.9rem;
    font-weight: 500;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.15s ease;
    text-decoration: none;
  }
  .btn-primary-custom {
    background-color: #0f172a;
    color: #ffffff;
    border: 1px solid transparent;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  }
  .btn-primary-custom:hover {
    background-color: #1e293b;
    color: #ffffff;
  }
  .btn-secondary-custom {
    background-color: #ffffff;
    color: #374151;
    border: 1px solid #d1d5db;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
  }
  .btn-secondary-custom:hover {
    background-color: #f9fafb;
    color: #111827;
    border-color: #9ca3af;
  }

  /* Table styles */
  .table-card {
    padding: 0;
    overflow: hidden;
  }
  .table {
    margin-bottom: 0;
  }
  .table th {
    background-color: #ffffff;
    color: #6b7280;
    font-weight: 500;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid #e5e7eb;
    border-top: none;
  }
  .table td {
    padding: 0.6rem 1rem;
    vertical-align: middle;
    color: #111827;
    font-size: 0.9rem;
    border-bottom: 1px solid #f3f4f6;
  }
  .table tbody tr:last-child td {
    border-bottom: none;
  }
  .table tbody tr {
    transition: background-color 0.1s ease;
  }
  .table tbody tr:hover {
    background-color: #f1f5f9;
  }
  
  /* Action buttons inside table */
  .btn-action {
    padding: 0.25rem 0.6rem;
    font-size: 0.8rem;
    font-weight: 500;
    border-radius: 6px;
    transition: all 0.15s;
    display: inline-flex;
    align-items: center;
  }
  .btn-edit {
    color: #0369a1;
    background-color: #f0f9ff;
    border: 1px solid #bae6fd;
  }
  .btn-edit:hover {
    background-color: #e0f2fe;
    border-color: #7dd3fc;
    color: #0284c7;
  }
  .btn-delete {
    color: #be123c;
    background-color: #fff1f2;
    border: 1px solid #fecdd3;
  }
  .btn-delete:hover {
    background-color: #ffe4e6;
    border-color: #fda4af;
    color: #e11d48;
  }
</style>

<div class="page-header">
  <div>
    <h1 class="page-title">Lista Cursuri</h1>
    <p class="page-subtitle">Gestionează cursurile înregistrate în platformă</p>
  </div>
  <div class="header-actions">
    <a href="index.php?resource=export&action=csv&type=courses" class="btn-dashboard btn-secondary-custom">Export CSV</a>
    <a href="index.php?resource=courses&action=create" class="btn-dashboard btn-primary-custom">Adaugă curs</a>
  </div>
</div>

<!-- Filter Card -->
<div class="admin-card">
  <div class="filter-wrapper">
    <form class="row g-2 filter-form align-items-center" method="get" action="">
      <input type="hidden" name="resource" value="courses">
      <div class="col-md-5">
        <input name="q" value="<?= htmlspecialchars($_GET['q']??'') ?>"
               class="form-control" placeholder="Caută denumire / profesor…">
      </div>
      <div class="col-md-4">
        <select name="sem" class="form-select">
          <option value="">– Toate semestrele –</option>
          <option value="1" <?= ($_GET['sem']??'')==1?'selected':'' ?>>Semestrul 1</option>
          <option value="2" <?= ($_GET['sem']??'')==2?'selected':'' ?>>Semestrul 2</option>
        </select>
      </div>
      <div class="col-md-3">
        <button class="btn-dashboard btn-primary-custom w-100">Aplica Filtre</button>
      </div>
    </form>
  </div>
</div>

<!-- Table Card -->
<div class="admin-card table-card">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Denumire</th>
          <th>Profesor</th>
          <th>Credite</th>
          <th>Semestru</th>
          <th>Acțiuni</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($courses as $c): ?>
        <tr>
          <td style="color: #6b7280; font-family: monospace;"><?= $c['ID_Curs'] ?></td>
          <td style="font-weight: 500;"><?= htmlspecialchars($c['Denumire']) ?></td>
          <td style="color: #4b5563;"><?= htmlspecialchars($c['Profesor_Titular']) ?></td>
          <td style="color: #4b5563;"><?= $c['Nr_Credite'] ?></td>
          <td><?= $c['Semester'] ?></td>
          <td>
            <div class="d-flex gap-2 flex-nowrap">
              <a href="index.php?resource=courses&action=edit&id=<?= $c['ID_Curs'] ?>"
                 class="btn-action btn-edit text-decoration-none">Editează</a>
              <a href="index.php?resource=courses&action=delete&id=<?= $c['ID_Curs'] ?>"
                 class="btn-action btn-delete text-decoration-none"
                 onclick="return confirm('Ștergi cursul?')">Șterge</a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if(empty($courses)): ?>
        <tr>
          <td colspan="6" class="text-center py-4" style="color: #6b7280;">Nu am găsit niciun curs.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__.'/../templates/footer.php'; ?>
