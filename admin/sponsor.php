<?php
class SponsorManagement extends Management {
    protected function register() {
        $this->nonce_reference = basename(__FILE__);
        $this->screen = 'sponsor';
        $this->metas = array(
            'scm-contact-meta-box-nonce' => array(
                'sponsor_address_label',
                'sponsor_address_street',
                'sponsor_address_postcode',
                'sponsor_address_city',
                'sponsor_phone_number',
                'sponsor_url',
                'sponsor_honorific',
                'sponsor_hours_of_business',
                'sponsor_contact_form_id',
                'sponsor_contact_form_parameters'
            ),
            'scm-gallery-meta-box-nonce' => array(
                'sponsor_logo_id',
                'sponsor_gallery_ids'
            )
        );
        $this->meta_boxes = array(
            new MetaBox(
                'contact-meta-box', __('Contact meta', SCM_PLUGIN_TEXTDOMAIN),
                array($this, 'contactMetaBoxMarkup'), 'sponsor', 'side', 'core', null),
            new MetaBox(
                'gallery-meta-box', __('Gallery', SCM_PLUGIN_TEXTDOMAIN),
                array($this, 'galleryMetaBoxMarkup'), 'sponsor', 'side', 'core', null)
        );
        $this->enableQuformOnSponsorPages();
    }

    private function enableQuformOnSponsorPages() {
        add_filter('quform_enqueue_scripts', function ($loadScripts) {
            $post = Quform::getCurrentPost();
            echo $post;
            $loadScripts = true;
            return $loadScripts;
        });
    }

    public function contactMetaBoxMarkup($post, $callback_args) {
        wp_nonce_field($this->nonce_reference, "scm-contact-meta-box-nonce"); ?>
        <div>
            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="sponsor_address_label">
                    <?php _e('Address', SCM_PLUGIN_TEXTDOMAIN); ?>
                </label>
            </p>
            <input name="sponsor_address_label" type="text" value="<?php echo get_post_meta($post->ID, "sponsor_address_label", true); ?>" placeholder="<?php _e('Label', SCM_PLUGIN_TEXTDOMAIN )?>" />
            <input name="sponsor_address_street" type="text" value="<?php echo get_post_meta($post->ID, "sponsor_address_street", true); ?>" placeholder="<?php _e('Street', SCM_PLUGIN_TEXTDOMAIN )?>" pattern="[\wäöüß\- ]*? [0-9]{1,4}[\w]?"/>
            <input name="sponsor_address_postcode" type="text" value="<?php echo get_post_meta($post->ID, "sponsor_address_postcode", true); ?>" placeholder="<?php _e('Postcode', SCM_PLUGIN_TEXTDOMAIN )?>" pattern="[0-9]{5}" />
            <input name="sponsor_address_city" type="text" value="<?php echo get_post_meta($post->ID, "sponsor_address_city", true); ?>" placeholder="<?php _e('City', SCM_PLUGIN_TEXTDOMAIN )?>" />

            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="sponsor_phone_number">
                    <?php _e('Contact data', SCM_PLUGIN_TEXTDOMAIN); ?>
                </label>
            </p>
            <input name="sponsor_phone_number" type="text" value="<?php echo get_post_meta($post->ID, "sponsor_phone_number", true); ?>" placeholder="<?php _e('Phone number', SCM_PLUGIN_TEXTDOMAIN )?>" />
            <input name="sponsor_url" type="text" value="<?php echo get_post_meta($post->ID, "sponsor_url", true); ?>" placeholder="<?php _e('URL', SCM_PLUGIN_TEXTDOMAIN )?>" pattern="%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu" />
            
            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="sponsor_honorific">
                    <?php _e('Form of address', SCM_PLUGIN_TEXTDOMAIN); ?>
                </label>
            </p>
            <select name="sponsor_honorific"><?php 
                $option_values = array(__('formal', SCM_PLUGIN_TEXTDOMAIN ), __('familiar', SCM_PLUGIN_TEXTDOMAIN ));
                foreach ($option_values as $key => $value) {
                    if ($value == get_post_meta($post->ID, "sponsor_honorific", true)) {
                        ?><option selected><?php echo $value; ?></option><?php
                    } else {
                        ?><option><?php echo $value; ?></option><?php
                    }
                }?>
            </select>
            
            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="sponsor_hours_of_business">
                    <?php _e('Hours of business', SCM_PLUGIN_TEXTDOMAIN); ?>
                </label>
            </p>
            <textarea name="sponsor_hours_of_business">
                <?php echo get_post_meta($post->ID, "sponsor_hours_of_business", true); ?>
            </textarea>

            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="sponsor_contact_form">
                    <?php _e('Contact form', SCM_PLUGIN_TEXTDOMAIN); ?>
                </label>
            </p>
            <input name="sponsor_contact_form_id" type="text" value="<?php echo get_post_meta($post->ID, "sponsor_contact_form_id", true); ?>" placeholder="<?php _e('ID', SCM_PLUGIN_TEXTDOMAIN )?>" />
            <input name="sponsor_contact_form_parameters" type="text" value="<?php echo get_post_meta($post->ID, "sponsor_contact_form_parameters", true); ?>" placeholder="<?php _e('Parameters', SCM_PLUGIN_TEXTDOMAIN )?>" />
        </div><?php  
    }

    public function galleryMetaBoxMarkup($post, $callback_args) {
        wp_nonce_field(basename(__FILE__), "scm-gallery-meta-box-nonce");?>
        <div>
            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="sponsor_logo_id">
                    <?php _e('Logo ID', SCM_PLUGIN_TEXTDOMAIN); ?>
                </label>
            </p>
            <input name="sponsor_logo_id" type="text" value="<?php echo get_post_meta($post->ID, "sponsor_logo_id", true); ?>" placeholder="<?php _e('ID', SCM_PLUGIN_TEXTDOMAIN )?>" />
            
            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="sponsor_gallery_ids">
                    <?php _e('Image IDs', SCM_PLUGIN_TEXTDOMAIN); ?>
                </label>
            </p>
            <input name="sponsor_gallery_ids" type="text" value="<?php echo get_post_meta($post->ID, "sponsor_gallery_ids", true); ?>" placeholder="<?php _e('1, 2, 3, 4', SCM_PLUGIN_TEXTDOMAIN )?>" /><!-- pattern="\w*[0-9]+(\w*,\w*[0-9]+)*\w*" -->
        </div><?php
    }
}
?>