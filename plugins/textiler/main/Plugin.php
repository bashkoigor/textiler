<?php namespace Textiler\Main;

use Backend;
use System\Classes\PluginBase;

/**
 * main Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Textiler',
            'description' => 'Main plugin, contain all features',
            'author'      => 'textiler',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Textiler\Main\Components\Subscribers' => 'Subscribers',
            'Textiler\Main\Components\Reviews' => 'Reviews',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'textiler.main.some_permission' => [
                'tab' => 'main',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'main' => [
                'label'       => 'Textiler',
                'url'         => Backend::url('textiler/main/subscribers'),
                'icon'        => 'icon-list',
                'permissions' => ['textiler.main.*'],
                'order'       => 5000,
                'sideMenu' => [
                    'subscribers' => [
                        'label'       => 'Подписчики',
                        'url'         => Backend::url('textiler/main/subscribers'),
                        'icon'        => 'icon-leaf',
                        'permissions' => ['textiler.subscribers.*'],
                        'order'       => 500,
                    ],
                    'reviews' => [
                        'label'       => 'Отзывы',
                        'url'         => Backend::url('textiler/main/reviews'),
                        'icon'        => 'icon-leaf',
                        'permissions' => ['textiler.reviews.*'],
                        'order'       => 500,
                    ]
                ],
            ],
        ];
    }
}
