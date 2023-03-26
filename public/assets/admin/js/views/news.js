import { ajaxDestroy, toast, JsChecker, appCookie, URLQueryParams } from '../utils/helpers.js';
import { MESSAGE, COOKIE_KEYS } from '../utils/constants.js';

$(document).ready(function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#formTable #sort').sortable({
        update: function (event, ui) {
            var total = $('.ui-sortable tr').length;
            $(this).children().each(function (index) {
                if ($(this).attr('data-position') != (index+1)) {
                    $(this).attr('data-position', (total-index)).addClass('updated');
                }
            });
            var positions = [];
            $('.updated').each(function () {
                positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
                $(this).removeClass('updated');
            });
            $.ajax({
                url: "/admin/news/sort",
                type: 'POST',
                dataType: 'json',
                data: {
                    updated: 1,
                    positions: positions,
                }, success: function (response) {
                    //location.reload();
                }
            });
        }
    });
});

(function($) {
    // =========================================
    // Javascript handle create/edit
    // =========================================
    $(function() {
        /**
         * Destroy news
         * @param {Object} e
         * @returns void
         */
        function ajaxTrashHandler(e) {
            if (confirm(MESSAGE.DELETE_CONFIRM)) {
                const routeAct = $(e.target).attr('data-url');

                ajaxDestroy(routeAct)
                    .then(({ data: { redirect_url }}) => {
                        const beforeHide = () => window.location.href = redirect_url;
                        toast('success', MESSAGE.DELETE_SUCCESS, beforeHide);
                    }).catch(() => {
                        toast('error', MESSAGE.GLOBAL_ERROR);
                    });
            }
        }

        $("[data-action='trash']").on('click', ajaxTrashHandler);
    });

    // =========================================
    // Javascript handle list
    // =========================================
    $(function($) {
        // Handle Listen URL have preview redirect link
        if (!!URLQueryParams.redirect_url) {
            window.history.pushState({}, document.title, window.location.pathname);
            window.open(URLQueryParams.redirect_url);
        }

        // ==============================
        // Handle Checklist Store Cookie
        // ==============================
        let listItems     = [];
        let groupId       = $("[js-checkitem]").data('check-group');
        let checkedSaved  = [];
        // ArticleCookie is a Closure
        let newsCookie = appCookie(COOKIE_KEYS.ARTICLE_CHECKED_LIST);

        loadCheckedList();

        // Initial load list checked item in Cookie
        function loadCheckedList() {
            let checkedSavedGrp = newsCookie.get();
            checkedSaved = checkedSavedGrp[groupId];
        }

        // JsChecker instance
        JsChecker("[js-checkall]", "[js-checkitem]", "js-checkitem", checkedSaved, checker => {
            if (checker.totalItemChecked > 0) {
                listItems = checker.attrValChecked();
            }
            if (checker.totalItemChecked === 0) {
                listItems = [];
            }

            syncChecklist(listItems);
        });

        // Sync checklist is checked into Cookie with another checklis group
        function syncChecklist(items) {
            const checkedGrpSaved = newsCookie.get();
            checkedGrpSaved[groupId] = items;
            newsCookie.set(checkedGrpSaved);
        }

        // Handle listen button select
        $(".tableSelection-button").on('click', function() {
            let actions = {
                1: changeStatusHandler,
                2: changeStatusHandler,
                3: deleteHandler
            };

            let selectVal = $(".tableSelection-select").val();
            if (actions[selectVal]) {
                const itemsGrpChecked = newsCookie.get();
                let listChecked = [];

                for (const [_, value] of Object.entries(itemsGrpChecked)) {
                    listChecked = [...listChecked, ...value];
                }

                if (!!listChecked.length) {
                    // Convert string to integer
                    listChecked = listChecked.map(item => +item);

                    if (+selectVal === 1) {
                        actions[selectVal](1, listChecked);
                    }
                    if (+selectVal === 2) {
                        actions[selectVal](2, listChecked);
                    }
                    if (+selectVal === 3) {
                        actions[selectVal](listChecked);
                    }
                } else {
                    toast('error', MESSAGE.TABLE_SELECTION_EMPTY);
                }
            } else {
                toast('error', MESSAGE.TABLE_SELECTION_ACTION_INVALID);
            }
        });

        // Change Status by Bunk list of the Article
        const changeStatusHandler = (state, list) => {
            const msgConfirm = (+state === 1) ? MESSAGE.CHANGE_STATUS_PUBLIC_CONFIRM : MESSAGE.CHANGE_STATUS_PRIVATE_CONFIRM
            if (confirm(msgConfirm)) {
                $.ajax({
                    url: `/admin/news/mass-update-status`,
                    type: 'POST',
                    data: {state, ids: list},
                    dataType: 'json',
                    success: function({ data: { success }}) {
                        if (success) {
                            location.reload();
                            newsCookie.remove();
                        }
                    }
                });
            }
        }

        // Move to trash by Bunk list of the Article
        function deleteHandler(list) {
            if (confirm(MESSAGE.DELETE_BULK_CONFIRM)) {
                $.ajax({
                    url: '/admin/news/mass-trash',
                    type: 'POST',
                    data: {ids: list},
                    dataType: 'json',
                    success: function({ data: { success }}) {
                        if (success) {
                            location.reload();
                            newsCookie.remove();
                        }
                    }
                })
            }
        }

        $("#newPreview").on('click', function(event) {
            event.preventDefault()
            var editor = myEditor.getData();
            $('input[name="data[editor_convert]"]').val(editor);
            const params = $(".news_form").serialize();

            $.ajax({
                url: '/admin/news/preview',
                type: 'POST',
                data: params,
                dataType: 'json',
                success: function (res) {
                    if (res.uniqid) {
                        if (res.category == '1') {
                            var url = "/manual/preview/" + res.uniqid;
                        }else{
                            var url = "/news/preview/" + res.uniqid;
                        }

                        window.open(url, "_blank");
                    }
                }
            })
      });
    });
})(jQuery);
