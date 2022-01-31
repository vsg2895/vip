// Preloader
$(document).ready(function () {
    // Closing
    $('.preloader-content').fadeOut();
});


// Browser backlink event in axios conflict
if (window.history && window.history.pushState) {
    // Check event
    $(window).on('popstate', function () {

        // Get hahsed location
        var hashLocation = location.hash;

        // Split
        var hashSplit = hashLocation.split("#!/");

        // Make hash name
        var hashName = hashSplit[1];

        // Validate data
        if (hashName !== '') {
            // Make hash
            var hash = window.location.hash;
            if (hash === '') {
                // Redirect
                window.location = window.location.href;

                // Break
                return false;
            }
        }
    });
}

// Lazy Loading
$(function () {
    $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0,});
});

// Remove slick labels
$('.slick-arrow').removeAttr('aria-label');

// Currency menu action
$(document).on('click', '.currency-current-item', function () {
    $(this).parents('ul.currency-menu').find('ul.submenu').stop().slideToggle();
});

// Languges menu action
$(document).on('click', '.language-current-item', function () {
    if ($(window).width() < 561) {
        $('.language-top-item').stop().animate({'bottom': '-35px', 'left': '8px'}, 200).fadeToggle();
        $('.language-bottom-item').stop().animate({'bottom': '-65px', 'left': '8px'}, 200).fadeToggle();

    } else {
        $('.language-top-item').stop().animate({'top': '-30px'}, 200).fadeToggle();
        $('.language-bottom-item').stop().animate({'bottom': '-60px'}, 200).fadeToggle();

    }


});

// Calculator menu action
let calculatorCounter = 0;
$(document).on('click', '.calculator svg', function () {
    calculatorCounter++;
    $(this).parents('.calculator').find('.calculaor-menu').stop().slideToggle();
});

// $(document).on('click', 'body', function(e){
//     if(!$(e.target).hasClass('no-clicked')){
//         $('.calculator').find('.calculaor-menu').stop().slideUp();
//         calculatorCounter = 0;
//     }
// });

