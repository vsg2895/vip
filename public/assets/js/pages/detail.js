// Gallery Slider Large Images
$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    asNavFor: '.slider-nav',
    // nextArrow: '<i class="fa detail-right fa-chevron-right"></i>',
    // prevArrow: '<i class="fa detail-prev fa-chevron-left"></i>',
});

// Gallery Slider Thumbnails
$('.slider-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    focusOnSelect: true,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 576,
            settings: "unslick"
        }
    ]
});

// Send message to post author
$('#sendMessageToPostAutherUserForm').on('submit', function (e) {
    // Diabled all default events
    e.preventDefault();

    // Get form inputs data
    const dataString = new FormData(this);

    // Disabled request moment resend form event
    $('#sendMessageForm').addClass('disabled');

    // Send data to controller
    axios.post(this.getAttribute('action'), dataString)
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire(
                    dataMessageSendToPostAuthorTitleSuccess.innerText,
                    dataMessageSendToPostAuthorDescriptionSuccess.innerText,
                    'success'
                );

                // Clear inputs value
                $('textarea[form="sendMessageToPostAutherUserForm"]').val('');

                // Active resend form button
                $('#sendMessageForm').removeClass('disabled');
            } else { // Something wwnt wrong
                // Warning Alert
                Swal.fire(
                    dataMessageSendToPostAuthorTitleError.innerText,
                    dataMessageSendToPostAuthorDescriptionError.innerText,
                    'warning'
                );
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire(
            dataMessageSendToPostAuthorTitleError.innerText,
            dataMessageSendToPostAuthorDescriptionError.innerText,
            'error'
        );
    });
});

// Send report to admin
reportMessageSendForm.addEventListener('submit', function (e) {
    // Diabled all default events
    e.preventDefault();

    // Get form inputs data
    const dataString = new FormData(this);

    // Disabled request moment resend form event
    $('#sendReportForm').addClass('disabled');

    // Send data to controller
    axios.post(this.getAttribute('action'), dataString)
        .then(res => {
            // Sucees Alert
            if (res.data == 1) { // Request sned and get success
                Swal.fire(
                    dataSendReportToAdminTitleSuccess.innerText,
                    dataSendReportToAdminDescriptionSuccess.innerText,
                    'success'
                );

                // Clear inputs value
                $('textarea[form="reportMessageSendForm"]').val('');

                // Active resend form button
                $('#sendReportForm').removeClass('disabled');
            } else { // Something wwnt wrong
                // Warning Alert
                Swal.fire(
                    dataSendReportToAdminTitleError.innerText,
                    dataSendReportToAdminDescriptionError.innerText,
                    'warning'
                );
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire(
            dataSendReportToAdminTitleError.innerText,
            dataSendReportToAdminDescriptionError.innerText,
            'error'
        );
    });
});

var sliderindex = 0;
var arrowCheck = 0;

$(document).on('click', '.slider-large', function () {
    arrowCheck = 1;
    $('#box').find('.bg').css({'background-image': 'url("' + $(this).attr('src') + '")'});
    $('#box').show();
    sliderindex = $(this).attr('data-index');
});

$(document).on('click', '#box .close', function () {
    $('#box').hide();
    arrowCheck = 0;
});

$(document).on('click', '#box #right', function () {
    sliderindex++;
    if (sliderindex >= $('.slider-large').length) {
        sliderindex = 0;
    }
    $('#box').find('.bg').css({'background-image': 'url("' + $('.slider-large[data-index="' + sliderindex + '"]').attr('src') + '")'});
});

$(document).on('click', '#box #left', function () {
    sliderindex--;
    if (sliderindex == -1) {
        sliderindex = $('.slider-large').length - 1;
    }
    $('#box').find('.bg').css({'background-image': 'url("' + $('.slider-large[data-index="' + sliderindex + '"]').attr('src') + '")'});
});

document.addEventListener('keydown', function (e) {
    if (arrowCheck == 1) {
        e.preventDefault();
        switch (e.keyCode) {
            case 37:
                sliderindex--;
                if (sliderindex == -1) {
                    sliderindex = $('.slider-large').length - 1;
                }
                $('#box').find('.bg').css({'background-image': 'url("' + $('.slider-large[data-index="' + sliderindex + '"]').attr('src') + '")'});
                break;
            case 38:
                sliderindex++;
                if (sliderindex >= $('.slider-large').length) {
                    sliderindex = 0;
                }
                $('#box').find('.bg').css({'background-image': 'url("' + $('.slider-large[data-index="' + sliderindex + '"]').attr('src') + '")'});
                break;
            case 39:
                sliderindex++;
                if (sliderindex >= $('.slider-large').length) {
                    sliderindex = 0;
                }
                $('#box').find('.bg').css({'background-image': 'url("' + $('.slider-large[data-index="' + sliderindex + '"]').attr('src') + '")'});
                break;
            case 40:
                sliderindex--;
                if (sliderindex == -1) {
                    sliderindex = $('.slider-large').length - 1;
                }
                $('#box').find('.bg').css({'background-image': 'url("' + $('.slider-large[data-index="' + sliderindex + '"]').attr('src') + '")'});
                break;
        }
    }
});
$('.iframe-a').on('click', function (e) {

    $videoSrc = "http://www.youtube.com/embed/" + $(this).data('key');
    $("#youtube-iframe").attr('src', $videoSrc + "?autoplay=1");

    // $('.iframe-a').each(function() {
    //     $(this).attr("disabled", "disabled")
    // });
    // $(this).removeAttr("disabled");
    // let youtube_url = "http://www.youtube.com/embed/"+$(this).data('key');
    // $("#youtube-iframe").attr('src',youtube_url);
    // if($("#youtube-iframe").hasClass('d-none'))
    // {
    //     $("#youtube-iframe").removeClass('d-none');
    //     $(this).parent().addClass('d-none');
    //
    // }
    // else
    // {
    //     $("#youtube-iframe").addClass('d-none');
    //     $(this).parent().removeClass('d-none');
    //
    // }

    // alert(youtube_url)
})
$('.close-video').on('click', function () {

    $(this).closest('#myModal-video').find("#youtube-iframe").attr('src', "");

})
