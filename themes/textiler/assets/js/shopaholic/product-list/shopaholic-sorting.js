import {UrlGeneration} from "../filter/url-generation.js";
class ShopaholicSorting {
    /**
     * @param {ShopaholicProductList} obProductListHelper
     */
    constructor(obProductListHelper = null) {
        this.obProductListHelper = obProductListHelper;
        this.sEventType = 'change';
        this.sFiledName = 'sort';

        this.sDefaultSelectClass = '_shopaholic-sorting';
        this.sSelectSelector = `.${this.sDefaultSelectClass}`;

        this.obUrlGeneration = new UrlGeneration();
    }

    /**
     * Init event handlers
     */
    init() {
        $(document).on(this.sEventType, this.sSelectSelector, (obEvent) => {
            const obSelect = $(obEvent.currentTarget),
                sSorting = obSelect.val();

            this.obUrlGeneration.init();
            this.obUrlGeneration.set(this.sFiledName, [sSorting]);
            this.obUrlGeneration.update();
            if (!this.obProductListHelper) {
                return;
            }

            this.obProductListHelper.send();
        });
    }
}
export {ShopaholicSorting};
