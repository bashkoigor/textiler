import {ShopaholicProductList} from "./product-list/shopaholic-product-list.js";
import {ShopaholicPagination} from "./product-list/shopaholic-pagination.js";
import {ShopaholicFilterPanel} from "./filter/shopaholic-filter-panel.js";
import {ShopaholicFilterPrice} from "./filter/shopaholic-filter-price.js";

const obListHelper = new ShopaholicProductList();
obListHelper.setAjaxRequestCallback((obRequestData) => {
    obRequestData.update = {'catalog/product-list': `.catalog_wrapper`};

    return obRequestData;
});

const obPaginationHelper = new ShopaholicPagination(obListHelper);
obPaginationHelper.init();

const obFilterPanel = new ShopaholicFilterPanel(obListHelper);
obFilterPanel.init();

const obFilterPrice = new ShopaholicFilterPrice(obListHelper);
obFilterPrice.setEventType('blur').init();
