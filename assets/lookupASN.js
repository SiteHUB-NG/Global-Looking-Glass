/*==============================================
# Written By Chike Egbuna For SiteHUB Agency Ltd
# Last Updated: 28th June 2025
===============================================*/

function lookupASN() {
  const target = document.getElementById('target').value.trim();
  if (!target) return alert("Enter an IP or hostname first.");
  const modal = document.getElementById('asn-modal');
  const resultBox = document.getElementById('asn-result');
  modal.style.display = 'block';
  resultBox.innerHTML = `<em>Looking up ASN info for <strong>${target}</strong>...</em>`;
  fetch(`https://ipinfo.io/${target}/json?token=demo`) //Replace demo with ipinfo api
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
