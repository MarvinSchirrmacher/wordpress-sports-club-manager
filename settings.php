<?php

require_once SCM_PLUGIN_DIR . '/includes/team.php';
require_once SCM_PLUGIN_DIR . '/includes/sponsor.php';
require_once SCM_PLUGIN_DIR . '/includes/type-registration.php';

if (is_admin()) {
	require_once SCM_PLUGIN_DIR . '/admin/admin.php';
}

function scm_load_textdomain() {
	load_plugin_textdomain(SCM_PLUGIN_TEXTDOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
}
add_action('plugins_loaded', 'scm_load_textdomain');

function scm_footer_image_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id'    => '',
		'class' => ''
    ), $atts));
    return sprintf(
        '<img%s%s src="%s" />',
        (empty($id) ? '' : ' id="' . $id . '"'),
        (empty($class) ? '' : ' class="' . $class . '"'),
        get_option('scm_sponsor_footer_image')
    );
}
add_shortcode('scm_footer_image', 'scm_footer_image_shortcode');

?>