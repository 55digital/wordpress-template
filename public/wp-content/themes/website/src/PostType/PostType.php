<?php

namespace App\PostType;

use Illuminate\Support\Str;

class PostType
{
    protected string $id;

    protected array $args;

    protected \WP_Post_Type $postType;

    public function __construct($singular, $plural = null)
    {
        $this->id = strtolower($singular);
        $this->args = $this->setDefaultArguments($singular, $plural);
    }

    public function set($settings = []): self
    {
        $this->args = array_replace_recursive($this->args, $settings);

        if ('init' === current_filter()) {
            $this->register();
        } else {
            add_action('init', [$this, 'register']);
        }

        return $this;
    }

    public function setIcon($icon): self
    {
        $this->args['menu_icon'] = $icon;

        return $this;
    }

    public function register(): void
    {
        $this->postType = register_post_type($this->id, $this->args);
    }

    protected function setDefaultArguments($singular, $plural = null): array
    {
        if (is_null($plural)) {
            $plural = Str::plural($singular);
        }

        $singular = strtolower($singular);
        $plural = strtolower($plural);
        $upperSingular = ucwords($singular);
        $upperPlural = ucwords($plural);

        $labels = [
            'add_new' => 'Add New',
            'add_new_item' => "Add New {$upperSingular}",
            'edit_item' => "Edit {$upperSingular}",
            'menu_name' => $upperPlural,
            'name' => $upperPlural,
            'new_item' => "New {$upperSingular}",
        ];

        return $defaults = [
            'labels' => $labels,
            'description' => '',
            'public' => true,
            'menu_position' => 20,
            'has_archive' => true
        ];
    }
}
