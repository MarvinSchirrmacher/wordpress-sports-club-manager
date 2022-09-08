<?php
class TeamManagement extends Management {
    protected function register() {
        $this->nonce_reference = basename(__FILE__);
        $this->screen = 'team';
        $this->metas = array(
            'scm-team-meta-box-nonce' => array(
                'team_competition_link',
                'team_competition_id',
                'team_league',
                'team_coaches',
                'team_age',
                'team_training',
                'team_sponsor_id'
            )
        );
        $this->meta_boxes = array(
            new MetaBox(
                'team-meta-box', __('Meta', SCM_PLUGIN_TEXTDOMAIN),
                array($this, 'teamMetaBoxMarkup'), 'team', 'side', 'core', null)
        );
    }

    public function teamMetaBoxMarkup($post, $callback_args) {
        wp_nonce_field($this->nonce_reference, "scm-team-meta-box-nonce");
        ?>
        <div>
            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="team_fussballde_link"><?php _e('Competition', SCM_PLUGIN_TEXTDOMAIN); ?></label>
            </p>
            <input name="team_league" type="text" value="<?php echo get_post_meta($post->ID, "team_league", true); ?>" placeholder="<?php _e('League', SCM_PLUGIN_TEXTDOMAIN )?>" pattern="[0-9\w\-\(\)\. ]*" />
            <input name="team_competition_link" type="text" value="<?php echo get_post_meta($post->ID, "team_competition_link", true); ?>" placeholder="<?php _e('Link', SCM_PLUGIN_TEXTDOMAIN )?>" /> <!-- pattern="[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)"/> -->
            <input name="team_competition_id" type="text" value="<?php echo get_post_meta($post->ID, "team_competition_id", true); ?>" placeholder="<?php _e('ID', SCM_PLUGIN_TEXTDOMAIN )?>" pattern="[A-Z0-9]{32}"/>

            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="team_coaches"><?php _e('Coaches', SCM_PLUGIN_TEXTDOMAIN); ?></label>
            </p>
            <input name="team_coaches" type="text" value="<?php echo get_post_meta($post->ID, "team_coaches", true); ?>" placeholder="<?php _e('Coaches', SCM_PLUGIN_TEXTDOMAIN )?>" />
            
            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="team_age"><?php _e('Players', SCM_PLUGIN_TEXTDOMAIN); ?></label>
            </p>
            <input name="team_age" type="text" value="<?php echo get_post_meta($post->ID, "team_age", true); ?>" placeholder="<?php _e('Age group', SCM_PLUGIN_TEXTDOMAIN )?>" />
            
            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="team_training"><?php _e('Training schedule', SCM_PLUGIN_TEXTDOMAIN); ?></label>
            </p>
            <textarea name="team_training" placeholder="<?php _e('Training', SCM_PLUGIN_TEXTDOMAIN )?>">
                <?php echo get_post_meta($post->ID, "team_training", true); ?>
            </textarea>

            <p class="post-attributes-label-wrapper">
                <label class="post-attributes-label" for="team_sponsor_id"><?php _e('Sponsor', SCM_PLUGIN_TEXTDOMAIN); ?></label>
            </p>
            <input name="team_sponsor_id" type="text" value="<?php echo get_post_meta($post->ID, "team_sponsor_id", true); ?>" placeholder="<?php _e('Sponsor ID', SCM_PLUGIN_TEXTDOMAIN )?>"  pattern="\d+"/>
        </div>
        <?php  
    }
}
?>