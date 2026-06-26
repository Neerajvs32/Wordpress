<?php
/**
 * Plugin Name:  CertifyMe for LifterLMS
 * Plugin URI:   https://www.certifyme.online/lifterlms-integration
 * Description:  Auto-issue CertifyMe digital credentials on course completion
 * Version:      1.0.0
 * Author:       CertifyMe
 * Author URI:   https://www.certifyme.online
 * License:      GPLv2 or later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  certifyme-for-lifterlms
 * Requires Plugins: lifterlms
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once plugin_dir_path(__FILE__) . 'includes/logger.php';
require_once plugin_dir_path(__FILE__) . 'admin/settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/hooks.php';
require_once plugin_dir_path(__FILE__) . 'includes/api.php';