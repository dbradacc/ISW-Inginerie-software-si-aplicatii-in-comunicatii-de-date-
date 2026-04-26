<?php include __DIR__ . '/../templates/header.php'; ?>

<h1>Catalog</h1>

<a href="index.php?resource=enrollments&action=create"
   class="btn btn-primary mb-2">Adaugă înscriere</a>

<table class="table table-striped">
  <thead>
    <tr>
      <th>ID Student</th><th>Student</th>
      <th>ID Curs</th><th>Curs</th>
      <th>Notă</th><th>Acțiuni</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($enrollments as $e): ?>
    <tr>
      <td><?= $e['ID_Student'] ?></td>
      <td><?= htmlspecialchars($e['Student']) ?></td>

      <td><?= $e['ID_Curs'] ?></td>
      <td><?= htmlspecialchars($e['Curs']) ?></td>

      <td><?= $e['Nota_Finala'] ?></td>
      <td>
        <!-- URL CURAT, FĂRĂ newline -->
        <a href="index.php?resource=enrollments&action=edit&student_id=<?= $e['ID_Student'] ?>&course_id=<?= $e['ID_Curs'] ?>"
           class="btn btn-sm btn-warning">Editează</a>

        <a href="index.php?resource=enrollments&action=delete&student_id=<?= $e['ID_Student'] ?>&course_id=<?= $e['ID_Curs'] ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Ștergi această notă?')">Șterge</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?php include __DIR__ . '/../templates/footer.php'; ?>