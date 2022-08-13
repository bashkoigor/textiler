<?php namespace Textiler\Base;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */
use Event;
use System\Classes\PluginBase;
use Textiler\Base\Classes\Event\Settings\ExtendSettingsModel;

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
            '\Textiler\Base\Components\Breadcrumbs'     => 'Breadcrumbs',
            '\Textiler\Base\Components\SiteSettings'    => 'SiteSettings',
            '\Textiler\Base\Components\OfferProperties' => 'OfferProperties',
            '\Textiler\Base\Components\Catalog' => 'Catalog',
        ];
    }

    /**
     * Register settings
     * @return array
     */
    public function registerSettings()
    {
        return [
            'config'    => [
                'label'       => 'Textiler',
                'description' => 'Общие настройки',
                'icon'        => 'icon-cogs',
                'class'       => 'Textiler\Base\Models\Settings',
                'permissions' => ['textiler-site-settings'],
                'order'       => 1000,
            ],
        ];
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
