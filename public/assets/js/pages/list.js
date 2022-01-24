var row_count = $('#top_size').data('row');
var show_count = $('#top_size').data('show');
if ($(window).width() < 1025 && $(window).width() > 768) {
    if ($('#top_size').hasClass('spare_show')) {
        show_count = 3;
    } else {
        show_count = 4;
    }
}

if ($(window).width() < 770) {

    if ($('#top_size').hasClass('spare_show')) {
        show_count = 2;
    }
// css('display','none!important');
    $('#in_slider_variant').addClass('d-none');
    $('#in_slider_variant_2').addClass('d-none');
    $('#in_slider_variant_mob').removeClass('d-none');


} else {

    $('#in_slider_variant').removeClass('d-none');
    $('#in_slider_variant_2').removeClass('d-none');
    $('#in_slider_variant_mob').addClass('d-none');

}
// alert(show_count)
$('#slick1').slick({
    rows: row_count,
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: show_count,
    slidesToScroll: 1,
    focusOnSelect: false,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 770,
            settings: {
                slidesToShow: $('#top_size').hasClass('spare_show') ? show_count : 3,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: $('#top_size').hasClass('spare_show') ? 1 : 2
            },
        }

    ]
});

$('#slick1-spare-store').slick({
    rows: row_count,
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 1,
    focusOnSelect: false,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 770,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 380,
            settings: {
                slidesToShow: 2
            }
        },
    ]
});

$('#slick2').slick({
    rows: row_count,
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: show_count,
    slidesToScroll: 1,
    focusOnSelect: false,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 380,
            settings: {
                slidesToShow: 1
            }
        },
    ]
});

// auto slider
$('.custom-slider-auto').slick({
    slidesToShow: 15,
    slidesToScroll: 5,
    autoplay: true,
    autoplaySpeed: 1500,
    infinite: true,
    dots: false,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 12,
                slidesToScroll: 3,
            }
        },
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 2,
            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 400,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 1,
            }
        }
    ]
});

let sub_count = $('#sub_cats_count').val();
let show_sub_count = parseInt(sub_count) + 2;
// let show_sub_count = 8
let show_sub_count_1200 = 6;
let show_sub_count_900 = 5;
let show_sub_count_550 = 4;
let show_sub_count_450 = 3;
// if (sub_count < 7){

// if (sub_count > 3){

// show_sub_count = show_sub_count - (show_sub_count - sub_count);
//
// show_sub_count_1200 = show_sub_count_1200 - (show_sub_count_1200 - sub_count);
// show_sub_count_900 = show_sub_count_900 - (show_sub_count_900 - sub_count);
// show_sub_count_550 = show_sub_count_550 - (show_sub_count_550 - sub_count);
// show_sub_count_450 = show_sub_count_450 - (show_sub_count_450 - sub_count);

// }
//     else {
//
//         show_sub_count = 7
//     }
//
// }
// alert(sub_count);
// Sub categories slider
// alert()
$('.custom-slider').slick({
    slidesToShow: 5,
    slidesToScroll: 5,
    autoplay: true,
    autoplaySpeed: 8000,
    infinite: true,
    pauseOnHover: true,
    pauseOnFocus: true,
    dots: true,
    prevArrow: false,
    nextArrow: false,
    responsive: [
        {
            breakpoint: 2600,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 7,
            }
        },
        {
            breakpoint: 1450,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 5,
            }
        },
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
            }
        },
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
        },
        {
            breakpoint: 400,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
        }
    ]
});

// Special categories slider
$('.custom-slider-2').slick({
    slidesToShow: 21,
    slidesToScroll: 4,
    autoplay: true,
    autoplaySpeed: 4000,
    infinite: true,
    dots: false,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 16,
            }
        },
        {
            breakpoint: 900,
            settings: {
                slidesToShow: 12,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 9,
            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 6,
            }
        },
        {
            breakpoint: 400,
            settings: {
                slidesToShow: 6,
            }
        }
    ]
});

// Make Filter Counter
let counterFilter = 0;

