<?php include __DIR__ . '/../templates/header.php'; ?>

<!-- LOGIN SECTION CENTERED -->
<style>
  .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 30px 20px 90px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  }
  
  .login-card {
    background: #ffffff;
    padding: 32px 36px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03);
    border: 1px solid #e5e7eb;
    width: 100%;
    max-width: 360px;
  }
  
  .login-header {
    text-align: center;
    margin-bottom: 24px;
  }

  .login-title {
    margin: 0 0 4px 0;
    font-size: 20px;
    font-weight: 600;
    color: #111827;
    letter-spacing: -0.01em;
  }
  
  .login-subtitle {
    margin: 0;
    font-size: 14px;
    color: #6b7280;
  }

  .login-card .form-label {
    display: block;
    font-size: 13px;
    font-weight: 500;
    color: #374151;
    margin-bottom: 6px;
  }

  .login-card .form-control {
    width: 100%;
    padding: 9px 12px;
    font-size: 14px;
    line-height: 1.5;
    color: #111827;
    background-color: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.01);
  }

  .login-card .form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
  }

  .login-card .btn-primary {
    width: 100%;
    padding: 10px 16px;
    font-size: 14px;
    font-weight: 500;
    color: #ffffff;
    background-color: #18181b;
    border: 1px solid transparent;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.15s ease;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    margin-top: 8px;
  }

  .login-card .btn-primary:hover {
    background-color: #27272a;
  }

  .login-alert {
    font-size: 13px;
    padding: 10px 12px;
    border-radius: 6px;
    margin-bottom: 20px;
    background-color: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
  }
</style>

<div class="login-container">
  <div class="login-card">
    <div class="login-header">
      <h1 class="login-title">Autentificare</h1>
      <p class="login-subtitle">Conectează-te pentru a accesa platforma</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="login-alert"><?= $error ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?resource=auth&action=login">
      <div style="margin-bottom: 16px;">
        <label class="form-label">Utilizator</label>
        <input name="username" class="form-control" required autocomplete="username">
      </div>
      <div style="margin-bottom: 20px;">
        <label class="form-label">Parolă</label>
        <input type="password" name="password" class="form-control" required autocomplete="current-password">
      </div>
      <button type="submit" class="btn-primary">Autentificare</button>
    </form>
  </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
