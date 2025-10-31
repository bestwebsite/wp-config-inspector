<p align="center">
  <img src="https://raw.githubusercontent.com/bestwebsite/wp-config-inspector/master/assets/social/wp-config-inspector-banner.png"
       alt="WP Config Inspector — Inspect key WordPress constants and environment details" />
</p>

# WP Config Inspector

[![Latest release](https://img.shields.io/github/v/release/bestwebsite/wp-config-inspector)](../../releases)
[![License: GPL-2.0+](https://img.shields.io/badge/license-GPL--2.0%2B-blue.svg)](LICENSE)
[![WP-CLI](https://img.shields.io/badge/WP--CLI-supported-2ea44f.svg)](https://wp-cli.org/)
[![Maintained by Best Website](https://img.shields.io/badge/maintainer-Best%20Website-3AA0FF)](https://bestwebsite.com)

Instant visibility into what your WordPress instance is *actually* running.

WP Config Inspector surfaces important constants, environment flags, and configuration details in a safe, read‑only way — from the dashboard or from WP‑CLI.

---

## Features

- View key WordPress constants (e.g. `WP_DEBUG`, `DISALLOW_FILE_EDIT`, `WP_ENVIRONMENT_TYPE`)
- View environment/server details useful for support and debugging
- Security-minded: salts, passwords, and secrets are **never** displayed
- “Health check” style flags to highlight risky production settings
- JSON export for support tickets / audits
- WP‑CLI commands for headless environments or locked-down admin areas

---

## Use Cases

- ✅ Hand this to a client or stakeholder so they can send you an environment snapshot without giving cPanel/SSH access  
- ✅ Sanity-check production: confirm debug mode is off, file editor is disabled, SSL is enforced  
- ✅ Capture config state before a migration or major upgrade  
- ✅ Keep a lightweight record of how an environment was configured on a specific date

---

## Admin UI

Once activated, WP Config Inspector adds a page in the dashboard that shows:

- A table of important constants and values
- A table of environment details (PHP version, web server, etc.)
- A list of “Flags / Warnings” that call out potentially unsafe production settings

All values are read‑only. This plugin does not write or modify configuration.

---

## WP‑CLI Usage

You can pull the same data (and export it) over the command line.

```bash
# List key constants and environment values
wp config-inspector list

# Export everything to JSON for sharing with support
wp config-inspector export > config-report.json
```

### Example output (`wp config-inspector list`)

```text
+---------------------------+---------------------+
| key                       | value               |
+---------------------------+---------------------+
| WP_DEBUG                  | false               |
| WP_ENVIRONMENT_TYPE       | production          |
| DISALLOW_FILE_EDIT        | true                |
| FORCE_SSL_ADMIN           | true                |
| PHP_VERSION               | 8.2.12              |
| WEB_SERVER                | nginx               |
| MULTISITE                 | false               |
+---------------------------+---------------------+
```

Security-sensitive values like salts, DB credentials, etc. are intentionally excluded.

---

## Installation

1. Upload the `wp-config-inspector` folder to `/wp-content/plugins/`
2. Activate via **Plugins → WP Config Inspector**
3. Open the new inspector page in the admin dashboard

or, if you have CLI and direct file access:

```bash
wp plugin activate wp-config-inspector
wp config-inspector list
```

---

## Contributing

Questions, ideas, PRs, or requests for new checks are all welcome.

Please see [CONTRIBUTING.md](.github/CONTRIBUTING.md) for guidelines.  
You can also open an issue labeled `enhancement` or `good first issue`.

Support: support@bestwebsite.com

---

## Roadmap

- Additional environment checks for common security misconfigs
- Export “flags” separately for automated audit workflows
- Optional REST endpoint for remote monitoring (read-only)

---

## License

GPL‑2.0‑or‑later  
Built and maintained by **Best Website** — https://bestwebsite.com
