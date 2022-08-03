<?php namespace Textiler\Base\Components;

use Cms\Classes\ComponentBase;
use Textiler\Base\Models\Settings;

/**
 * Class SiteSettings
 * @package Lovata\BaseCode\Components
 */
class SiteSettings extends ComponentBase
{
    /**
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'SiteSettings',
            'description' => 'SiteSettings component.'
        ];
    }

    public function get($sCode) {
        return Settings::getValue($sCode);
    }
}
