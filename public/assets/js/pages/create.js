// import {Cloudinary} from window.cloudinary;
// require('@cloudinary/url-gen');
// const paket = require('@cloudinary/url-gen');
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
// GET CURRENT LOCAL LANGUAGE

var current_url = window.location.href;
var array_current_url = current_url.split('/');
var lang_array = ['hy', 'ru', 'en'];
var current_lang = null;
function get_locale(value) {
    let lang = "";
    if (lang_array.indexOf(value) !== -1) {
        lang = value;
    }
    return lang;
}
current_lang = array_current_url.map(get_locale);
current_lang = current_lang.filter(function (el){
    return el != "";
})
current_lang = current_lang.length == 1 ? current_lang[0] : 'hy';
console.log(current_lang);

// END GETTING LOCAL LANGUAGE


$(document).ready(function () {

    if ($('#spare_min_year').val() !== undefined || $('#spare_min_year').val() !== "") {
        for (let i = 1990; i <= new Date().getFullYear(); i++) {
            if (i == $('#spare_min_year').val()) {
                $(".spare_year_start").each(function () {

                    if ($(this).attr('data-value') == i) {
                        $(this).append(`<option value="${i}" selected> ${i} </option>`)

                    } else {
                        $(this).append(`<option value="${i}"> ${i} </option>`)

                    }
                })

            } else {
                $(".spare_year_start").each(function () {
                    console.log($(this).attr('data-value'))
                    if ($(this).attr('data-value') == i) {
                        $(this).append(`<option value="${i}" selected> ${i} </option>`)

                    } else {
                        $(this).append(`<option value="${i}"> ${i} </option>`)

                    }

                })

            }

        }
    }
    if ($('#spare_max_year').val() !== undefined || $('#spare_max_year').val() !== "") {
        for (let i = 1990; i <= new Date().getFullYear(); i++) {

            if (i == $('#spare_max_year').val()) {
                $(".spare_year_end").each(function () {
                    if ($(this).attr('data-value') == i) {

                        $(this).append(`<option value="${i}" selected > ${i} </option>`)
                    } else {
                        $(this).append(`<option value="${i}"> ${i} </option>`)

                    }

                })
                // $(".spare_year_end").append(`<option value="${i}" selected>${i}</option>`)

            } else {

                $(".spare_year_end").each(function () {
                    if ($(this).attr('data-value') == i) {

                        $(this).append(`<option value="${i}" selected > ${i} </option>`)
                    } else {
                        $(this).append(`<option value="${i}"> ${i} </option>`)

                    }

                })

            }

        }

    }

})


$(".checkbox-menu").on("change", "input[type='checkbox']", function () {
    $(this).closest("li").toggleClass("active", this.checked);
});

