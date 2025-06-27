<?php
/*==============================================
# Written By Chike Egbuna For SiteHUB Agency Ltd
# Last Updated: 26th June 2025
===============================================*/

$servers = include('config/servers.php');
$design = include('config/designer.php');
$defaultEndpoint = $servers[0]['endpoint'];
$theme = $_COOKIE['theme'] ?? $design['theme'];
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?= $theme ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Looking Glass Tool</title>
  <link rel="icon" href="<?= $design['favicon'][$theme] ?>">
  <link rel="stylesheet" href="assets/style.css">
 <style>
  * {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    box-sizing: border-box;
  }

  body {
    background: <?= $design['background_color'] ?>;
    color: <?= $design['text_color'] ?>;
    margin: 0;
    padding: 0;
  }

  header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: <?= $design['header_bg'] ?>;
    padding: 20px 40px;
    border-bottom: 2px solid <?= $design['neon_color'] ?>;
  }

  #theme-switcher {
    font-size: 20px;
    cursor: pointer;
  }

  header img {
    height: 50px;
  }

  h1 {
    margin: 0;
    font-size: 28px;
  }

  #main-container {
    padding: 20px;
    max-width: 1000px;
    margin: auto;
  }

  #location-selector {
    text-align: center;
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
  }

  .location-button {
   display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 15px;
    background: <?= $design['button_bg'] ?>;
    color: <?= $design['text_color'] ?>;
    border: 1px solid <?= $design['neon_color'] ?>55;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    min-width: 240px;
    max-width: 300px;
  }

  .location-button.active {
    background: <?= $design['neon_color'] ?>;
    color: <?= $design['active_text_color'] ?>;
    font-weight: bold;
  }

  .flag-left {
    width: 32px;
    height: 32px;
    object-fit: contain;
    border-radius: 4px;
  }

  .location-label {
    display: flex;
    flex-direction: column;
    justify-content: center;
    line-height: 1.2;
    gap: 2px; /* tightens spacing */
  }

  .location-label strong {
    font-size: 15px;
  }

  .location-label small {
    font-size: 12px;
    opacity: 0.75;
  }

  #action-pane {
    text-align: center;
    margin: 20px 0;
  }

  #action-pane input {
    padding: 10px;
    width: 300px;
    border-radius: 5px;
    border: none;
    margin-right: 10px;
    background: <?= $design['input_bg'] ?>;
    color: <?= $design['text_color'] ?>;
  }

  #action-pane button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background: <?= $design['neon_color'] ?>;
    color: <?= $design['active_text_color'] ?>;
    margin: 5px;
    cursor: pointer;
  }

  #output-box {
    background: <?= $design['output_bg'] ?>;
    padding: 15px;
    border-radius: 12px;
    border: 1px solid <?= $design['neon_color'] ?>33;
    box-shadow: 0 0 10px <?= $design['neon_color'] ?>22;
    display: none;
    transition: all 0.3s ease;
  }

  .output {
    background: #000;
    color: lime;
    padding: 10px;
    min-height: 100px;
    max-height: 500px;
    overflow-y: auto;
    white-space: pre-wrap;
    border-radius: 5px;
    font-size: 13px;
  }

  .download-buttons {
    margin-top: 15px;
    text-align: center;
  }

  .download-buttons a {
    display: inline-block;
    margin: 5px;
    padding: 6px 12px;
    background: <?= $design['neon_color'] ?>;
    color: <?= $design['active_text_color'] ?>;
    text-decoration: none;
    border-radius: 4px;
    font-size: 13px;
  }

  .modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
  }

  .modal-content {
    background-color: #1f2235;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid <?= $design['neon_color'] ?>;
    width: 400px;
    color: <?= $design['text_color'] ?>;
    border-radius: 8px;
    position: relative;
  }

  .modal-content .close {
    position: absolute;
    top: 8px;
    right: 12px;
    font-size: 20px;
    cursor: pointer;
    color: <?= $design['neon_color'] ?>;
  }

  footer a:hover {
    text-decoration: underline;
  }

  /* Theme Overrides: Light Mode */
  [data-theme="light"] body {
    background: #f7f7f7;
    color: #222;
  }

  [data-theme="light"] header {
    background: #ffffff;
    border-bottom: 2px solid #007acc;
  }

  [data-theme="light"] footer {
    color: #222;
  }

  [data-theme="light"] footer a {
    color: #007acc;
  }

  [data-theme="light"] #action-pane input {
    background: #ffffff;
    color: #222;
    border: 1px solid #ccc;
  }

  [data-theme="light"] #action-pane button {
    background: #007acc;
    color: #ffffff;
  }

  [data-theme="light"] #output-box {
    background: #ffffff;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px #ccc;
  }

  [data-theme="light"] .output {
    background: #f1f1f1;
    color: #222;
  }

  [data-theme="light"] .download-buttons a {
    background: #007acc;
    color: #fff;
  }

  [data-theme="light"] .location-button {
    background: #ffffff;
    color: #222;
    border: 1px solid #007acc55;
  }

  [data-theme="light"] .location-button.active {
    background: #007acc;
    color: #fff;
  }

  /* Footer styles */
  .footer-link {
    font-weight: 600;
    font-size: 15px;
    text-decoration: none;
    margin: 0 12px;
    transition: color 0.3s ease;
  }

  [data-theme="dark"] .footer-link {
    color: <?= $design['neon_color'] ?>;
  }

  [data-theme="light"] .footer-link {
    color: #005a9e;
  }

  .footer-link:hover {
    opacity: 0.85;
    text-decoration: none;
  }

  .footer-signature {
    text-decoration: none;
    font-weight: bold;
  }

  .footer-signature:hover {
    opacity: 0.85;
  }

  .sitehub-green {
    color: #00cc66;
  }

  .sitehub-blue {
    color: #3399ff;
  }

  [data-theme="light"] .sitehub-green {
    color: #00aa33;
  }

  [data-theme="light"] .sitehub-blue {
    color: blue;
  }