// Show filters mobile event
$('body').on('click', '.show-filters', function () {
    // Show or Hide Section
    $('.filters-bar').stop().slideToggle()

    // Increment
    counterFilter++;

    // Check data
    if (counterFilter % 2 == 0) {
        // Set this text
        $(this).html($(this).attr('data-show'));

        // Click slider 2
        $('.custom-slider-2').find('.slick-slide').indexOf(1).click();
        $('.custom-slider-auto').find('.slick-slide').indexOf(1).click();

        // Click slider
        $('.custom-slider').find('.slick-slide').indexOf(1).click();
    } else {
        // Set this text
        $(this).html($(this).attr('data-close'));
    }
});

// FILTER
// alert()

// $(document).on('click')
$(document).on('click', '.cat-subitems .custom-box-2', function (e) {

    e.preventDefault();
    const self = $(this);

    // Remove all active classes
    $('.cat-subitems .custom-box-2').removeClass('active');

    // Add active class
    $(this).addClass('active');

    // Get action
    let action = self.attr('data-url');

    // Spliting action with segments
    let segments = action.split('/');
    // Get this


    // Get category_id value
    let category_id = self.attr('data-id');

    // Check category_id data
    // if (category_id == null || category_id == '' || category_id == undefined) {
    //     // Make default value
    //
    //     category_id = 0;
    //     category_id =
    // }
    // Get min price value
    let min_year_spare = $('input[name="min_year_spare"]').val();

    // Check min price data
    if (min_year_spare == null || min_year_spare == '' || min_year_spare == undefined) {
        // Make default value
        min_year_spare = 1990;
    }

    // Get max price value
    let max_year_spare = $('input[name="max_year_spare"]').val();

    // Check max price data
    if (max_year_spare == null || max_year_spare == '' || max_year_spare == undefined) {
        // Make default value
        max_year_spare = 2021;
        // Number(filterMaxiumPriceValue.innerText);
    }

    // Get brand value
    let brand = 'default';
    let brand_elem = document.getElementsByName('brand')[0];
    if (brand_elem != undefined) {
        brand = brand_elem['options'][brand_elem['selectedIndex']].value
        if (brand == null) {
            brand = 'default';
        }
    }
    // Get brand value
    let model = 'default';
    let model_elem = document.getElementsByName('model')[0];
    if (model_elem != undefined) {
        model = model_elem['options'][model_elem['selectedIndex']].value
        if (model == null) {
            model = 'default';
        }
    }


    // Get location value
    let location = 0;
    let location_elem = document.getElementsByName('location_spare')[0];
    if (location_elem != undefined) {

        location = location_elem['options'][location_elem['selectedIndex']].value
        // Check location data
        if (location == null) {
            // Make default value
            location = 0;
        }

    }


    if ($('input[name="search_value"]').val() == '' || $('input[name="search_value"]').val() == null) {
        search_value = 'default';
    } else {
        search_value = $('input[name="search_value"]').val();
    }
    // category_id = 78;
    console.log(category_id, location, min_year_spare, max_year_spare, brand, model, search_value, url)
    // Set url segments
    segments[5] = category_id;
    segments[6] = location;
    segments[7] = min_year_spare;
    segments[8] = max_year_spare;
    segments[9] = brand;
    segments[10] = model;
    segments[11] = search_value;
    segments[12] = 'submit';


    // Make new url
    var url = "";

    // Loop from segments
    segments.forEach(urlGenerating);

    // Make url generation function
    function urlGenerating(value, index, array) {
        // Check index
        if (index == Number(segments.length - 1)) { // Last item
            // Add value from url
            url = url + value;
        } else { // Any item exept last
            // Add value from url
            url = url + value + "/";
        }
    }

    console.log(url)
    // // Make new special inpust url

    // Send data to controller
    axios.get(url)
        .then(res => {

            // Categories blocks shows and hides


            if ($(window).width() < 770) {

                setTimeout(function () {
                    //   $('#in_slider_variant_mob').removeClass('d-none')
                    $('#in_slider_variant').addClass('d-none');
                    $('#in_slider_variant_2').addClass('d-none');


                }, 200);

            } else {

                setTimeout(function () {
                    $('#in_slider_variant_mob').addClass('d-none');
                    $('#in_slider_variant').removeClass('d-none');
                    $('#in_slider_variant_2').removeClass('d-none');
                }, 200);


            }

            // Reintializate lazy loading
            $(function () {
                $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0});
            });

            // Push items
            $('.list-page-content-full').html(res.data);
            // Posts two row slider
            $('#slick1').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: show_count,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 770,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2
                        },
                    },

                ]
            });

            $('#slick1-spare-store').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 770,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 380,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                ]
            });

            $('#slick2').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: show_count,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 380,
                        settings: {
                            slidesToShow: 1
                        }
                    },
                ]
            });

            // Sub categories slider

            $('.custom-slider').slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                pauseOnHover: true,
                pauseOnFocus: true,
                dots: false,
                prevArrow: false,
                nextArrow: false,
                responsive: [
                    {
                        breakpoint: 2600,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 7,
                        }
                    },
                    {
                        breakpoint: 1450,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    }
                ]
            });

