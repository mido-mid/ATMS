$(document).ready(function () {
    $('.toggler-button').on('click', function () {

        $('.animated-icon').toggleClass('open');
    });
    $(document).click(function (event) {
        var click = $(event.target);
        var _open = $(".navbar-collapse").hasClass("show");
        if (_open === true && !click.hasClass("nav")) {
            $(".navbar-toggler").click();
        }
    });
    $('#toCheckbox').click(function () {
        $('#dateTo').toggle(200);
    });
    $('.acceptdeny').click(function () {
        $(this).hide(100);
        $(this).siblings().hide(100);
        $(this).siblings('.reconsider').show(100);
    });
    $('.reconsider').click(function () {
        $(this).hide(100);
        $(this).siblings().show(100);
    });
});
