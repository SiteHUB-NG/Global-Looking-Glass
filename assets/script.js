/*==============================================
# Written By Chike Egbuna For SiteHUB Agency Ltd
# Last Updated: 28th June 2025
#==============================================*/
 
<!-- Use the below to serve download files directly from accessible downloads directory (Unsafe) -->
/*
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
}); */
	
<!-- Use the below to server downloads from secure location. Abusers are rate limited. (Safe) -->

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