$(document).on('click', '.allow-focus', function (e) {
    e.stopPropagation();
});
// Select_Type
$(document).on('click', '.sel_added_type', function (e) {

    e.preventDefault();
    $('input[name="added_post_type"]').val($(this).data('type'));
    let sel_type = $('input[name="added_post_type"]').val();
    const createUrl = $(this).parents('.categories-content').attr('action');
    if (sel_type != null || sel_type == undefined) {
        console.log(sel_type)
        // Send data to controller
        axios.get(createUrl, {
            params: {
                type: sel_type
            }
        }).then(res => {
            if (!('error' in res.data)) { // Request send and get success
                // Get currenct url
                console.log(res.data)
                const currentUrl = window.location.href;
                // Push new data to url
                window.history.pushState("", "", 'create-post/');
                // Set content information
                // Reintializate lazy loading

                $('#create-post-page').html(res.data.view);

            } else {
                alert("Error")
            }
        }).catch(res => { // Request error
            alert(res);
        });

    }

})
$('.iframe-a').on('click', function (e) {

    let videoSrc = "http://www.youtube.com/embed/" + $(this).data('key');
    $("#youtube-iframe").attr('src', videoSrc + "?autoplay=1");

})
$('.close-video').on('click', function () {

    $(this).closest('#myModal-video').find("#youtube-iframe").attr('src', "");

})
$(document).on('click', '.sel_spare_store_type', function (e) {

    e.preventDefault();
    $('input[name="spare_store_post_type"]').val($(this).data('type'));
    let sel_type = $('input[name="spare_store_post_type"]').val();
    let create_url = route('create-type', current_lang);
    const createUrl = $(this).parents('#spare_type_sel').attr('action');
    if (sel_type != null || sel_type == undefined) {
        // Send data to controller
        axios.get(createUrl, {
            params: {
                type: sel_type
            }
        }).then(res => {
            if ($('#create-post-page').length == 0) {
                window.location.href = create_url;
            } else {
                // console.log($('#create-post-page').length, 'first');
                if (!('error' in res.data)) { // Request sned and get success
                    // Get currenct url
                    const currentUrl = window.location.href;
                    // Check url charecters has <<create-post>> string
                    window.history.pushState("", "", 'spare-store/');
                    // Set content information
                    // Reintializate lazy loading
                    $('html, body').animate({scrollTop: $("#create-post-page").offset().top - 200}, 400);
                    // stugel # element ete undefined poxel
                    $('#create-post-page').html(res.data.view);
                    for (let i = 1990; i <= new Date().getFullYear(); i++) {
                        // console.log(i)
                        $("select[name='spare_store_year_start']").append(`<option value="${i}">${i}</option>`)
                        $("select[name='spare_store_year_end']").append(`<option value="${i}">${i}</option>`)
                    }
                } else {
                    alert('Something Is Wrong')
                    window.location.href = create_url;
                }
            }

        }).catch(res => { // Request error
            alert('Something Is Wrong')
            window.location.href = create_url;
        });

    }

})

// Select category
$(document).on('click', '.selectcategory', function (e) {
    // Disabled all default events
    e.preventDefault();
    // Get text
    const categoryName = $('input[name="main_name"]').val();
    // Get category id
    let categoryId = $('input[name="category_id"]').val();
    // Check category id
    if (categoryId == undefined) {
        categoryId = 0;
    }
    let create_url = route('create-type', current_lang);
    // Get level 2 url
    const level2Url = $(this).parents('.categories-content').attr('action').split('/level2/')[0] + '/level2/' + categoryId;
    // Send data to controller
    axios.get(level2Url)
        .then(res => {
            if ($('#create-post-page').length == 0) {

                window.location.href = home_url;
            } else {
                if (!('error' in res.data)) { // Request sned and get success
                    // Get currenct url
                    const currentUrl = window.location.href;
                    // Check url charecters has <<create-post>> string
                    if (currentUrl.indexOf('create-post/') > -1) {
                        // Push new data to url
                        window.history.pushState("", "", 'level2/' + categoryId);
                    } else {
                        // Push new data to url
                        window.history.pushState("", "", 'create-post/level2/' + categoryId);
                    }
                    // Set content information
                    $('html, body').animate({scrollTop: $("#create-post-page").offset().top - 200}, 400);
                    $('#create-post-page').html(res.data.view);

                } else {
                    window.location.href = home_url;
                    alert('Something Is Wrong');
                }
            }
        }).catch(res => { // Request error
        alert('Something Is Wrong');
        window.location.href = home_url;
    });
});

// alert(new Date().getFullYear())


