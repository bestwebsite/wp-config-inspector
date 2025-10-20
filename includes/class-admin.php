<?php
namespace BestWebsite\ConfigInspector;

class Admin {

    public function hooks(): void {
        add_action('admin_menu', [ $this, 'menu' ]);
        add_action('admin_enqueue_scripts', [ $this, 'assets' ]);
        add_action('wp_ajax_bwci_export', [ $this, 'ajax_export' ]);
    }

    public function menu(): void {
        add_management_page(
            __('Config Inspector','wp-config-inspector'),
            __('Config Inspector','wp-config-inspector'),
            'manage_options',
            'wp-config-inspector',
            [ $this, 'render' ]
        );
    }

    public function assets(): void {
        wp_register_script('bwci-admin', BWCI_URL.'assets/js/admin.js', ['jquery'], BWCI_VERSION, true);
        wp_localize_script('bwci-admin', 'BWCI', ['ajax'=>admin_url('admin-ajax.php'), 'nonce'=>wp_create_nonce('bwci_export')]);
        wp_enqueue_script('bwci-admin');
        wp_enqueue_style('bwci-admin', BWCI_URL.'assets/css/admin.css', [], BWCI_VERSION);
    }

    public function ajax_export(): void {
        if ( ! current_user_can('manage_options') ) wp_send_json_error('forbidden', 403);
        check_ajax_referer('bwci_export','nonce');
        wp_send_json_success( Core::collect() );
    }

    public function render(): void {
        if ( ! current_user_can('manage_options') ) return;
        $data = Core::collect();

        echo '<div class="wrap"><h1>WP Config Inspector</h1>';
        echo '<p>View key WordPress constants and environment details. No secrets are exposed. You can export the data as JSON.</p>';

        echo '<h2>Constants</h2>';
        echo '<table class="widefat striped"><thead><tr><th>Constant</th><th>Value</th></tr></thead><tbody>';
        foreach ( $data['constants'] as $k => $v ) {
            $val = is_null($v) ? '<em>not defined</em>' : esc_html( (string) $v );
            echo '<tr><td><code>'.esc_html($k).'</code></td><td>'.$val.'</td></tr>';
        }
        echo '</tbody></table>';

        echo '<h2 style="margin-top:16px;">Environment</h2>';
        echo '<table class="widefat striped"><thead><tr><th>Key</th><th>Value</th></tr></thead><tbody>';
        foreach ( $data['environment'] as $k => $v ) {
            $val = is_null($v) ? '<em>-</em>' : esc_html( (string) $v );
            echo '<tr><td><code>'.esc_html($k).'</code></td><td>'.$val.'</td></tr>';
        }
        echo '</tbody></table>';

        echo '<h2 style="margin-top:16px;">Checks</h2><ul class="bwci-flags">';
        echo $data['flags']['debug_on_in_production'] ? '<li class="bwci-warn">WP_DEBUG is ON in production.</li>' : '<li class="bwci-ok">WP_DEBUG is appropriate.</li>';
        echo $data['flags']['no_ssl_admin'] ? '<li class="bwci-warn">FORCE_SSL_ADMIN is not enabled in production.</li>' : '<li class="bwci-ok">Admin SSL is enforced or non-production.</li>';
        echo $data['flags']['file_edit_enabled'] ? '<li class="bwci-warn">Theme/Plugin file editor is enabled.</li>' : '<li class="bwci-ok">Theme/Plugin file editor disabled.</li>';
        echo '</ul>';

        echo '<p><button id="bwci-export" class="button button-primary">Export as JSON</button> <button id="bwci-copy" class="button">Copy to Clipboard</button></p>';
        echo '<textarea id="bwci-json" style="width:100%;height:200px;" readonly></textarea>';

        echo '</div>';
    }
}
