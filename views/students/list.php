<?php include __DIR__.'/../templates/header.php'; ?>

<style>
  /* Base & Typography */
  body {
    background-color: #f8fafc; /* gri-albastrui foarte deschis */
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
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    border: 1px solid #e2e8f0;
    margin-bottom: 1.5rem;
  }
  
  /* Filter Area */
  .filter-wrapper {
    padding: 1rem 1.25rem;
  }
  .filter-form .form-control, .filter-form .form-select {
    border-radius: 6px;
    border: 1px solid #cbd5e1;
    font-size: 0.9rem;
    padding: 0.4rem 0.75rem;
    height: 36px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    color: #0f172a;
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
    color: #334155;
    border: 1px solid #cbd5e1;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
  }
  .btn-secondary-custom:hover {
    background-color: #f8fafc;
    color: #0f172a;
    border-color: #94a3b8;
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
    background-color: #f8fafc;
    color: #64748b;
    font-weight: 500;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid #e2e8f0;
    border-top: none;
  }
  .table td {
    padding: 0.6rem 1rem;
    vertical-align: middle;
    color: #0f172a;
    font-size: 0.9rem;
    border-bottom: 1px solid #f1f5f9;
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
    <h1 class="page-title">Lista Studenți</h1>
    <p class="page-subtitle">Gestionează studenții înregistrați în platformă</p>
  </div>
  <div class="header-actions">
    <a href="index.php?resource=export&action=csv&type=students" class="btn-dashboard btn-secondary-custom">Export CSV</a>
    <a href="index.php?resource=students&action=create" class="btn-dashboard btn-primary-custom">Adaugă student</a>
  </div>
</div>

<!-- Filter Card -->
<div class="admin-card">
  <div class="filter-wrapper">
    <form class="row g-2 filter-form align-items-center" method="get" action="">
      <input type="hidden" name="resource" value="students">
      <div class="col-md-5">
        <input name="q" value="<?= htmlspecialchars($_GET['q']??'') ?>"
               class="form-control" placeholder="Caută nume sau email…">
      </div>
      <div class="col-md-4">
        <select name="an" class="form-select">
          <option value="">Toți anii de studiu</option>
          <?php for($i=1;$i<=6;$i++): ?>
            <option value="<?= $i ?>" <?= ($_GET['an']??'')==$i?'selected':'' ?>>An <?= $i ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn-dashboard btn-primary-custom w-100">Aplica Filtre</button>
        <a href="index.php?resource=students" class="btn-dashboard btn-secondary-custom w-100">Resetează</a>
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
          <th>Nume</th>
          <th>An</th>
          <th>Email</th>
          <th>Telefon</th>
          <th>Acțiuni</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($students as $st): ?>
        <tr>
          <td style="color: #64748b; font-family: monospace;"><?= $st['ID_Student'] ?></td>
          <td style="font-weight: 500;"><?= htmlspecialchars($st['Nume'].' '.$st['Prenume']) ?></td>
          <td><?= $st['An_Studiu'] ?></td>
          <td style="color: #475569;"><?= htmlspecialchars($st['Email']) ?></td>
          <td style="color: #475569;"><?= htmlspecialchars($st['Telefon']) ?></td>
          <td>
            <div class="d-flex gap-2 flex-nowrap">
              <a href="index.php?resource=students&action=edit&id=<?= $st['ID_Student'] ?>"
                 class="btn-action btn-edit text-decoration-none">Editează</a>
              <a href="index.php?resource=students&action=delete&id=<?= $st['ID_Student'] ?>"
                 class="btn-action btn-delete text-decoration-none"
                 onclick="return confirm('Ștergi studentul?')">Șterge</a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if(empty($students)): ?>
        <tr>
          <td colspan="6" class="text-center py-4" style="color: #64748b;">Nu am găsit niciun student.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__.'/../templates/footer.php'; ?>