// auto slider
            $('.custom-slider-auto').slick({
                slidesToShow: 15,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 12,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
            // Special categories slider
            $('.custom-slider-2').slick({
                slidesToShow: 21,
                slidesToScroll: 4,
                autoplay: true,
                autoplaySpeed: 4000,
                infinite: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 16,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 12,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 9,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 6,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 6,
                        }
                    }
                ]
            });

            // Get url segment
            var urlSegment = new URL(url);
            // Push new data to url

            window.history.pushState("", "", urlSegment.pathname);
        }).catch(res => { // Request error
        alert('Error :(');
    });

})
// Items list select subcategory event
$(document).on('click', '.cat-subitems .custom-box', function (e) {
    // Disabled all default events

    e.preventDefault();

    // Get this
    const self = $(this);

    // Remove all active classes
    $('.cat-subitems .custom-box').removeClass('active');

    // Add active class
    $(this).addClass('active');

    // Get action
    let action = self.attr('data-url');

    // Spliting action with segments
    let segments = action.split('/');

    // Push input value
    $('input[name="category_id"]').val($(this).attr('data-id'));

    // Get category_id value
    let category_id = $('input[name="category_id"]').val();

    // Check category_id data
    if (category_id == null || category_id == '') {
        // Make default value
        category_id = 0;
    }

    // Get min price value
    let min_price = $('input[name="min_price"]').val();

    // Check min price data
    if (min_price == null || min_price == '') {
        // Make default value
        min_price = 0;
    }

    // Get max price value
    let max_price = $('input[name="max_price"]').val();

    // Check max price data
    if (max_price == null || max_price == '') {
        // Make default value
        max_price = Number(filterMaxiumPriceValue.innerText);
    }

    // Get post_type value
    let post_type = 'default';
    let post_elem = document.getElementsByName('post_type')[0];
    // console.log(post_elem)
    if (post_elem != undefined) {
        post_type = post_elem['options'][post_elem['selectedIndex']].value
        if (post_type == null) {
            post_type = 'default';
        }
    }
    console.log(post_type)
    // Get estate_type value
    let estate_type = 'default';
    let estate_elem = document.getElementsByName('estate_type')[0];
    if (estate_elem != undefined) {
        estate_type = estate_elem['options'][estate_elem['selectedIndex']].value
        if (estate_type == null) {
            estate_type = 'default';
        }
    }
    // Get electro_type value
    let electro_type = 'default';
    let electro_elem = document.getElementsByName('electro_type')[0];
    if (electro_elem != undefined) {
        electro_type = electro_elem['options'][electro_elem['selectedIndex']].value
        if (electro_type == null) {
            electro_type = 'default';
        }
    }
    // Get location value
    let location = 0;
    let location_elem = document.getElementsByName('location')[0];
    if (location_elem != undefined) {

        location = location_elem['options'][location_elem['selectedIndex']].value
        // Check location data
        if (location == null) {
            // Make default value
            location = 0;
        }

    }
    // Get auth_type value
    let auth_type = 'default';
    let auth_type_elem = document.getElementsByName('auth_type')[0];
    if (auth_type_elem != undefined) {

        auth_type = auth_type_elem['options'][auth_type_elem['selectedIndex']].value
        // Check location data
        if (auth_type == null) {
            // Make default value
            auth_type = 0;
        }

    }

    // Check search_value data
    if ($('input[name="search_value"]').val() == '' || $('input[name="search_value"]').val() == null) {
        search_value = 'default';
    } else {
        search_value = $('input[name="search_value"]').val();
    }
    // console.log(post_type)
    // console.log(location)
    // console.log(auth_type)
    // Set url segments
    // Set url segments
    segments[5] = category_id;
    segments[6] = location;
    segments[7] = min_price;
    segments[8] = max_price;
    segments[9] = post_type;
    segments[10] = auth_type;
    segments[11] = estate_type;
    segments[12] = electro_type;
    segments[13] = search_value;
    segments[14] = 'submit';

    // Make new url
    var url = "";

    // Loop from segments
    segments.forEach(urlGenerating);

    // Make url generation function
    function urlGenerating(value, index, array) {
        // Check index
        if (index == Number(segments.length - 1)) { // Last item
            // Add value from url
            url = url + value;
        } else { // Any item exept last
            // Add value from url
            url = url + value + "/";
        }
    }

    // Send data to controller
    axios.get(url)
        .then(res => {
            // Categories blocks shows and hides
            // Categories blocks shows and hides


            if ($(window).width() < 770) {

                setTimeout(function () {
                    //   $('#in_slider_variant_mob').removeClass('d-none')
                    $('#in_slider_variant').addClass('d-none');
                    $('#in_slider_variant_2').addClass('d-none');


                }, 200);

            } else {

                setTimeout(function () {
                    $('#in_slider_variant_mob').addClass('d-none');
                    $('#in_slider_variant').removeClass('d-none');
                    $('#in_slider_variant_2').removeClass('d-none');
                }, 200);


            }
            // Reintializate lazy loading
            $(function () {
                $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0});
            });

            // Push items
            $('.list-page-content-full').html(res.data);

            // // Check eleemt
            // if ($(".big-load-data-content").length > 0) {
            //     // Scroll to pined item
            //     setTimeout(function () {
            //         $('html, body').stop().animate({scrollTop: $(".big-load-data-content").offset().top - 100});
            //     }, 500);
            // }

            // Posts two row slider
            $('#slick1').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: show_count,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 770,
                        settings: {
                            slidesToShow: $('#top_size').hasClass('spare_show') ? show_count : 3,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: $('#top_size').hasClass('spare_show') ? 1 : 2
                        },
                    }

                ]
            });

            $('#slick1-spare-store').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 770,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 380,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                ]
            });

            $('#slick2').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: show_count,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 380,
                        settings: {
                            slidesToShow: 1
                        }
                    },
                ]
            });
            // Sub categories slider
            $('.custom-slider').slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                pauseOnHover: true,
                pauseOnFocus: true,
                dots: false,
                prevArrow: false,
                nextArrow: false,
                responsive: [
                    {
                        breakpoint: 2600,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 7,
                        }
                    },
                    {
                        breakpoint: 1450,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    }
                ]
            });
