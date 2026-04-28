<?php
/*  /views/audit/list.php  */
?>
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
  
  /* Main Cards */
  .admin-card {
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02), 0 4px 12px rgba(0, 0, 0, 0.01);
    border: 1px solid #e5e7eb;
    margin-bottom: 1.5rem;
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
    color: #475569;
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
  
  /* Action Badges */
  .badge-action {
    display: inline-block;
    padding: 0.25rem 0.6rem;
    font-size: 0.75rem;
    font-weight: 500;
    border-radius: 9999px;
  }
  .action-login { background-color: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }
  .action-logout { background-color: #f3f4f6; color: #4b5563; border: 1px solid #e5e7eb; }
  .action-create { background-color: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }
  .action-update { background-color: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; }
  .action-delete { background-color: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }
  .action-default { background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0; }

  .badge-entity {
    display: inline-block;
    padding: 0.2rem 0.5rem;
    font-size: 0.75rem;
    font-weight: 500;
    background-color: #f0f9ff;
    color: #0369a1;
    border: 1px solid #e0f2fe;
    border-radius: 6px;
  }
  
  /* Info Box */
  .info-box {
    display: inline-block;
    max-width: 250px;
    white-space: pre-wrap;
    font-family: monospace;
    font-size: 0.8rem;
    color: #374151;
    background-color: #f9fafb;
    padding: 0.2rem 0.4rem;
    border: 1px solid #e5e7eb;
    border-radius: 4px;
    word-break: break-all;
  }
  .info-empty {
    color: #9ca3af;
    font-style: italic;
  }
</style>

<div class="page-header">
  <div>
    <h1 class="page-title">Audit</h1>
    <p class="page-subtitle">Vizualizează istoricul acțiunilor din platformă</p>
  </div>
</div>

<!-- Filter Card -->
<div class="admin-card mb-3 p-3">
  <div class="row g-3 align-items-end">
    <div class="col-md-3">
      <label class="form-label mb-1" style="font-size: 0.85rem; font-weight: 500; color: #475569;">Caută IP</label>
      <input type="text" id="filterIp" class="form-control form-control-sm" placeholder="Introdu IP...">
    </div>
    <div class="col-md-3">
      <label class="form-label mb-1" style="font-size: 0.85rem; font-weight: 500; color: #475569;">Acțiune</label>
      <select id="filterAction" class="form-select form-select-sm">
        <option value="">Toate acțiunile</option>
        <option value="login">Login</option>
        <option value="logout">Logout</option>
        <option value="create">Create</option>
        <option value="update">Update</option>
        <option value="delete">Delete</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label mb-1" style="font-size: 0.85rem; font-weight: 500; color: #475569;">Sortează după</label>
      <select id="sortSelect" class="form-select form-select-sm">
        <option value="newest">Cele mai noi</option>
        <option value="oldest">Cele mai vechi</option>
        <option value="ip-asc">IP A-Z</option>
        <option value="action-asc">Acțiune A-Z</option>
      </select>
    </div>
    <div class="col-md-3 d-flex gap-2">
      <button id="applyFiltersBtn" class="btn btn-sm w-100" style="background-color: #0f172a; color: #ffffff; border-radius: 6px; font-weight: 500; padding-top: 0.35rem; padding-bottom: 0.35rem;">
        Aplică Filtre
      </button>
      <button id="resetFiltersBtn" class="btn btn-sm w-100" style="border: 1px solid #cbd5e1; color: #475569; background-color: #ffffff; border-radius: 6px; font-weight: 500; padding-top: 0.35rem; padding-bottom: 0.35rem; transition: all 0.2s;">
        Resetează
      </button>
    </div>
  </div>
</div>

<!-- Table Card -->
<div class="admin-card table-card">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>IP</th>
          <th>Acțiune</th>
          <th>Tabel</th>
          <th>ID</th>
          <th>Info</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($logs as $l): ?>
        <tr class="audit-row" data-timestamp="<?= strtotime($l['Created_at']) ?>">
          <td style="color: #6b7280; font-family: monospace;"><?= $l['ID_Audit'] ?></td>
          <td style="font-weight: 500; color: #374151;"><?= htmlspecialchars($l['username']) ?></td>
          <td class="ip-cell" style="color: #64748b; font-family: monospace; font-size: 0.85rem;"><?= htmlspecialchars($l['IP']) ?></td>
          <td>
            <?php 
              $actionClass = 'badge-action ';
              $actStr = strtolower($l['Actiune']);
              if ($actStr === 'login') $actionClass .= 'action-login';
              elseif ($actStr === 'logout') $actionClass .= 'action-logout';
              elseif ($actStr === 'create') $actionClass .= 'action-create';
              elseif ($actStr === 'update') $actionClass .= 'action-update';
              elseif ($actStr === 'delete') $actionClass .= 'action-delete';
              else $actionClass .= 'action-default';
            ?>
            <span class="<?= $actionClass ?>"><?= htmlspecialchars(ucfirst($actStr)) ?></span>
          </td>
          <td>
            <?php if (!empty($l['Entitate'])): ?>
              <span class="badge-entity"><?= htmlspecialchars(ucfirst($l['Entitate'])) ?></span>
            <?php else: ?>
              <span class="info-empty">-</span>
            <?php endif; ?>
          </td>
          <td style="color: #6b7280; font-family: monospace;">
            <?= (!empty($l['ID_Ent']) && $l['ID_Ent'] !== '-') ? htmlspecialchars($l['ID_Ent']) : '<span class="info-empty">-</span>' ?>
          </td>
          <td>
            <?php 
              $infoRaw = $l['Info'] ?? '';
              $infoText = trim((string)$infoRaw);
              if (!empty($infoText) && $infoText !== '-'): 
            ?>
              <div class="info-box"><?= htmlspecialchars($infoText) ?></div>
            <?php else: ?>
              <span class="info-empty">-</span>
            <?php endif; ?>
          </td>
          <td style="color: #374151; font-weight: 500; white-space: nowrap;">
            <?= date('d.m.Y H:i:s', strtotime($l['Created_at'])) ?>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if(empty($logs)): ?>
        <tr>
          <td colspan="8" class="text-center py-4" style="color: #6b7280;">Nu am găsit nicio înregistrare de audit.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const applyBtn = document.getElementById('applyFiltersBtn');
  const resetBtn = document.getElementById('resetFiltersBtn');
  const tbody = document.querySelector('tbody');
  
  if (!tbody || !applyBtn) return;
  
  const originalRows = Array.from(tbody.querySelectorAll('tr.audit-row'));
  
  let noResultsRow = document.createElement('tr');
  noResultsRow.className = 'no-results-row';
  noResultsRow.style.display = 'none';
  noResultsRow.innerHTML = '<td colspan="8" class="text-center py-4" style="color: #6b7280; font-style: italic;">Nu există înregistrări pentru filtrele selectate.</td>';
  tbody.appendChild(noResultsRow);

  applyBtn.addEventListener('click', function() {
    const ipVal = document.getElementById('filterIp').value.toLowerCase().trim();
    const actionVal = document.getElementById('filterAction').value.toLowerCase();
    const sortVal = document.getElementById('sortSelect').value;

    let visibleCount = 0;
    let filteredRows = [];

    originalRows.forEach(row => {
      const ip = row.querySelector('.ip-cell').textContent.toLowerCase();
      const action = row.querySelector('.badge-action').textContent.toLowerCase();
      
      let show = true;
      if (ipVal && !ip.includes(ipVal)) show = false;
      if (actionVal && action !== actionVal) show = false;

      if (show) {
        filteredRows.push(row);
        visibleCount++;
      } else {
        row.style.display = 'none';
      }
    });

    filteredRows.sort((a, b) => {
      if (sortVal === 'newest') {
        return parseInt(b.dataset.timestamp) - parseInt(a.dataset.timestamp);
      } else if (sortVal === 'oldest') {
        return parseInt(a.dataset.timestamp) - parseInt(b.dataset.timestamp);
      } else if (sortVal === 'ip-asc') {
        const ipA = a.querySelector('.ip-cell').textContent.toLowerCase();
        const ipB = b.querySelector('.ip-cell').textContent.toLowerCase();
        return ipA.localeCompare(ipB);
      } else if (sortVal === 'action-asc') {
        const actA = a.querySelector('.badge-action').textContent.toLowerCase();
        const actB = b.querySelector('.badge-action').textContent.toLowerCase();
        return actA.localeCompare(actB);
      }
      return 0;
    });

    filteredRows.forEach(row => {
      row.style.display = '';
      tbody.appendChild(row);
    });

    noResultsRow.style.display = visibleCount === 0 && originalRows.length > 0 ? '' : 'none';
    tbody.appendChild(noResultsRow);
    
    const originalEmpty = tbody.querySelector('tr:not(.audit-row):not(.no-results-row)');
    if (originalEmpty && originalRows.length > 0) {
      originalEmpty.style.display = 'none';
    }
  });

  if (resetBtn) {
    resetBtn.addEventListener('click', function() {
      document.getElementById('filterIp').value = '';
      document.getElementById('filterAction').value = '';
      document.getElementById('sortSelect').value = 'newest';
      applyBtn.click();
    });
  }
});
</script>

<?php include __DIR__ . '/../templates/footer.php'; ?>