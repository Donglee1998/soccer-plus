/**
 * Setting initial Ajax header
 */
$(document).ready(function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

/**
 * Send ajax destroy resource.
 *
 * @param {String} routeAct
 * @param {String} beforeSend
 * @returns Promise
 */
export function ajaxDestroy(routeAct, beforeSend) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: routeAct,
            type: 'DELETE',
            dataType: 'json',
            beforeSend: beforeSend,
            success: res => {
                return resolve(res)
            },
            error: function (xhr, ajaxOptions, thrownError) {
                return reject({
                    status: xhr.status,
                    thrownError
                });
            }
        });
    });
}

/**
 * Custom toast.
 *
 * @param {String} type
 * @param {String} message
 * @param {Object} {...}
 * @returns void
 */
export function toast(type, message, callback = () => {}) {
    // type = warning|success|error|info
    $.toast({
      text: message,
      heading: (type == 'error') ? 'エラー' : 'お知らせ',
      icon: type,
      showHideTransition: 'fade',
      allowToastClose: true,
      hideAfter: 3000,
      stack: 5,
      position: 'top-center',
      textAlign: 'left',
      loader: true,
      loaderBg: '#9EC600',
      beforeShow: function() {},
      afterShown: function() {},
      beforeHide: function() {
          return callback();
      },
      afterHidden: function() {}
    });
}

/**
 * Js Checker Instance
 * @param {string} domAll
 * @param {string} domItems
 * @param {string} attrData
 * @param {array} listChecked
 * @param {function} callback
 * @returns object
 */
export function JsChecker(domAll, domItems, attrData, listChecked = [], callback = () => {}) {
    const JsChecker = {};
    JsChecker.btnCheckAll      = domAll;
    JsChecker.btnCheckItems    = domItems;
    JsChecker.totalItem        = $(domItems).length;
    JsChecker.totalItemChecked = 0;
    JsChecker.listChecked      = listChecked;
    JsChecker.attrData         = attrData;

    // First load, setup list checked, if had checked list
    if (!!JsChecker.listChecked.length) {
        $(JsChecker.btnCheckItems).each((_, dom) => {
            const value = $(dom).attr(JsChecker.attrData);
            if (listChecked.findIndex(item => +item === +value) !== -1) {
                $(dom).prop('checked', true);
                JsChecker.totalItemChecked++;
            }
        });

        if (JsChecker.totalItemChecked === JsChecker.totalItem) {
            $(JsChecker.btnCheckAll).prop('checked', true);
        }
    }

    // Listen checkitem button change state
    $(JsChecker.btnCheckItems).on('change', function() {
        if ($(this).is(':checked')) {
            JsChecker.totalItemChecked++;
        } else {
            JsChecker.totalItemChecked--;
        }
        if (JsChecker.totalItemChecked === JsChecker.totalItem) {
            $(JsChecker.btnCheckAll).prop('checked', true);
        } else {
            $(JsChecker.btnCheckAll).prop('checked', false);
        }
        return callback(JsChecker);
    });

    // Listen checkall button change state
    $(JsChecker.btnCheckAll).on('change', function() {
        if ($(this).is(':checked')) {
            $(JsChecker.btnCheckItems).prop('checked', true);
            JsChecker.totalItemChecked = $(JsChecker.btnCheckItems).length;
        } else {
            $(JsChecker.btnCheckItems).prop('checked', false);
            JsChecker.totalItemChecked = 0;
        }
        return callback(JsChecker);
    });

    // Get all value in the checkitem is checked
    JsChecker.attrValChecked = (attr = JsChecker.attrData) => {
        let list = [];
        $(JsChecker.btnCheckItems).each((_, item) => {
            if ($(item).is(':checked')) {
                list.push($(item).attr(attr));
            }
        })
        return list;
    }
}

/**
 * App Cookie is a Closure to Cookie custom package
 * @param {string} key
 * @returns function closure
 */
export function appCookie(key) {
    var _key = key;

    /**
     * Store the data into the Cookie
     * @param {array|object} data
     * @return void
     */
    function set(data) {
        Cookies.set(_key, JSON.stringify(data));
    }

    /**
     * Get the data from the Cookie
     * @param {array|object} _default
     * @returns array|object
     */
    function get(_default = {}) {
        let data = Cookies.get(_key);
        data = !!data ? JSON.parse(data) : _default;

        return data;
    }

    /**
     * Check data specified in the Cookie is empty
     * @returns bool
     */
    function isEmpty() {
        let data = get();

        if (Array.isArray(data)) {
            return !!data.length;
        }

        if (!Array.isArray(data)) {
            return !!Object.values(data).length;
        }
    }

    /**
     * Remove data from Cookie
     * @return void
     */
    function remove() {
        Cookies.remove(_key);
    }

    return { set, get, isEmpty, remove }
}

/**
 * Get params in URL
 */
export const URLQueryParams = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});