// auto slider
            $('.custom-slider-auto').slick({
                slidesToShow: 15,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 12,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
            // Special categories slider
            $('.custom-slider-2').slick({
                slidesToShow: 21,
                slidesToScroll: 4,
                autoplay: true,
                autoplaySpeed: 4000,
                infinite: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 16,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 12,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 9,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 6,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 6,
                        }
                    }
                ]
            });

            // Get url segment
            var urlSegment = new URL(url);

            // Push new data to url
            window.history.pushState("", "", urlSegment.pathname);
        }).catch(res => { // Request error
        console.log(res);
    });
});

// Items list select subcategory event
$(document).on('click', '.main-items .custom-box', function (e) {
    // Disabled all default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Remove all active classes
    $('.cat-subitems .custom-box').removeClass('active');

    // Add active class
    $(this).addClass('active');

    // Get action
    let action = self.attr('data-url');

    // Spliting action with segments
    let segments = action.split('/');

    // Push input value
    $('input[name="category_id"]').val($(this).attr('data-id'));

    // Get category_id value
    let category_id = $('input[name="category_id"]').val();

    // Check category_id data
    if (category_id == null || category_id == '') {
        // Make default value
        category_id = 0;
    }

    // Get min price value
    let min_price = $('input[name="min_price"]').val();

    // Check min price data
    if (min_price == null || min_price == '') {
        // Make default value
        min_price = 0;
    }

    // Get max price value
    let max_price = $('input[name="max_price"]').val();

    // Check max price data
    if (max_price == null || max_price == '') {
        // Make default value
        max_price = Number(filterMaxiumPriceValue.innerText);
    }

    // Get post_type value
    let post_type = 'default';
    let post_elem = document.getElementsByName('post_type')[0];
    // console.log(post_elem)
    if (post_elem != undefined) {
        post_type = post_elem['options'][post_elem['selectedIndex']].value
        if (post_type == null) {
            post_type = 'default';
        }
    }

    // Get estate_type value
    let estate_type = 'default';
    let estate_elem = document.getElementsByName('estate_type')[0];
    if (estate_elem != undefined) {
        estate_type = estate_elem['options'][estate_elem['selectedIndex']].value
        if (estate_type == null) {
            estate_type = 'default';
        }
    }
    // Get electro_type value
    let electro_type = 'default';
    let electro_elem = document.getElementsByName('electro_type')[0];
    if (electro_elem != undefined) {
        electro_type = electro_elem['options'][electro_elem['selectedIndex']].value
        if (electro_type == null) {
            electro_type = 'default';
        }
    }
    // Get location value
    let location = 0;
    let location_elem = document.getElementsByName('location')[0];
    if (location_elem != undefined) {

        location = location_elem['options'][location_elem['selectedIndex']].value
        // Check location data
        if (location == null) {
            // Make default value
            location = 0;
        }

    }

    // Get auth_type value
    let auth_type = 'default';
    let auth_type_elem = document.getElementsByName('auth_type')[0];
    if (auth_type_elem != undefined) {

        auth_type = auth_type_elem['options'][auth_type_elem['selectedIndex']].value
        // Check location data
        if (auth_type == null) {
            // Make default value
            auth_type = 0;
        }

    }


    // Check search_value data
    if ($('input[name="search_value"]').val() == '' || $('input[name="search_value"]').val() == null) {
        search_value = 'default';
    } else {
        search_value = $('input[name="search_value"]').val();
    }

    // Set url segments
    segments[5] = category_id;
    segments[6] = location;
    segments[7] = min_price;
    segments[8] = max_price;
    segments[9] = post_type;
    segments[10] = auth_type;
    segments[11] = estate_type;
    segments[12] = electro_type;
    segments[13] = search_value;
    segments[14] = 'submit';

    // Make new url
    var url = "";

    // Loop from segments
    segments.forEach(urlGenerating);

    // Make url generation function
    function urlGenerating(value, index, array) {
        // Check index
        if (index == Number(segments.length - 1)) { // Last item
            // Add value from url
            url = url + value;
        } else { // Any item exept last
            // Add value from url
            url = url + value + "/";
        }
    }

    // Send data to controller
    axios.get(url)
        .then(res => {

            // Categories blocks shows and hides


            if ($(window).width() < 770) {

                setTimeout(function () {
                    //   $('#in_slider_variant_mob').removeClass('d-none')
                    $('#in_slider_variant').addClass('d-none');
                    $('#in_slider_variant_2').addClass('d-none');


                }, 200);

            } else {
                setTimeout(function () {
                    $('#in_slider_variant_mob').addClass('d-none');
                    $('#in_slider_variant').removeClass('d-none');
                    $('#in_slider_variant_2').removeClass('d-none');
                }, 200);

            }

            // Reintializate lazy loading
            $(function () {
                $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0});
            });

            // Push items
            $('.list-page-content-full').html(res.data);

            // Check eleemt
            // scrool in posts by filter
            // if ($(".big-load-data-content").length > 0) {
            //     // Scroll to pined item
            //     setTimeout(function () {
            //         $('html, body').stop().animate({scrollTop: $(".big-load-data-content").offset().top - 100});
            //     }, 500);
            // }

            // Posts two row slider
            $('#slick1').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: show_count,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 770,
                        settings: {
                            slidesToShow: $('#top_size').hasClass('spare_show') ? show_count : 3,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: $('#top_size').hasClass('spare_show') ? 1 : 2
                        },
                    }

                ]
            });

            $('#slick1-spare-store').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 770,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 380,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                ]
            });

            $('#slick2').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: show_count,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 380,
                        settings: {
                            slidesToShow: 1
                        }
                    },
                ]
            });
            // Sub categories slider
            $('.custom-slider').slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                pauseOnHover: true,
                pauseOnFocus: true,
                dots: false,
                prevArrow: false,
                nextArrow: false,
                responsive: [
                    {
                        breakpoint: 2600,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 7,
                        }
                    },
                    {
                        breakpoint: 1450,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    }
                ]
            });
