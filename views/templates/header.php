<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="utf-8">
  <title>Zona Administrativă</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php $role = $_SESSION['user']['role'] ?? ''; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    <!-- LOGO (unul singur) -->
    <a class="navbar-brand fw-bold" href="index.php">ZONA ADMINISTRATIVĂ</a>

    <?php if (!empty($_SESSION['user'])): ?>
      <div class="navbar-nav">

        <!-- vizibile doar pentru admin & secretar -->
        <?php if ($role !== 'profesor'): ?>
          <a class="nav-link" href="index.php?resource=students">Studenți</a>
          <a class="nav-link" href="index.php?resource=courses">Cursuri</a>
        <?php endif; ?>

        <!-- vizibile tuturor -->
        <a class="nav-link" href="index.php?resource=enrollments">Catalog</a>
        <a class="nav-link" href="index.php?resource=attendance">Prezenta</a>

        <!-- doar admin -->
        <?php if ($role === 'admin'): ?>
          <a class="nav-link" href="index.php?resource=users">Utilizatori</a>
          <a class="nav-link" href="index.php?resource=audit">Audit</a>
        <?php endif; ?>
      </div>

      <!-- Salut & Logout -->
      <div class="ms-auto">
        <span class="text-white me-3">
          Salut, <?= htmlspecialchars($_SESSION['user']['username']) ?>
        </span>
        <a class="btn btn-sm btn-outline-light"
           href="index.php?resource=auth&action=logout">Logout</a>
      </div>
    <?php endif; ?>

  </div>
</nav>

<div class="container mt-4">