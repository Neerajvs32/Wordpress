<?php
function certifyme_get_log_file() {
    $log_dir = WP_CONTENT_DIR . '/uploads/certifyme-logs';

    if ( ! file_exists( $log_dir ) ) {
        wp_mkdir_p( $log_dir );
        file_put_contents( $log_dir . '/.htaccess', 'Deny from all' );
        file_put_contents( $log_dir . '/index.php', '<?php // Silence is golden.' );
    }

    return $log_dir . '/certifyme-lifterlms.log';
}

function certifyme_log( $level, $message, $context = [] ) {
    $timestamp = current_time('Y-m-d H:i:s');
    $level_tag = strtoupper( $level );

    $line = "[{$timestamp}] [{$level_tag}] {$message}";
    if ( ! empty( $context ) ) {
        $line .= ' | ' . json_encode( $context );
    }
    $line .= PHP_EOL;

    error_log( $line, 3, certifyme_get_log_file() );
}

function certifyme_log_info( $message, $context = [] ) {
    certifyme_log( 'info', $message, $context );
}

function certifyme_log_warning( $message, $context = [] ) {
    certifyme_log( 'warning', $message, $context );
}

function certifyme_log_error( $message, $context = [] ) {
    certifyme_log( 'error', $message, $context );
}