$(document).on("input", ".add_spare_phone", function () {

    let msg_phone = "PLease enter valid phone number";
    // var field_name = $(this).attr('name');
    let phone_val = $(this).val();
    var phone_length = 8;
    const reg = /^\d+$/;
    const phonePattern = /^.*\+?\(?([0-9]{3})?\)?[-. ]?\(?([0-9]{2,3})?\)?[-. ]?(([0-9]{3})[-. ]?([0-9]{3})|([0-9]{2})[-. ]?([0-9]{2})[-. ]?([0-9]{2})).*$/;
    let firstChar = phone_val.charAt(0);
    let first_is_num = reg.test(firstChar)
    if (first_is_num) {
        if (firstChar == '0') {

            phone_length = 9;
        }
        $('.phone_msg').empty();
        $(this).attr('name', 'spare_store_phone');
    } else {

        $('.phone_msg').text(msg_phone);
        $(this).attr('name', 'spare_store_phone_no');

    }
    if (phone_val.match(phonePattern)) {
        if (phone_val.length != phone_length) {

            $('.phone_msg').text(msg_phone);
            $(this).attr('name', 'spare_store_phone_no');
        } else {
            $('.phone_msg').empty();
            $(this).attr('name', 'spare_store_phone');

        }

    } else {
        $('.phone_msg').text(msg_phone);
        $(this).attr('name', 'spare_store_phone_no');
        // alert(false);
    }

});

$(document).on("click", "input[name='spare_store_brand[]']", function () {

    var array_checked = [];
    $("input[name='spare_store_brand[]']").each(function () {

        if ($(this).prop('checked') == true) {

            array_checked.push($(this).val());
        }

    })
    $('.spare-price-row').remove();

    let url = $(this).data('action');
    let parent_elem = $('.model_append_ul');
    let default_title = $(this).data('default-title');
    get_model_type(array_checked, parent_elem, default_title, url);
    console.log($('#session_model_has').length);
    if ($('#session_model_has').length > 0) {
        var checked_models = [];
        $("input[name='spare_store_model[]']").each(function () {

            if ($(this).prop('checked') == true) {
                console.log($(this).val());
                // checked_models.push($(this).data('brand') + '-' + $(this).data('name') + '-' + $(this).val());
            }

        })

    }

});
$(document).on("click", "input[name='spare_store_model[]']", function () {
    var checked_models = [];
    $("input[name='spare_store_model[]']").each(function () {

        if ($(this).prop('checked') == true) {

            checked_models.push($(this).data('brand') + '-' + $(this).data('name') + '-' + $(this).val());
        }

    })
    var parent_elem = $('.years_container');
    var spare_year = $('.years_container').attr('data-titleYear');
    var spare_year_start = $('.years_container').attr('data-titleStart');
    var spare_year_end = $('.years_container').attr('data-titleEnd');
    // console.log(spare_year,spare_year_start,spare_year_end)
    parent_elem.empty();
    for (let i = 0; i < checked_models.length; i++) {
        var split_keys = checked_models[i].split('-');
        var in_label_years = split_keys[0] + "-" + split_keys[1];
        parent_elem.append('            <div class="row no-gutters spare-price-row justify-content-start" data-brandYear="' + split_keys[0] + '">\n' +
            '                <div class="col-lg-4 col-12">\n' +
            '                    <!-- Title -->\n' +
            '                    <label\n' +
            '                        class="font-weight-bold input-create-label spare_years_label float-left">' + spare_year + '<br> ' + in_label_years + '</label>\n' +
            '                </div>\n' +
            '                <div class="col-lg-3 col-xl-3 col-md-5 col-5">\n' +
            '                    <!-- Input -->\n' +
            '                    <select name="spare_store_year_start-' + split_keys[2] + '" form="addPostSpareForm" class="input-default spare_year_start w-100 p-2">\n' +
            '                        <!-- Default value -->\n' +
            '                        <option value="default">' + spare_year_start + '</option>\n' +
            '\n' +
            '                    </select>\n' +
            '                </div>\n' +
            '\n' +
            '                <div class="col-lg-3 col-xl-3 col-md-5 col-5 ml-xl-3 ml-lg-3">\n' +
            '                    <!-- Input -->\n' +
            '                    <select name="spare_store_year_end-' + split_keys[2] + '" form="addPostSpareForm" class="input-default spare_year_end w-100 p-2">\n' +
            '                        <!-- Default value -->\n' +
            '                        <option value="default">' + spare_year_end + '</option>\n' +
            '\n' +
            '                    </select>\n' +
            '                </div>\n' +
            '\n' +
            '            </div>')

    }
    if ($('#spare_min_year').val() !== undefined || $('#spare_min_year').val() !== "") {
        for (let i = 1990; i <= new Date().getFullYear(); i++) {

            if (i == $('#spare_min_year').val()) {

                $(".spare_year_start").append(`<option value="${i}" selected>${i}</option>`)

            } else {
                $(".spare_year_start").append(`<option value="${i}">${i}</option>`)


            }

        }
    }
    if ($('#spare_max_year').val() !== undefined || $('#spare_max_year').val() !== "") {
        for (let i = 1990; i <= new Date().getFullYear(); i++) {

            if (i == $('#spare_max_year').val()) {

                $(".spare_year_end").append(`<option value="${i}" selected>${i}</option>`)

            } else {
                $(".spare_year_end").append(`<option value="${i}">${i}</option>`)


            }

        }
    }
    console.log(in_label_years);
    console.log(split_keys[2]);


})

