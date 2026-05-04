<?php
/**
 * ShieldX — Helper Functions
 */

// ── Output Escaping ──────────────────────────────────────
function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// ── Token Generation ─────────────────────────────────────
function sx_generate_token(): string
{
    return bin2hex(random_bytes(32)); // 64-char hex
}

function sx_hash_token(string $token): string
{
    return hash('sha256', $token);
}

function sx_token_prefix(string $token): string
{
    return substr($token, 0, 8);
}

// ── HMAC Verification ────────────────────────────────────
function sx_verify_hmac(string $secret, string $timestamp, string $nonce, array $body, string $signature): bool
{
    $snapshotHash = hash('sha256', $body['snapshot_text'] ?? '');
    $canonical = $timestamp . "\n" . $nonce . "\n"
               . ($body['tool_key'] ?? '') . "\n"
               . ($body['target'] ?? '') . "\n"
               . $snapshotHash;

    $expected = hash_hmac('sha256', $canonical, $secret);
    return hash_equals('sha256=' . $expected, $signature);
}

function sx_compute_hmac(string $secret, string $timestamp, string $nonce, string $toolKey, string $target, string $snapshotText): string
{
    $snapshotHash = hash('sha256', $snapshotText);
    $canonical = $timestamp . "\n" . $nonce . "\n" . $toolKey . "\n" . $target . "\n" . $snapshotHash;
    return 'sha256=' . hash_hmac('sha256', $canonical, $secret);
}

// ── IP Allowlist Check ───────────────────────────────────
function sx_ip_allowed(string $ip, array $allowList): bool
{
    if (empty($allowList)) return true; // no restriction

    foreach ($allowList as $entry) {
        if (strpos($entry, '/') !== false) {
            if (sx_ip_in_cidr($ip, $entry)) return true;
        } else {
            if ($ip === $entry) return true;
        }
    }
    return false;
}

function sx_ip_in_cidr(string $ip, string $cidr): bool
{
    [$subnet, $bits] = explode('/', $cidr, 2);
    $bits = (int) $bits;

    // IPv4
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        $ipLong = ip2long($ip);
        $subLong = ip2long($subnet);
        if ($ipLong === false || $subLong === false) return false;
        $mask = -1 << (32 - $bits);
        return ($ipLong & $mask) === ($subLong & $mask);
    }

    // IPv6 (basic support)
    $ipBin = inet_pton($ip);
    $subBin = inet_pton($subnet);
    if ($ipBin === false || $subBin === false) return false;

    $fullBits = strlen($ipBin) * 8;
    $mask = str_repeat('1', $bits) . str_repeat('0', $fullBits - $bits);
    $maskBin = '';
    for ($i = 0; $i < $fullBits; $i += 8) {
        $maskBin .= chr(bindec(substr($mask, $i, 8)));
    }
    return ($ipBin & $maskBin) === ($subBin & $maskBin);
}

// ── Time Formatting ──────────────────────────────────────
function sx_time_ago(string $datetime): string
{
    $ts = strtotime($datetime);
    $diff = time() - $ts;
    if ($diff < 60) return $diff . 's ago';
    if ($diff < 3600) return floor($diff / 60) . 'm ago';
    if ($diff < 86400) return floor($diff / 3600) . 'h ago';
    if ($diff < 604800) return floor($diff / 86400) . 'd ago';
    return date('M j, Y', $ts);
}

function sx_format_dt(string $datetime): string
{
    $ts = strtotime($datetime);
    return $ts ? date('Y-m-d H:i:s', $ts) . ' UTC' : '—';
}

// ── Share Status ─────────────────────────────────────────
function sx_share_status(array $share): string
{
    if ($share['revoked_at'] !== null) return 'revoked';
    if (strtotime($share['expires_at']) < time()) return 'expired';
    return 'active';
}

function sx_status_badge(string $status): string
{
    $colors = [
        'active'  => '#16a34a',
        'expired' => '#d97706',
        'revoked' => '#dc2626',
    ];
    $color = $colors[$status] ?? '#6b7280';
    return '<span style="display:inline-block;padding:2px 10px;border-radius:9999px;font-size:12px;'
         . 'font-weight:600;color:#fff;background:' . $color . '">' . e(ucfirst($status)) . '</span>';
}

// ── Pagination ───────────────────────────────────────────
function sx_paginate(int $total, int $perPage, int $currentPage): array
{
    $totalPages = max(1, (int) ceil($total / $perPage));
    $currentPage = max(1, min($currentPage, $totalPages));
    $offset = ($currentPage - 1) * $perPage;
    return [
        'total'       => $total,
        'per_page'    => $perPage,
        'current'     => $currentPage,
        'total_pages' => $totalPages,
        'offset'      => $offset,
    ];
}

function sx_pagination_html(array $pag, string $baseUrl): string
{
    if ($pag['total_pages'] <= 1) return '';
    $html = '<div class="sx-pagination">';
    $sep = (strpos($baseUrl, '?') !== false) ? '&' : '?';

    if ($pag['current'] > 1) {
        $html .= '<a href="' . e($baseUrl . $sep . 'page=' . ($pag['current'] - 1)) . '">&laquo; Prev</a>';
    }

    $start = max(1, $pag['current'] - 3);
    $end   = min($pag['total_pages'], $pag['current'] + 3);

    for ($i = $start; $i <= $end; $i++) {
        $cls = ($i === $pag['current']) ? ' class="active"' : '';
        $html .= '<a href="' . e($baseUrl . $sep . 'page=' . $i) . '"' . $cls . '>' . $i . '</a>';
    }

    if ($pag['current'] < $pag['total_pages']) {
        $html .= '<a href="' . e($baseUrl . $sep . 'page=' . ($pag['current'] + 1)) . '">Next &raquo;</a>';
    }
    $html .= '</div>';
    return $html;
}

// ── Nonce Validation ─────────────────────────────────────
function sx_nonce_check(string $nonce): bool
{
    $db = sx_db();
    // Check if already used
    $stmt = $db->prepare('SELECT 1 FROM api_nonces WHERE nonce = ? LIMIT 1');
    $stmt->execute([$nonce]);
    if ($stmt->fetch()) return false;

    // Record it
    $stmt = $db->prepare('INSERT INTO api_nonces (nonce) VALUES (?)');
    $stmt->execute([$nonce]);
    return true;
}
