<?php

/**
 * Plugin Name: Sports Club Manager
 * Plugin URI: http://www.codestructor.de/plugins/sports-club-manager/
 * Description: This plugin enables the administration and presentation of teams, players, contacts and more. 
 * Version: 0.3
 * Author: Marvin Schirrmacher
 * Author URI: http://www.codestructor.de
 * License: Codestructor
 */

define( 'SCM_VERSION', '0.3' );
define( 'SCM_REQUIRED_WP_VERSION', '4.8' );
define( 'SCM_PLUGIN', __FILE__ );
define( 'SCM_PLUGIN_BASENAME', plugin_basename( SCM_PLUGIN ) );
define( 'SCM_PLUGIN_NAME', trim( dirname( SCM_PLUGIN_BASENAME ), '/' ) );
define( 'SCM_PLUGIN_DIR', untrailingslashit( dirname( SCM_PLUGIN ) ) );
define( 'SCM_PLUGIN_TEXTDOMAIN', 'sportsclubmanager' );

require_once SCM_PLUGIN_DIR . '/settings.php';

?>