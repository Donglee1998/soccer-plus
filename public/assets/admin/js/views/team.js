$(document).ready(function (e) {
    // ==============================
    // team color
    // ==============================
    let color, team;
    $(".openModal").on("click", function() {
        $(".modalTeam, .overlay").addClass("active");
        team = $(this).attr('data-team');
    })

    $(".btnClose, .overlay, .submitColor").on("click", function() {
        $(".modalTeam, .overlay").removeClass("active");
    })


    $("input:radio[name=team_color]").click(function() {
        color = $(this).val();
    });

    $(".submitColor").on("click", function() {
        let svg = $(".openModal[data-team="+team+"]").find('svg');
        $("input[name='data["+team+"]']").val(color)
        color = colors[color]
        if (color == '#FFF') {
            $(svg).addClass('colorWhite');
            $(svg).removeClass('colorGreen');
            $(svg).html('<use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams-white" />');
        }else{
            $(svg).addClass('colorGreen');
            $(svg).removeClass('colorWhite');
            $(svg).attr('style', 'fill: ' + color + ' !important');
            $(svg).html('<use xlink:href="/assets/img/svg/symbol-defs.svg#color-teams" />');
        }
    });


})