function get_model_type(elem, parent_elem, default_title, url) {
    // Send data to controller
    axios.post(url, {model: elem})
        .then(res => {
            console.log(res)
            parent_elem.empty();

            parent_elem.append(res.data.view)
            if ($('#session_model_has').length > 0) {
                $(".spare_part_model_checks").prop('checked', false)

            }
        }).catch(error => { // Request error
        alert(error);

    });

}

// Add new image event
let iamgeCounter = $('input[name="imagesCount"]').val();
$(document).on('click', '.imgAdd', function (e) {
    // Add process

    $(this).closest(".row").find('.imgAdd').before('<label class="image-upload-item image position-relative"><input type="file" name="uploadImage' + parseInt(parseInt($('.uploadFile').length) + parseInt(1)) + '" form="addPostForm" class="uploadFile d-none"><i class="fa fa-times del" title="' + deleteImage.innerText + '"></i>');

    $(this).prev().trigger('click');

});
// Delete image
$(document).on('click', '.del', function (e) {
    // Disabled all default events
    e.preventDefault();

    // Get this
    var self = $(this);

    // Check axios
    if ($(this).hasClass('axios')) { // Axios
        // Send data to controller
        let del_url = $(this).attr('data-dels3');
        console.log();
        axios.get($(this).attr('action'), {
            params: {
                del_url: del_url
            }
        }).then(res => {
            if (res.data != 'error') { // Request sned and get success
                // Set content information
                self.parent().remove();
            } else {

            }
        }).catch(res => { // Request error

        });
    } else { // Js only
        // Remove image
        $(this).parent().remove();
    }

    // Change
    $('input[name="imagesCount"]').val(parseInt($('.uploadFile').length));
});


// If user tries to upload videos other than these extension , it will throw error.
function isVideo(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
        case 'm4v':
        case 'avi':
        case 'mp4':
        case 'mov':
        case 'mpg':
        case 'mpeg':
            // etc
            return true;
    }
    return false;
}

function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}

console.log(window.cloudinary_obj, 'cloudinary')

// const cloudinary = new window.cloudinary_obj({
//     cloud: {
//         cloudName: 'yerevan-vip'
//     }
// });


// console.log(window.cloudinary)
function deleteImage(publicId, resourceType, callback) {
    console.log(resourceType);//image,video,raw

    window.cloudinary_obj.api.delete_resources(publicId, function (result) {
        console.log(result);
        if (result.hasOwnProperty("error")) {
            callback(result);
            return;
        } else {
            callback(result);

        }
    }, {all: true, resource_type: resourceType});
}

