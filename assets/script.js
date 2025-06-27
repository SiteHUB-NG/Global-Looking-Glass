/*==============================================
# Written By Chike Egbuna For SiteHUB Agency Ltd
# Last Updated: 26th June 2025
#==============================================*/
 
function runTool(tool) {
  const target = document.getElementById('target').value.trim();
  if (!target) {
    alert("Enter an IP or domain.");
    return;
  }

  const servers = document.querySelectorAll('.server-box');
  servers.forEach(server => {
    const endpoint = server.dataset.endpoint;
    const output = server.querySelector('.output');

    output.textContent = `Running ${tool} on ${target}...`;

    fetch('api/remote-proxy.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({
        endpoint: endpoint,
        tool: tool,
        target: target
      })
    })
    .then(res  => res.text())
    .then(data => {
      output.textContent = data;
    })
    .catch(err => {
      output.textContent = 'Error: ' + err;
    });
  });
}
