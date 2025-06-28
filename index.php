<?php
/*==============================================
# Written By Chike Egbuna For SiteHUB Agency Ltd
# Last Updated: 28th June 2025
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
  <title>Global Looking Glass</title>
  <link rel="icon" href="<?= $design['favicon'][$theme] ?>">
  <link rel="stylesheet" href="assets/style.css">
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
	
<script src="assets/lookupASN.js"></script>
<script src="assets/script.js"></script>
<script src="assets/downloads.js"></script>

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
