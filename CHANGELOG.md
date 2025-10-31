# Changelog

## v1.0.1
- docs: Added "Use Cases" section to README
- docs: Added "Example output" section for WP‑CLI usage
- docs: Added Contributing / Support info block
- meta: Clarified security posture (never surfaces salts or secrets)

## v1.0.0
- Initial public release of WP Config Inspector.
- Admin dashboard view for key WordPress constants and environment details.
- Health-style flags for risky production settings.
- Safe output (no salts, no passwords).
- WP‑CLI support:
  - `wp config-inspector list`
  - `wp config-inspector export > config.json`
