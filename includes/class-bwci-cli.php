<?php
use WP_CLI\Utils;

if ( defined('WP_CLI') && WP_CLI ) {
    class BWCI_CLI extends WP_CLI_Command {

        public function list($args, $assoc_args) {
            $data = BestWebsite\ConfigInspector\Core::collect();
            $format = isset($assoc_args['format']) ? $assoc_args['format'] : 'table';
            if ( $format === 'json' ) {
                WP_CLI::print_value( $data, ['format' => 'json'] );
                return;
            }
            $rows = [];
            foreach ($data['constants'] as $k=>$v) { $rows.append(['group'=>'constant','key'=>$k,'value'=>is_null($v)?'not defined':$v]); }
            foreach ($data['environment'] as $k=>$v) { $rows.append(['group'=>'environment','key'=>$k,'value'=>is_null($v)?'-':$v]); }
            Utils\format_items('table', $rows, ['group','key','value']);
        }

        public function export() {
            $data = BestWebsite\ConfigInspector\Core::collect();
            WP_CLI::print_value( $data, ['format' => 'json'] );
        }
    }
    WP_CLI::add_command('config-inspector', 'BWCI_CLI');
}
