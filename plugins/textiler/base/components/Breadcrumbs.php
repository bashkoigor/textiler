<?php namespace Textiler\Base\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;

class Breadcrumbs extends ComponentBase
{

    protected $obProduct = null;
    protected $obCategory = null;
    protected $obMainCategory = null;
    protected $obPage = null;

    public function componentDetails()
    {
        return [
            'name'        => 'Breadcrumbs',
            'description' => 'Breadcrumbs component.'
        ];
    }

    public function set($obProduct, $obCategory, $obMainCategory, $obPage)
    {
        $this->obProduct = $obProduct;
        $this->obCategory = $obCategory;
        $this->obMainCategory = $obMainCategory;
        $this->obPage = $obPage;
    }

    /**
     * Get breadcrumbs array
     * @return array
     */
    public function get()
    {
        $arBreadcrumbs = [];

        if (!empty($this->obPage)) {
            $arBreadcrumbs[] = [
                'name' => $this->obPage['title'],
                'url' => $this->obPage['url'],
            ];
        }

        if (!empty($this->obProduct)) {
            $arBreadcrumbs[] = [
                'name' => $this->obProduct->name,
                'url' => $this->obProduct->getPageUrl('product'),
            ];
        }

        if (!empty($this->obCategory)) {
            $arBreadcrumbs[] = [
                'name' => $this->obCategory->name,
                'url' => $this->obCategory->getPageUrl('catalog'),
            ];
        }

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
