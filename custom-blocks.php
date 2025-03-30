<?php
/**
 * Plugin Name: Custom blocks
 * Description: Shared custom Gutenberg blocks with integrated design system for multiple websites
 * Version: 1.0.0
 * Author: Sebastian Musiał
 */

if (!defined('ABSPATH')) {
    exit;
}

class Custom_Blocks {
    private static $instance = null;
    private $blocks_directory;
    private $plugin_directory;

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->plugin_directory = plugin_dir_path(__FILE__);
        $this->blocks_directory = $this->plugin_directory . 'blocks/';

        add_action('init', [$this, 'register_assets']);
        add_action('acf/init', [$this, 'register_blocks']);
    }

    public function register_assets() {
        // Editor assets
        add_action('enqueue_block_editor_assets', function() {
            wp_enqueue_style(
                'custom-blocks-editor-style',
                plugins_url('/build/editor.css', __FILE__),
                ['wp-edit-blocks'],
                filemtime($this->plugin_directory . 'build/editor.css')
            );

            wp_enqueue_style(
                'custom-blocks-style',
                plugins_url('/build/style.css', __FILE__),
                [],
                filemtime($this->plugin_directory . 'build/style.css')
            );

            wp_enqueue_script(
                'custom-blocks-editor-js',
                plugins_url('/build/main.js', __FILE__),
                ['wp-blocks', 'wp-element', 'wp-editor'],
                filemtime($this->plugin_directory . 'build/main.js'),
                true
            );
        });

        // Frontend assets
        add_action('wp_enqueue_scripts', function() {
            wp_enqueue_style(
                'custom-blocks-style',
                plugins_url('/build/style.css', __FILE__),
                [],
                filemtime($this->plugin_directory . 'build/style.css')
            );

            wp_enqueue_script(
                'custom-blocks-js',
                plugins_url('/build/main.js', __FILE__),
                [],
                filemtime($this->plugin_directory . 'build/main.js'),
                true
            );
        });
    }

    public function register_blocks() {
        if (!function_exists('acf_register_block_type')) {
            return;
        }

        $blocks = $this->discover_blocks();

        foreach ($blocks as $block) {
            $this->register_single_block($block);
        }
    }

    private function discover_blocks() {
        $blocks = [];
        $block_directories = glob($this->blocks_directory . '*/');

        foreach ($block_directories as $block_dir) {
            $block_name = basename($block_dir);

            if (file_exists($block_dir . 'config.php') && file_exists($block_dir . 'template.php')) {
                $blocks[] = [
                    'name' => $block_name,
                    'dir' => $block_dir
                ];
            }
        }

        return $blocks;
    }

    private function register_single_block($block) {
        $block_dir = $block['dir'];
        $block_name = $block['name'];

        $config = include $block_dir . 'config.php';

        $default_config = [
            'name'              => $block_name,
            'title'             => __(ucfirst(str_replace('-', ' ', $block_name))),
            'description'       => __('Blok ' . $block_name),
            'render_template'   => $block_dir . 'template.php',
            'category'          => 'custom-blocks',
            'icon'              => 'block-default',
            'keywords'          => [str_replace('-', ' ', $block_name), 'custom'],
            'supports'          => [
                'align' => true,
                'mode' => true,
                'jsx' => true
            ],
            'example'           => [
                'attributes' => [
                    'mode' => 'preview',
                    'data' => [
                        'is_preview' => true
                    ]
                ]
            ]
        ];

        $block_config = array_merge($default_config, $config);

        acf_register_block_type($block_config);

        if (file_exists($block_dir . 'fields.php')) {
            include_once $block_dir . 'fields.php';
        }
    }

    public static function init() {
        return self::get_instance();
    }
}

Custom_Blocks::init();