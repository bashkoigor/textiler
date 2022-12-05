import {ShopaholicProductList} from "./product-list/shopaholic-product-list.js";
import {ShopaholicPagination} from "./product-list/shopaholic-pagination.js";
import {ShopaholicSorting} from "./product-list/shopaholic-sorting.js";
import {ShopaholicFilterPanel} from "./filter/shopaholic-filter-panel.js";
import {ShopaholicFilterPrice} from "./filter/shopaholic-filter-price.js";

const obListHelper = new ShopaholicProductList();
obListHelper.setAjaxRequestCallback((obRequestData) => {
    obRequestData.update = {'catalog/product-list': `.catalog_wrapper`};

    return obRequestData;
});

const obPaginationHelper = new ShopaholicPagination(obListHelper);
obPaginationHelper.init();

const obSortingHelper = new ShopaholicSorting(obListHelper);
obSortingHelper.init();

const obFilterPanel = new ShopaholicFilterPanel(obListHelper);
obFilterPanel.init();

const obFilterPrice = new ShopaholicFilterPrice(obListHelper);
obFilterPrice.setEventType('change').init();

/* Filter show more/less */
const elements = document.getElementsByClassName('filter-show-more');

Array.from(elements).forEach(function(element) {
    element.addEventListener('click', (event) => {
        Array.from(element.previousSibling.previousSibling.querySelectorAll('div'))
            .forEach(function(div) {
                if (div.classList.contains("d-none")) {
                    div.classList.remove("d-none");
                    div.classList.add("d-block");
                    element.textContent = element.dataset.textLess;
                } else if (div.classList.contains("d-block")) {
                    div.classList.remove("d-block");
                    div.classList.add("d-none");
                    element.textContent = element.dataset.textMore;
                }
            });
    });
});


