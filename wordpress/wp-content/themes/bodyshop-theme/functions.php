<?php
/**
 * Bodyshop Theme functions.
 */

if (!defined('ABSPATH')) {
    exit;
}

function bodyshop_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'bodyshop-theme'),
    ));
}
add_action('after_setup_theme', 'bodyshop_theme_setup');

function bodyshop_theme_enqueue_assets() {
    wp_enqueue_style('bodyshop-theme-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'bodyshop_theme_enqueue_assets');

function bodyshop_register_gallery_post_type() {
    $labels = array(
        'name' => __('Gallery Items', 'bodyshop-theme'),
        'singular_name' => __('Gallery Item', 'bodyshop-theme'),
        'add_new_item' => __('Add New Gallery Item', 'bodyshop-theme'),
        'edit_item' => __('Edit Gallery Item', 'bodyshop-theme'),
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
add_action('init', 'bodyshop_register_gallery_post_type');

function bodyshop_add_gallery_meta_boxes() {
    add_meta_box(
        'bodyshop_before_after',
        __('Before/After Details', 'bodyshop-theme'),
        'bodyshop_render_gallery_meta_box',
        'gallery_item',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'bodyshop_add_gallery_meta_boxes');

function bodyshop_render_gallery_meta_box($post) {
    wp_nonce_field('bodyshop_gallery_nonce_action', 'bodyshop_gallery_nonce');

    $before_image_id = get_post_meta($post->ID, '_before_image_id', true);
    $after_image_id = get_post_meta($post->ID, '_after_image_id', true);
    $service_type = get_post_meta($post->ID, '_service_type', true);
    $vehicle_info = get_post_meta($post->ID, '_vehicle_info', true);
    ?>
    <p>
        <label for="bodyshop_before_image_id"><strong><?php esc_html_e('Before Image Attachment ID', 'bodyshop-theme'); ?></strong></label><br>
        <input type="number" id="bodyshop_before_image_id" name="bodyshop_before_image_id" value="<?php echo esc_attr($before_image_id); ?>" style="width:100%;">
        <small><?php esc_html_e('Upload image in Media Library and paste the attachment ID.', 'bodyshop-theme'); ?></small>
    </p>
    <p>
        <label for="bodyshop_after_image_id"><strong><?php esc_html_e('After Image Attachment ID', 'bodyshop-theme'); ?></strong></label><br>
        <input type="number" id="bodyshop_after_image_id" name="bodyshop_after_image_id" value="<?php echo esc_attr($after_image_id); ?>" style="width:100%;">
    </p>
    <p>
        <label for="bodyshop_service_type"><strong><?php esc_html_e('Service Type', 'bodyshop-theme'); ?></strong></label><br>
        <input type="text" id="bodyshop_service_type" name="bodyshop_service_type" value="<?php echo esc_attr($service_type); ?>" style="width:100%;">
    </p>
    <p>
        <label for="bodyshop_vehicle_info"><strong><?php esc_html_e('Vehicle Info', 'bodyshop-theme'); ?></strong></label><br>
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

    $before_image_id = isset($_POST['bodyshop_before_image_id']) ? absint($_POST['bodyshop_before_image_id']) : '';
    $after_image_id = isset($_POST['bodyshop_after_image_id']) ? absint($_POST['bodyshop_after_image_id']) : '';
    $service_type = isset($_POST['bodyshop_service_type']) ? sanitize_text_field(wp_unslash($_POST['bodyshop_service_type'])) : '';
    $vehicle_info = isset($_POST['bodyshop_vehicle_info']) ? sanitize_text_field(wp_unslash($_POST['bodyshop_vehicle_info'])) : '';

    update_post_meta($post_id, '_before_image_id', $before_image_id);
    update_post_meta($post_id, '_after_image_id', $after_image_id);
    update_post_meta($post_id, '_service_type', $service_type);
    update_post_meta($post_id, '_vehicle_info', $vehicle_info);
}
add_action('save_post_gallery_item', 'bodyshop_save_gallery_meta');

function bodyshop_customize_admin_menu() {
    if (!current_user_can('manage_options')) {
        remove_menu_page('tools.php');
        remove_menu_page('edit-comments.php');
    }
}
add_action('admin_menu', 'bodyshop_customize_admin_menu', 999);
