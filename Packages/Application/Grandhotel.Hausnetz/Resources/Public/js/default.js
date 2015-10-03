$(function() {
    /* Autogrowing textreas */
    $(".autogrow").autoGrow();

    /* Affix Navigation */
    $('#navigation').affix({
        offset: {
            top: 85
        }
    });

    /* Bootstrap Form Errors */
    $('.f3-form-error').parents('.form-group').addClass('has-error');

});

