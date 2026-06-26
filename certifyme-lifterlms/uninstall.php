<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

delete_option( 'certifyme_api_token' );
delete_option( 'certifyme_template_id' );
delete_option( 'certifyme_server' );