// function switch_sum_variant_video(variant_num) {
//     let res_obj;
//     switch (variant_num) {
//         case 30:
//             res_obj = {
//                 'sum': 1500,
//                 'duration': 30,
//             }
//             break;
//         case 60:
//             res_obj = {
//                 'sum': 2000,
//                 'duration': 60,
//             }
//             break;
//         case 90:
//             res_obj = {
//                 'sum': 2500,
//                 'duration': 90,
//             }
//             break;
//         case 120:
//             res_obj = {
//                 'sum': 3000,
//                 'duration': 120,
//             }
//             break;
//     }
//     return res_obj;
// }

var res;
$(document).on('click', '.variant_video', function () {
    // var elem_parent = $('#parent_variants')
    var sum = $(this).data('price');
    var duration = $(this).data('duration');
    res = {
        'sum': sum,
        'duration': duration,
    }
    // res = switch_sum_variant_video(indexOfElem)
    $('.myvideo_empty').removeClass('d-none');
    1
    $('.myvideo_empty_img').removeClass('d-none');
    $(this).parent().addClass('d-none');
})

var timeout_time = 200;

function upload_cloudinary(file, element, element_form) {
    // let valid_upload = true;
    var del_public_id = "";
    var form_id = element.closest('.video-container').find('#custom-video').attr('form');
    var form_added = $('#' + form_id);
    console.log(form_id);
    var vid = document.getElementById("video_start");
    var failed_img_path = element.data('failed');
    // vid.src = URL.createObjectURL(file)
    var vid_duration = Math.round(vid.duration, 1);
    console.log(vid_duration);
    if (vid_duration == undefined || vid_duration == "" || isNaN(vid_duration)) {
        timeout_time = timeout_time - 100;
        if (timeout_time == 0) {
            timeout_time = 100;
        }
        setTimeout(function () {
            upload_cloudinary(file, element);
        }, timeout_time);
    } else {
        // Check res is not declared or undefined set 30 second else selected variant duration
        let permissible_duration = 30;
        if ($('#custom_video_duration').length != 0) {
            permissible_duration = $('#custom_video_duration').val();
        } else {
            permissible_duration = typeof res === "undefined" || !res ? 30 : res.duration;
        }
        console.log(permissible_duration);
        if (permissible_duration == '' || typeof permissible_duration === "undefined" || !permissible_duration) {
            let home_url = route('home', current_lang);
            let deleting_url = route('del-failed-post', current_lang);
            axios.post(deleting_url)
                .then(res => {
                    // if (res.data == 'ok')
                    // {
                    window.location.href = home_url;
                    // }
                }).catch(error => { // Request error
                alert(error);
            });
        }
        if (vid_duration <= permissible_duration) {
            $('.error_duration').addClass('d-none');
            $('#duration_error').text('');
            const url = "https://api.cloudinary.com/v1_1/yerevan-vip/video/upload";
            // const create_signature_url = "https://api.cloudinary.com/v1_1/yerevan-vip/video/upload";
            const formData = new FormData();
            formData.append("file", file);
            formData.append("upload_preset", "vip_preset");
            element.prop("controls", true);
            element.removeAttr("poster");
            vid.src = URL.createObjectURL(file)
            if (element.attr('data-public') !== undefined && element.attr('data-public') != "") {
                del_public_id = element.attr('data-public');
                var del_url = element.attr('data-delete');

                // Send data to controller
                axios.post(del_url, {public_id: del_public_id})
                    .then(res => {
                        console.log(res)
                    }).catch(error => { // Request error
                    alert(error);
                });
            }
            fetch(url, {
                method: "POST",
                body: formData
            })
                .then((response) => {
                    return response.text();
                })
                .then((data) => {
                    var obj_data = JSON.parse(data);
                    console.log(obj_data);
                    console.log(element.attr('data-public'));
                    element.attr('data-url', obj_data.secure_url);
                    element.attr('data-public', obj_data.public_id);
                    console.log(element.attr('data-public'))
                    form_added.append(`<input type="hidden" value="${obj_data.secure_url}" form="${form_id}" name="custom_video" class="custom_video_input"/>`)
                    form_added.append(`<input type="hidden" value="${obj_data.public_id}" form="${form_id}" name="custom_video_name" class="custom_video_input"/>`)
                    if (res !== undefined) {
                        form_added.append(`<input type="hidden" value="${res.sum}" form="${form_id}" name="custom_video_price" class="custom_video_input"/>`)
                        form_added.append(`<input type="hidden" value="${res.duration}" form="${form_id}" name="custom_video_duration" class="custom_video_input"/>`)

                    } else {
                        if ($('#custom_video_duration').length != 0) {
                            let duration_session = $('#custom_video_duration').val();
                            form_added.append(`<input type="hidden" value="${duration_session}" form="${form_id}" name="custom_video_duration" class="custom_video_input"/>`)
                        }
                        if ($('#custom_video_price').length != 0) {
                            let sum_session = $('#custom_video_price').val();
                            form_added.append(`<input type="hidden" value="${sum_session}" form="${form_id}" name="custom_video_price" class="custom_video_input"/>`)
                        }
                    }
                    element_form.submit();

                });
        } else {
            $('.error_duration').removeClass('d-none')
            $('#duration_error').text("");
            let message = "Video Duration must be max:" + permissible_duration + " second";
            $('#duration_error').text(message);
            element.prop("controls", false);
            vid.src = "";
            vid.poster = failed_img_path;
            $('#custom-video').val("");
            $(".loading-icon").addClass("d-none");
        }
    }
}

