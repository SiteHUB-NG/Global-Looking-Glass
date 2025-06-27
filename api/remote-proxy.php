<?php
/*==============================================
# Written By Chike Egbuna For SiteHUB Agency Ltd
# Last Updated: 26th June 2025
===============================================*/

$data = json_decode(file_get_contents("php://input"), true);

$endpoint = filter_var($data['endpoint'], FILTER_VALIDATE_URL);
$tool     = preg_replace('/[^a-z]/', '', $data['tool']);
$target   = escapeshellarg($data['target']);

$payload = json_encode([
  'tool'   => $tool,
  'target' => $data['target'],
  'token'  => 'SHARED-SECRET' //Ensure this key matches across all of your servers and api.php
]);

$context = stream_context_create([
  'http' => [
    'method'        => 'POST',
    'header'        => "Content-Type: application/json\r\n",
    'content'       => $payload,
    'ignore_errors' => true
  ]
]);

$response = file_get_contents($endpoint, false, $context);

// Capture HTTP status code
$http_response_header = $http_response_header ?? [];
$statusLine = $http_response_header[0] ?? '';
preg_match('{HTTP/\S+ (\d{3})}', $statusLine, $match);
$statusCode = $match[1] ?? 0;

if ($response === false) {
    http_response_code(502);
    echo "Error: Could not reach remote server.";
} elseif ($statusCode >= 400) {
    http_response_code($statusCode);
    echo "Error: Remote server responded with $statusCode\n\n$response";
} else {
    echo $response;
}