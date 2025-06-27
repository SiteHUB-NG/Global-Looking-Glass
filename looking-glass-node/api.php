<?php
/*==============================================
# Written By Chike Egbuna For SiteHUB Agency Ltd
# Last Updated: 26th June 2025
===============================================*/

session_start();
$clientIp = $_SERVER['REMOTE_ADDR'];
$rateFile = sys_get_temp_dir() . "/lg_rate_$clientIp";

// Rate Limit!
$limit = 5; // Max 5 requests
$interval = 60; // per 60 seconds

if (file_exists($rateFile)) {
    $timestamps = array_filter(explode("\n", file_get_contents($rateFile)));
    $timestamps = array_filter($timestamps, fn($ts) => time() - (int)$ts < $interval);
} else {
    $timestamps = [];
}

if (count($timestamps) >= $limit) {
    http_response_code(429);
    exit("Rate limit exceeded. Try again later.");
}

$timestamps[] = time();
file_put_contents($rateFile, implode("\n", $timestamps));


$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['token']) || $data['token'] !== 'SHARED-SECRET') {  // Ensure this is the same password as the one in remote_proxy.php
    http_response_code(403);
    exit('Forbidden: Invalid token.');
}

$allowedTools = ['ping', 'traceroute', 'mtr'];
$tool = strtolower(trim($data['tool'] ?? ''));
if (!in_array($tool, $allowedTools)) {
    http_response_code(400);
    exit('Error: Unsupported tool requested.');
}

$targetRaw = trim($data['target'] ?? '');
if (!filter_var($targetRaw, FILTER_VALIDATE_IP) && !preg_match('/^([a-z0-9-]+\.)+[a-z]{2,}$/i', $targetRaw)) {
    http_response_code(400);
    exit('Error: Invalid target IP or hostname.');
}
$target = escapeshellarg($targetRaw);

switch ($tool) {
    case 'ping':
        $cmd = "ping -c 4 $target 2>&1";
        break;
    case 'traceroute':
        $cmd = "traceroute $target 2>&1";
        break;
    case 'mtr':
        function findExecutable($name) {
            $paths = ['/usr/bin/', '/usr/sbin/', '/bin/', '/sbin/', '/usr/local/bin/', '/usr/local/sbin/'];
            foreach ($paths as $path) {
                $full = $path . $name;
                if (is_executable($full)) {
                    return $full;
                }
            }
            return false;
        }
        $mtrPath = findExecutable('mtr');
        if (!$mtrPath) {
            http_response_code(500);
            exit("Error: mtr not found on system.");
        }
        $cmd = "$mtrPath -rwzbc 10 $target 2>&1";
        break;
}

exec($cmd, $output, $exitCode);
if ($exitCode !== 0) {
    echo "Error: Tool execution failed with code $exitCode\n\n";
}
echo implode("\n", $output);
