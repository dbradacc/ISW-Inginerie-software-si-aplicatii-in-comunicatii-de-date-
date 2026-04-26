<?php
// confirmare JS pentru ștergere student
?>
<script>
if (confirm('Sigur vrei să ștergi acest student?')) {
  window.location = 'index.php?resource=students&action=delete&id=<?= $_GET['id'] ?>';
} else {
  window.location = 'index.php?resource=students';
}
</script>

## View-uri Înscrieri (views/enrollments) (views/enrollments)

### `/views/enrollments/list.php`
```php
<?php include __DIR__ . '/../templates/header.php'; ?>
<h1>Lista Înscrieri</h1>
<a href="index.php?resource=enrollments&action=create" class="btn btn-primary mb-2">Adaugă înscriere</a>
<table class="table table-striped">
  <thead>
    <tr><th>Student</th><th>Curs</th><th>Notă</th><th>Acțiuni</th></tr>
  </thead>
  <tbody>
  <?php foreach ($enrollments as $e): ?>
    <tr>
      <td><?= htmlspecialchars($e['ID_Student']) ?></td>
      <td><?= htmlspecialchars($e['ID_Curs']) ?></td>
      <td><?= $e['Nota_Finala'] ?></td>
      <td>
        <a href="index.php?resource=enrollments&action=edit&student_id=<?= $e['ID_Student'] ?>&course_id=<?= $e['ID_Curs'] ?>" class="btn btn-sm btn-warning">Editează</a>
        <a href="index.php?resource=enrollments&action=delete&student_id=<?= $e['ID_Student'] ?>&course_id=<?= $e['ID_Curs'] ?>" class="btn btn-sm btn-danger">Șterge</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php include __DIR__ . '/../templates/footer.php'; ?>