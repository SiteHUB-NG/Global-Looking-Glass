<?php
/*==============================================
# Written By Chike Egbuna For SiteHUB Agency Ltd
# Last Updated: 26th June 2025
===============================================*/

session_start();

$file = basename($_GET['file'] ?? '');
$allowed = ['10MB.test', '50MB.test', '100MB.test'];

if (!in_array($file, $allowed, true)) {
    http_response_code(403);
    exit('Invalid file request.');
}

// --- Rate limit ---
$ip = $_SERVER['REMOTE_ADDR'];
$key = "downloads_$ip";

if (!isset($_SESSION[$key])) {
    $_SESSION[$key] = ['count' => 0, 'start' => time()];
}
if (time() - $_SESSION[$key]['start'] > 600) {
    $_SESSION[$key] = ['count' => 0, 'start' => time()];
}
if ($_SESSION[$key]['count'] >= 3) {
    http_response_code(429);
    exit("Rate limit exceeded. Try again later.");
}
$_SESSION[$key]['count']++;

// --- Secure full path ---
// Try and keep this path outside of public directories. Place the network test files here
$path = "/full/path/to/private/directory/$file";

if (!file_exists($path)) {
    http_response_code(404);
    exit('File not found.');
}

// --- Download headers ---
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $file . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($path));

flush();
readfile($path);
exit;