// In BACK BUTTON BROWSER

// popstate
window.addEventListener('popstate', function (event) {
    event.preventDefault();
    event.stopPropagation();
    let home_url = route('home', current_lang);
    let level3_post_url = '/create-post/level2/';
    let level3_spare_store_url = '/create-post/spare-store';
    let finish_post_url = '/create-post/level3';
    let finish_spare_store_url = '/create-post/level3-spare/';
    let deleting_url = route('del-failed-post', current_lang);
    // alert(current_url.indexOf(level3_spare_store_url) !== -1)
    if (current_url.includes(level3_post_url) || current_url.includes(level3_spare_store_url) || current_url.includes(finish_post_url) || current_url.includes(finish_spare_store_url)) {
        axios.post(deleting_url)
            .then(res => {
                // if (res.data == 'ok')
                // {
                window.location.href = home_url;
                // }
            }).catch(error => { // Request error
            alert(error);
        });
    }

}, false);
// icon click change the uploading video
$(document).on('click', '.upload_custom_video', function () {
    $("#custom-video").trigger("click");
})
// icon click clear the uploading video
$(document).on('click', '.clear_custom_video', function () {
    let create_url = route('create-type', current_lang);
    $('.myvideo_preview').addClass('d-none');
    $('.myvideo_empty_img').removeClass('d-none');
    $('.myvideo_empty_img').css('display', 'block');
    $('.myvideo_empty').css('display', 'none');
    $('#custom-video').val("");
    $('.error_duration').addClass('d-none');
    $('#duration_error').text('');
    $('.video_icons_container').remove();
    $('.upload_custom_video').remove();
    $('.clear_custom_video').remove();
    if ($('.myvideo_preview').length > 0) {
        var vid = document.getElementById("video_start");
        vid.src = "";
        let del_public_id = $('.myvideo_preview').attr('data-public');
        let del_url = $('.myvideo_preview').attr('data-delete');
        // Send data to controller
        axios.post(del_url, {public_id: del_public_id})
            .then(res => {
                console.log(res)
                $('.myvideo_preview').removeAttr('data-public');
                $('.myvideo_preview').removeAttr('data-url');
                location.reload();
            }).catch(error => { // Request error
            window.location.href = create_url;
        });
    } else {
        location.reload();
    }
    console.log($('.myvideo_preview').length);
})
$(document).on('change', '#custom-video', function (e) {
    if (isVideo($(this).val())) {
        $('.error_duration').addClass('d-none');
        $('#duration_error').text('');
        if ($('.myvideo_empty').length != 0) {
            $('.myvideo_empty_img').css('display', 'none')
            $('.myvideo_empty').css('display', 'block')
            $('.myvideo_empty').removeAttr('src');
            $('.myvideo_empty').removeAttr('poster');
            $('.myvideo_empty').prop("controls", true);
            $('.video-container').find('.upload_custom_video').remove();
            $('.myvideo_empty').attr('src', URL.createObjectURL(this.files[0]));
            $('.myvideo_empty').height('80%');
            $('.video_icons_container').remove();
            $('.upload_custom_video').remove();
            $('.clear_custom_video').remove();
            $('.video-container').append('<div class="d-flex justify-content-between video_icons_container"></div>')
            $('.video_icons_container').append('<i class="fas fa-file-video upload_custom_video"></i>');
            $('.video_icons_container').append('<i class="fas fa-minus-circle clear_custom_video"></i>');
            let file = this.files[0];
            console.log(file);
        } else {
            $('.myvideo_empty_img').css('display', 'none')
            $('.myvideo_preview').removeClass('d-none')
            $('.myvideo_preview').removeAttr('src');
            $('.myvideo_preview').removeAttr('poster');
            $('.myvideo_preview').prop("controls", true);
            $('.video-container').find('.upload_custom_video').remove();
            $('.myvideo_preview').attr('src', URL.createObjectURL(this.files[0]));
            $('.myvideo_preview').height('80%');
            $('.video_icons_container').remove();
            $('.upload_custom_video').remove();
            $('.clear_custom_video').remove();
            $('.video-container').append('<div class="d-flex justify-content-between video_icons_container"></div>')
            $('.video_icons_container').append('<i class="fas fa-file-video upload_custom_video"></i>');
            $('.video_icons_container').append('<i class="fas fa-minus-circle clear_custom_video"></i>');
            let file = this.files[0];
            console.log(file);
        }
    } else {
        $('.error_duration').removeClass('d-none')
        $('#duration_error').text("");
        $('#duration_error').text('Only video files are allowed to upload.');
        // alert("Only video files are allowed to upload.")
    }
})
$(document).on('click', '.add_link_btn', function () {

    var parent = $(this).closest('.youtube-links');
    if ($(this).hasClass('spare_external')) {
        parent.append('<input name="external_url[]" type="text" form="addPostSpareForm" ' +
            'class="form-control external_url" aria-describedby="url"  ' +
            ' autocomplete="off" autofocus placeholder="Youtube-ի հղում">');
        $(this).remove();
        parent.append('<button type="button" class="btn btn-primary btn-sm spare_external add_link_btn"><i class="fas fa-plus"></i></button>');
    } else {
        parent.append('<input name="external_url[]" type="text" form="addPostForm" ' +
            'class="form-control external_url" aria-describedby="url"  ' +
            ' autocomplete="off" autofocus placeholder="Youtube-ի հղում">');
        $(this).remove();
        parent.append('<button type="button" class="btn btn-primary btn-sm add_link_btn"><i class="fas fa-plus"></i></button>');

    }
})
$(document).on('click', '.add_post_button', function (e) {
    e.preventDefault();
    $(".loading-icon").removeClass("d-none");
    let file = document.getElementById("custom-video").files[0];
    if (file === undefined || file == "") {
        $(this).parent().submit();
    } else {
        if ($('.myvideo_empty').length != 0) {
            upload_cloudinary(file, $('.myvideo_empty'), $(this).parent());
        } else {
            upload_cloudinary(file, $('.myvideo_preview'), $(this).parent());
        }
    }
})
$(document).on('click', '.myvideo_empty_img', function () {
    $("#custom-video").trigger("click");
})
$(document).on('change', '.uploadFile', function (e) {
    // Get this
    const uploadFile = $(this);
    // Get files
    var files = !!this.files ? this.files : [];
    // No file selected, or no FileReader support
    if (!files.length || !window.FileReader) {
        return;
    }
    // Validation
    if (/^image/.test(files[0].type)) {
        // Instance of the FileReader
        const reader = new FileReader();
        // Read the local file
        reader.readAsDataURL(files[0]);
        // Set image data as background of div
        reader.onloadend = function () {
            // Upload
            console.log(uploadFile.closest(".image-upload-item"));
            uploadFile.parent().css("background-image", "url(" + this.result + ")");
            uploadFile.parent().addClass('image');
            uploadFile.parent().append('<i class="fa fa-times del" title="Delete Image"></i>')
            uploadFile.parent().find('.fa-plus').remove();
            // Change images count input value
            $('input[name="imagesCount"]').val(parseInt($('input[name="imagesCount"]').val()) + parseInt(1));
            console.log($('input[name="imagesCount"]').val())
        }
    }

});

