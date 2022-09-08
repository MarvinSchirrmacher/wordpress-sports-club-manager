<?php
class MetaBox {
    public $id;
    public $title;
    public $callback;
    public $screen = null;
    public $context = 'advanced';
    public $priority = 'default';
    public $callback_args = null;

    public function __construct($id, $title, $callback,
            $screen, $context, $priority, $callback_args) {
        $this->id = $id;
        $this->title = $title;
        $this->callback = $callback;
        $this->screen = $screen;
        $this->context = $context;
        $this->priority = $priority;
        $this->callback_args = $callback_args;
    }

    public function register() {
        add_meta_box(
            $this->id, $this->title, $this->callback,
            $this->screen, $this->context,
            $this->priority, $this->callback_args);
    }
}

abstract class Management extends Singleton {
    protected $screen = '';
    protected $metas = array();
    protected $meta_boxes = array();
    protected $nonce_reference = '';

    protected function initialize() {
        $this->register();
        add_action('add_meta_boxes', array($this, 'addMetaBoxes'));
        add_action('save_post', array($this, 'saveMetas'), 10, 3);
    }

    abstract protected function register();

    public function addMetaBoxes() {
        foreach ($this->meta_boxes as $box)
            $box->register();
    }

    public function saveMetas($post_id, $post, $update) {
        foreach ($this->metas as $key => $values)
            $this->saveMeta($post_id, $post, $update, $key, $values);
    }

    private function saveMeta($post_id, $post, $update, $nonce, $keys) {
        if (!$this->validateSave($post_id, $post, $nonce))
            return $post_id;
    
        foreach ($keys as $key) {
            $value = "";
            if (isset($_POST[$key]))
                $value = $_POST[$key];
            update_post_meta($post_id, $key, esc_html($value));
        }
    }
    
    private function validateSave($post_id, $post, $nonce) {
        if (!isset($_POST[$nonce]) ||
            !wp_verify_nonce($_POST[$nonce], $this->nonce_reference))
            return false;
    
        if (!current_user_can("edit_post", $post_id))
            return false;
    
        if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
            return false;
    
        if ($this->screen != $post->post_type)
            return false;
    
        return true;
    }
}
?>