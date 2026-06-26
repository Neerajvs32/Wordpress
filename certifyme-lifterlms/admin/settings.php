<?php
add_action( 'admin_menu', function() {
    add_options_page(
        'CertifyMe Settings',
        'CertifyMe',
        'manage_options',
        'certifyme-settings',
        'certifyme_settings_page'
    );
});

function certifyme_settings_page() {
    $servers = [
        'apac'      => 'APAC (apac.platform.certifyme.dev)',
        'eu2'       => 'EU2 (eu2.certifyme.org)',
        'us1'       => 'US1 (us1.certifyme.org)',
        'butterfly' => 'Butterfly (butterfly.certifyme.org)',
    ];

    if ( isset($_POST['certifyme_save']) ) {
        check_admin_referer('certifyme_save_settings');
        update_option('certifyme_api_token',   sanitize_text_field($_POST['certifyme_api_token']));
        update_option('certifyme_template_id', sanitize_text_field($_POST['certifyme_template_id']));
        $submitted_server = sanitize_text_field($_POST['certifyme_server']);
        update_option('certifyme_server', array_key_exists($submitted_server, $servers) ? $submitted_server : 'apac');
        echo '<div class="updated"><p>Settings saved.</p></div>';
    }
    $token  = get_option('certifyme_api_token', '');
    $tmpl   = get_option('certifyme_template_id', '');
    $server = get_option('certifyme_server', 'apac');
    ?>
    <div class="wrap">
        <h2>CertifyMe API Settings</h2>
        <form method="post">
            <?php wp_nonce_field('certifyme_save_settings'); ?>
            <table class="form-table">
                <tr>
                    <th>Server</th>
                    <td>
                        <select name="certifyme_server">
                            <?php foreach ( $servers as $key => $label ) : ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php selected($server, $key); ?>>
                                    <?php echo esc_html($label); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>API Token</th>
                    <td><input type="text" name="certifyme_api_token"
                        value="<?php echo esc_attr($token); ?>" size="60" /></td>
                </tr>
                <tr>
                    <th>Template ID</th>
                    <td><input type="text" name="certifyme_template_id"
                        value="<?php echo esc_attr($tmpl); ?>" size="20" /></td>
                </tr>
            </table>
            <input type="submit" name="certifyme_save"
                value="Save Settings" class="button-primary" />
        </form>
    </div>
    <?php
}