<?php class ViteWpTheme {
    private static $instance = null;
    private $theme_name = 'theme';
    private $manifest_path;

    public static function get_instance() {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->manifest_path = get_template_directory() . "/dist/.vite/manifest.json";
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function enqueue_assets() {
        if(file_exists($this->manifest_path)) {
            $this->enqueue_built_assets();
        } else {
            $this->enqueue_dev_assets();
        }
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

    private function enqueue_dev_assets() {
        wp_enqueue_script_module('vite', 'http://localhost:5173/@vite/client');
        wp_enqueue_script_module("$this->theme_name-dev", 'http://localhost:5173/src/main.js');
    }
}
ViteWpTheme::get_instance();
