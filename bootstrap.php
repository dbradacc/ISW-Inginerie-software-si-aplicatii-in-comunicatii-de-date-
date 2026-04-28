<?php
/**
 * ShieldX — Bootstrap
 * Include this at the top of every page.
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

date_default_timezone_set('UTC');

// ── PDO Singleton ────────────────────────────────────────
function sx_db(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . SX_DB_HOST . ';dbname=' . SX_DB_NAME . ';charset=' . SX_DB_CHARSET;
        $pdo = new PDO($dsn, SX_DB_USER, SX_DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    }
    return $pdo;
}

// ── Secure Session ───────────────────────────────────────
function sx_session_start(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) return;

    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    session_name(SX_SESSION_NAME);
    session_set_cookie_params([
        'lifetime' => SX_SESSION_LIFETIME,
        'path'     => '/',
        'domain'   => '',
        'secure'   => $secure,
        'httponly'  => true,
        'samesite'  => 'Strict',
    ]);
    session_start();

    // Regenerate session ID periodically
    if (!isset($_SESSION['_sx_created'])) {
        $_SESSION['_sx_created'] = time();
    } elseif (time() - $_SESSION['_sx_created'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['_sx_created'] = time();
    }
}

// ── CSRF Protection ──────────────────────────────────────
function sx_csrf_token(): string
{
    sx_session_start();
    if (empty($_SESSION['_sx_csrf'])) {
        $_SESSION['_sx_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_sx_csrf'];
}

function sx_csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . sx_csrf_token() . '">';
}

function sx_csrf_verify(): bool
{
    sx_session_start();
    $token = $_POST['_csrf'] ?? '';
    return $token !== '' && hash_equals($_SESSION['_sx_csrf'] ?? '', $token);
}

// ── Admin Auth Helpers ───────────────────────────────────
function sx_require_auth(): array
{
    sx_session_start();
    if (empty($_SESSION['sx_admin_id'])) {
        header('Location: /admin/login.php');
        exit;
    }
    return [
        'id'       => $_SESSION['sx_admin_id'],
        'username' => $_SESSION['sx_admin_username'] ?? '',
        'role'     => $_SESSION['sx_admin_role'] ?? 'management',
        'display'  => $_SESSION['sx_admin_display'] ?? '',
    ];
}

function sx_require_role(string $role): array
{
    $admin = sx_require_auth();
    if ($admin['role'] !== $role) {
        http_response_code(403);
        echo 'Access denied: insufficient privileges.';
        exit;
    }
    return $admin;
}

function sx_is_dev(array $admin): bool
{
    return $admin['role'] === 'dev';
}

// ── Audit Logging ────────────────────────────────────────
function sx_audit(string $action, ?int $adminId = null, ?string $details = null): void
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $stmt = sx_db()->prepare(
        'INSERT INTO admin_audit_log (admin_id, action, details, ip_address) VALUES (?, ?, ?, ?)'
    );
    $stmt->execute([$adminId, $action, $details, $ip]);
}

// ── Rate Limiting (Login) ────────────────────────────────
function sx_login_rate_check(string $ip): bool
{
    $db = sx_db();
    $stmt = $db->prepare(
        'SELECT COUNT(*) FROM login_attempts 
         WHERE ip_address = ? AND attempted_at > DATE_SUB(NOW(), INTERVAL ? MINUTE) AND success = 0'
    );
    $stmt->execute([$ip, SX_LOGIN_WINDOW_MINUTES]);
    return (int) $stmt->fetchColumn() < SX_LOGIN_MAX_ATTEMPTS;
}

function sx_login_record(string $ip, bool $success): void
{
    $stmt = sx_db()->prepare(
        'INSERT INTO login_attempts (ip_address, success) VALUES (?, ?)'
    );
    $stmt->execute([$ip, $success ? 1 : 0]);
}

// ── Rate Limiting (Public View) ──────────────────────────
function sx_view_rate_check(string $ip): bool
{
    $db = sx_db();
    $stmt = $db->prepare(
        'SELECT COUNT(*) FROM share_views 
         WHERE viewer_ip = ? AND viewed_at > DATE_SUB(NOW(), INTERVAL 1 MINUTE)'
    );
    $stmt->execute([$ip]);
    return (int) $stmt->fetchColumn() < SX_VIEW_MAX_PER_MINUTE;
}

// ── Client IP ────────────────────────────────────────────
function sx_client_ip(): string
{
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

// ── JSON Response ────────────────────────────────────────
function sx_json(array $data, int $code = 200): void
{
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_SLASHES);
    exit;
}
