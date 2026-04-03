<?php
/**
 * MU-plugin: registers Gallery Item CPT and exposes before/after fields in REST.
 * This makes the site work even if the custom theme is not active.
 */

if (!defined('ABSPATH')) {
    exit;
}

function bodyshop_register_gallery_item_cpt() {
    $labels = array(
        'name' => __('Gallery Items', 'bodyshop'),
        'singular_name' => __('Gallery Item', 'bodyshop'),
        'add_new_item' => __('Add New Gallery Item', 'bodyshop'),
        'edit_item' => __('Edit Gallery Item', 'bodyshop'),
    );

    register_post_type('gallery_item', array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'gallery'),
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'bodyshop_register_gallery_item_cpt');

function bodyshop_register_rest_meta() {
    register_post_meta('gallery_item', '_before_image_id', array(
        'single' => true,
        'type' => 'integer',
        'show_in_rest' => true,
    ));
    register_post_meta('gallery_item', '_after_image_id', array(
        'single' => true,
        'type' => 'integer',
        'show_in_rest' => true,
    ));
    register_post_meta('gallery_item', '_service_type', array(
        'single' => true,
        'type' => 'string',
        'show_in_rest' => true,
    ));
    register_post_meta('gallery_item', '_vehicle_info', array(
        'single' => true,
        'type' => 'string',
        'show_in_rest' => true,
    ));

    // Convenience fields: Vue can render URLs directly.
    register_rest_field('gallery_item', 'beforeImageUrl', array(
        'get_callback' => function ($object) {
            $post_id = isset($object['id']) ? (int) $object['id'] : 0;
            if (!$post_id) return '';
            $attachment_id = (int) get_post_meta($post_id, '_before_image_id', true);
            if (!$attachment_id) return '';
            return (string) wp_get_attachment_image_url($attachment_id, 'large');
        },
        'schema' => array(
            'description' => 'Before image URL',
            'type' => 'string',
        ),
    ));

    register_rest_field('gallery_item', 'afterImageUrl', array(
        'get_callback' => function ($object) {
            $post_id = isset($object['id']) ? (int) $object['id'] : 0;
            if (!$post_id) return '';
            $attachment_id = (int) get_post_meta($post_id, '_after_image_id', true);
            if (!$attachment_id) return '';
            return (string) wp_get_attachment_image_url($attachment_id, 'large');
        },
        'schema' => array(
            'description' => 'After image URL',
            'type' => 'string',
        ),
    ));
}
add_action('rest_api_init', 'bodyshop_register_rest_meta');

function bodyshop_add_gallery_meta_box() {
    add_meta_box(
        'bodyshop_before_after',
        __('Before/After Details', 'bodyshop'),
        'bodyshop_render_gallery_meta_box',
        'gallery_item',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'bodyshop_add_gallery_meta_box');

function bodyshop_render_gallery_meta_box($post) {
    wp_nonce_field('bodyshop_gallery_nonce_action', 'bodyshop_gallery_nonce');

    $before_image_id = get_post_meta($post->ID, '_before_image_id', true);
    $after_image_id = get_post_meta($post->ID, '_after_image_id', true);
    $service_type = get_post_meta($post->ID, '_service_type', true);
    $vehicle_info = get_post_meta($post->ID, '_vehicle_info', true);
    ?>
    <p>
        <label for="bodyshop_before_image_id"><strong><?php esc_html_e('Before Image Attachment ID', 'bodyshop'); ?></strong></label><br>
        <input type="number" id="bodyshop_before_image_id" name="bodyshop_before_image_id" value="<?php echo esc_attr($before_image_id); ?>" style="width:100%;">
        <small><?php esc_html_e('Upload image in Media Library and paste the attachment ID.', 'bodyshop'); ?></small>
    </p>
    <p>
        <label for="bodyshop_after_image_id"><strong><?php esc_html_e('After Image Attachment ID', 'bodyshop'); ?></strong></label><br>
        <input type="number" id="bodyshop_after_image_id" name="bodyshop_after_image_id" value="<?php echo esc_attr($after_image_id); ?>" style="width:100%;">
    </p>
    <p>
        <label for="bodyshop_service_type"><strong><?php esc_html_e('Service Type', 'bodyshop'); ?></strong></label><br>
        <input type="text" id="bodyshop_service_type" name="bodyshop_service_type" value="<?php echo esc_attr($service_type); ?>" style="width:100%;">
    </p>
    <p>
        <label for="bodyshop_vehicle_info"><strong><?php esc_html_e('Vehicle Info', 'bodyshop'); ?></strong></label><br>
        <input type="text" id="bodyshop_vehicle_info" name="bodyshop_vehicle_info" value="<?php echo esc_attr($vehicle_info); ?>" style="width:100%;">
    </p>
    <?php
}

function bodyshop_save_gallery_meta($post_id) {
    if (!isset($_POST['bodyshop_gallery_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['bodyshop_gallery_nonce'])), 'bodyshop_gallery_nonce_action')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $before_image_id = isset($_POST['bodyshop_before_image_id']) ? absint($_POST['bodyshop_before_image_id']) : 0;
    $after_image_id = isset($_POST['bodyshop_after_image_id']) ? absint($_POST['bodyshop_after_image_id']) : 0;
    $service_type = isset($_POST['bodyshop_service_type']) ? sanitize_text_field(wp_unslash($_POST['bodyshop_service_type'])) : '';
    $vehicle_info = isset($_POST['bodyshop_vehicle_info']) ? sanitize_text_field(wp_unslash($_POST['bodyshop_vehicle_info'])) : '';

    update_post_meta($post_id, '_before_image_id', $before_image_id);
    update_post_meta($post_id, '_after_image_id', $after_image_id);
    update_post_meta($post_id, '_service_type', $service_type);
    update_post_meta($post_id, '_vehicle_info', $vehicle_info);
}
add_action('save_post_gallery_item', 'bodyshop_save_gallery_meta');