// auto slider
            $('.custom-slider-auto').slick({
                slidesToShow: 15,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 12,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
            // Special categories slider
            $('.custom-slider-2').slick({
                slidesToShow: 21,
                slidesToScroll: 4,
                autoplay: true,
                autoplaySpeed: 4000,
                infinite: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 16,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 12,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 9,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 6,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 6,
                        }
                    }
                ]
            });

            // Get url segment
            var urlSegment = new URL(url);

            // Push new data to url
            window.history.pushState("", "", urlSegment.pathname);
        }).catch(res => { // Request error
        console.log(res);
    });
});
$(document).on('click', '.hide_part_text', function () {

    let elem = $(this);

    $hide_filtrs = elem.parent().parent().prev().find('.hide_block');
    $in_show = elem.parent().parent().prev().find('.in_show');
    if ($hide_filtrs.length != 0) {

        $hide_filtrs.each(function () {

            $(this).removeClass('hide_block')
        })
        elem.parent().parent().prev().removeClass('hide_block')
    } else {
        $in_show.each(function () {

            $(this).addClass('hide_block')
        })
        elem.parent().parent().prev().addClass('hide_block')
    }

})
$(document).on('click', '.auto-brand-item', function () {

    let sel_brand = $(this).data('brand');
    $('[name="input_1"]').find('option').each(function () {

        if ($(this).val() == sel_brand) {
            $(this).prop('selected', true);

        }

    })

    $('#filteringForm').trigger('submit');

})
$(document).on('submit', '#filteringForm', function (e) {
    // alert()
    // Disabled all default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Get action
    let action = self.attr('action');

    // Spliting action with segments
    let segments = action.split('/');

    // Get category_id value
    let category_id = $('input[name="category_id"]').val();

    // Check category_id data
    if (category_id == null || category_id == '') {
        // Make default value
        category_id = 0;
    }
    // Get min price value
    let min_price = $('input[name="min_price"]').val();

    // Check min price data
    if (min_price == null || min_price == '') {
        // Make default value
        min_price = 0;
    }

    // Get max price value
    let max_price = $('input[name="max_price"]').val();

    // Check max price data
    if (max_price == null || max_price == '') {
        // Make default value
        max_price = Number(filterMaxiumPriceValue.innerText);
    }

    // Get post_type value
    let post_type = 'default';
    let post_elem = document.getElementsByName('post_type')[0];
    if (post_elem != undefined) {
        post_type = post_elem['options'][post_elem['selectedIndex']].value
        if (post_type == null) {
            post_type = 'default';
        }
    }
    // Get estate_type value
    let estate_type = 'default';
    let estate_elem = document.getElementsByName('estate_type')[0];
    if (estate_elem != undefined) {
        estate_type = estate_elem['options'][estate_elem['selectedIndex']].value
        if (estate_type == null) {
            estate_type = 'default';
        }
    }
    console.log(estate_type)
    // Get electro_type value
    let electro_type = 'default';
    let electro_elem = document.getElementsByName('electro_type')[0];
    if (electro_elem != undefined) {
        electro_type = electro_elem['options'][electro_elem['selectedIndex']].value
        if (electro_type == null) {
            electro_type = 'default';
        }
    }

    // Get location value
    let location = 0;
    let location_elem = document.getElementsByName('location')[0];
    if (location_elem != undefined) {

        location = location_elem['options'][location_elem['selectedIndex']].value
        // Check location data
        if (location == null) {
            // Make default value
            location = 0;
        }

    }
    console.log(location)
    // Get auth_type value
    let auth_type = 'default';
    let auth_type_elem = document.getElementsByName('auth_type')[0];
    if (auth_type_elem != undefined) {

        auth_type = auth_type_elem['options'][auth_type_elem['selectedIndex']].value
        // Check location data
        if (auth_type == null) {
            // Make default value
            auth_type = 0;
        }

    }
    console.log(auth_type)

    if ($('input[name="search_value"]').val() == '' || $('input[name="search_value"]').val() == null) {
        search_value = 'default';
    } else {
        search_value = $('input[name="search_value"]').val();
    }

    // Set url segments
    segments[5] = category_id;
    segments[6] = location;
    segments[7] = min_price;
    segments[8] = max_price;
    segments[9] = post_type;
    segments[10] = auth_type;
    segments[11] = estate_type;
    segments[12] = electro_type;
    segments[13] = search_value;
    segments[14] = 'submit';

    // Make new url
    var url = "";

    // Loop from segments
    segments.forEach(urlGenerating);

    // Make url generation function
    function urlGenerating(value, index, array) {
        // Check index
        if (index == Number(segments.length - 1)) { // Last item
            // Add value from url
            url = url + value;
        } else { // Any item exept last
            // Add value from url
            url = url + value + "/";
        }
    }

    // Make new special inpust url
    var specialInputsUrl = '';

    // Loop from segments
    $('.filterSpecialInput').each(urlGeneratingFromSpecialInput);

    // Make url generation function
    function urlGeneratingFromSpecialInput(value, index, array) {
        // Check data
        if ($(this).val() == '' || $(this).val() == null) {
            thisValue = 'filterValue';
        } else {
            thisValue = $(this).val();
        }

        // Add value from url
        specialInputsUrl += '|' + $(this).attr('name') + '=' + thisValue;
    }

    // Add filtering items to url
    // if (specialInputsUrl != ""){
    url += '?filters=' + specialInputsUrl;

    // }

    // console.log(url)
    // Send data to controller
    axios.get(url)
        .then(res => {

            // Categories blocks shows and hides


            if ($(window).width() < 770) {

                setTimeout(function () {
                    //   $('#in_slider_variant_mob').removeClass('d-none')
                    $('#in_slider_variant').addClass('d-none');
                    $('#in_slider_variant_2').addClass('d-none');


                }, 200);

            } else {

                setTimeout(function () {
                    $('#in_slider_variant_mob').addClass('d-none');
                    $('#in_slider_variant').removeClass('d-none');
                    $('#in_slider_variant_2').removeClass('d-none');
                }, 200);


            }


            // Reintializate lazy loading
            $(function () {
                $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0});
            });

            // Push items
            $('.list-page-content-full').html(res.data);

            // Check eleemt
            // if ($(".big-load-data-content").length > 0) {
            //     // Scroll to pined item
            //     setTimeout(function () {
            //         $('html, body').stop().animate({scrollTop: $(".big-load-data-content").offset().top - 100});
            //     }, 500);
            // }

            // Posts two row slider
            $('#slick1').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: show_count,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 770,
                        settings: {
                            slidesToShow: $('#top_size').hasClass('spare_show') ? show_count : 3,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: $('#top_size').hasClass('spare_show') ? 1 : 2
                        },
                    }

                ]
            });

            $('#slick1-spare-store').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 770,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 380,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                ]
            });

            $('#slick2').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: show_count,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 380,
                        settings: {
                            slidesToShow: 1
                        }
                    },
                ]
            });

            // Sub categories slider

            $('.custom-slider').slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                pauseOnHover: true,
                pauseOnFocus: true,
                dots: false,
                prevArrow: false,
                nextArrow: false,
                responsive: [
                    {
                        breakpoint: 2600,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 7,
                        }
                    },
                    {
                        breakpoint: 1450,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    }
                ]
            });
