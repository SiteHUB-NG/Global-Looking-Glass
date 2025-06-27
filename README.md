# Global Looking Glass

**Global Looking Glass** is a PHP-based network diagnostic tool that enables public probing of multiple servers via an easy-to-deploy interface.

<img width="870" alt="image" src="https://github.com/user-attachments/assets/12fc0dea-2d1c-4687-afe2-fe7784644890" />


## 🌐 Features

- **Network Diagnostics**: Run `ping`, `traceroute`, `MTR`, and download test files (e.g., 10MB/100MB).
- **View ASN details for deeper network analysis.
- **Multi-Server Support**: Add and manage multiple servers from a single pane—even on shared hosting.
- **Security First**:
  - IP-based rate limiting
  - Command sanitization
  - CSRF protection

## 🚀 Live Demo

Check out the tool in action at:  
🔗 [https://looking-glass.sitehub.agency](https://looking-glass.sitehub.agency)

## ⚙️ Tech Stack

- HTML, PHP, JavaScript, Bash
- Compatible with Apache or Nginx-based platforms

## 🧱 Requirements

Most basic web hosting environments are sufficient. For self-hosted installs:

- Apache or Nginx
- PHP with the following packages:  
  `php`, `php-fpm`, `php-cli`, `php-mysqlnd`, `php-common`
- SSL support: `mod_ssl` / `a2enmod`, `certbot`, `python3-certbot-apache` or `python3-certbot-nginx`
- Tools: `mtr`, `traceroute`

## 🛠️ Installation

1. Unzip the project files into your web root.
2. Add your logo and favicon assets.
3. Insert your API keys and server configurations.
4. Create your shared secret.
5. Done! Your Looking Glass is live.

## ✅ To Deploy:
1. Host the frontend index.php on your main site.
2. Place `looking-glass-node/api.php` on each probe server.
3. Update `servers.php` with the correct URLs and country codes for flag mapping.
4. On each probe server, install required packages
   - iputils-ping
   - traceroute
   - mtr
5. Make sure the folder is accessible over HTTPS with a valid SSL certificate. You should see the response: `Access denied: Invalid token`.
6. Replace the line `$EXPECTED_TOKEN = 'SHARED_SECRET';` in both `remote-proxy.php` on the main site and `api.php` on each probe server. Be sure that the keys match.
7. Configure Server URLs in `config/servers.php` making sure to only use https protocol. It will not work with http.
8. Drop test files into a private directory and provide the full path or use the `downloads/` directory and make sure they’re accessible.
9. Secure each probe server's `api.php` with token validation or IP restrictions. 

## 👥 Contributing

Contributions are welcome! Feel free to fork the repo and submit pull requests to improve functionality or add features.

## 📜 License

A free and open license will be applied (TBD). In the meantime, you're welcome to use, fork, and build upon this project.
