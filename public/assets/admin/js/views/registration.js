import { ajaxDestroy, toast, JsChecker, appCookie } from '../utils/helpers.js';
import { MESSAGE, COOKIE_KEYS } from '../utils/constants.js';

$(document).ready(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

(function ($) {
    // =========================================
    // Javascript handle list
    // =========================================
    $(function () {
        // ==============================
        // Handle Checklist Store Cookie
        // ==============================
        let listItems = [];
        let groupId = $("[js-checkitem]").data('check-group');
        let checkedSaved = [];
        // ArticleCookie is a Closure
        let registrationCookie = appCookie(COOKIE_KEYS.REGISTRATION_CHECKED_LIST);

        loadCheckedList();

        // Initial load list checked item in Cookie
        function loadCheckedList() {
            let checkedSavedGrp = registrationCookie.get();
            checkedSaved = checkedSavedGrp[groupId];
        }

        // JsChecker instance
        JsChecker("[js-checkall]", "[js-checkitem]", "js-checkitem", checkedSaved, checker => {
            if (checker.totalItemChecked > 0) {
                listItems = checker.attrValChecked('js-checkitem');
            }
            if (checker.totalItemChecked === 0) {
                listItems = [];
            }

            syncChecklist(listItems);
        });

        // Sync checklist is checked into Cookie with another checklis group
        function syncChecklist(items) {
            const checkedGrpSaved = registrationCookie.get();
            checkedGrpSaved[groupId] = items;
            registrationCookie.set(checkedGrpSaved);
        }

        function ajaxTrashHandler(e) {
            if (confirm(MESSAGE.DELETE_CONFIRM)) {
                const routeAct = $(e.target).attr('data-url');

                ajaxDestroy(routeAct)
                    .then(({ data: { redirect_url } }) => {
                        const beforeHide = () => window.location.href = redirect_url;
                        toast('success', MESSAGE.DELETE_SUCCESS, beforeHide);
                    }).catch(() => {
                        toast('error', MESSAGE.GLOBAL_ERROR);
                    });
            }
        }
        $("[data-action='trash']").on('click', ajaxTrashHandler);
        // Handle export csv
        $("[data-action='export-csv']").click(function () {
            $.ajax({
                type: 'GET',
                url: $(this).data('url'),
                cache: false,
                contentType: false,
                processData: false,
                success: () => {
                    window.location.href = $(this).data('url');
                },
                error: function () {
                    toast('error', MESSAGE.EXPORT_CSV_FAILED);
                }
            });
        });

        // Handle mass trash
        $("[data-action='mass-trash']").click(function () {
            const itemsGrpChecked = registrationCookie.get();
            let listChecked = [];

            for (const [_, value] of Object.entries(itemsGrpChecked)) {
                listChecked = [...listChecked, ...value];
            }

            if (!!listChecked.length) {
                if (confirm(MESSAGE.DELETE_BULK_CONFIRM)) {
                    $.ajax({
                        url: '/admin/registration/mass-trash',
                        type: 'POST',
                        data: { ids: listChecked.map(item => +item) },
                        dataType: 'json',
                        success: function ({ data: { success } }) {
                            if (success) {
                                location.reload();
                            }
                        }
                    });
                }
            } else {
                toast('error', MESSAGE.TABLE_SELECTION_EMPTY);
            }
        });

        //ajaxzip3
        let corp_building_zip = $('input[name="data[registration][corp_building_zip]"]');
        let sub_zip = $('input[name="data[registration][sub_zip]"]');
        let pic_zip = $('input[name="data[registration][pic_zip]"]');
        function ajaxZip(elementZip, city, pref, addr) {
            elementZip.keyup(function () {
                let zip = $(this).val().split('-');
                if (zip.length == 1) {
                    let zip1 = elementZip.val().substring(0, 3);
                    $('input[name="data[registration][zip1]"]').val(zip1);
                    let zip2 = elementZip.val().substring(3, 7);
                    $('input[name="data[registration][zip2]"]').val(zip2);
                    AjaxZip3.zip2addr('data[registration][zip1]', 'data[registration][zip2]', pref, city, addr);
                } else {
                    let zip1 =zip[0];
                    $('input[name="data[registration][zip1]"]').val(zip1);
                    let zip2 = zip[1];
                    $('input[name="data[registration][zip2]"]').val(zip2);
                    AjaxZip3.zip2addr('data[registration][zip1]', 'data[registration][zip2]', pref, city, addr);
                }

              
            });
        }
        ajaxZip(corp_building_zip, 'data[registration][corp_building_city]', 'data[registration][corp_building_pref]', 'data[registration][corp_building_address]');
        ajaxZip(sub_zip, 'data[registration][sub_city]', 'data[registration][sub_pref]', 'data[registration][sub_address]');
        ajaxZip(pic_zip, 'data[registration][pic_city]', 'data[registration][pic_pref]', 'data[registration][pic_address]');
    });
})(jQuery);
