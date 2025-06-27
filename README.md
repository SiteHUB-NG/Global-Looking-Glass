# Global Looking Glass

**Global Looking Glass** is a PHP-based network diagnostic tool that enables public probing of multiple servers via an easy-to-deploy interface.

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

## 👥 Contributing

Contributions are welcome! Feel free to fork the repo and submit pull requests to improve functionality or add features.

## 📜 License

A free and open license will be applied (TBD). In the meantime, you're welcome to use, fork, and build upon this project.

## 📬 Contact

**Created by**: Chike Egbuna  
**Email**: chike@sitehub.agency