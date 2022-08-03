<?php namespace Textiler\Base;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */
use Event;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'Base plugin',
            'description' => 'Base plugin',
            'author'      => 'Igor Bashko',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerComponents()
    {
        return [
            '\Textiler\Base\Components\Breadcrumbs'     => 'Breadcrumbs'
        ];
    }

    /**
     * Register settings
     * @return array
     */
    public function registerSettings()
    {
        return [];
    }

    /**
     * Plugin boot method
     */
    public function boot()
    {
        $this->addEventListener();
    }

    /**
     * Add listener
     */
    protected function addEventListener()
    {

    }
}
