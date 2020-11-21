<?php

namespace App;

class Theme
{
    protected static $instance;

    public static function instance(): self
    {
        if (is_null(static::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->hooks();
        $this->loadPlugins();
    }

    protected function hooks()
    {
    }

    protected function loadPlugins()
    {
        define('MY_ACF_PATH', get_stylesheet_directory().'/inc/plugins/acf-pro/');
        define('MY_ACF_URL', get_stylesheet_directory_uri().'/inc/plugins/acf-pro/');

        include_once(MY_ACF_PATH.'acf.php');

        add_filter('acf/settings/url', function ($url) {
            return MY_ACF_URL;
        });
    }
}
