<?php
function certifyme_get_server_url() {
    $servers = [
        'apac'      => 'https://apac.platform.certifyme.dev/',
        'eu2'       => 'https://eu2.certifyme.org/',
        'us1'       => 'https://us1.certifyme.org/',
        'butterfly' => 'https://butterfly.certifyme.org/',
    ];
    $selected = get_option( 'certifyme_server', 'apac' );
    return isset( $servers[ $selected ] ) ? $servers[ $selected ] : $servers['apac'];
}

function certifyme_issue_credential( $data ) {
    $api_token   = get_option('certifyme_api_token');
    $server_url  = certifyme_get_server_url();
    $endpoint    = trailingslashit( $server_url ) . 'api/v2/credential';

    certifyme_log_info( 'Calling API endpoint', [ 'url' => $endpoint ] );

    $response = wp_remote_post(
        $endpoint,
        [
            'headers' => [
                'Authorization' => $api_token,
                'Content-Type'  => 'application/json',
                'accept'        => 'application/json',
            ],
            'body'    => json_encode( $data ),
            'timeout' => 50,
        ]
    );

    if ( is_wp_error( $response ) ) {
        certifyme_log_error( 'WP HTTP error calling API', [
            'error'  => $response->get_error_message(),
            'url' => $endpoint,
        ]);
        return false;
    }

    $code = wp_remote_retrieve_response_code( $response );
    $body = wp_remote_retrieve_body( $response );

    if ( $code < 200 || $code >= 300 ) {
        certifyme_log_error( 'API returned non-2xx response', [
            'status' => $code,
            'body'   => $body,
            'url' => $endpoint,
        ]);
        return false;
    }

    certifyme_log_info( 'API call succeeded', [
        'status' => $code,
        'body'   => $body,
    ]);
    return true;
}