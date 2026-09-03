<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
function user_id(): ?int { return isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null; }
function require_login(): void { if (!user_id()) { header('Location: login.php'); exit; } }
function csrf_token(): string { if (empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function check_csrf(): void { if (!isset($_POST['csrf']) || !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'])) { http_response_code(419); exit('Invalid request token.'); } }
function e(string $v): string { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }
