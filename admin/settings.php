<?php
class SportsClubManagerSettings extends Singleton {
    public static $page = 'reading';
    public static $section = 'scm_settings_section';
    public static $optionFooterImage = 'scm_sponsor_footer_image';

    protected function initialize() {
        add_action('admin_init', array($this, 'registerSettingsPage'));
        add_action('admin_enqueue_scripts', array($this, 'registerImageMetaBox'));
    }

    public function registerSettingsPage() {
        register_setting(
            self::$page,
            self::$optionFooterImage
        );
        add_settings_section(
            self::$section,
            __('Sports Club Manager', SCM_PLUGIN_TEXTDOMAIN),
            array($this, 'echoSectionHeader'),
            self::$page
        );
        add_settings_field(
            'scm_sponsor_footer_image_field',
            __('Sponsor footer image', SCM_PLUGIN_TEXTDOMAIN),
            array($this, 'echoFooterImageField'),
            self::$page,
            self::$section
        );
    }
    
    public function registerImageMetaBox() {
        wp_enqueue_media();
        wp_register_script( 'meta-box-image', plugin_dir_url( __FILE__ ) . '/scripts/meta-box-image.js', array( 'jquery' ) );
        wp_localize_script( 'meta-box-image', 'meta_image',
            array(
                'title' => __( 'Choose or upload an image', SCM_PLUGIN_TEXTDOMAIN ),
                'button' => __( 'Use this image', SCM_PLUGIN_TEXTDOMAIN ),
            )
        );
        wp_enqueue_script( 'meta-box-image' );
    }

    public function echoSectionHeader() {
        echo '';
    }

    public function echoFooterImageField() {
        $option = get_option( self::$optionFooterImage );
        echo sprintf(
            '<input type="text" name="%s" id="sponsor-footer-image" value="%s" />',
            self::$optionFooterImage,
            ( isset( $option ) ? esc_attr( $option ) : '' )
        );
        echo sprintf(
            '<input type="button" id="sponsor-footer-image-button" class="button" value="%s" />',
            __( 'Choose or upload an image', SCM_PLUGIN_TEXTDOMAIN )
        );
    }
}
?>