# WP Config Inspector

Inspect key WordPress constants and server environment details. Export results and use via WP‑CLI.

[![Latest release](https://img.shields.io/github/v/release/bestwebsite/wp-config-inspector)](../../releases)
[![License: GPL-2.0+](https://img.shields.io/badge/license-GPL--2.0%2B-blue.svg)](LICENSE)
[![WP-CLI](https://img.shields.io/badge/WP--CLI-supported-2ea44f.svg)](https://wp-cli.org/)
[![Maintained by Best Website](https://img.shields.io/badge/maintainer-Best%20Website-3AA0FF)](https://bestwebsite.com)

## Features
- Read-only dashboard showing core constants and environment info
- Simple health checks (debug in production, admin SSL, file editor)
- Export JSON in the admin (AJAX) or via WP‑CLI
- No secrets are exposed (no DB password, salts, or keys)

## Installation
1. Upload `wp-config-inspector` to `/wp-content/plugins/`
2. Activate via **Plugins**
3. Go to **Tools → Config Inspector**

## WP‑CLI
```bash
wp config-inspector list
wp config-inspector list --format=json
wp config-inspector export > config.json
```

## Author
Built and maintained by **Best Website** — https://bestwebsite.com  
Support: support@bestwebsite.com

## License
GPL‑2.0 or later
