// http://textiler.loc/catalog/para-la-costura-y-el-bordado/maquinas-de-coser-bordar?property[1]=38|39&property[2]=146
let obProductListHelper = null;
let sEventType = 'change';
let sFiledName = 'property';
let sFilterType_ = 'data-filter-type';
let sPropertyIDAttribute = 'data-property-id';
let sBaseURL = `${location.origin}${location.pathname}`;

let sDefaultWrapperClass = '_shopaholic-filter-wrapper';
let sWrapperSelector = `.${sDefaultWrapperClass}`;

function urlGenerationInit() {
    let sSearchString = window.location.search.substring(1);
    let obParamList = {};
    let arPartList = sSearchString.split('&');
    arPartList.forEach((sParam) => {
        let iPosition = sParam.indexOf("=");
        if (iPosition < 0) {
            return;
        }

        let sFiled = sParam.substring(0, iPosition),
            sValue = sParam.substring(iPosition + 1);
        if (!sFiled && !sValue) {
            return;
        }

        obParamList[sFiled] = sValue.split('|');
    });

    return obParamList;
}

function urlGenerationUpdate(obParamList) {
    generateSearchString(obParamList);

    if (Object.keys(obParamList).length > 0) {
        history.pushState(null, null, `${sBaseURL}?${sSearchString}`);
    } else {
        history.pushState(null, null, `${sBaseURL}`);
    }
}

function generateSearchString(obParamList) {
    let arFieldList = Object.keys(obParamList);

    sSearchString = '';
    arFieldList.forEach((sField) => {
        if (sSearchString.length > 0) {
            sSearchString += '&'
        }

        sSearchString += `${sField}=${obParamList[sField].join('|')}`;
    });
}

function urlGenerationRemove(obParamList, sFiled) {
    if (!sFiled || !obParamList.hasOwnProperty(sFiled)) {
        return;
    }

    delete obParamList[sFiled];
}

function urlGenerationSet(obParamList, sFiled, obValue) {
    if (!sFiled || !obValue) {
        return;
    }

    if (typeof obValue == 'string') {
        obValue = [obValue];
    }

    obParamList[sFiled] = obValue;
}

function prepareRequestData(obParamList) {
    const obFilterList = $(sWrapperSelector);
    if (obFilterList.length == 0) {
        return;
    }

    obFilterList.each((iNumber) => {
        //Get filter type
        const obWrapper = $(obFilterList[iNumber]),
            sFilterType = obWrapper.attr(sFilterType_),
            iPropertyID = obWrapper.attr(sPropertyIDAttribute);

        let sFieldName = `${sFiledName}`;
        if (!sFilterType) {
            return;
        }

        if (iPropertyID) {
            sFieldName += `[${iPropertyID}]`;
        }

        let obInputList = null,
            arValueList = [];

        if (sFilterType == 'between') {
            obInputList = obWrapper.find('input');
        } else if (sFilterType == 'checkbox' || sFilterType == 'switch') {
            obInputList = obWrapper.find('input[type="checkbox"]:checked');
        } else if (sFilterType == 'select' || sFilterType == 'select_between') {
            obInputList = obWrapper.find('select');
        } else if (sFilterType == 'radio') {
            obInputList = obWrapper.find('input[type="radio"]:checked');
        }

        if (!obInputList || obInputList.length == 0) {
            urlGenerationRemove(obParamList, sFieldName);
            return;
        }

        obInputList.each((iInputNumber) => {
            const sValue = $(obInputList[iInputNumber]).val();
            if (!sValue) {
                return;
            }

            arValueList.push(sValue);
        });

        if (!arValueList || arValueList.length == 0) {
            urlGenerationRemove(obParamList, sFieldName);
        } else {
            urlGenerationSet(obParamList, sFieldName, arValueList);
        }
    });
}



$(document).on(sEventType, sWrapperSelector, () => {
    let obParamList = urlGenerationInit();
    prepareRequestData(obParamList);
    urlGenerationRemove(obParamList, 'page');
    urlGenerationUpdate(obParamList);

    window.location.href = window.location.href;
});


