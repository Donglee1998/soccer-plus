$(document).on('click', '.tree label', function(e) {
    $(this).next('ul').fadeToggle();
    e.stopPropagation();
});

$(document).on('change', '.tree input[type=checkbox]', function(e) {
    $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
    $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
    e.stopPropagation();
});

$(document).on('click', 'button', function(e) {
    switch ($(this).text()) {
        case 'Collepsed':
            $('.tree ul').fadeOut();
            break;
        case 'Expanded':
            $('.tree ul').fadeIn();
            break;
        case 'Checked All':
            $(".tree input[type='checkbox']").prop('checked', true);
            break;
        case 'Unchek All':
            $(".tree input[type='checkbox']").prop('checked', false);
            break;
        default:
    }
});