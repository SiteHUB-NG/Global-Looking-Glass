<?php
/*==============================================
# Written By Chike Egbuna For SiteHUB Agency Ltd
# Last Updated: 26th June 2025
===============================================*/

return [
  // Default theme - 'dark' or 'light'
  'theme'            => 'dark',

  'background_color' => '#0e101c',
  'text_color'       => '#ffffff',
  'active_text_color'=> '#000000',

  'header_bg'        => '#1a1c2c',
  'button_bg'        => '#2a2e4c',
  'input_bg'         => '#2a2e4c',
  'output_bg'        => '#1f2235',
  'neon_color'       => '#00e5ff',

  // Set light and dark logos and favicons here
  'logo'             => [
    'dark'           => 'assets/img/dark-logo.png',
    'light'          => 'assets/img/light-logo.png',
  ],
	
  'favicon'          => [
    'dark'           => 'assets/img/favicon-dark.ico',
    'light'          => 'assets/img/favicon-light.ico',
  ],
	
  'footer'           => [
    'custom_text'    => '© ' . date("Y"). ' SiteHUB Network Tools. All rights reserved.',
    'show_signature' => true,
    'peeringdb_url'  => 'https://www.peeringdb.com/net/37079', // Change to your organisations PeeringDB
    'bgptools_url'   => 'https://bgp.tools/as/214354'          // Change to your organisations ASN
  ]
];
