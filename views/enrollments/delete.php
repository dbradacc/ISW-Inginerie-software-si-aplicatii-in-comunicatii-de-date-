<?php
// confirmare JS
?>
<script>
if (confirm('Sigur vrei să ștergi această înscriere?')) {
  window.location = 'index.php?resource=enrollments&action=delete&student_id=<?= $_GET['student_id'] ?>&course_id=<?= $_GET['course_id'] ?>';
} else {
  window.location = 'index.php?resource=enrollments';
}
</script>