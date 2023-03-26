
(function ($) {
   
    $(function () {
        let inputPassword = $('*.input-password input');
        let btnToggle = $('*.icon-showpass');
        for(let i = 0; i < btnToggle.length; i++) {
            $(btnToggle[i]).on('click', function (e) {
                e.preventDefault();
                if ($(inputPassword[i]).attr('type') === 'password') {
                    $(inputPassword[i]).prop('type', 'text');
                    $(btnToggle[i]).prop('src','/assets/admin/img/admin/icon/eye.svg');
                } else {
                    $(inputPassword[i]).prop('type', 'password');
                    $(btnToggle[i]).prop('src','/assets/admin/img/admin/icon/eye1.png');
                }
            });
        }

    });
})(jQuery);