</style>

</head>
<body>
<header>
  <img src="<?= $design['logo'][$theme] ?>" alt="Your Logo Here">
  <h1>Global Looking Glass</h1>
  <div id="theme-switcher" title="Toggle Theme">🌙</div>
</header>

<div id="main-container">
  <div id="location-selector">
    <?php foreach ($servers as $server): ?>
      <div class="location-button" onclick="selectLocation(this, '<?= htmlspecialchars($server['endpoint']) ?>', '<?= htmlspecialchars($server['id']) ?>')">
  <img src="assets/flags/4x3/<?= strtolower($server['country']) ?>.svg" alt="<?= $server['country'] ?>" class="flag-left">
  <div class="location-label">
    <strong><?= htmlspecialchars($server['name']) ?></strong>
    <small><?= htmlspecialchars($server['description']) ?></small>
  </div>
</div>
    <?php endforeach; ?>
  </div>

  <div id="action-pane">
    <input type="text" id="target" placeholder="Enter IP or Hostname..." />
    <button onclick="runTool('ping')">Ping</button>
    <button onclick="runTool('traceroute')">Traceroute</button>
    <button onclick="runTool('mtr')">MTR</button>
    <button onclick="lookupASN()">ASN Info</button>
  </div>

  <div id="output-box">
    <pre class="output" id="command-output"></pre>
    <div class="download-buttons" id="download-buttons"></div>
  </div>
</div>

<div id="asn-modal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="document.getElementById('asn-modal').style.display='none'">&times;</span>
    <h3>ASN Information</h3>
    <div id="asn-result" style="font-size: 14px;"></div>
  </div>
</div>

<footer style="text-align: center; margin-top: 60px; padding: 20px; font-size: 13px;">
  <?php if (!empty($design['footer']['custom_text'])): ?>
    <div><?= htmlspecialchars($design['footer']['custom_text']) ?></div>
  <?php endif; ?>

  <div style="margin: 15px 0; font-size: 15px;">
    <a href="<?= $design['footer']['peeringdb_url'] ?>" target="_blank" class="footer-link">🔗 PeeringDB</a>
    <a href="<?= $design['footer']['bgptools_url'] ?>" target="_blank" class="footer-link">📡 BGP.tools</a>
  </div>

  <?php if (!empty($design['footer']['show_signature'])): ?>
    <div style="margin-top: 5px; opacity: 0.6;">
      Designed by 
      <a href="https://sitehub.agency" target="_blank" class="footer-signature">
        <span class="sitehub-green">Site</span><span class="sitehub-blue">HUB</span>
      </a>
    </div>
  <?php endif; ?>
</footer>
	

