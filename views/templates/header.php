<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="utf-8">
  <title>Zona Administrativă</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      background-color: #f8fafc;
      color: #334155;
    }
    .navbar {
      padding-top: 0.75rem;
      padding-bottom: 0.75rem;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
      background-color: #0f172a !important; /* dark slate */
    }
    .navbar-brand {
      letter-spacing: 0.5px;
      font-size: 1.1rem;
    }
    .nav-link {
      font-weight: 500;
      color: rgba(255, 255, 255, 0.7) !important;
      transition: all 0.2s;
      position: relative;
      padding-bottom: 0.25rem !important;
      margin-bottom: -0.25rem;
    }
    .nav-link:hover {
      color: #ffffff !important;
    }
    .nav-link.active {
      color: #ffffff !important;
    }
    .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0.5rem;
      right: 0.5rem;
      height: 2px;
      background-color: #3b82f6;
      border-radius: 2px;
    }
    .user-greeting {
      font-size: 0.85rem;
      color: rgba(255, 255, 255, 0.6);
      font-weight: 400;
    }
    .btn-logout {
      border-radius: 6px;
      padding: 0.35rem 0.85rem;
      font-size: 0.85rem;
      font-weight: 500;
      color: #cbd5e1;
      border: 1px solid rgba(255,255,255,0.2);
      transition: all 0.2s;
      text-decoration: none;
    }
    .btn-logout:hover {
      background-color: rgba(255, 255, 255, 0.1);
      color: #ffffff;
      border-color: rgba(255,255,255,0.3);
    }
  </style>
</head>
<body>

<?php 
  $role = $_SESSION['user']['role'] ?? ''; 
  $current_resource = $_GET['resource'] ?? 'students';
?>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container <?= empty($_SESSION['user']) ? 'justify-content-center' : '' ?>">

    <!-- LOGO (unul singur) -->
    <a class="navbar-brand fw-bold <?= empty($_SESSION['user']) ? 'm-0' : '' ?>" href="index.php">ZONA ADMINISTRATIVĂ</a>

    <?php if (!empty($_SESSION['user'])): ?>
      <div class="navbar-nav me-auto ms-4 gap-2">

        <!-- vizibile doar pentru admin & secretar -->
        <?php if ($role !== 'profesor'): ?>
          <a class="nav-link <?= $current_resource === 'students' ? 'active' : '' ?>" href="index.php?resource=students">Studenți</a>
          <a class="nav-link <?= $current_resource === 'courses' ? 'active' : '' ?>" href="index.php?resource=courses">Cursuri</a>
        <?php endif; ?>

        <!-- vizibile tuturor -->
        <a class="nav-link <?= $current_resource === 'enrollments' ? 'active' : '' ?>" href="index.php?resource=enrollments">Catalog</a>
        <a class="nav-link <?= $current_resource === 'attendance' ? 'active' : '' ?>" href="index.php?resource=attendance">Prezențe</a>

        <!-- doar admin -->
        <?php if ($role === 'admin'): ?>
          <a class="nav-link <?= $current_resource === 'users' ? 'active' : '' ?> ms-2" href="index.php?resource=users">Utilizatori</a>
          <a class="nav-link <?= $current_resource === 'audit' ? 'active' : '' ?>" href="index.php?resource=audit">Audit</a>
        <?php endif; ?>
      </div>

      <!-- Salut & Logout -->
      <div class="ms-auto d-flex align-items-center">
        <span class="user-greeting me-3">
          Salut, <?= htmlspecialchars($_SESSION['user']['username']) ?>
        </span>
        <a class="btn-logout" href="index.php?resource=auth&action=logout">Logout</a>
      </div>
    <?php endif; ?>

  </div>
</nav>

<div class="container mt-4 mb-5">