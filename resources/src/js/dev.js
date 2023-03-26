import $ from 'jquery';
import Log from 'laravel-mix/src/Log';
import Swal from 'sweetalert2';
import Resumable from 'resumable-file-uploads';

// ---------------------------------------------------------
// Custom Functions for Back-End
// ---------------------------------------------------------
$(document).ready(function() {
    // Variables
    var video_selected_stats = {};

    // End variables

    if ($('.jsEnableDependOn').length) {
        $('.jsEnableDependOn').each(function() {
            let depend_on_ele_id = $(this).attr('enable-depend-on'),
                id = $(this).attr('id'),
                checked = $('#' + depend_on_ele_id).is(':checked');
            if (checked) {
                $('#' + id).removeClass('disabled');
            } else {
                $('#' + id).addClass('disabled');
            }

            $('#' + depend_on_ele_id).on('change', function() {
                if ($(this).is(':checked')) {
                    $('#' + id).removeClass('disabled');
                } else {
                    $('#' + id).addClass('disabled');
                }
            });
        });
    }

    if ($('.jsDynamicFormAction').length) {
        $('.jsDynamicFormAction').on('click', function() {
            let $this = $(this),
                action = $this.data('action');
            $this.parents('form:first').attr('action', action).submit();
        });
    }

    var value_checkbox_folder = [];
    $(".table_folder").on('change', '.folder_checkbox', function (e) {
        $(this).each(function() {
            var $this = $(this);

            var dataStorage = JSON.parse(localStorage.getItem("folder_id"));
            if ($this.prop("checked") == true) {
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_folder = JSON.parse(localStorage.getItem("folder_id"));
                }
                value_checkbox_folder.push($this.val())
                localStorage.setItem("folder_id", JSON.stringify([...new Set(value_checkbox_folder)]));
                enableFolderDelBtn();
            }
            else if ($this.prop("checked") == false) {
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_folder = JSON.parse(localStorage.getItem("folder_id")).filter(e => e !== $this.val());
                    localStorage.setItem("folder_id", JSON.stringify([...new Set(value_checkbox_folder)]));
                    if ([...new Set(value_checkbox_folder)].length < 1) {
                        disabelFolderDelBtn();
                    }
                }
            }
        });
    })

    $(".table_folder").on("click", ".jsCheckAll", function () {
        var checkAll = !$(this)
            .siblings()
            .is(":checked"),
            listCheckbox = $(this)
                .parents(".handledCheckCtrl")
                .find('.jsChecked input[type="checkbox"]');
        if (checkAll) {
            listCheckbox.each(function () {
                var dataStorage = JSON.parse(localStorage.getItem("folder_id"));
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_folder = JSON.parse(localStorage.getItem("folder_id"));
                }
                value_checkbox_folder.push($(this).val())
                localStorage.setItem("folder_id", JSON.stringify([...new Set(value_checkbox_folder)]));
                enableFolderDelBtn();
            });
        } else {
            listCheckbox.each(function () {
                var dataStorage = JSON.parse(localStorage.getItem("folder_id"));
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_folder = JSON.parse(localStorage.getItem("folder_id")).filter(e => e !== $(this).val());
                    localStorage.setItem("folder_id", JSON.stringify([...new Set(value_checkbox_folder)]));
                    if ([...new Set(value_checkbox_folder)].length < 1) {
                        disabelFolderDelBtn();
                    }
                }
            });
        }
    });

    function firstLoadFolder() {
        var count = 0;
        var checkboxInPage = $(".folder_checkbox").length
        $(".folder_checkbox").each(function() {
            var dataStorage = JSON.parse(localStorage.getItem("folder_id"));
            if (dataStorage && dataStorage.length >= 1) {
                value_checkbox_folder = JSON.parse(localStorage.getItem("folder_id"));

                if (value_checkbox_folder.includes($(this).val())) {
                    $(this).prop('checked', true);
                    count++
                }
                enableFolderDelBtn();
            } else if ([...new Set(value_checkbox_folder)].length < 1) {
                $(this).prop('checked', false);
                disabelFolderDelBtn();
            }
        });

        if (count == checkboxInPage) {
            $('.folder_checkbox_all').prop('checked', true);
        }
    }

    if ($('.table_folder').length) {
        firstLoadFolder();
    } else {
        localStorage.removeItem("folder_id");
    }

    var delFolder = (password_admin) => {
        var password_admin = password_admin;
        return new Promise((resolve, reject) => {
            var dataStorage = JSON.parse(localStorage.getItem("folder_id"));
            if (dataStorage && dataStorage.length >= 1) {
                var folder_id = JSON.parse(localStorage.getItem("folder_id")).filter(e => e !== $(this).val());
                var formData = new FormData()
                formData.append('id_folder', folder_id)
                formData.append('password_admin', password_admin)
            }
            $.ajax({
                type: 'post',
                url: '/folder/destroy',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    localStorage.removeItem("folder_id");
                    $("tr").has('.folder_checkbox:checked').remove()
                    $('.folder_checkbox_all').prop('checked', false);
                    resolve(res)
                },
                error: function (err) {
                    $('#errorMatch').text('パスワードが違います').css('display', 'block');
                }
            });
        })
    }

    $("#delFolder").click(function (e) {
        e.preventDefault();
        modal3.addClass('active');
    })

    $('.jsOkModalFolder').on('click', function (e) {
        e.preventDefault();
        var password_admin = $("input[name=password_admin]").val();
        if (password_admin.length <= 0) {
            $('#errorMatch').text('パスワードが違います').css('display', 'block');
        } else {
            delFolder(password_admin).then(function (res) {
                if (res.status === true) {
                    closeModal();
                    disabelFolderDelBtn()
                } else {
                    $('#errorMatch').text('パスワードが違います').css('display', 'block');
                }
            }).catch(function (err) {
                // Run this when promise was rejected via reject()
                $('#errorMatch').text('パスワードが違います').css('display', 'block');
            })
        }
    })
    function disabelFolderDelBtn(){
        $('#delFolder').addClass("disabled");
    }

    function enableFolderDelBtn() {
        $('#delFolder').removeClass("disabled");
    }

    $(".addFolder").click(function (e) {
        $(this).addClass("disabled");
    })

    $('.jsOkModalEditFolder').on('click', function (e) {
        e.preventDefault();
        var folder_name = $("input[name=folder_name]").val();
        var folder_id = $("input[name=folder_id]").val();
        $.ajax({
            type: 'put',
            url: '/folder/update/' + folder_id,
            data: {
                name: folder_name
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                $('.nameFolder').text(folder_name);
                closeModal();
            },
            error: function (err) {
                $('#error').text(err.responseJSON.errors.name[0]).css('display', 'block');
            }
        });
    })

    // End Folder

    // Videos

    var value_checkbox_video = [];
    $(".table_video").on('change', '.video_checkbox', function (e) {
        $(this).each(function() {
            var $this = $(this);

            var dataStorage = JSON.parse(localStorage.getItem("video_id"));
            if ($this.prop("checked") == true) {
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_video = JSON.parse(localStorage.getItem("video_id"));
                }
                value_checkbox_video.push($this.val())
                localStorage.setItem("video_id", JSON.stringify([...new Set(value_checkbox_video)]));
                enableDelButton();
            }
            else if ($this.prop("checked") == false) {
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_video = JSON.parse(localStorage.getItem("video_id")).filter(e => e !== $this.val());
                    localStorage.setItem("video_id", JSON.stringify([...new Set(value_checkbox_video)]));
                    if ([...new Set(value_checkbox_video)].length < 1) {
                        disableDelButton();
                    }
                }
            }
        });
    })

    $(".table_video").on("click", ".jsCheckAll", function () {
        var checkAll = !$(this)
            .siblings()
            .is(":checked"),
            listCheckbox = $(this)
                .parents(".handledCheckCtrl")
                .find('.jsChecked input[type="checkbox"]');
        if (checkAll) {
            listCheckbox.each(function () {
                var dataStorage = JSON.parse(localStorage.getItem("video_id"));
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_video = JSON.parse(localStorage.getItem("video_id"));
                }
                value_checkbox_video.push($(this).val())
                localStorage.setItem("video_id", JSON.stringify([...new Set(value_checkbox_video)]));
                enableDelButton();
            });
        } else {
            listCheckbox.each(function () {
                var dataStorage = JSON.parse(localStorage.getItem("video_id"));
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_video = JSON.parse(localStorage.getItem("video_id")).filter(e => e !== $(this).val());
                    localStorage.setItem("video_id", JSON.stringify([...new Set(value_checkbox_video)]));
                    if ([...new Set(value_checkbox_video)].length < 1) {
                        disableDelButton();
                    }
                }
            });
        }
    });

    if ($('.table_video').length) {
        firstLoadVideo();
    } else {
        localStorage.removeItem("video_id");
    }

    function firstLoadVideo() {
        var count = 0;
        var checkboxInPage = $(".video_checkbox").length
        $(".video_checkbox").each(function() {
            var dataStorage = JSON.parse(localStorage.getItem("video_id"));
            if (dataStorage && dataStorage.length >= 1) {
                value_checkbox_video = JSON.parse(localStorage.getItem("video_id"));

                if (value_checkbox_video.includes($(this).val())) {
                    $(this).prop('checked', true);
                    count++
                }
                enableDelButton();
            } else if ([...new Set(value_checkbox_video)].length < 1) {
                disableDelButton();
            }
        });

        if (count == checkboxInPage) {
            $('.video_checkbox_all').prop('checked', true);
        }
    }

    function getFile(filePath) {
        return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
    }

    var delVideo = (password_admin) => {
        var password_admin = password_admin;
        return new Promise((resolve, reject) => {
            var dataStorage = JSON.parse(localStorage.getItem("video_id"));
            if (dataStorage && dataStorage.length >= 1) {
                var value_video_id = JSON.parse(localStorage.getItem("video_id")).filter(e => e !== $(this).val());
                var folder_id = $("input[name=folder_id]").val()
                var formData = new FormData()
                formData.append('id_video', value_video_id)
                formData.append('folder_id', folder_id)
                formData.append('password_admin', password_admin)
            }
            $.ajax({
                type: 'post',
                url: '/video/destroy',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    localStorage.removeItem("video_id");
                    $('.video_checkbox_all').prop('checked', false);
                    $("tr").has('.video_checkbox:checked').remove()
                    $('.video_checkbox_all').prop('checked', false);

                    if (res.status && typeof res.data !== 'undefined') {
                        $('.jsSpaceUploadUsed').text(res.data.space_upload_info.used_mb);
                        $('.jsSpaceUploadPercent').css('width', res.data.space_upload_info.used_percent + '%');
                    }

                    resolve(res)
                },
                error: function (reject) {
                    $('#errorMatch').text('パスワードが違います').css('display', 'block');
                }
            });
        })
    }

    $("#delVideo").click(function (e) {
        e.preventDefault();
        modal3.addClass('active');
    })

    $('.jsOkModalVideo').on('click', function (e) {
        e.preventDefault();
        var password_admin = $("input[name=password_admin]").val();
        if (password_admin.length <= 0) {
            $('#errorMatch').text('パスワードが違います').css('display', 'block');
        } else {
            delVideo(password_admin).then(function (res) {
                if (res.status === true) {
                    closeModal();
                    disableDelButton()
                } else {
                    $('#errorMatch').text('パスワードが違います').css('display', 'block');
                }
            }).catch(function (err) {
                // Run this when promise was rejected via reject()
                $('#errorMatch').text('パスワードが違います').css('display', 'block');
            })
        }
    })

    function disableDelButton(){
        $('#delVideo').addClass("disabled");
    }

    function enableDelButton() {
        $('#delVideo').removeClass("disabled");
    }

    $('.jsOkModalEditVideo').on('click', function (e) {
        e.preventDefault();
        var video_name = $("input[name=video_name]").val();
        var video_id = $("input[name=video_id]").val();
        $.ajax({
            type: 'put',
            url: '/video/update/' + video_id,
            data: {
                title: video_name
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                $('.nameVideo').text(video_name);
                closeModal();
            },
            error: function (err) {
                $('#error').text(err.responseJSON.errors.title[0]).css('display', 'block');
            }
        });
    })

    // End Video

    // ScoreBook

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    $('#keyword').keyup(delay(function (e) {
        searchMatch()
    }, 500));

    $('select[name=typeMatch]').on('change', function() {
        searchMatch()
    });

    $('input[name=startDateMatch]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY年MM月DD日'));
        setTimeout(function() {
            searchMatch()
        }, 200)
    });

    $('input[name=endDateMatch]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.endDate.format('YYYY年MM月DD日'));
        setTimeout(function() {
            searchMatch()
        }, 200)
    });

    $('input[name=startDateMatch], input[name=endDateMatch]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        picker.setStartDate({});
        picker.setEndDate({});
        setTimeout(function() {
            searchMatch()
        }, 200)
    });

    function searchMatch() {
        var keyword = $("input[name=keyword]").val();
        var type_match = $("select[name=typeMatch]").find(":selected").val();
        var start_date_match = $("input[name=startDateMatch]").val();
        var end_date_match = $("input[name=endDateMatch]").val();
        var formData = new FormData()
        formData.append('keyword', keyword)
        formData.append('type_match', type_match)
        formData.append('start_date_match', start_date_match)
        formData.append('end_date_match', end_date_match)
        $.ajax({
            type: 'get',
            url: '/scorebook?keyword=' + keyword + '&type_match=' + type_match + '&start_date_match=' + start_date_match + '&end_date_match=' + end_date_match,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                $('.matchs').html(res);

                //Change url => Save params search when user f5
                window.history.pushState("","", '?keyword=' + keyword + '&type_match=' + type_match + '&start_date_match=' + start_date_match + '&end_date_match=' + end_date_match);
                localStorage.removeItem("match_id");
            },
            error: function (reject) {

            }
        });
    }

    var value_checkbox_match = [];
    $(".matchs").on('change', '.match_checkbox', function (e) {
        $(this).each(function () {
            var $this = $(this);

            var dataStorage = JSON.parse(localStorage.getItem("match_id"));
            if ($this.prop("checked") == true) {
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_match = JSON.parse(localStorage.getItem("match_id"));
                }
                value_checkbox_match.push($this.val())
                localStorage.setItem("match_id", JSON.stringify([...new Set(value_checkbox_match)]));
                enableDelMatchButton()
            }
            else if ($this.prop("checked") == false) {
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_match = JSON.parse(localStorage.getItem("match_id")).filter(e => e !== $this.val());
                    localStorage.setItem("match_id", JSON.stringify([...new Set(value_checkbox_match)]));
                    if ([...new Set(value_checkbox_match)].length < 1) {
                        disableDelMatchButton()
                    }
                }
            }
        });
    })

    $(".matchs").on("click", ".jsCheckAll", function () {
        var checkAll = !$(this)
            .siblings()
            .is(":checked"),
            listCheckbox = $(this)
                .parents(".handledCheckCtrl")
                .find('.jsChecked input[type="checkbox"]');
        if (checkAll) {
            listCheckbox.each(function () {
                var dataStorage = JSON.parse(localStorage.getItem("match_id"));
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_match = JSON.parse(localStorage.getItem("match_id"));
                }
                value_checkbox_match.push($(this).val())
                localStorage.setItem("match_id", JSON.stringify([...new Set(value_checkbox_match)]));
                enableDelMatchButton()
            });
        } else {
            listCheckbox.each(function () {
                var dataStorage = JSON.parse(localStorage.getItem("match_id"));
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_match = JSON.parse(localStorage.getItem("match_id")).filter(e => e !== $(this).val());
                    localStorage.setItem("match_id", JSON.stringify([...new Set(value_checkbox_match)]));
                    if ([...new Set(value_checkbox_match)].length < 1) {
                        disableDelMatchButton()
                    }
                }
            });
        }
    });

    function firstLoadMatch() {
        var count = 0;
        var checkboxInPage = $(".match_checkbox").length
        $(".match_checkbox").each(function () {
            var dataStorage = JSON.parse(localStorage.getItem("match_id"));
            if (dataStorage && dataStorage.length >= 1) {
                value_checkbox_match = JSON.parse(localStorage.getItem("match_id"));

                if (value_checkbox_match.includes($(this).val())) {
                    $(this).prop('checked', true);
                    count++
                }
                enableDelMatchButton()
            } else if ([...new Set(value_checkbox_match)].length < 1) {
                $(this).prop('checked', false);
                disableDelMatchButton()
            }
        });

        if (count == checkboxInPage) {
            $('.match_checkbox_all').prop('checked', true);
        }
    }

    if ($('.table_match').length) {
        firstLoadMatch();
    } else {
        localStorage.removeItem("match_id");
    }

    function disableDelMatchButton(){
        $('#delMatch').addClass("disabled");
    }

    function enableDelMatchButton() {
        $('#delMatch').removeClass("disabled");
    }

    var delMatch = (password_admin) => {
        var password_admin = password_admin
        return new Promise((resolve, reject) => {
            var dataStorage = JSON.parse(localStorage.getItem("match_id"));
            if (dataStorage && dataStorage.length >= 1) {
                var value_match = JSON.parse(localStorage.getItem("match_id")).filter(e => e !== $(this).val());
                var formData = new FormData()
                formData.append('value_match', value_match)
                formData.append('password_admin', password_admin)
            }
            Swal.fire({
                title: 'しばらくお待ちください。',
                html: 'チェックした試合を削除しています。',
                allowOutsideClick: false,
                scrollbarPadding: false,
                heightAuto: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            $.ajax({
                type: 'post',
                url: '/scorebook/destroy',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    localStorage.removeItem("match_id");
                    $("tr").has('.match_checkbox:checked').remove()
                    $('.match_checkbox_all').prop('checked', false);
                    resolve(res)
                    location.reload()
                },
                error: function (reject) {
                    $('#errorMatch').text('パスワードが違います').css('display', 'block');
                }
            });
        })
    }

    function getLevelUser() {
        return new Promise(function(resolve, reject) {
            $.ajax({
                type: 'get',
                url: '/user/get-level-user',
                success: function (res) {
                    resolve(res)
                },
                error: function (err) {
                    reject(err)
                }
            });
        });
    }

    // End Scorebook

    // Run after upload video → Page play video
    function first_add_video(video_id) {
      var round_current = $('#matches_id').attr('data-round_current');
      var formData = new FormData();
      formData.append('video_id', video_id)
      formData.append('match_id', $('#matches_id').data('id'))
      formData.append('round', round_current)
      $.ajax({
        type: 'post',
        url: '/scorebook/matches/add_time_play_all_stats',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (res) {
          if(res){
            res.forEach(function(e,i){
              var stat = $('.statList'+round_current+' .stat_'+e.stat_id+' .time_start_play');
              stat.text(e.time_start_play);
              stat.attr('data-start', e.time_start_play);
              stat.attr('data-end', e.time_stop_play);

              $('.statList'+round_current+' .stat_'+e.stat_id+' .jsPlayVideo')
                .attr('data-type', '01')
                .attr('data-time_start', time2sec(e.time_start_play))
                .attr('data-time_stop', time2sec(e.time_stop_play))
                .attr('data-video_id', 'myvideo' + round_current)
                .removeClass('playType02').removeClass('playType03').addClass('playType01');
            });
          }
        },
      })
    }

    // Upload video → Page play video
    let objVideoCreate = {
      'folder_id': '',
      'video': '',
    }
    let objVideo = {
      'folder_id': '',
      'video': '',
    }
    var modal  = $("#myModal");
    var modal1 = $("#myModal1");
    var modal2 = $("#myModal2");
    var modal3 = $("#modalPassword");
    $(".btnOpenPopup").on('click', function(e) {
      e.preventDefault();
      renderListFolder();
      $('#backToFolderSelector').removeClass('noDisplay');
      isPreparingPlayUpload = false;
      modal1.addClass('active');
    })

    $(".modal:not(#myModal2)").on('click', '.tblList a', function(e) {
      e.preventDefault();
      if($(this).parents(".modal").attr("id") == 'myModal1') {
        objVideo.folder_id= $(this).attr("id");
        getVideoByFolder(objVideo.folder_id);
        $("#myModal1").removeClass('active');
        closeModal();
        modal2.addClass('active');
      }
    })
    let myvideo = document.getElementById("myvideo");

  $("#myModal2").on('click', '.tblList a', function(e) {
    e.preventDefault();
    let round = $('#matches_id').attr('data-round_current');
    let video = document.getElementById("myvideo" + round);
    let href = $(this).attr("href");
    let video_id = $(this).attr("id");
    first_add_video(video_id);
    video.src = href;
    $('#uploadBox' + round).css('display', 'none');
    $('#groupBtn' + round).css('display', '');
    closeModal();

    let show_video_class = 'showVideo' + round;
    $('.' + show_video_class).css('display', 'block');

    setTimeout(() => {
      if(video.duration) {
        $('.' + show_video_class + ' .timeVideo .time').text(new Date(video.duration * 1000).toISOString().slice(14, 19));
      }
    }, 300);
  })
  $('.showVideo .btnDelete').on('click', function() {
    $(this).parents('.showVideo').css('display', 'none');
    $(this).parents('.tabBox').find('.uploadBox').css('display', 'flex');
  })

    window.onclick = function(event) {
      if(event.target.id) {
        if (event.target.id !== 'overlayModel' && $("#" + event.target.id).hasClass('modal')) {
          closeModal();
        }
      }
    }

    function loading() {
      let tr = `<tr>
                  <td colspan="2">
                    <div class="loading">Loading</div>
                  </td>
                </tr>`;
      $(".modal:not(#overlayModel) tbody").html(tr);
    }

    let arrFolder = [];
    const findExistItem = (id) => {
      for (let i = 0; i < arrFolder.length; i++) {
        if (id == arrFolder[i].id) {
          return true
        }
      }
      return false
    };
    function reRenderList(arrFolder) {
      let tr = '';
      if(arrFolder.length < 1) {
        tr = `<tr>
                  <td colspan="2" class="center">null</td>
              </tr>`
      } else {
        arrFolder.forEach(item => {
          tr += `<tr>
                    <td><a href="javascript:void(0);" id="${item.id}" class="jsChunkPlayUpload">${item.name}</a></td>
                </tr>`
        })
      }
      $("#myModal tbody, #myModal1 tbody").html(tr);
    }
    function reRenderListVideo(arrVideo) {
      let tr = '';
      if(arrVideo.length < 1) {
        tr = `<tr>
                  <td colspan="2" class="center">null</td>
              </tr>`
      } else {
        arrVideo.forEach(item => {
          tr += `<tr>
                  <td class="rePadd">
                      <a href="${document.app_config.AWS_URL}/${item.path}" id="${item.id}"}>
                        <img src="${document.app_config.AWS_URL}/${item.thumbnail}" alt="home">
                      </a>
                  </td>
                  <td>${item.title}</td>
                </tr>`
        })
      }
      $("#myModal2 tbody").html(tr);
    }
    function renderListFolder() {
      loading();
      $.ajax({
        type: 'get',
        url: '/ajax/list-folder',
        cache: false,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            let tr = '';
            res.data.forEach(item => {
              if (!findExistItem(item.id)) {
                arrFolder.push(item);
              }
            })
            reRenderList(arrFolder);
        },
        error: function (err) {
          Swal.fire({
            icon: 'error',
            text: err.responseJSON.errors.title,
          })
          closeModal();
        }
      });
    }
    if ($(".modal").length) {
      renderListFolder();
    }
    $(".jsCreateFolder").on('click', function() {
      var name = $(".modal .blockUpload__name input").val();
      if(name != "") {
        var formData = new FormData()
        formData.append('name', name)
        $.ajax({
          type: 'post',
          url: '/ajax/folder',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (res) {
            let item = {
              'id': res.folder.id,
              'name': res.folder.name
            }
            if (!findExistItem(item.id)) {
              arrFolder.push(item);
            }
            reRenderList(arrFolder);
            $(".modal .blockUpload + .error").css('display', 'none');
          },
          error: function (err) {
            $(".modal .blockUpload + .error").html(err.responseJSON.errors.name).css('display', 'block');
          }
        });
      } else{
        $(".modal .blockUpload + .error").css('display', 'block');
      }
    });

    function getVideoByFolder(folder_id) {
      loading();
      var folder_id = folder_id;
      $.ajax({
          type: 'get',
          url: '/ajax/list-video?folder_id=' + folder_id,
          cache: false,
          contentType: false,
          processData: false,
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (res) {
            reRenderListVideo(res)
          },
          error: function (err) {
            Swal.fire({
              icon: 'error',
              text: err.responseJSON.errors.title,
            })
            closeModal();
          }
      });
    }
    $(".jsCloseModal").on('click', function(e) {
      e.preventDefault();
      closeModal();
    })
    function closeModal() {
      $(".modal").removeClass('active');
      $(".jsSeachFolder").val("");

      $('#errorMatch').css('display', 'none')
      $('input[name=password_admin]').val('')
    }

    $(".matchs").on('click', '.jsModalPassword',function(e) {
        e.preventDefault();
        modal3.addClass('active');
    })

    $(".jsSeachFolder").on('keyup change', function() {
        var value = $(this).val().toLowerCase();
            $(".modal .tblList a").filter(function() {
            $(this).parents("tr").toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    })
    $('.jsModal').on('click', function(e) {
        e.preventDefault();
        let nameModal = $(this).attr('href');
      $(nameModal).addClass('active');
    })
    // End Upload video → Page play video

    $('.jsOkModal').on('click', function(e) {
        e.preventDefault();
        var password_admin = $("input[name=password_admin]").val();
        if(password_admin.length <= 0) {
            $('#errorMatch').text('パスワードが違います').css('display', 'block');
        } else {
            delMatch(password_admin).then(function(res) {
                if(res.status === true) {
                        closeModal()
                        disableDelMatchButton()
                } else {
                    $('#errorMatch').text('パスワードが違います').css('display', 'block');
                }
              }).catch(function(err) {
                $('#errorMatch').text('パスワードが違います').css('display', 'block');
            })
        }
    });

  // Buttun チェックしたプレイの動画を解除 → Page play video
  $('.btnRemoveStatPlayVideo').on('click',function(e){
    if (!confirm('選択したプレイの動画を解除しますか？')) {
        return;
    }

    var args = [];
    $('.statCheckbox:checkbox:checked').each(function( index ) {
      args.push($( this ).val())
    });
    if(!args){
      return
    }
    var formData = new FormData();
    formData.append('stats', args)
    $.ajax({
      type: 'post',
      url: '/scorebook/matches/delete_stat_video_play',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      success: function (res) {
        if(res.result){
          args.forEach(function(el,idx,arr){
            var stat = $('.stat_'+el);
            stat.find('.time_start_play').text('').attr('data-start','').attr('data-end','');
            stat.find('.statCheckbox').prop('checked', false);
            stat.find('.jsPlayVideo').attr('data-type', '03').removeClass('playType01').removeClass('playType02').addClass('playType03');
          });

          let round_current = $('#matches_id').attr('data-round_current');
          if ($('.statList' + round_current + ':first').find('.jsPlayVideo.playType01').length === 0) {
            $('.showVideo' + round_current + ':first').find('.btnDelete:first').trigger('click');
            $('#groupBtn' + round_current).hide();
          }
        }
      },
    })
  })

    // Pulldown 並び順を選択 → Page play video
    $('#folderStat').on('change', function () {
        var formData = new FormData()
        formData.append('folder_id', this.value)
        $.ajax({
            type: 'post',
            url: '/scorebook/stat/get_pulldown_video',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (res) {
                var select = $('#videoStat');
                select.find('option').remove().end();
                select.append($('<option>', { value: '', text: '選手を選択' }));
                $.each(res, function (i, item) {
                    $('<option/>', {
                        value: item.id,
                        text: item.title,
                        'data-url': item.url,
                    }).appendTo(select);
                });
            },
        })
        $("input[name='video_id']").val('');
    })

    $('#videoStat').on('click', function (e) {
        $("input[name='video_id']").val(this.value);
        var src = $(this).children(":selected").data("url");
        let videoSource = $("#playVideoStat").find("#playVideoStatSource");
        videoSource.attr("src", src);
        let autoplayVideo = $("#playVideoStat").get(0);
        autoplayVideo.load();
    });

    // Auto play video
    autoplayVideo();
    function autoplayVideo() {
        let video     = document.getElementById('playVideoStat');
        if (video) {
            let startTime = $(video).data('start');
            let endTime   = $(video).data('stop');
            playVideoEdit(video, startTime, endTime);
        }
    }

    function playVideoEdit(elementVideo, startTime, endTime) {
        /* Stop if playing (otherwise ignored) */
        elementVideo.pause();
        /* Set video start time */
        elementVideo.currentTime = startTime;
        /* Play video */
        elementVideo.play();
        /* Check the current time and pause IF/WHEN endTime is reached*/
    }

    // Tactic
    var value_checkbox_tactic = [];
    $(".list_tactic").on('change', '.tactic_checkbox', function (e) {
        $(this).each(function() {
            var $this = $(this);

            var dataStorage = JSON.parse(localStorage.getItem("tactic_id"));
            if ($this.prop("checked") == true) {
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_tactic = JSON.parse(localStorage.getItem("tactic_id"));
                }
                value_checkbox_tactic.push($this.val())
                localStorage.setItem("tactic_id", JSON.stringify([...new Set(value_checkbox_tactic)]));
                enableTacticDelBtn();
            }
            else if ($this.prop("checked") == false) {
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_tactic = JSON.parse(localStorage.getItem("tactic_id")).filter(e => e !== $this.val());
                    localStorage.setItem("tactic_id", JSON.stringify([...new Set(value_checkbox_tactic)]));
                    if ([...new Set(value_checkbox_tactic)].length < 1) {
                        disabelTacticDelBtn();
                    }
                }
            }
        });
    })

    function firstLoadTactic() {
        var count = 0;
        var checkboxInPage = $(".tactic_checkbox").length
        $(".tactic_checkbox").each(function() {
            var dataStorage = JSON.parse(localStorage.getItem("tactic_id"));
            if (dataStorage && dataStorage.length >= 1) {
                value_checkbox_folder = JSON.parse(localStorage.getItem("tactic_id"));

                if (value_checkbox_folder.includes($(this).val())) {
                    $(this).prop('checked', true);
                    count++
                }
                enableTacticDelBtn();
            } else if ([...new Set(value_checkbox_folder)].length < 1) {
                $(this).prop('checked', false);
                disabelTacticDelBtn();
            }
        });

        if (count == checkboxInPage) {
            $('.tactic_checkbox_all').prop('checked', true);
        }
    }

    $(".jsCheckAll").on("click", function () {
        var checkAll = !$(this)
            .siblings()
            .is(":checked"),
            listCheckbox = $(this)
                .parents(".handledCheckCtrl")
                .find('.jsChecked input[type="checkbox"]');
        if (checkAll) {
            listCheckbox.each(function () {
                var dataStorage = JSON.parse(localStorage.getItem("tactic_id"));
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_tactic = JSON.parse(localStorage.getItem("tactic_id"));
                }
                value_checkbox_tactic.push($(this).val())
                localStorage.setItem("tactic_id", JSON.stringify([...new Set(value_checkbox_tactic)]));
                enableTacticDelBtn();
            });
        } else {
            listCheckbox.each(function () {
                var dataStorage = JSON.parse(localStorage.getItem("tactic_id"));
                if (dataStorage && dataStorage.length >= 1) {
                    value_checkbox_tactic = JSON.parse(localStorage.getItem("tactic_id")).filter(e => e !== $(this).val());
                    localStorage.setItem("tactic_id", JSON.stringify([...new Set(value_checkbox_tactic)]));
                    if ([...new Set(value_checkbox_tactic)].length < 1) {
                        disabelTacticDelBtn();
                    }
                }
            });
        }
    });

    if ($('.list_tactic').length) {
        firstLoadTactic();
    } else {
        localStorage.removeItem("tactic_id");
    }

    var delTactic = (password_admin) => {
        var password_admin = password_admin;
        return new Promise((resolve, reject) => {
            var dataStorage = JSON.parse(localStorage.getItem("tactic_id"));
            if (dataStorage && dataStorage.length >= 1) {
                var tactic_id = JSON.parse(localStorage.getItem("tactic_id")).filter(e => e !== $(this).val());
                var formData = new FormData()
                formData.append('id_tactic', tactic_id)
                formData.append('password_admin', password_admin)
            }
            $.ajax({
                type: 'post',
                url: '/tactic/destroy',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    localStorage.removeItem("tactic_id");
                    $("div.item").has('.tactic_checkbox:checked').remove()
                    $('.tactic_checkbox_all').prop('checked', false);
                    resolve(res)
                },
                error: function (err) {
                    $('#errorMatch').text('パスワードが違います').css('display', 'block');
                }
            });
        })
    }

    $("#delTactic").click(function (e) {
        e.preventDefault();
        modal3.addClass('active');
    })

    $('.jsOkModalTactic').on('click', function (e) {
        e.preventDefault();
        var password_admin = $("input[name=password_admin]").val();
        if (password_admin.length <= 0) {
            $('#errorMatch').text('パスワードが違います').css('display', 'block');
        } else {
            delTactic(password_admin).then(function (res) {
                if (res.status === true) {
                    closeModal();
                    disabelTacticDelBtn()
                } else {
                    $('#errorMatch').text('パスワードが違います').css('display', 'block');
                }
            }).catch(function (err) {
                // Run this when promise was rejected via reject()
                $('#errorMatch').text('パスワードが違います').css('display', 'block');
            })
        }
    })
    function disabelTacticDelBtn(){
        $('#delTactic').addClass("disabled");
    }

    function enableTacticDelBtn() {
        $('#delTactic').removeClass("disabled");
    }
    // End Tactic
    $('#purpose').on('change', function(){
      $('#appType select').val('');
      if($(this).val() == 2) {
        $('#appType').removeClass('noDisplay');
      }else{
        $('#appType').addClass('noDisplay');
      }
    })

    // Auto validation
    if ($('.jsAutoValidateForm').length) {
        $('.jsAutoValidateField').focusout(function() {
            let $this = $(this);
            if (isValidatePassed($this.data('validate-type'), $this.val())) {
                $this.css('border-color', '').css('background-color', '');
            } else {
                $this.css('border-color', '#D33D3D').css('background-color', '#FDF5F5');
            }
        });

        $('.jsAutoValidateField').on('keyup', function() {
            let $this = $(this);
            if (isValidatePassed($this.data('validate-type'), $this.val())) {
                $this.css('border-color', '').css('background-color', '');
            } else {
                $this.css('border-color', '#D33D3D').css('background-color', '#FDF5F5');
            }
        });
    }

    function isValidatePassed(validate_type, value) {
        let is_num, is_email;
        switch (validate_type) {
            case 'email':
                is_email = /\S+@\S+\.\S+/.test(value);
                return is_email ? true : false;
            case 'zip_1':
                is_num = /^\d+$/.test(value);
                return (!is_num || value.length !== 3) ? false : true;
            case 'zip_2':
                let is_num = /^\d+$/.test(value);
                return (!is_num || value.length !== 4) ? false : true;
            case 'tel':
                is_num = /^\d+$/.test(value.replaceAll('-', ''));
                return is_num ? true : false; 
            default:
                return value ? true : false;
        }
    }
    // End Auto validation

    // Entry form auto scoll to failed field
    if ($('.jsAutoScrollToFailedField').length && $('span.err').length) {
        $('span.err').get(0).scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    // End Entry form auto scoll to failed field

    if ($('#playTimeSubmitButton').length) {
        $('#playTimeSubmitButton').on('click', function() {
            $('#errorPlayTime').text('').removeClass('block');

            var formData = new FormData()
            formData.append('play_time', $('#playTimeInput').val());
            formData.append('round', $('#playTimeRoundHidden').val());
            $.ajax({
                type: 'post',
                url: $('#playTimeUrl').val(),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    $('#myModal3').removeClass('active');
                    var round_current = $('#matches_id').attr('data-round_current');
                    res.forEach(function(e,i){
                        var stat = $('.statList'+round_current+' .stat_'+e.stat_id+' .time_start_play')
                        stat.text(e.time_start_play);
                        stat.attr('data-start', e.time_start_play)
                        stat.attr('data-end', e.time_stop_play)
                    })
                },
                error: function (err) {
                    if (err.status === 422) {
                        $('#errorPlayTime').text(err.responseJSON.errors.play_time).addClass('block');
                    }
                }
            });
        });
    }

    // Play video
    $(document).on('click', '.jsPlayVideo', function(e){
        e.preventDefault();
        let $this = $(this),
            type = $this.attr('data-type');
        if (type != '01') {
            return;
        }

        video_selected_stats[$('#matches_id').attr('data-round_current')] = [];
        let time_start = $this.attr('data-time_start'),
            video_id = $this.attr('data-video_id'),
            $video = document.getElementById(video_id);
        $('#' + video_id).get(0).scrollIntoView({ behavior: 'smooth', block: 'center' });
        $video.currentTime = time_start;
        $video.play();
    });

    if ($('.jsMainVideo').length) {
        $('.jsMainVideo').on('timeupdate', function(event){
            let current_time = this.currentTime,
                round = $('#matches_id').attr('data-round_current');

            $('#' + this.id + '_timer').text(sec2time(current_time));

            if (typeof video_selected_stats[round] !== 'undefined' && video_selected_stats[round].length) {
                let is_valid_time = false;
                $.each(video_selected_stats[round], function(key, stat) {
                    if (current_time >= stat.time_start && current_time < stat.time_stop) {
                        is_valid_time = true;
                        return false;
                    }
                });

                if (!is_valid_time) {
                    let jump_to_time = null;
                    $.each(video_selected_stats[round], function(key, stat) {
                        if (current_time < stat.time_start) {
                            jump_to_time = stat.time_start;
                            return false;
                        }
                    });

                    if (jump_to_time !== null) {
                        this.currentTime = jump_to_time;
                    } else {
                        this.currentTime = video_selected_stats[round][0].time_start;
                    }
                }
            }

            $('.jsPlayVideo[data-video_id="' + this.id + '"]').each(function(){
                let $btn = $(this);
                if ($btn.attr('data-time_start') < current_time && $btn.attr('data-time_stop') > current_time) {
                    $btn.attr('data-type', '02').removeClass('playType01').addClass('playType02');
                } else {
                    $btn.attr('data-type', '01').removeClass('playType02').addClass('playType01');
                }
            });
        });
    }

    function time2sec(time) {
        let parts = time.split(':');
        switch (parts.length) {
            case 2:
                return (parseInt(parts[0]) * 60) + parseInt(parts[1]);
            case 3:
                return (parseInt(parts[0]) * 3600) + (parseInt(parts[1]) * 60) + parseInt(parts[2]);
            default:
                return 0;
        }
    }

    function sec2time(sec) {
        let hour, minute, second;
        sec = parseInt(sec);
        if (sec < 60) {
            return '00:' + zerofill(sec, 2);
        }
        if (sec < 3600) {
            minute = parseInt(sec / 60);
            second = sec - (minute * 60);
            return zerofill(minute, 2) + ':' + zerofill(second, 2);
        }
        hour = parseInt(sec / 3600);
        minute = parseInt((sec - (hour * 3600)) / 60);
        second = sec - (hour * 3600) - (minute * 60);
        return zerofill(hour, 2) + ':' + zerofill(minute, 2) + ':' + zerofill(second, 2);
    }

    function zerofill(number, width) {
        return String(number).padStart(width, '0');
    }

    if ($('.jsBackToFolderSelector').length) {
        $('.jsBackToFolderSelector').on('click', function(){
            modal2.removeClass('active');
            renderListFolder();
            modal1.addClass('active');
        });
    }

    if ($('.jsPlaySelectedStats').length) {
        $('.jsPlaySelectedStats').on('click', function() {
            let $this = $(this),
                video_id = $this.data('video_id'),
                $video = document.getElementById(video_id),
                round = '_' + $this.data('round'),
                $stats = $('.statList' + round + ' .statCheckbox:checked');
            if ($stats.length) {
                video_selected_stats[round] = [];
                $stats.each(function(){
                    let $stat = $(this).parents('tr:first').find('.jsPlayVideo:first'),
                        time_start = $stat.attr('data-time_start'),
                        time_stop = $stat.attr('data-time_stop');

                    video_selected_stats[round].push({
                        time_start: parseFloat(time_start),
                        time_stop: parseFloat(time_stop),
                    });
                });

                $('#' + video_id).get(0).scrollIntoView({ behavior: 'smooth', block: 'center' });
                $video.currentTime = video_selected_stats[round][0].time_start;
                $video.play();
            }
        });
    }

    if ($('.jsSelectSortBy').length) {
        $('.jsSelectSortBy').on('change', function() {
            let $this = $(this),
                val = $this.val(),
                round = $this.data('round'),
                $select2 = $('.jsSelectSortItem[data-round=' + round + ']');

            $select2.find('option').remove();
            if (val == 'action') {
                $select2.append($('<option>', {value: '', text: 'プレイ選択'}));
                $.each(document.pd_options[round].actions, function (i, item) {
                    $select2.append($('<option>', {
                        value: item.id,
                        text: item.value
                    }));
                });
            } else {
                $select2.append($('<option>', {value: '', text: '選手を選択'}));
                if (val) {
                    $.each(document.pd_options[round].members, function (i, item) {
                        $select2.append($('<option>', {
                            value: item.id,
                            text: item.value
                        }));
                    });
                }
            }

            change_stat_list_order(val, round);
        });

        $('.jsSelectSortItem').on('change', function () {
            let $this = $(this),
                round = $this.data('round'),
                val = $this.val(),
                $table = $('.statList' + round),
                sort_by = $('.jsSelectSortBy[data-round=' + round + ']').val();
            $table.find('.statCheckbox').prop('checked', false);

            if (sort_by == 'action') {
                $.each(document.pd_options[round].action_stats[val], function (i, stat_id) {
                    $table.find('.stat_' + stat_id + ':first').find('.statCheckbox').prop('checked', true);
                });
            } else {
                $.each(document.pd_options[round].member_stats[val], function (i, stat_id) {
                    $table.find('.stat_' + stat_id + ':first').find('.statCheckbox').prop('checked', true);
                });
            }
        });
    }

    function change_stat_list_order(sort_by, round) {
        let $table = $('.statList' + round + ':first');
        switch (sort_by) {
            case 'member':
                $table.find('tr.jsStatRow').sort(function (a, b) {
                    return a.dataset.member_id != b.dataset.member_id
                        ? +a.dataset.member_id - +b.dataset.member_id
                        : +a.dataset.timer_at - +b.dataset.timer_at;
                }).appendTo($table);
                break;
            case 'action':
                $table.find('tr.jsStatRow').sort(function (a, b) {
                    return a.dataset.action_id != b.dataset.action_id
                        ? +a.dataset.action_id - +b.dataset.action_id
                        : +a.dataset.timer_at - +b.dataset.timer_at;
                }).appendTo($table);
                break;
            default:
                $table.find('tr.jsStatRow').sort(function (a, b) {
                    return +a.dataset.timer_at - +b.dataset.timer_at;
                }).appendTo($table);
                break;
        }
    }
    // End Play video

    function showOverlayModel(content) {
        $('#overlayModelContent').text(content);
        $('#overlayModel').addClass('active');
    }

    function hideOverlayModel() {
        $('#overlayModelContent').text('');
        $('#overlayModel').removeClass('active');
    }

    // Chunk upload
    var playHandlers = ['play1ST', 'play2ND', 'play3RD', 'play4TH', 'playEXT1', 'playEXT2', 'playPK'],
        currentPlay = {},
        isPreparingPlayUpload = true,
        resumables = {
            album: { handler: null, file: {}, interval: null },
            play1ST: { handler: null, file: {}, interval: null },
            play2ND: { handler: null, file: {}, interval: null },
            play3RD: { handler: null, file: {}, interval: null },
            play4TH: { handler: null, file: {}, interval: null },
            playEXT1: { handler: null, file: {}, interval: null },
            playEXT2: { handler: null, file: {}, interval: null },
            playPK: { handler: null, file: {}, interval: null },
        };

    $('.jsChunkUploadPrepare').each(function() {
        let $this = $(this),
            processType = $this.data('process-type');
        if (!resumables[processType].handler) {
            initResumable($this);
        }
    });

    function initResumable($uploadBtn) {
        let fileInputId = $uploadBtn.data('assign-upload-id'),
            validateUrl = $uploadBtn.data('validate-url'),
            progressUrl = $uploadBtn.data('progress-url'),
            processType = $uploadBtn.data('process-type'),
            saveUrl = $uploadBtn.data('save-url');
        console.log('init', processType);
        resumables[processType].handler = new Resumable({
            chunkSize: $uploadBtn.data('chunk-mb') * 1024 * 1024, // MB
            simultaneousUploads: 3,
            testChunks: false,
            maxFiles: 1,
            fileType: $uploadBtn.data('file-types').split(','),
            throttleProgressCallbacks: 1,
            target: $uploadBtn.data('upload-url'),
            query: { _token : $('input[name=_token]').val() }
        });

        if (!resumables[processType].handler.support) {
            showOverlayModel('Resumable not supported');
        } else {
            resumables[processType].handler.assignBrowse(document.getElementById(fileInputId));
            resumables[processType].handler.on('fileAdded', function (file) {
                resumables[processType].file = {
                    name: file.fileName,
                    size: file.size,
                    type: file.file.type,
                };

                if (processType == 'album') {
                    $('#fileUploadName').text(file.fileName);
                } else if (playHandlers.includes(processType)) {
                    isPreparingPlayUpload = true;
                    currentPlay = {
                        processType: processType,
                        validateUrl: validateUrl,
                    }

                    objVideoCreate.video = file.file;
                    renderListFolder();
                    $('#backToFolderSelector').addClass('noDisplay');
                    modal.addClass('active');
                }
            });
            resumables[processType].handler.on('fileSuccess', function (file, message) {
                showOverlayModel('処理中');
                let data = {},
                    messageObj = JSON.parse(message);
                if (processType == 'album') {
                    data = $.extend({}, messageObj, {
                        title: $('#titleInput').val(),
                        folder_id: $('#folderIdHiddenInput').val()
                    });
                } else if (playHandlers.includes(processType)) {
                    data = $.extend({}, messageObj, {
                        title: resumables[processType].file.title,
                        folder_id: resumables[processType].file.folder_id,
                    });
                }

                let intervalTime = document.defaultIntervalTime ? document.defaultIntervalTime : 10000;
                resumables[processType].interval = setInterval(function() {
                    callJsonAjax({
                        method: 'post',
                        url: progressUrl,
                        data: data,
                        onSuccess: function(res) {
                            if (res.status == 'done') {
                                callJsonAjax({
                                    method: 'post',
                                    url: saveUrl,
                                    data: data,
                                    onSuccess: function() {
                                        if (processType == 'album') {
                                            location.reload();
                                        } else if (playHandlers.includes(processType)) {
                                            hideOverlayModel();
                                            closeModal();
                                            modal2.addClass('active');
                                            getVideoByFolder(resumables[processType].file.folder_id);
                                        }
                                    },
                                    onError: function(err) {
                                        handleUploadError(err, processType, $uploadBtn);
                                    }
                                });

                                clearInterval(resumables[processType].interval);
                            }
                        },
                        onError: function(err) {
                            handleUploadError(err, processType, $uploadBtn);
                        }
                    });
                }, intervalTime);
            });
            resumables[processType].handler.on('fileError', function (file, message) {
                console.log(message);
            });
            resumables[processType].handler.on('fileProgress', function (file) {
                let percent = Math.floor(resumables[processType].handler.progress() * 100),
                    message = percent < 100 ? 'アップロード中　' + percent + '%' : '処理中';
                showOverlayModel(message);
            });
        }
    }

    $(document).on('click', '.jsChunkPlayUpload', function(e) {
        if (!isPreparingPlayUpload) {
            return;
        }

        let $this = $(this),
            validateFields = [{name: 'title'}, {name: 'size' }];

        resumables[currentPlay.processType].file['title'] = getCurrentTime() + " " + resumables[currentPlay.processType].file.name; 
        resumables[currentPlay.processType].file['folder_id'] = $this.attr('id');

        callJsonAjax({
            method: 'post',
            url: currentPlay.validateUrl,
            data: resumables[currentPlay.processType].file,
            onSuccess: function() {
                if (resumables[currentPlay.processType].handler) {
                    resumables[currentPlay.processType].handler.upload();
                }
            },
            onError: function(err) {
                if (err.status == 422) {
                    $.each(validateFields, function(key, field) {
                        if (typeof err.responseJSON[field.name] !== 'undefined') {
                            hideOverlayModel();
                            closeModal();
                            Swal.fire({
                                icon: 'error',
                                text: err.responseJSON[field.name],
                            });
                            return false;
                        }
                    });
                }
            }
        });
    });

    $(document).on('click', '.jsChunkUploadButton', function(e) {
        e.preventDefault();
        let $this = $(this),
            validateUrl = $this.data('validate-url'),
            processType = $this.data('process-type'),
            data = {},
            validateFields = [];
        if (!resumables[processType].handler) {
            initResumable($this);
        }

        if (processType == 'album') {
            data['title'] = $('#titleInput').val();
            data['folder_id'] = $('#folderIdHiddenInput').val();
            data = $.extend({}, data, resumables[processType].file);

            validateFields = [
                {name: 'title', messageEleId: '#titleErrorMessage'},
                {name: 'size', messageEleId: '#sizeErrorMessage'},
                {name: 'type', messageEleId: '#typeErrorMessage'},
            ];
            validateFields.forEach(function(field) {
                $(field.messageEleId).text('');
            });
        }

        $this.addClass('disabled');
        callJsonAjax({
            method: 'post',
            url: validateUrl,
            data: data,
            onSuccess: function() {
                $this.removeClass('disabled');
                if (resumables[processType].handler) {
                    resumables[processType].handler.upload();
                }
            },
            onError: function(err) {
                $this.removeClass('disabled');
                if (err.status == 422) {
                    if (processType == 'album') {
                        validateFields.forEach(function(field) {
                            if (typeof err.responseJSON[field.name] !== 'undefined') {
                                $(field.messageEleId).text(err.responseJSON[field.name]);
                            }
                        });
                    }
                }
            }
        });
    });

    function callJsonAjax(options) {
        $.ajax({
            type: options.method,
            url: options.url,
            data: options.data,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: options.onSuccess,
            error: options.onError
        });
    }

    function getCurrentTime() {
        let currentDate = new Date();
        return "" + currentDate.getFullYear()
            + zerofill(currentDate.getMonth() + 1, 2)
            + zerofill(currentDate.getDate(), 2) + " "
            + zerofill(currentDate.getHours(), 2)
            + zerofill(currentDate.getMinutes(), 2)
            + zerofill(currentDate.getSeconds(), 2); 
    }

    function handleUploadError(err, processType, $uploadBtn) {
        let message = '異常が起こりました。';
        try { message = err.responseJSON.message } catch {};

        if (processType == 'album') {
            $uploadBtn.removeClass('disabled');
            $('#fileUploadName').text('ファイルを選択');
            $('#sizeErrorMessage').text(message);
        } else if (playHandlers.includes(processType)) {
            closeModal();
            Swal.fire({
                icon: 'error',
                text: message,
            });
        }
        hideOverlayModel();
        resumables[processType].file = {};
    }
});
