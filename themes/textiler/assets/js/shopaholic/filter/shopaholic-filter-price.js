import {UrlGeneration} from "./url-generation.js";

class ShopaholicFilterPrice {
    /**
     * @param {ShopaholicProductList} obProductListHelper
     */
    constructor(obProductListHelper = null) {
        this.obProductListHelper = obProductListHelper;
        this.sEventType = 'change';
        this.sFiledName = 'price';

        this.sInputMinPriceName = 'filter-min-price';
        this.sInputMaxPriceName = 'filter-max-price';

        this.sDefaultInputClass = '_shopaholic-price-filter';
        this.sInputSelector = `.${this.sDefaultInputClass}`;

        this.iCallBackDelay = 400;

        this.obUrlGeneration = new UrlGeneration();
    }

    /**
     * Init event handlers
     */
    init() {
        $(document).on(this.sEventType, this.sInputSelector, () => {
            if (this.sEventType === 'input') {
                clearTimeout(this.timer);

                this.timer = setTimeout(() => {
                    this.priceChangeCallBack();
                }, this.iCallBackDelay);
            } else {
                this.priceChangeCallBack();
            }
        });

        // $(document).on('input', this.sInputSelector, ({ currentTarget }) => {
        //     const { value } = currentTarget;
        //     console.log(currentTarget);
        //     const correctValue = value.replace(/[^\d.]/g, '');
        //
        //     currentTarget.value = correctValue; // eslint-disable-line no-param-reassign
        // });
    }

    priceChangeCallBack() {
        this.obUrlGeneration.init();
        this.prepareRequestData();

        this.obUrlGeneration.remove('page');
        this.obUrlGeneration.update();
        if (!this.obProductListHelper) {
            window.location.href = window.location.href;
            return;
        }

        this.obProductListHelper.send();
    }

    prepareRequestData() {
        // Get min price from filter input
        const obInputList = $(this.setInputSelector);
        const obMinInput = obInputList.find(`[name=${this.sInputMinPriceName}]`);
        const obMaxInput = obInputList.find(`[name=${this.sInputMaxPriceName}]`);
        const fMinLimit = parseFloat(obMinInput.attr('min'));
        const fMaxLimit = parseFloat(obMinInput.attr('max'));

        let fMinPrice = obMinInput.val();
        let fMaxPrice = obMaxInput.val();

        if (fMinPrice > 0 && fMinPrice < fMinLimit) {
            fMinPrice = fMinLimit;
            obMinInput.val(fMinLimit);
        }

        if (fMaxPrice > 0 && fMaxPrice > fMaxLimit) {
            fMaxPrice = fMaxLimit;
            obMaxInput.val(fMaxLimit);
        }

        if (fMinPrice === 0 && fMaxPrice === 0) {
            this.obUrlGeneration.remove(this.sFiledName);
        } else {
            this.obUrlGeneration.set(this.sFiledName, [fMinPrice, fMaxPrice]);
        }
    }

    /**
     * Redeclare default selector of filter input
     * Default value is "_shopaholic-price-filter"
     *
     * @param {string} sInputSelector
     * @returns {ShopaholicFilterPrice}
     */
    setInputSelector(sInputSelector) {
        this.sInputSelector = sInputSelector;

        return this;
    }

    /**
     * Redeclare default event type
     * Default value is "change"
     *
     * @param {string} sEventType
     * @returns {ShopaholicFilterPrice}
     */
    setEventType(sEventType) {
        this.sEventType = sEventType;

        return this;
    }

    /**
     * Redeclare default input name with min price
     * Default value is "filter-min-price"
     *
     * @param {string} sInputName
     * @returns {ShopaholicFilterPrice}
     */
    setInputMinPriceName(sInputName) {
        this.sInputMinPriceName = sInputName;

        return this;
    }

    /**
     * Redeclare default input name with max price
     * Default value is "filter-max-price"
     *
     * @param {string} sInputName
     * @returns {ShopaholicFilterPrice}
     */
    setInputMaxPriceName(sInputName) {
        this.sInputMaxPriceName = sInputName;

        return this;
    }

    /**
     * Redeclare default URL filed name
     * Default value is "price"
     *
     * @param {string} sFieldName
     * @returns {ShopaholicFilterPrice}
     */
    setFieldName(sFieldName) {
        this.sFiledName = sFieldName;

        return this;
    }
}

export {ShopaholicFilterPrice};
