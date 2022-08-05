<?php namespace Textiler\Base\Models;

use Lovata\Shopaholic\Models\Category;
use Lovata\Shopaholic\Models\Product;
use System\Models\File;
use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

/**
 * Class Settings
 * @package Textiler\Base\Models
 * @author  Igor Bashko
 */
class Settings extends Model
{
    use Validation;

    public $implement = [
        'System.Behaviors.SettingsModel',
        '@RainLab.Translate.Behaviors.TranslatableModel'
    ];
    public $settingsCode = 'textiler_site_settings';
    public $settingsFields = 'fields.yaml';

    public $attachMany = [];

    public $rules = [];

    /**
     * @var array Attributes that support translation, if available.
     */
    public $translatable = ['main_slider'];

    /**
     * Get setting value from cache
     * @param string $sCode
     * @return null|string
     */
    public static function getValue($sCode) {

        if(empty($sCode)) {
            return null;
        }

        //Get settings object
        $obSettings = self::where('item', 'textiler_site_settings')->first();
        if(empty($obSettings)) {
            return null;
        }

        $sValue = $obSettings->$sCode;
        return $sValue;
    }

    /**
     * Get category list
     * @return array
     */
    public function getCategoryIdOptions()
    {
        $obCategoryList = Category::active()->orderBy('name', 'asc')->lists('name', 'id');
        return $obCategoryList;
    }

    /**
     * Get product list
     * @return array
     */
    public function getProductIdOptions()
    {
        $obCategoryList = Product::active()->orderBy('name', 'asc')->lists('name', 'id');
        return $obCategoryList;
    }
}