$(document).on('click', '#confirmPostCreatingProcess', function (e) {
    // Disabled all default events
    e.preventDefault();

    // Get url to send data
    const level4Url = $(this).attr('href');

    // Get dataChangeUrl
    const dataChangeUrl = $(this).attr('data-change-url');

    // Send data to controller
    // console.log(level4Url)
    axios.get(level4Url)
        .then(res => {
            if (res.data != 'error') { // Request sned and get success
                // Push new data to url
                window.history.pushState("", "", dataChangeUrl);

                // Set content information
                $('.load-content').html(res.data);

                // Scroll to this section
                $('html, body').animate({scrollTop: $(".load-content").offset().top - 200}, 400);
            } else {
                // Waning Alert
                Swal.fire({
                    title: 'Error',
                    icon: 'warning',
                    timer: 2000,
                });
            }
        }).catch(res => { // Request error
        // Error Alert
        alert()
        Swal.fire({
            title: 'Error',
            icon: 'error',
            timer: 2000,
        });
    });
});

// Post Make Top
$(document).on('click', '#post-make-top', function (e) {
    // Disabled all default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Get url
    const url = self.attr('href');

    // Get post maked top text
    const postMekedTopText = self.attr('post-maked-top-text');

    // Send data to controller
    axios.get(url)
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire({
                    title: postMakedTopSuccessTitle.innerText,
                    text: postMakedTopSuccessDescription.innerText,
                    icon: 'success',
                    timer: 2000,
                });

                // Change Text
                self.text(postMekedTopText);

                // Set To Pasive
                self.removeClass('btn-success').addClass('btn-secondary').addClass('disabled').attr('id', '');
            } else {
                // Sucees Alert
                Swal.fire({
                    title: postMakedTopErrorTitle.innerText,
                    text: postMakedTopErrorDescription.innerText,
                    icon: 'warning',
                    timer: 2000,
                });
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire({
            title: postMakedTopErrorTitle.innerText,
            text: postMakedTopErrorDescription.innerText,
            icon: 'error',
            timer: 2000,
        });
    });
});

// Post Make Hurry
$(document).on('click', '#post-make-hurry', function (e) {
    // Disabled all default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Get url
    const url = self.attr('href');

    // Get post maked Hurry text
    const postMekedHurryText = self.attr('post-maked-hurry-text');

    // Send data to controller
    axios.get(url)
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire({
                    title: postMakedHurrySuccessTitle.innerText,
                    text: postMakedHurrySuccessDescription.innerText,
                    icon: 'success',
                    timer: 2000,
                });

                // Change Text
                self.text(postMekedHurryText);

                // Set To Pasive
                self.removeClass('btn-success').addClass('btn-secondary').addClass('disabled').attr('id', '');
            } else {
                // Sucees Alert
                Swal.fire({
                    title: postMakedHurryErrorTitle.innerText,
                    text: postMakedHurryErrorDescription.innerText,
                    icon: 'warning',
                    timer: 2000,
                });
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire({
            title: postMakedHurryErrorTitle.innerText,
            text: postMakedHurryErrorDescription.innerText,
            icon: 'error',
            timer: 2000,
        });
    });
});