// auto slider
            $('.custom-slider-auto').slick({
                slidesToShow: 15,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 12,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
            // Special categories slider
            $('.custom-slider-2').slick({
                slidesToShow: 21,
                slidesToScroll: 4,
                autoplay: true,
                autoplaySpeed: 4000,
                infinite: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 16,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 12,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 9,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 6,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 6,
                        }
                    }
                ]
            });

            // Get url segment
            var urlSegment = new URL(url);
            // Push new data to url

            window.history.pushState("", "", urlSegment.pathname);
        }).catch(res => { // Request error
        alert('Error :(');
    });
});
// Trigger <a> category spare header cat

$(document).on('click', '.custom-box-parent-spare', function (e) {

    window.location = $(this).find(".link-spare-header-cat").attr("href");


})

$(document).on('submit', '#filteringFormSpare', function (e) {
    // alert()
    // Disabled all default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Get action
    let action = self.attr('action');

    // Spliting action with segments
    let segments = action.split('/');

    // Get category_id value
    let category_id = $('input[name="category_id"]').val();

    // Check category_id data
    if (category_id == null || category_id == '') {
        // Make default value
        category_id = 0;
    }
    // Get min price value
    let min_year_spare = $('input[name="min_year_spare"]').val();

    // Check min price data
    if (min_year_spare == null || min_year_spare == '') {
        // Make default value
        min_year_spare = 1990;
    }

    // Get max price value
    let max_year_spare = $('input[name="max_year_spare"]').val();

    // Check max price data
    if (max_year_spare == null || max_year_spare == '') {
        // Make default value
        max_year_spare = 2021;
        // Number(filterMaxiumPriceValue.innerText);
    }

    // Get brand value
    let brand = 'default';
    let brand_elem = document.getElementsByName('brand')[0];
    if (brand_elem != undefined) {
        brand = brand_elem['options'][brand_elem['selectedIndex']].value
        if (brand == null) {
            brand = 'default';
        }
    }
    // Get brand value
    let model = 'default';
    let model_elem = document.getElementsByName('model')[0];
    if (model_elem != undefined) {
        model = model_elem['options'][model_elem['selectedIndex']].value
        if (model == null) {
            model = 'default';
        }
    }


    // Get location value
    let location = 0;
    let location_elem = document.getElementsByName('location_spare')[0];
    if (location_elem != undefined) {

        location = location_elem['options'][location_elem['selectedIndex']].value
        // Check location data
        if (location == null) {
            // Make default value
            location = 0;
        }

    }
    console.log(location)

    if ($('input[name="search_value"]').val() == '' || $('input[name="search_value"]').val() == null) {
        search_value = 'default';
    } else {
        search_value = $('input[name="search_value"]').val();
    }

    // Set url segments
    segments[5] = category_id;
    segments[6] = location;
    segments[7] = min_year_spare;
    segments[8] = max_year_spare;
    segments[9] = brand;
    segments[10] = model;
    segments[11] = search_value;
    segments[12] = 'submit';


    // Make new url
    var url = "";

    // Loop from segments
    segments.forEach(urlGenerating);

    // Make url generation function
    function urlGenerating(value, index, array) {
        // Check index
        if (index == Number(segments.length - 1)) { // Last item
            // Add value from url
            url = url + value;
        } else { // Any item exept last
            // Add value from url
            url = url + value + "/";
        }
    }

    console.log(url)
    // // Make new special inpust url

    // Send data to controller
    axios.get(url)
        .then(res => {

            // Categories blocks shows and hides


            if ($(window).width() < 770) {

                setTimeout(function () {
                    //   $('#in_slider_variant_mob').removeClass('d-none')
                    $('#in_slider_variant').addClass('d-none');
                    $('#in_slider_variant_2').addClass('d-none');


                }, 200);

            } else {

                setTimeout(function () {
                    $('#in_slider_variant_mob').addClass('d-none');
                    $('#in_slider_variant').removeClass('d-none');
                    $('#in_slider_variant_2').removeClass('d-none');
                }, 200);


            }

            // Reintializate lazy loading
            $(function () {
                $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0});
            });

            // Push items
            $('.list-page-content-full').html(res.data);
            // Posts two row slider
            $('#slick1').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: show_count,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 770,
                        settings: {
                            slidesToShow: $('#top_size').hasClass('spare_show') ? show_count : 3,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: $('#top_size').hasClass('spare_show') ? 1 : 2
                        },
                    }

                ]
            });

            $('#slick1-spare-store').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: 5,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 770,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 380,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                ]
            });

            $('#slick2').slick({
                rows: row_count,
                dots: false,
                arrows: true,
                infinite: false,
                speed: 300,
                slidesToShow: show_count,
                slidesToScroll: 1,
                focusOnSelect: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 380,
                        settings: {
                            slidesToShow: 1
                        }
                    },
                ]
            });

            // Sub categories slider

            $('.custom-slider').slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                pauseOnHover: true,
                pauseOnFocus: true,
                dots: false,
                prevArrow: false,
                nextArrow: false,
                responsive: [
                    {
                        breakpoint: 2600,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 7,
                        }
                    },
                    {
                        breakpoint: 1450,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 5,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    }
                ]
            });

// auto slider
            $('.custom-slider-auto').slick({
                slidesToShow: 15,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 12,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 7,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    }
                ]
            });
            // Special categories slider
            $('.custom-slider-2').slick({
                slidesToShow: 21,
                slidesToScroll: 4,
                autoplay: true,
                autoplaySpeed: 4000,
                infinite: true,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 16,
                        }
                    },
                    {
                        breakpoint: 900,
                        settings: {
                            slidesToShow: 12,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 9,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 6,
                        }
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 6,
                        }
                    }
                ]
            });

            // Get url segment
            var urlSegment = new URL(url);
            // Push new data to url

            window.history.pushState("", "", urlSegment.pathname);
        }).catch(res => { // Request error
        alert('Error :(');
    });
});
