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
    flex-shrink: 0;
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
  
  /* Role Badges */
  .role-badge {
    display: inline-block;
    padding: 0.25rem 0.6rem;
    font-size: 0.8rem;
    font-weight: 500;
    border-radius: 9999px;
  }
  .role-admin {
    background-color: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
  }
  .role-profesor {
    background-color: #f0f9ff;
    color: #0369a1;
    border: 1px solid #e0f2fe;
  }
  .role-secretar {
    background-color: #f0fdf4;
    color: #15803d;
    border: 1px solid #dcfce7;
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
    <h1 class="page-title">Utilizatori</h1>
    <p class="page-subtitle">Gestionează conturile și rolurile din platformă</p>
  </div>
  <div class="header-actions">
    <a href="index.php?resource=users&action=create" class="btn-dashboard btn-primary-custom">Adaugă utilizator</a>
  </div>
</div>

<!-- Table Card -->
<div class="admin-card table-card">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th style="width: 15%;">ID</th>
          <th style="width: 35%;">Username</th>
          <th style="width: 25%;">Rol</th>
          <th style="width: 25%;">Acțiuni</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($users as $u): ?>
        <tr>
          <td style="color: #6b7280; font-family: monospace;"><?= $u['ID_User'] ?></td>
          <td style="color: #374151;"><?= htmlspecialchars($u['username']) ?></td>
          <td>
            <?php 
              $roleClass = 'role-badge ';
              $roleStr = strtolower($u['Role']);
              if ($roleStr === 'admin') $roleClass .= 'role-admin';
              elseif ($roleStr === 'profesor') $roleClass .= 'role-profesor';
              elseif ($roleStr === 'secretar') $roleClass .= 'role-secretar';
              else $roleClass .= 'role-profesor'; // default
            ?>
            <span class="<?= $roleClass ?>"><?= htmlspecialchars(ucfirst(strtolower($u['Role']))) ?></span>
          </td>
          <td>
            <div class="d-flex gap-2 flex-nowrap">
              <a href="index.php?resource=users&action=edit&id=<?= $u['ID_User'] ?>"
                 class="btn-action btn-edit text-decoration-none">Editează</a>
              <a href="index.php?resource=users&action=delete&id=<?= $u['ID_User'] ?>"
                 class="btn-action btn-delete text-decoration-none"
                 onclick="return confirm('Ștergi userul?')">Șterge</a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if(empty($users)): ?>
        <tr>
          <td colspan="4" class="text-center py-4" style="color: #6b7280;">Nu am găsit niciun utilizator.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__.'/../templates/footer.php'; ?>
