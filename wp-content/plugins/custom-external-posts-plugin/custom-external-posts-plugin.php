<?php

/**
 * Plugin Name: Custom External Posts Plugin
 * Description: A plugin to manage and display custom external post details.
 * Version: 1.1
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class CustomExternalPostsPlugin
{
    private $table_name;

    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'ang_custom_date';

        // Register plugin activation hook.
        register_activation_hook(__FILE__, [$this, 'activate_plugin']);

        // Add admin menu.
        add_action('admin_menu', [$this, 'add_admin_menu']);

        // Handle form submissions.
        add_action('admin_post_save_custom_posts', [$this, 'handle_form_submission']);

        // Register shortcode for frontend display.
        add_shortcode('custom_external_posts', [$this, 'render_shortcode']);

        // Enqueue styles for frontend and admin.
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
    }

    // Plugin activation: Create database table.
    public function activate_plugin()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE {$this->table_name} (
            id INT AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            image_url VARCHAR(255) NOT NULL,
            is_enabled TINYINT(1) DEFAULT 1,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    // Add admin menu.
    public function add_admin_menu()
    {
        add_menu_page(
            'Custom External Posts',
            'External Posts',
            'manage_options',
            'custom-external-posts',
            [$this, 'render_admin_page'],
            'dashicons-admin-post',
            20
        );
    }

    // Render admin page.
    public function render_admin_page()
    {
        global $wpdb;

        if (!current_user_can('manage_options')) {
            return;
        }

        $posts = $wpdb->get_results("SELECT * FROM {$this->table_name}", ARRAY_A);
        include plugin_dir_path(__FILE__) . 'admin-page.php';
    }

    // Handle form submission.
    public function handle_form_submission()
    {
        if (!current_user_can('manage_options') || !check_admin_referer('save_custom_posts_nonce')) {
            wp_die(__('You are not allowed to perform this action.', 'custom-external-posts'));
        }

        global $wpdb;
        $wpdb->query("TRUNCATE TABLE {$this->table_name}");

        $success = true;

        for ($i = 1; $i <= 3; $i++) {
            $title = sanitize_text_field($_POST["title_$i"]);
            $image_url = esc_url_raw($_POST["image_url_$i"]);
            $is_enabled = isset($_POST["is_enabled_$i"]) ? 1 : 0;

            if (!empty($title) && !empty($image_url) && filter_var($image_url, FILTER_VALIDATE_URL)) {
                $wpdb->insert($this->table_name, [
                    'title' => $title,
                    'image_url' => $image_url,
                    'is_enabled' => $is_enabled,
                ]);
            } else {
                $success = false;
                break;
            }
        }

        // Redirect with success or error status
        if ($success) {
            wp_redirect(admin_url('admin.php?page=custom-external-posts&status=success'));
        } else {
            wp_redirect(admin_url('admin.php?page=custom-external-posts&status=error'));
        }
        exit;
    }


    // Render shortcode for frontend display.
    public function render_shortcode()
    {
        global $wpdb;

        $posts = $wpdb->get_results("SELECT * FROM {$this->table_name} WHERE is_enabled = 1", ARRAY_A);

        if (empty($posts)) {
            return '<p>No posts available.</p>';
        }

        ob_start();
        echo '<div class="custom-external-posts-grid">';
        foreach ($posts as $post) {
            echo '<div class="custom-post-card">';
            echo '<img class="post-image" src="' . esc_url($post['image_url']) . '" alt="' . esc_attr($post['title']) . '">';
            echo '<div class="post-content">';
            echo '<h3 class="post-title">' . esc_html($post['title']) . '</h3>';
            echo '<a class="read-more-btn" href="#" target="_blank">Read More</a>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';

        return ob_get_clean();
    }

    // Enqueue frontend styles.
    public function enqueue_styles()
    {
        wp_enqueue_style('custom-external-posts-style', plugin_dir_url(__FILE__) . 'style.css');
    }

    // Enqueue admin styles.
    public function enqueue_admin_styles()
    {
        wp_enqueue_style('custom-external-posts-admin-style', plugin_dir_url(__FILE__) . 'admin-style.css');
    }
}

new CustomExternalPostsPlugin();
