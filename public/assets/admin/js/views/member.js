import { ajaxDestroy, toast, JsChecker, appCookie } from '../utils/helpers.js';
import { MESSAGE, COOKIE_KEYS } from '../utils/constants.js';

$(document).ready(function (e) {
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  // ==============================
  // import csv member
  // ==============================
  $('.importCsv').click(function(){
    $('.csvFile').trigger('click');
  });

  $(".csvFile").on('change', function(event) {
    event.preventDefault()
    var fd = new FormData();
    var files = this.files;
    var url = $(this).attr('data-url')
    fd.append('file', files[0]);
    $.ajax({
        url: url,
        type: "post",
        data: fd,
        contentType: false,
        processData: false,
        success: function (result) {
          if (result.success == true) {
            toast('success', 'インポートが成功しました。', function(){
              location.reload();
            });
          }else{
            toast('error', 'インポートが失敗しました。');
          }
        }
    }).fail(function(xhr, textStatus, errorThrown){
      toast('error', 'インポートが失敗しました。');
    });
  });

  // ==============================
  // Handle Checklist Store Cookie
  // ==============================
  let listItems     = [];
  let groupId       = $("[js-checkitem]").data('check-group');
  let checkedSaved  = [];
  // ArticleCookie is a Closure
  let memberCookie = appCookie(COOKIE_KEYS.MEMBER_CHECKED_LIST);

  loadCheckedList();

  // Initial load list checked item in Cookie
  function loadCheckedList() {
    let checkedSavedGrp = memberCookie.get();
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
    const checkedGrpSaved = memberCookie.get();
    checkedGrpSaved[groupId] = items;
    memberCookie.set(checkedGrpSaved);
  }

  // Handle mass trash
  $("[data-action='mass-trash']").click(function () {
      const itemsGrpChecked = memberCookie.get();
      let listChecked = [];

      for (const [_, value] of Object.entries(itemsGrpChecked)) {
          listChecked = [...listChecked, ...value];
      }
      if (!!listChecked.length) {
          if (confirm(MESSAGE.DELETE_BULK_CONFIRM)) {
              $.ajax({
                  url: '/admin/member/mass-trash',
                  type: 'POST',
                  data: { ids: listChecked },
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

})