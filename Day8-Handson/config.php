<?php
session_start();
const APP_NAME = 'MediBook';
const DB_PATH = __DIR__ . '/data/medibook.sqlite';
function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        if (!is_dir(__DIR__ . '/data')) mkdir(__DIR__ . '/data', 0775, true);
        $pdo = new PDO('sqlite:' . DB_PATH);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('PRAGMA foreign_keys = ON');
    }
    return $pdo;
}
function e($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function csrf_token(): string { if (empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function verify_csrf(): void { if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) { http_response_code(403); exit('Invalid request token.'); } }
function flash(string $type,string $msg):void{$_SESSION['flash']=[$type,$msg];}
function take_flash():?array{$f=$_SESSION['flash']??null;unset($_SESSION['flash']);return $f;}
function is_logged_in():bool{return !empty($_SESSION['user']);}
function require_login():void{if(!is_logged_in()){flash('warning','Please sign in to continue.');header('Location: login.php');exit;}}
function current_user():array{return $_SESSION['user']??[];}
function service_status(): array { return [
 ['Authentication','Operational','Account access and password reset'],
 ['Appointment Booking','Operational','Doctor search and slot booking'],
 ['Online Consultation','Operational','Demo consultation lobby'],
 ['Payment','Operational','Simulated payment only'],
 ['Notification','Degraded','Demo email/SMS event logging'],
 ['AI Chatbot','Operational','Rule-based guidance'],
 ['Medical Reports','Operational','Demo report metadata']
]; }
?>