<?php 
class ViteWpTheme {
    private $theme_name = 'theme';
    private $manifest_path;
    private $theme_features = array(
        'title-tag',
        'custom-logo',
        'menus',
        'post-thumbnails'
    );
    private $menu_locations = array(
        'main-menu' => 'Main menu',
        'footer-menu' => 'Footer menu'
    );

    public function __construct() {
        $this->manifest_path = get_template_directory() . "/dist/.vite/manifest.json";
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('after_setup_theme', [$this, 'setup_theme_features']);
        add_action('wp_head', [$this, 'add_admin_bar_css']);
    }

    public function enqueue_assets() {
        if(file_exists($this->manifest_path)) {
            $this->enqueue_built_assets();
        } else {
            $this->enqueue_dev_assets();
        }
    }

    public function setup_theme_features() {
        foreach($this->theme_features as $feature) {
            add_theme_support($feature);
        }
        register_nav_menus($this->menu_locations);
    }

    private function enqueue_built_assets() {
        $manifest_file = file_get_contents($this->manifest_path);
        $manifest_content = json_decode($manifest_file);

        $main_bundle = $manifest_content->{"src/main.js"}->file ?? null;
        if($main_bundle) {
            wp_enqueue_script("$this->theme_name-scripts", get_template_directory_uri() . '/dist/' . $main_bundle, [], false, true);
        }

        $main_style = $manifest_content->{"style.css"}->file ?? null;
        if($main_style) {
            wp_enqueue_style("$this->theme_name-style", get_template_directory_uri() . '/dist/' . $main_style);
        }
    }

    public function add_admin_bar_css() {
        if (is_admin_bar_showing()) {
            echo '
                <style>
                    body nav.main-nav {
                        top: 32px;
                    }
                    @media screen and (max-width: 782px) {
                        body nav.main-nav {
                            top: 46px;
                        }
                        #wpadminbar {
                            position: fixed;
                        }
                    }
                </style>
            ';
        }
    }

    private function enqueue_dev_assets() {
        wp_enqueue_script_module('vite', 'http://localhost:5173/@vite/client');
        wp_enqueue_script_module("$this->theme_name-dev", 'http://localhost:5173/src/main.js');
    }
}

new ViteWpTheme();