// Sending currency api form
let sendCurrecyApiForm = (elem) => {
    // Get form inputs data
    let dataString = new FormData();

    // Make data
    //
    // $('#currencyApiForm').find('input[name="price_value_1"]').val();
    // $('#currencyApiForm').find('select[name="currency_1"]').val();
    // $('#currencyApiForm').find('input[name="price_value_1"]').val();
    dataString['currency_1'] = elem.attr('name');
    // dataString['currency_2'] = $('#currencyApiForm').find('input[name="price_value_1"]').val();
    dataString['price_value_1'] = elem.val();

    // Send data to controller
    axios.post($('#currencyApiForm').attr('action'), {dataString})
        .then(res => {
            console.log(res.data.all_converts)
            if (res.data.all_converts) { // Request sned and get success
                for (var index in res.data.all_converts) {
                    console.log(index);
                    $('input[name="' + index + '"]').val(res.data.all_converts[index]);
                    $('input[name="' + index + '"]').prop('disabled', true);
                }
                // $.each('.currency_1', function () {
                //
                // });
                // $('input[name="price_value_2"]').removeAttr('readonly').val(res.data.toFixed(2));
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire(
            dataContactMessageTitleSendError.innerText,
            dataContactMessageDescriptionSendError.innerText,
            'error'
        );
    });
}

// // Change api price input change function
// $(document).on('input', 'input[name="price_value_1"]', function (e) {
//     // Disabled all default events
//     e.preventDefault();
//
//     // Check data
//     if ($(this).val() != '' && $(this).val() > 0) { // Price allowed
//         // Remove select 1 disabled
//         $('select[name="currency_1"]').removeAttr('disabled');
//     } else {
//         // Add disabled attributes
//         $('select[name="price_value_1"]').attr('disabled', 'disabled');
//         $('select[name="price_value_2"]').attr('disabled', 'disabled');
//         $('select[name="currency_1"]').attr('disabled', 'disabled');
//         $('select[name="currency_2"]').attr('disabled', 'disabled');
//     }
// });

// Change api price input change function
$(document).on('input', '.currency_1', function (e) {
    // Disabled all default events
    e.preventDefault();
    // alert()

    // Check data
    // console.log()
    if ($(this).val() != '' && $(this).val() != '#') { // Select  1 allowed
        // Remove select 2 disabled
        // $('select[name="currency_2"]').removeAttr('disabled');

        // if($('select[name="currency_2"]').val() != '#' &&  $('select[name="currency_2"]').val() != '' && typeof($('select[name="currency_2"]').val()) != 'object'){
        // Submit form
        $('#currencyApiForm').submit(sendCurrecyApiForm($(this)));
        // }
    } else {
        // alert()
        $('.currency_1').each(function () {
            $(this).val('');
            $(this).prop('disabled', false);
        });
        // Add disabled attributes
        // $('select[name="currency_2"]').attr('disabled', 'disabled');
        // $('select[name="price_value_2"]').attr('disabled', 'disabled');
    }
});

// Change api select 2 change function
// $(document).on('change', 'select[name="currency_2"]', function (e) {
//     // Disabled all default events
//     e.preventDefault();
//
//     // Check data
//     if ($('input[name="price_value_1"]') != '' && $(this).val() != '#') { // Select 2 allowed
//         // Remove input 3 price disabled
//         $('input[name="price_value_2"]').removeAttr('disabled').val(0);
//
//         // Submit form
//         $('#currencyApiForm').submit(sendCurrecyApiForm());
//     }
// });

// Password hide show
let passwordCounter = 0;
$(document).on('click', '.lock-icons-area', function (e) {
    e.preventDefault();
    if (passwordCounter++ % 2 == 0) {
        $(this).parents('.form-group').find('input[data-type="password"').attr('type', 'text');
        $(this).html('\
            <!-- Unlock icon --> \
            <svg class="unlock-icon" id="eye-close-up" xmlns="http://www.w3.org/2000/svg" width="24.419" height="15.956" viewBox="0 0 24.419 15.956"> \
                <path id="Path_1" data-name="Path 1" d="M12.21,161.525a13.406,13.406,0,0,0-12.16,7.757.523.523,0,0,0,0,.443,13.41,13.41,0,0,0,24.321,0,.523.523,0,0,0,0-.443A13.406,13.406,0,0,0,12.21,161.525Zm0,13.483a5.5,5.5,0,1,1,5.5-5.5A5.5,5.5,0,0,1,12.21,175.008Z" transform="translate(0 -161.525)" fill="#a2aebc"/> \
                <circle id="Ellipse_1" data-name="Ellipse 1" cx="3.523" cy="3.523" r="3.523" transform="translate(8.686 4.453)" fill="#a2aebc"/> \
            </svg> \
        ');
    } else {
        $(this).parents('.form-group').find('input[data-type="password"]').attr('type', 'password');
        $(this).html('\
            <!-- Lock icon --> \
            <svg xmlns="http://www.w3.org/2000/svg" width="23.018" height="23.018" viewBox="0 0 23.018 23.018"> \
                <g id="hide_1_" data-name="hide (1)" transform="translate(0 0)"> \
                    <g id="Group_161" data-name="Group 161" transform="translate(0 0)"> \
                        <g id="Group_160" data-name="Group 160" transform="translate(0 0) "> \
                            <path id="Path_15" data-name="Path 15" d="M22.877,21.521,1.5.141a.48.48,0,0,0-.678,0L.14.819a.479.479,0,0,0,0,.678L4.106,5.462a12.324,12.324,0,0,0-4.083,5.9.482.482,0,0,0,0,.293,12.085,12.085,0,0,0,11.486,8.485,11.851,11.851,0,0,0,5.779-1.5l4.233,4.233a.48.48,0,0,0,.678,0l.678-.678A.479.479,0,0,0,22.877,21.521Zm-11.368-3.3A6.7,6.7,0,0,1,6.137,7.494L8.222,9.579a3.757,3.757,0,0,0-.55,1.93,3.841,3.841,0,0,0,3.836,3.836,3.758,3.758,0,0,0,1.93-.55l2.085,2.085A6.7,6.7,0,0,1,11.509,18.223Z" transform="translate(0 0)" fill="#a2aebc"/> \
                            <path id="Path_16" data-name="Path 16" d="M246.2,171.044a.48.48,0,0,0,.1.525l3.316,3.316a.479.479,0,0,0,.819-.345,3.809,3.809,0,0,0-3.789-3.789A.523.523,0,0,0,246.2,171.044Z" transform="translate(-235.1 -163.074)" fill="#a2aebc"/> \
                            <path id="Path_17" data-name="Path 17" d="M156.728,66.484a.48.48,0,0,0,.546.094,6.642,6.642,0,0,1,2.888-.661,6.721,6.721,0,0,1,6.713,6.713,6.642,6.642,0,0,1-.661,2.888.48.48,0,0,0,.094.546l1.662,1.662a.479.479,0,0,0,.339.14h0a.482.482,0,0,0,.34-.142,12.5,12.5,0,0,0,3-4.948.482.482,0,0,0,0-.293A12.085,12.085,0,0,0,160.163,64a11.943,11.943,0,0,0-4.2.761.479.479,0,0,0-.171.788Z" transform="translate(-148.654 -61.122)" fill="#a2aebc"/> \
                        </g> \
                    </g> \
                </g> \
            </svg> \
        ');
    }
});

// Wishlist post action
$(document).on('click', '.wishlist-action', function (e) {
    e.preventDefault();
    let self = $(this);
    let url = self.attr('data-url');
    self.addClass('blocked');
    if (self.hasClass('not-liked')) {
        // alert()
        self.removeClass('not-liked');
        self.parents('.like-button-container').find('.like-action svg').attr('width', '24.523').attr('height', '24.557').attr('viewBox', '0 0 24.523 24.557');
        self.parents('.like-button-container').find('.like-action svg').html('\
            <!-- Liked --> \
            \
            <g id="like_" data-name="like " transform="translate(0 0.034)"> \
                <path id="Path_563" data-name="Path 563" d="M56.364,265.475v10.4a.936.936,0,0,1-.935.935h-3.9v.006a.936.936,0,0,1-.935-.935V265.475a.936.936,0,0,1,.935-.935h3.9A.936.936,0,0,1,56.364,265.475Z" transform="translate(-50.59 -252.544)" fill="#1876f2"/> \
                <path id="Path_564" data-name="Path 564" d="M182.835,55.424a2.322,2.322,0,0,1-1.09,2.007.791.791,0,0,0-.271.883.065.065,0,0,0,.006.017,2.048,2.048,0,0,1-.158,1.49,3.642,3.642,0,0,1-2.564,1.474,15.205,15.205,0,0,1-4.207.129h-.1a57.239,57.239,0,0,1-7.54-.412H166.9l-.035,0a.569.569,0,0,1-.5-.571V51a2.406,2.406,0,0,0-.071-.577.572.572,0,0,1,.008-.3,4.815,4.815,0,0,1,1-1.8.55.55,0,0,1,.063-.058c2.593-2.1,5.118-9.007,5.228-9.308a.735.735,0,0,0,.035-.389,5.291,5.291,0,0,1-.047-1.094.564.564,0,0,1,.712-.505,1.873,1.873,0,0,1,1.044.7c.592.818.568,2.28-.07,4.218-.974,2.953-1.056,4.508-.284,5.192a1.259,1.259,0,0,0,1.238.236l.054-.016c.344-.078.671-.146.982-.2l.075-.017c1.781-.389,4.971-.627,6.079.383a1.669,1.669,0,0,1,.2,2.118.775.775,0,0,0,.139,1.009,2.2,2.2,0,0,1,.644,1.352,2.157,2.157,0,0,1-.725,1.566.779.779,0,0,0-.116.928l.015.026A2.421,2.421,0,0,1,182.835,55.424Z" transform="translate(-158.874 -36.98)" fill="#1876f2"/> \
            </g> \
        ');
    } else {
        self.parents('.like-button-container').find('.like-action svg').attr('width', '24.523').attr('height', '24.557').attr('viewBox', '0 0 24.523 24.557');
        self.parents('.like-button-container').find('.like-action svg').html('\
            <!-- Liked --> \
            \
            <g id="like_" data-name="like " transform="translate(0 0.034)"> \
                <path id="Path_563" data-name="Path 563" d="M56.364,265.475v10.4a.936.936,0,0,1-.935.935h-3.9v.006a.936.936,0,0,1-.935-.935V265.475a.936.936,0,0,1,.935-.935h3.9A.936.936,0,0,1,56.364,265.475Z" transform="translate(-50.59 -252.544)" fill="#555555"/> \
                <path id="Path_564" data-name="Path 564" d="M182.835,55.424a2.322,2.322,0,0,1-1.09,2.007.791.791,0,0,0-.271.883.065.065,0,0,0,.006.017,2.048,2.048,0,0,1-.158,1.49,3.642,3.642,0,0,1-2.564,1.474,15.205,15.205,0,0,1-4.207.129h-.1a57.239,57.239,0,0,1-7.54-.412H166.9l-.035,0a.569.569,0,0,1-.5-.571V51a2.406,2.406,0,0,0-.071-.577.572.572,0,0,1,.008-.3,4.815,4.815,0,0,1,1-1.8.55.55,0,0,1,.063-.058c2.593-2.1,5.118-9.007,5.228-9.308a.735.735,0,0,0,.035-.389,5.291,5.291,0,0,1-.047-1.094.564.564,0,0,1,.712-.505,1.873,1.873,0,0,1,1.044.7c.592.818.568,2.28-.07,4.218-.974,2.953-1.056,4.508-.284,5.192a1.259,1.259,0,0,0,1.238.236l.054-.016c.344-.078.671-.146.982-.2l.075-.017c1.781-.389,4.971-.627,6.079.383a1.669,1.669,0,0,1,.2,2.118.775.775,0,0,0,.139,1.009,2.2,2.2,0,0,1,.644,1.352,2.157,2.157,0,0,1-.725,1.566.779.779,0,0,0-.116.928l.015.026A2.421,2.421,0,0,1,182.835,55.424Z" transform="translate(-158.874 -36.98)" fill="#555555"/> \
            </g> \
        ');
    }
    axios.get(url)
        .then(res => {
            switch (res.data) {
                case 1:
                    self.removeClass('not-liked');
                    self.parents('.like-button-container').find('.like-action svg').attr('width', '24.523').attr('height', '24.557').attr('viewBox', '0 0 24.523 24.557');
                    self.parents('.like-button-container').find('.like-action svg').html('\
                        <!-- Liked --> \
                        <g id="like_" data-name="like " transform="translate(0 0.034)"> \
                            <path id="Path_563" data-name="Path 563" d="M56.364,265.475v10.4a.936.936,0,0,1-.935.935h-3.9v.006a.936.936,0,0,1-.935-.935V265.475a.936.936,0,0,1,.935-.935h3.9A.936.936,0,0,1,56.364,265.475Z" transform="translate(-50.59 -252.544)" fill="#1876f2"/> \
                            <path id="Path_564" data-name="Path 564" d="M182.835,55.424a2.322,2.322,0,0,1-1.09,2.007.791.791,0,0,0-.271.883.065.065,0,0,0,.006.017,2.048,2.048,0,0,1-.158,1.49,3.642,3.642,0,0,1-2.564,1.474,15.205,15.205,0,0,1-4.207.129h-.1a57.239,57.239,0,0,1-7.54-.412H166.9l-.035,0a.569.569,0,0,1-.5-.571V51a2.406,2.406,0,0,0-.071-.577.572.572,0,0,1,.008-.3,4.815,4.815,0,0,1,1-1.8.55.55,0,0,1,.063-.058c2.593-2.1,5.118-9.007,5.228-9.308a.735.735,0,0,0,.035-.389,5.291,5.291,0,0,1-.047-1.094.564.564,0,0,1,.712-.505,1.873,1.873,0,0,1,1.044.7c.592.818.568,2.28-.07,4.218-.974,2.953-1.056,4.508-.284,5.192a1.259,1.259,0,0,0,1.238.236l.054-.016c.344-.078.671-.146.982-.2l.075-.017c1.781-.389,4.971-.627,6.079.383a1.669,1.669,0,0,1,.2,2.118.775.775,0,0,0,.139,1.009,2.2,2.2,0,0,1,.644,1.352,2.157,2.157,0,0,1-.725,1.566.779.779,0,0,0-.116.928l.015.026A2.421,2.421,0,0,1,182.835,55.424Z" transform="translate(-158.874 -36.98)" fill="#1876f2"/> \
                        </g> \
                    ');
                    self.removeClass('blocked');
                    break;

                case 2:
                    self.parents('.like-button-container').find('.like-action svg').attr('width', '22.507').attr('height', '24.557').attr('viewBox', '0 0 24.523 24.557');
                    self.parents('.like-button-container').find('.like-action svg').html('\
                        <!-- Not Liked --> \
                          <g id="like_" data-name="like " transform="translate(0 0.034)"> \
                            <path id="Path_563" data-name="Path 563" d="M56.364,265.475v10.4a.936.936,0,0,1-.935.935h-3.9v.006a.936.936,0,0,1-.935-.935V265.475a.936.936,0,0,1,.935-.935h3.9A.936.936,0,0,1,56.364,265.475Z" transform="translate(-50.59 -252.544)" fill="#555555"/> \
                            <path id="Path_564" data-name="Path 564" d="M182.835,55.424a2.322,2.322,0,0,1-1.09,2.007.791.791,0,0,0-.271.883.065.065,0,0,0,.006.017,2.048,2.048,0,0,1-.158,1.49,3.642,3.642,0,0,1-2.564,1.474,15.205,15.205,0,0,1-4.207.129h-.1a57.239,57.239,0,0,1-7.54-.412H166.9l-.035,0a.569.569,0,0,1-.5-.571V51a2.406,2.406,0,0,0-.071-.577.572.572,0,0,1,.008-.3,4.815,4.815,0,0,1,1-1.8.55.55,0,0,1,.063-.058c2.593-2.1,5.118-9.007,5.228-9.308a.735.735,0,0,0,.035-.389,5.291,5.291,0,0,1-.047-1.094.564.564,0,0,1,.712-.505,1.873,1.873,0,0,1,1.044.7c.592.818.568,2.28-.07,4.218-.974,2.953-1.056,4.508-.284,5.192a1.259,1.259,0,0,0,1.238.236l.054-.016c.344-.078.671-.146.982-.2l.075-.017c1.781-.389,4.971-.627,6.079.383a1.669,1.669,0,0,1,.2,2.118.775.775,0,0,0,.139,1.009,2.2,2.2,0,0,1,.644,1.352,2.157,2.157,0,0,1-.725,1.566.779.779,0,0,0-.116.928l.015.026A2.421,2.421,0,0,1,182.835,55.424Z" transform="translate(-158.874 -36.98)" fill="#555555"/> \
                        </g> \
                    ').addClass('not-liked');
                    self.removeClass('blocked');
                    break;

                default:
                    Swal.fire(
                        dataPostWishlistActionTitleError.innerText,
                        dataPostWishlistActionDescriptionError.innerText,
                        'warning'
                    );
                    self.removeClass('blocked');
            }
        }).catch(res => {
        Swal.fire(
            dataPostWishlistActionTitleError.innerText,
            dataPostWishlistActionDescriptionError.innerText,
            'error'
        );
        self.removeClass('blocked');
    });
});

// Wishlist searches action
$(document).on('click', '.wishlist-action-searches', function (e) {
    e.preventDefault();
    let self = $(this);
    let url = self.attr('data-url');
    axios.get(url)
        .then(res => {
            switch (res.data) {
                case 1:
                    self.parents('.item-card-row').remove();
                    break;

                default:
                    Swal.fire(
                        dataSearchesWishlistActionTitleError.innerText,
                        dataSearchesWishlistActionDescriptionError.innerText,
                        'warning'
                    );
            }
        }).catch(res => {
        Swal.fire(
            dataSearchesWishlistActionTitleError.innerText,
            dataSearchesWishlistActionDescriptionError.innerText,
            'error'
        );
    });
});

// Wishlist users action
$(document).on('click', '.wishlist-action-users', function (e) {
    e.preventDefault();
    let self = $(this);
    let url = self.attr('data-url');
    axios.get(url)
        .then(res => {
            switch (res.data) {
                case 1:
                    self.parents('.item-card-row').remove();
                    break;

                default:
                    Swal.fire(
                        dataUserWishlistActionTitleError.innerText,
                        dataUserWishlistActionDescriptionError.innerText,
                        'warning'
                    );
            }
        }).catch(res => {
        Swal.fire(
            dataUserWishlistActionTitleError.innerText,
            dataUserWishlistActionDescriptionError.innerText,
            'error'
        );
    });
});

// Mobile Menu ________________________________
// console.clear();
const navExpand = [].slice.call(document.querySelectorAll('.nav-expand'));
const backLink = `<li class="nav-item"><a class="nav-link nav-back-link" href="javascript:;"> Back </a></li>`;
navExpand.forEach(item => {

}); // ---------------------------------------
// not-so-important stuff starts here

$(document).on('click', '#ham', function () {
    $('.nav-is-toggled').stop().slideToggle();
});

$(document).on('click', '.mobile-search-icon', function () {
    $(this).hide();
    $('.mobile-search-input').focus();
    $('.mobile-search-icon-loop').show();
});

$(document).on('focus', '.mobile-search-input', function () {
    $('.mobile-search-icon').hide();
    $(this).focus();
    $('.mobile-search-icon-loop').show();
});

$(document).on('click', '.mobile-search-icon-loop', function (e) {
    e.preventDefault();
    $(this).parents('form').submit();
});

$(document).on('blur', '.mobile-search-input', function () {
    if ($(this).val() == '' && !$(this).hasClass('mobile-search-icon-loop')) {
        $('.mobile-search-icon').show();
        $('.mobile-search-icon-loop').hide();
    }
});


$('ul.mobile-submenu').eq(0).show();

$(document).on('click', '.mobile-menu-container ul li .icon', function () {
    $(this).next('ul.mobile-submenu').stop().slideToggle();
});

var mobileMenuCounter = 0;
var mobileMenuUserLinksCounter = 0;
$(document).on('click', '.mobile-menu-bar', function () {
    mobileMenuUserLinksCounter = 0;
    mobileMenuCounter++;
    $('.calculator-menu-contnet').stop().slideUp();
    $('.user-list-items-mobiles').stop().animate({'right': -100 + '%'}, 300);
    if (mobileMenuCounter % 2 != 0) {
        $('.mobile-menu-container').stop().animate({'left': 0 + 'px', 'right': 0 + 'px'}, 300);
    } else {
        $('.mobile-menu-container').stop().animate({'left': -100 + '%', 'right': 100 + '%'}, 300);
    }
});

$(document).on('click', '.user-mobile-img', function () {
    mobileMenuUserLinksCounter++;
    mobileMenuCounter = 0;
    $('.calculator-menu-contnet').stop().slideUp();
    $('.mobile-menu-container').stop().animate({'left': -100 + '%', 'right': 100 + '%'}, 300);
    if (mobileMenuUserLinksCounter % 2 != 0) {
        $('.user-list-items-mobiles').stop().animate({'right': 0 + 'px'}, 300);
    } else {
        $('.user-list-items-mobiles').stop().animate({'right': -100 + '%'}, 300);
    }
});

$(document).on('click', '.calculator-mobile', function () {
    $('.calculator-menu-contnet').stop().slideToggle();
});

$(document).on('click', '.create-post-cats li', function (e) {
    // alert()
    e.preventDefault();
    e.stopPropagation();
    if ($(this).hasClass('li-0')) {
        // alert()
        console.log($(this).find('.submenu-select').css('visibility'))
        if ($(this).find('.submenu-select').css('visibility') == 'hidden') {
// alert('ayoo')
            $('ul.submenu-select').stop().hide();
            $(this).find('.submenu-select').css('visibility', 'visible');
            console.log($(this).find('.submenu-select'))
            // $('.submenu-select').css('display','none!important');

        } else {
            // alert();
            // $(this).find('.submenu-select').css('display','block');

            $(this).find('.submenu-select').css('visibility', 'hidden');

        }

    }
    if ($(this).hasClass('finishCat')) {
        $('.finishCat').css({'border': 'none', 'padding': '0', 'border-radius': '0px', 'box-sizing': 'border-box'});
        $(this).css({
            'border': '0.5px solid black',
            'padding': '10px',
            'border-radius': '7px',
            'box-sizing': 'border-box'
        });
        $('input[name="main_name"]').val($(this).text().replace(/\s/g, ''));
        $('input[name="category_id"]').val($(this).attr('category_id').replace(/\s/g, ''));
    }
    $(this).find('ul').eq(0).stop().show();
});


// Listen Messages Socket

// Check Url Contains Or No

var arr_url = window.location.href.split('/');
console.log(arr_url);

// Check value isset in array
function inArray(needle, haystack) {
    var length = haystack.length;
    for (var i = 0; i < length; i++) {
        if (haystack[i] == needle) return true;
    }
    return false;
}

console.log(inArray('conversation', arr_url));
console.log($('#active_chat_user').length);

var active_user_id = 0;
if ($('#active_chat_user').length > 0) {
    var active_user_id = $('#active_chat_user').val();
    var elem = $('a[data-id=' + active_user_id + ']');
    elem.parent().addClass('active');
}
console.log(active_user_id);
var initialRender = true;
var auth_id = $('#auth_id').val();
var receiver_id = active_user_id;
setTimeout(function () {
    var rootRef = firebase.database().ref("messages/");
    rootRef.on('value', (snapshot) => {
        console.log('miacav')
        if (initialRender) {
            initialRender = false;
        } else {
            var data = snapshot.val();
            console.log(data);
            console.log(receiver_id);
            console.log(auth_id);
            if (auth_id != 0 && receiver_id != 0) {
                var encode_data = (parseInt(auth_id) * parseInt(receiver_id)) - (parseInt(auth_id) + parseInt(receiver_id))
                console.log(encode_data)
                console.log(data[encode_data]);
                last_message = Object.keys(data[encode_data])[Object.keys(data[encode_data]).length - 1];
                last_elem = data[encode_data][last_message];
                console.log(data[encode_data][last_message]);
                console.log(last_elem.receiverId);
                console.log($('#user-notify-menu' + last_elem.receiverId));
                if (last_elem.senderId == auth_id) {
                    // console.log($('.newMessageContnet' + senderUserId));
                    // console.log($('.newMessageContnet' + receiverUserId));
                    // Mesasge append to conversation
                    $('#newMessageContnet' + last_elem.senderId).append(' \
            <!-- Contnet --> \
            <div class="row no-gutters w-100 d-block mt-2 float-right my-4 position-relative m-item m-item-m new-added"> \
                <!-- URL --> \
                <a href="#"> \
                    <!-- My Image --> \
                    <img class="d-inline-block float-right rounded-circle" width="45px" src="' + myImg + '" title="' + fullName + '" alt="' + fullName + '"> \
                </a> \
                <div class="p-2 rounded mr-2 float-right d-inline bg-light w-75"> \
                    <span class="text-message">' + last_elem.message + '</span> \
                    <div class="w-100 d-block"> \
                        <small class="text-muted float-right"><i class="far fa-clock"></i> ' + $('#dataSendMessageNow').text() + '</small> \
                    </div> \
                </div> \
                <div class="clearfix"></div> \
            </div> ');

                    // Scroll to down
                    $('.messages-section').scrollTop($('.messages-section')[0].scrollHeight);
                } else {
                    // I am received message
                    // Get my user fullname
                    const fullName_friend = $('.friend-user').text();

                    // Get friend user img
                    const friendImg = $('.friend-image').attr('src');

                    // Get friend user link
                    const friendLink = $('.friend-link').attr('href');

                    // Add alert to alerts list
                    $('.alerts-section').prepend(' \
            <!-- Alert --> \
            <a href="' + friendLink + '" class="alert alert-warning alert-dismissible fade show w-100 d-block" role="alert"> \
                <!-- Sender Data --> \
                <strong>' + fullName_friend + '</strong>  \
                <!-- Description --> \
                <div class="w-100 d-block clearfix"> \
                    ' + last_elem.message + '\
                </div>\
                <!-- Break -->\
                <hr>\
                <!-- Time -->\
                <div class="w-100 d-block clearfix">\
                    <i class="far fa-clock"></i> Now\
                </div>\
                <!-- Close Button -->\
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
            </a>\
        ');
                    // Mesasge append to conversation
                    $('#newMessageContnet' + last_elem.receiverId).append(' \
            <!-- Contnet --> \
            <div class="row no-gutters w-100 d-block mt-2 float-right my-4 position-relative m-item-m"> \
                <!-- URL --> \
                <a href="' + friendLink + '"> \
                    <!-- My Image --> \
                    <img class="d-inline-block float-left rounded-circle" width="45px" src="' + friendImg + '" title="' + fullName_friend + '" alt="' + fullName_friend + '"> \
                </a> \
                <div class="p-2 rounded mr-2 float-left d-inline bg-light w-75"> \
                    <span class="text-message">' + last_elem.message + '</span> \
                    <div class="w-100 d-block"> \
                        <small class="text-muted float-left"><i class="far fa-clock"></i> ' + $('#dataSendMessageNow').text() + '</small> \
                    </div> \
                </div> \
                <div class="clearfix"></div> \
            </div> ');

                    // Scroll to down
                    if ($('#new-message-in-user-list' + last_elem.senderId).length == 0) {
                        $('#chat-user-list' + last_elem.senderId).append('<span class="real-message-impuls">\n' +
                            '<i class="fas fa-circle new-message-in-user-list" id="new-message-in-user-list' + last_elem.senderId + '"></i>\n' +
                            '</span>');
                    }
                    $('.messages-section').scrollTop($('.messages-section')[0].scrollHeight);
                }
                $('textarea[form=sendMessageForm]').val("");

                // console.log(inArray('conversation', arr_url));
                // console.log(receiver_id);
                // if (!inArray('conversation', arr_url) && receiver_id != 0) {
                // alert();

                // }

            } else {
                console.log(auth_id)
                var rootconversation = firebase.database().ref("last_added/");
                rootconversation.on('value', (snapshot) => {
                    console.log('miacav_erkrord')
                    var data_current_conversation = snapshot.val();
                    console.log(data_current_conversation.receiverId)
                    console.log(data_current_conversation.senderId)
                    console.log($('#user-notify-menu' + data_current_conversation.receiverId))
                    console.log($('#chat-user-list' + data_current_conversation.senderId))
                    if ($('#new-message-in-user-list' + data_current_conversation.senderId).length == 0) {
                        $('#chat-user-list' + data_current_conversation.senderId).append('<span class="real-message-impuls">\n' +
                            '<i class="fas fa-circle new-message-in-user-list" id="new-message-in-user-list' + data_current_conversation.senderId + '"></i>\n' +
                            '</span>');
                    }
                    if ($('#message_icon').length == 0) {
                        $('#user-notify-menu' + data_current_conversation.receiverId).append('<span class="bg-danger messages-count" id="message_icon">\n' +
                            '<i class="fas fa-spinner fa-comment-dots"></i>\n' +
                            '</span>');
                    }

                })

            }
        }
    });
    // rootRef.off();
}, 1000)

$(document).on('submit', '#sendMessageForm', function (e) {
    // Disabled default events
    console.log('ha ba');
    e.preventDefault();
    // Get this
    let self = $(this);
    // Get form inputs data
    var dataString = new FormData(this);
    receiver_id = self.attr('action').substring(self.attr('action').lastIndexOf('/') + 1);
    var sender_id = self.attr('data-id');
    var messaage = $('textarea[form=sendMessageForm]').val();
    const dateNow = Date.now();
    console.log(receiver_id);
    console.log(sender_id);
    console.log(messaage);
    var bazm = parseInt(sender_id) * parseInt(receiver_id);
    var gum = parseInt(sender_id) + parseInt(receiver_id);
    var encode_path = bazm - gum;
    var rootRef = firebase.database().ref("messages/" + encode_path);
    var rootconversation = firebase.database().ref("last_added/");
    var today = new Date();
    var time = today.getHours() + ":" + today.getMinutes();
    // Firebase realtime database chat Logic
    // $('.newMessageContnet').html("");
    var unique_key = rootRef.push().key;
    // rootRef.off();
    rootRef.child(unique_key).set({
        "senderId": sender_id,
        "receiverId": receiver_id,
        "message": messaage,
        "created_at": time,

    });
    // rootRef.off();
    rootconversation.set({
        "senderId": sender_id,
        "receiverId": receiver_id,
    });
    console.log(encode_path);
    console.log(unique_key);
    // End Firebase Code
    // Send data to controller
    axios.post(self.attr('action'), dataString)
        .then(res => {
            if (res.data) { // Request sned and get success
                // Scroll to down
                console.log(res.data)
                $('.messages-section').scrollTop($('.messages-section')[0].scrollHeight);
                console.log($('#sendMessageForm').closest('.chat-messenger-section').prev().find('.chat-row').find('.chat-section').find('.messages-section'));

                // Clear text from textarea
                $('textarea[form="sendMessageForm"]').val('');
                // $('.chat-user-list a').trigger('click');
            } else {
                // Reload Page
                location.reload();
            }
        }).catch(res => { // Request error
        // Reload Page
        location.reload();
    });
});
