<?php namespace Textiler\Base\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;

class Breadcrumbs extends ComponentBase
{

    protected $obProduct = null;
    protected $obCategory = null;
    protected $obMainCategory = null;

    public function componentDetails()
    {
        return [
            'name'        => 'Breadcrumbs',
            'description' => 'Breadcrumbs component.'
        ];
    }

    public function set($obProduct, $obCategory, $obMainCategory)
    {
        $this->obProduct = $obProduct;
        $this->obCategory = $obCategory;
        $this->obMainCategory = $obMainCategory;
    }

    /**
     * Get breadcrumbs array
     * @return array
     */
    public function get()
    {
        $arBreadcrumbs = [];

        $arBreadcrumbs[] = [
            'name' => $this->obProduct->name,
            'url'  => $this->obProduct->getPageUrl('product'),
        ];

        $arBreadcrumbs[] = [
            'name' => $this->obCategory->name,
            'url'  => $this->obCategory->getPageUrl('catalog'),
        ];

        if (!empty($this->obMainCategory)) {
            $arBreadcrumbs[] = [
                'name' => $this->obMainCategory->name,
                'url'  => $this->obMainCategory->getPageUrl('catalog'),
            ];
        }

        $arBreadcrumbs[] = [
            'name' => 'Inicio',
            'url'  => Page::url('index'),
        ];

        $arBreadcrumbs = array_reverse($arBreadcrumbs);

        return $arBreadcrumbs;
    }

}
