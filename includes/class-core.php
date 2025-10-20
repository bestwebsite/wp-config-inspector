<?php
namespace BestWebsite\ConfigInspector;

class Core {

    public function init(): void {
        if ( is_admin() ) {
            ( new Admin() )->hooks();
        }
    }

    public static function collect(): array {
        global $wpdb;

        $constants = [
            'WP_ENVIRONMENT_TYPE' => defined('WP_ENVIRONMENT_TYPE') ? WP_ENVIRONMENT_TYPE : null,
            'WP_DEBUG'            => defined('WP_DEBUG') ? ( WP_DEBUG ? 'true' : 'false' ) : null,
            'SCRIPT_DEBUG'        => defined('SCRIPT_DEBUG') ? ( SCRIPT_DEBUG ? 'true' : 'false' ) : null,
            'WP_CACHE'            => defined('WP_CACHE') ? ( WP_CACHE ? 'true' : 'false' ) : null,
            'DISALLOW_FILE_EDIT'  => defined('DISALLOW_FILE_EDIT') ? ( DISALLOW_FILE_EDIT ? 'true' : 'false' ) : null,
            'FORCE_SSL_ADMIN'     => defined('FORCE_SSL_ADMIN') ? ( FORCE_SSL_ADMIN ? 'true' : 'false' ) : null,
            'WP_HOME'             => defined('WP_HOME') ? WP_HOME : null,
            'WP_SITEURL'          => defined('WP_SITEURL') ? WP_SITEURL : null,
        ];

        $env = [
            'php_version'         => PHP_VERSION,
            'server_software'     => isset($_SERVER['SERVER_SOFTWARE']) ? sanitize_text_field($_SERVER['SERVER_SOFTWARE']) : null,
            'memory_limit'        => ini_get('memory_limit'),
            'max_execution_time'  => ini_get('max_execution_time'),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size'       => ini_get('post_max_size'),
            'max_input_vars'      => ini_get('max_input_vars'),
            'mysql_version'       => method_exists($wpdb, 'db_version') ? $wpdb->db_version() : null,
            'wordpress_version'   => get_bloginfo('version'),
            'site_url'            => get_site_url(),
            'home_url'            => get_home_url(),
        ];

        $flags = [
            'debug_on_in_production' => ( ( defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'production' ) && defined('WP_DEBUG') && WP_DEBUG ) ? true : false,
            'no_ssl_admin'           => ( defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'production' && ( ! defined('FORCE_SSL_ADMIN') || FORCE_SSL_ADMIN !== true ) ),
            'file_edit_enabled'      => ( ! defined('DISALLOW_FILE_EDIT') || DISALLOW_FILE_EDIT === false ),
        ];

        return [
            'generated_at' => time(),
            'constants'    => $constants,
            'environment'  => $env,
            'flags'        => $flags,
        ];
    }
}
