/*==============================================
# Written By Chike Egbuna For SiteHUB Agency Ltd
# Last Updated: 28th June 2025
===============================================*/

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
