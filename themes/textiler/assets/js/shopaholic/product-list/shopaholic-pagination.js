import {UrlGeneration} from "../filter/url-generation.js";
class ShopaholicPagination {
    /**
     * @param {ShopaholicProductList} obProductListHelper
     */
    constructor(obProductListHelper = null) {
        this.obProductListHelper = obProductListHelper;
        this.sEventType = 'click';
        this.sFiledName = 'page';
        this.sAttributeName = 'data-page';

        this.sDefaultButtonClass = '_shopaholic-pagination';
        this.sButtonSelector = `.${this.sDefaultButtonClass}`;

        this.obUrlGeneration = new UrlGeneration();
    }

    /**
     * Init event handlers
     */
    init() {
        $(document).on(this.sEventType, this.sButtonSelector, (obEvent) => {
            obEvent.preventDefault();
            obEvent.stopPropagation();

            const obButton = $(obEvent.currentTarget),
                iPage = obButton.attr(this.sAttributeName);

            this.obUrlGeneration.init();
            if (iPage == 1) {
                this.obUrlGeneration.remove(this.sFiledName);
            } else {
                this.obUrlGeneration.set(this.sFiledName, [iPage]);
            }

            this.obUrlGeneration.update();
            if (!this.obProductListHelper) {
                return;
            }

            this.obProductListHelper.send();
        });
    }

    /**
     * Redeclare default selector of pagination button
     * Default value is "_shopaholic-pagination"
     *
     * @param {string} sButtonSelector
     * @returns {ShopaholicPagination}
     */
    setButtonSelector(sButtonSelector) {
        this.sButtonSelector = sButtonSelector;

        return this;
    }
}
export {ShopaholicPagination};
