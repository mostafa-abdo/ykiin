$(function () {
    $('.project-images .project-image').hover(function () {
        $("#project-image-view img").attr('src', $(this).find('img').attr('src'));
    });


    var project = $('.project-info-container');

    project.find('.amount-btn').on('click', function (e) {
        e.preventDefault();

        $(this).addClass('active').siblings().removeClass('active');
        project.find('.amount-input input').val($(this).data('amount'));
    });

    project.find('.amount-input input').on('input', function () {
        project.find('.amount-btn').removeClass('active');
        $(this).val($(this).val().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));

        if ($(this).val() > 0) {
            project.find('.amount-btn[data-amount="'+$(this).val()+'"]').addClass('active');
        }
    })



    setTimeout(() => {
        var progress = project.find('.progress-bar').attr('aria-valuenow');
        project.find('.progress-bar').css('width', progress + '%');
    }, 200);

});