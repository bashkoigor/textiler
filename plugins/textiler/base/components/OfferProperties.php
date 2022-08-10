<?php namespace Textiler\Base\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;

class OfferProperties extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'OfferProperties',
            'description' => 'OfferProperties component.'
        ];
    }

    public function getOfferProperties($obProduct, $arPropertyCode)
    {
        $arProperties = array();
        if (count($obProduct->offer_id_list) > 1) {
            $obOfferList = $obProduct->offer;
            foreach ($arPropertyCode as $id => $value) {
                $obProperty = null;
                $arPropertyValues = array();
                foreach ($obOfferList as $offerId => $offer) {
                    $obProperty = $offer->property->getByCode($value);
                    if ($obProperty->hasValue()) {
                        $sValue = $obProperty->property_value->getValueString();
                        $arPropertyValues[$offerId] = $sValue;
                    }
                }
                $arProperties[] = array(
                    'code' => $value,
                    'name' => $obProperty->name,
                    'type' => $obProperty->type,
                    'data' => $arPropertyValues,
                );
            }
        }
        return $arProperties;
    }
}