<!-- Use the below to serve download files directly from accessible downloads directory (Unsafe) -->
<!-- <script>
let currentEndpoint = "<?= $defaultEndpoint ?>";
function selectLocation(button, endpoint) {
  document.querySelectorAll('.location-button').forEach(btn => btn.classList.remove('active'));
  button.classList.add('active');
  currentEndpoint = endpoint;
  updateDownloads();
}
function runTool(tool) {
  const target = document.getElementById('target').value.trim();
  if (!target) return alert("Enter an IP or domain.");
  document.getElementById('command-output').textContent = `Running ${tool} on ${target}...`;
  document.getElementById('output-box').style.display = 'block';
  fetch('api/remote-proxy.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({ endpoint: currentEndpoint, tool, target })
  })
  .then(res => res.text())
  .then(data => {
    document.getElementById('command-output').textContent = data;
  })
  .catch(err => {
    document.getElementById('command-output').textContent = 'Error: ' + err;
  });
  updateDownloads();
}
function updateDownloads() {
  const d = document.getElementById('download-buttons');
  d.innerHTML = [10, 50, 100].map(size =>
    `<a href="${currentEndpoint}?file=${size}MB" target="_blank">${size}MB File</a>`
  ).join('');
}
window.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.location-button')[0]?.click();
});
</script> -->
	
<!-- Use the below to server downloads from secure location. Abusers are rate limited. (Safe) -->
<script>
let currentEndpoint = "<?= $defaultEndpoint ?>";
let currentServerId = "<?= $servers[0]['id'] ?? 'default' ?>"; // fallback

function selectLocation(button, endpoint, serverId) {
  document.querySelectorAll('.location-button').forEach(btn => btn.classList.remove('active'));
  button.classList.add('active');
  currentEndpoint = endpoint;
  currentServerId = serverId;
  updateDownloads();
}

function runTool(tool) {
  const target = document.getElementById('target').value.trim();
  if (!target) return alert("Enter an IP or domain.");
  document.getElementById('command-output').textContent = `Running ${tool} on ${target}...`;
  document.getElementById('output-box').style.display = 'block';
  fetch('api/remote-proxy.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({ endpoint: currentEndpoint, tool, target })
  })
  .then(res => res.text())
  .then(data => {
    document.getElementById('command-output').textContent = data;
  })
  .catch(err => {
    document.getElementById('command-output').textContent = 'Error: ' + err;
  });
  updateDownloads();
}
	

function updateDownloads() {
  const sizes = [10, 50, 100];
  const container = document.getElementById('download-buttons');

  container.innerHTML = sizes.map(size =>
     `<a href="downloads/download.php?file=${size}MB.test&server=${currentServerId}" 
         class="download-link">
         Download ${size}MB
      </a>`
   ).join('');
}


window.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.location-button')[0]?.click();
});
</script>


<script>
function lookupASN() {
  const target = document.getElementById('target').value.trim();
  if (!target) return alert("Enter an IP or hostname first.");
  const modal = document.getElementById('asn-modal');
  const resultBox = document.getElementById('asn-result');
  modal.style.display = 'block';
  resultBox.innerHTML = `<em>Looking up ASN info for <strong>${target}</strong>...</em>`;
  fetch(`https://ipinfo.io/${target}/json?token=demo`) // This is for your ipinfo API key. Replace demo with ipinfo API key for ASN button to work. Note: You can use any provider you choose.
    .then(res => res.json())
    .then(data => {
      const info = `
        <strong>IP:</strong> ${data.ip || 'N/A'}<br>
        <strong>ASN:</strong> ${data.org || 'N/A'}<br>
        <strong>City:</strong> ${data.city || 'N/A'}<br>
        <strong>Region:</strong> ${data.region || 'N/A'}<br>
        <strong>Country:</strong> ${data.country || 'N/A'}<br>
        <strong>Hostname:</strong> ${data.hostname || 'N/A'}
      `;
      resultBox.innerHTML = info;
    })
    .catch(err => {
      resultBox.innerHTML = `<span style="color: red;">Lookup failed: ${err}</span>`;
    });
}
</script>

<script>
const htmlTag = document.documentElement;
const themeSwitcher = document.getElementById('theme-switcher');
const storedTheme = localStorage.getItem('theme') || '<?= $design['theme'] ?>';
htmlTag.setAttribute('data-theme', storedTheme);
themeSwitcher.textContent = storedTheme === 'light' ? '☀️' : '🌙';

themeSwitcher.addEventListener('click', () => {
  const newTheme = htmlTag.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
  htmlTag.setAttribute('data-theme', newTheme);
  localStorage.setItem('theme', newTheme);
  document.cookie = "theme=" + newTheme + "; path=/; max-age=31536000";
  themeSwitcher.textContent = newTheme === 'light' ? '☀️' : '🌙';

  // Update logo
  const logo = document.querySelector('header img');
  logo.src = <?= json_encode($design['logo']) ?>[newTheme];

  // Update favicon
  const favicon = document.querySelector('link[rel="icon"]');
  favicon.href = <?= json_encode($design['favicon']) ?>[newTheme];
});

</script>

</body>
</html>