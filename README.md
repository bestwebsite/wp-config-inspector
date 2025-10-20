# WP Config Inspector

Inspect key WordPress constants and server environment details. Export results and use via WP‑CLI.

![GitHub release](https://img.shields.io/github/v/release/bestwebsite/wp-config-inspector) ![License](https://img.shields.io/badge/license-GPL--2.0%2B-blue)

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
