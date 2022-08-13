<?php namespace Textiler\Base\Components;

use Input;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use function PHPUnit\Framework\exactly;

class Catalog extends ComponentBase
{

    protected $obFilteredProductList;
    protected $arFilterPropertyList = [];

    public function componentDetails()
    {
        return [
            'name'        => 'Catalog',
            'description' => 'Catalog component.'
        ];
    }

    /**
     * Get filter property list from request
     * @return array
     */
    public function getFilterPropertyList()
    {
        $this->arFilterPropertyList = Input::get('property');
        $this->arFilterPropertyList = $this->parseRepuestValue($this->arFilterPropertyList);
        return $this->arFilterPropertyList;
    }

    /**
     * Get filtered product list with filter by properties
     * @param $obProductList
     * @param $obCategory
     * @return mixed
     */
    public function getFilterProductPropertyList($obProductList, $obCategory)
    {
        $this->obFilteredProductList = $obProductList->copy();
        if (!empty($this->arFilterPropertyList)) {
            $this->obFilteredProductList->filterByProperty($this->arFilterPropertyList, $obCategory->product_filter_property);
        }
        return $this->obFilteredProductList;
    }

    /**
     * Parse request array
     * @param array $arValueList
     * @return array
     */
    protected function parseRepuestValue($arValueList)
    {
        if (empty($arValueList)) {
            return [];
        }

        foreach ($arValueList as $iKey => $sValue) {
            $arValueList[$iKey] = explode('|', $sValue);
        }

        return $arValueList;
    }
}

