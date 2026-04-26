<?php include __DIR__ . '/../templates/header.php'; ?>

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
    <h1 class="page-title">Catalog</h1>
    <p class="page-subtitle">Gestionează înscrierile și notele studenților</p>
  </div>
  <div class="header-actions">
    <a href="index.php?resource=enrollments&action=create" class="btn-dashboard btn-primary-custom">Adaugă înscriere</a>
  </div>
</div>

<!-- Table Card -->
<div class="admin-card table-card">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>ID Student</th>
          <th>Student</th>
          <th>ID Curs</th>
          <th>Curs</th>
          <th>Notă</th>
          <th>Acțiuni</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($enrollments as $e): ?>
        <tr>
          <td style="color: #6b7280; font-family: monospace;"><?= $e['ID_Student'] ?></td>
          <td style="font-weight: 500;"><?= htmlspecialchars($e['Student']) ?></td>
          <td style="color: #6b7280; font-family: monospace;"><?= $e['ID_Curs'] ?></td>
          <td style="font-weight: 500; color: #4b5563;"><?= htmlspecialchars($e['Curs']) ?></td>
          <td>
            <?php if (!empty($e['Nota_Finala'])): ?>
              <span style="font-weight: 600; color: #111827;"><?= $e['Nota_Finala'] ?></span>
            <?php else: ?>
              <span style="color: #9ca3af; font-style: italic;">Nevaluat</span>
            <?php endif; ?>
          </td>
          <td>
            <div class="d-flex gap-2 flex-nowrap">
              <a href="index.php?resource=enrollments&action=edit&student_id=<?= $e['ID_Student'] ?>&course_id=<?= $e['ID_Curs'] ?>"
                 class="btn-action btn-edit text-decoration-none">Editează</a>
              <a href="index.php?resource=enrollments&action=delete&student_id=<?= $e['ID_Student'] ?>&course_id=<?= $e['ID_Curs'] ?>"
                 class="btn-action btn-delete text-decoration-none"
                 onclick="return confirm('Ștergi această notă?')">Șterge</a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if(empty($enrollments)): ?>
        <tr>
          <td colspan="6" class="text-center py-4" style="color: #6b7280;">Nu există nicio înscriere.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>