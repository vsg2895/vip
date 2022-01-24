// Pusher.logToConsole = true;
// var pusher = new Pusher('a686ef753076cc0e3202', {
//     cluster: 'eu',
//     // forceTLS: true,
//     // encrypted: true
// });
//
// // Subscribe to channel join user
// var chanelUserJoin = pusher.subscribe('my-channel-user-join');
//
// // Subscribe to channel send message
// var chanel = pusher.subscribe('my-channel');
//
// // Subscribe to channel delete message
// var chanelDelete = pusher.subscribe('my-channel-delete');
//
// // Subscribe to channel update message
// var chanelUpdate = pusher.subscribe('my-channel-update');
//
// // Get this
let self = $(this);
//
// // Get my user fullname
const fullName = $('.my-user').attr('title');
//
// // Get my user img
const myImg = $('.my-image').attr('src');
//
// // Bind event
// console.log(chanel);
// // 'submited'
// // pusher:subscription_succeeded
// chanel.bind('submited', function (data) {
// const senderUserId = data.userId;
// const currentUserId = $('#sendMessageForm').attr('data-id');
// const itemId = data.itemId;
// // Get modal url
// let modalUrl = $('.more-info-message').attr('data-modal-url').split('/destroy/')[0] + '/destroy/' + itemId;
//
// // Get modal url
// let updateUrl = $('.more-info-message').attr('data-update-url').split('/update/')[0] + '/update/' + itemId;
//
// // I am sended message
// if (senderUserId == currentUserId) {
//     // Mesasge append to conversation
//     $('.newMessageContnet').append(' \
//         <!-- Contnet --> \
//         <div class="row no-gutters w-100 d-block mt-2 float-right my-4 position-relative m-item m-item-m new-added" data-item-id="' + itemId + '"> \
//             <!-- URL --> \
//             <a href="#"> \
//                 <!-- My Image --> \
//                 <img class="d-inline-block float-right rounded-circle" width="45px" src="' + myImg + '" title="' + fullName + '" alt="' + fullName + '"> \
//             </a> \
//             <div class="p-2 rounded mr-2 float-right d-inline bg-light w-75"> \
//                 <span class="text-message">' + data.text + '</span> \
//                 <div class="w-100 d-block"> \
//                     <small class="text-muted float-right"><i class="far fa-clock"></i> ' + $('#dataSendMessageNow').text() + '</small> \
//                 </div> \
//             </div> \
//             <div class="clearfix"></div> \
//         </div> ');
//
//     // Scroll to down
//     $('.messages-section').scrollTop($('.messages-section')[0].scrollHeight);
// } else {
//     // I am received message
//     // Get my user fullname
//     const fullName = $('.friend-user').text();
//
//     // Get friend user img
//     const friendImg = $('.friend-image').attr('src');
//
//     // Get friend user link
//     const friendLink = $('.friend-link').attr('href');
//
//     // Add alert to alerts list
//     $('.alerts-section').prepend(' \
//         <!-- Alert --> \
//         <a href="' + friendLink + '" class="alert alert-warning alert-dismissible fade show w-100 d-block" role="alert"> \
//             <!-- Sender Data --> \
//             <strong>' + fullName + '</strong>  \
//             <!-- Description --> \
//             <div class="w-100 d-block clearfix"> \
//                 ' + data.text + '\
//             </div>\
//             <!-- Break -->\
//             <hr>\
//             <!-- Time -->\
//             <div class="w-100 d-block clearfix">\
//                 <i class="far fa-clock"></i> Now\
//             </div>\
//             <!-- Close Button -->\
//             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>\
//         </a>\
//     ');
//
//     // Mesasge append to conversation
//     $('.newMessageContnet').append(' \
//         <!-- Contnet --> \
//         <div class="row no-gutters w-100 d-block mt-2 float-right my-4 position-relative m-item-m" data-item-id="' + itemId + '"> \
//             <!-- URL --> \
//             <a href="' + friendLink + '"> \
//                 <!-- My Image --> \
//                 <img class="d-inline-block float-left rounded-circle" width="45px" src="' + friendImg + '" title="' + fullName + '" alt="' + fullName + '"> \
//             </a> \
//             <div class="p-2 rounded mr-2 float-left d-inline bg-light w-75"> \
//                 <span class="text-message">' + data.text + '</span> \
//                 <div class="w-100 d-block"> \
//                     <small class="text-muted float-left"><i class="far fa-clock"></i> ' + $('#dataSendMessageNow').text() + '</small> \
//                 </div> \
//             </div> \
//             <div class="clearfix"></div> \
//         </div> ');
//
//     // Scroll to down
//     $('.messages-section').scrollTop($('.messages-section')[0].scrollHeight);
// }
// });


//
// // Bind event
// chanelDelete.bind('message-deleted', function (data) {
//     const senderUserId = data.userId;
//     const itemId = data.itemId;
//     const currentUserId = $('#sendMessageForm').attr('data-id');
//
//     // Deleted message from freiend interface
//     if (senderUserId != currentUserId) {
//         // Remove
//         $('body').find('.m-item-m[data-item-id="' + itemId + '"]').remove();
//     }
// });
//
// // Bind event
// chanelUpdate.bind('message-updated', function (data) {
//     const senderUserId = data.userId;
//     const itemId = data.itemId;
//     const currentUserId = $('#sendMessageForm').attr('data-id');
//
//     // Deleted message from freiend interface
//     if (senderUserId != currentUserId) {
//         // Update
//         $('body').find('.m-item-m[data-item-id="' + itemId + '"]').find('.text-message').html(data.text);
//     }
// });


// Post Delete Button Click Event
$(document).on('click', '.action.delete', function (e) {
    // Disabled default events
    e.preventDefault();

    // Clear datas
    $('.delete-action').attr('href', '');
    $('.delete-modal-title').text('');

    // Push new datas
    $('.delete-modal-title').text($(this).parents('.item-card-row').find('.card-title').text());
    $('.delete-action').attr('href', $('a.delete-action').attr('data-href') + '/' + $(this).parents('.item-card-row').attr('data-item-id'));
});

// Delete Post
$(document).on('click', 'a.delete-action', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    let self = $(this);

    // Disabled request moment resend data
    self.addClass('disabled');

    // Send data to controller
    axios.get(self.attr('href'))
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: dataDeletePostTitleSuccess.innerText,
                    text: dataDeletePostDescriptionSuccess.innerText,
                    timer: 1500,
                });

                // Get post id
                let id = self.attr('href').split('delete/')[1];

                // Remove item
                $('body').find('.item-card-row[data-item-id="' + id + '"]').remove();

                // Close modal after 2 second
                setTimeout(function () {
                    // Hide modal
                    $('#deletPostModalCenter').modal('hide');

                    // Remove disabled status
                    self.removeClass('disabled');
                }, 2000);
            } else {
                // Error Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'warning',
                    title: dataDeletePostTitleError.innerText,
                    text: dataDeletePostDescriptionError.innerText,
                    timer: 1800,
                });
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire({
            position: 'center-center',
            icon: 'error',
            title: dataDeletePostTitleError.innerText,
            text: dataDeletePostDescriptionError.innerText,
            timer: 1800,
        });
    });
});

// Post Update Button Click Event
$(document).on('click', '.action.update', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    let self = $(this);

    // Clear datas
    $('.update-action').attr('href', '');
    $('.updates-count').text(0);
    $('.update-modal-title').text('');

    // Check has class diasabled
    if ($('.update-action').hasClass('disabled')) {
        $('.update-action').removeClass('disabled');
    }

    // Check button has access or no
    if (self.hasClass('access-disabled')) {
        // Change modal last update date text
        self.parents('.item-card-row').attr('data-item-update-date', self.attr('data-item-update-date-new'));

        // Get last updated data
        let lastUpdatedDate = self.parents('.item-card-row').attr('data-item-update-date');

        // Change modal last updated date text
        $('.last-update-date').text(lastUpdatedDate);
    }

    // Push new datas
    $('.update-modal-title').text(self.parents('.item-card-row').find('.card-title').text());
    $('.updates-count').text(self.parents('.item-card-row').attr('data-item-updates'));
    $('.update-action').attr('href', $('a.update-action').attr('data-href') + '/' + self.parents('.item-card-row').attr('data-item-id'));
});

// Update post
$(document).on('click', 'a.update-action', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    let self = $(this);

    // Disabled request moment resend data
    self.addClass('disabled');

    // Send data to controller
    axios.get(self.attr('href'))
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: dataUpdatePostTitleSuccess.innerText,
                    text: dataUpdatePostDescriptionSuccess.innerText,
                    timer: 1500,
                });

                // Get post id
                let id = self.attr('href').split('update/')[1];

                // Change Button
                $('body').find('.item-card-row[data-item-id="' + id + '"]').find('svg.update path').attr('fill', '#707070');
                $('body').find('.item-card-row[data-item-id="' + id + '"]').find('svg.update').attr('data-target', '#updatePostModalDisabledCenter');
                $('body').find('.item-card-row[data-item-id="' + id + '"]').find('svg.update').addClass('access-disabled');

                // Get updates count
                let updatesCount = $('body').find('.item-card-row[data-item-id="' + id + '"]').attr('data-item-updates');

                // Change updated count text
                $('.updates-count').text(Number(updatesCount) + Number(1));

                // Active button
                self.removeClass('disabled');

                // Copyy item
                let newTag = $('body').find('.item-card-row[data-item-id="' + id + '"]').clone();

                // Remove item
                $('body').find('.item-card-row[data-item-id="' + id + '"]').remove();

                // Item pin to top
                $('.last-update-item-area').prepend(newTag);

                // Close modal after 2 second
                setTimeout(function () {
                    $('#updatePostModalCenter').modal('hide');
                }, 2000);

                // Scroll to pined item
                $('html, body').animate({scrollTop: $(".last-update-item-area").offset().top - 200}, 400);
                location.reload();

            } else if (res.data == 0) { // Update 3 days limit
                // Warning Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'warning',
                    title: dataUpdatePostTitle3DaysLimit.innerText,
                    text: dataUpdatePostDescription3DaysLimit.innerText,
                    timer: 1800,
                });
            } else {
                // Error Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'warning',
                    title: dataUpdatePostTitleError.innerText,
                    text: dataUpdatePostDescriptionError.innerText,
                    timer: 1800,
                });
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire({
            position: 'center-center',
            icon: 'error',
            title: dataUpdatePostTitleError.innerText,
            text: dataUpdatePostDescriptionError.innerText,
            timer: 1800,
        });
    });
});

// Post Passivation Button Click Event
$(document).on('click', '.action.passivation', function (e) {
    // Disabled default events
    e.preventDefault();

    // Clear datas
    $('.passivation-action').attr('href', '');
    $('.passivation-modal-title').text('');

    // Push new datas
    $('.passivation-modal-title').text($(this).parents('.item-card-row').find('.card-title').text());
    $('.passivation-action').attr('href', $('a.passivation-action').attr('data-href') + '/' + $(this).parents('.item-card-row').attr('data-item-id'));
});

// Post Make Passive
$(document).on('click', 'a.passivation-action', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    let self = $(this);

    // Disabled request moment resend data
    self.addClass('disabled');

    // Send data to controller
    axios.get(self.attr('href'))
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: dataPostMakePassiveTitleSuccess.innerText,
                    text: dataPostMakePassiveDescriptionSuccess.innerText,
                    timer: 1500,
                });

                // Get post id
                let id = self.attr('href').split('make-passive/')[1];

                // Remove item
                $('body').find('.item-card-row[data-item-id="' + id + '"]').remove();

                // Close modal after 2 second
                setTimeout(function () {
                    $('#passivationActionPostModalCenter').modal('hide');
                }, 2000);
            } else {
                // Error Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'warning',
                    title: dataPostMakePassiveTitleError.innerText,
                    text: dataPostMakePassiveDescriptionError.innerText,
                    timer: 1800,
                });
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire({
            position: 'center-center',
            icon: 'error',
            title: dataPostMakePassiveTitleError.innerText,
            text: dataPostMakePassiveDescriptionError.innerText,
            timer: 1800,
        });
    });
});


$(document).on('click', '.imgAdd', function (e) {
    // Add process
    $(this).closest(".row").find('.imgAdd').before('<label class="image-upload-item image position-relative"><input type="file" name="uploadImage' + parseInt(parseInt($('.uploadFile').length) + parseInt(1)) + '" form="addPostForm" class="uploadFile d-none"><i class="fa fa-times del" title="' + deleteImage.innerText + '"></i>');
});

// Post Passivation Button Click Event
$(document).on('click', '.action.activation', function (e) {
    // Disabled default events
    e.preventDefault();

    // Clear datas
    $('.activation-action').attr('href', '');
    $('.activation-modal-title').text('');

    // Push new datas
    $('.activation-modal-title').text($(this).parents('.item-card-row').find('.card-title').text());
    $('.activation-action').attr('href', $('a.activation-action').attr('data-href') + '/' + $(this).parents('.item-card-row').attr('data-item-id'));
});

// Post Make Passive
$(document).on('click', 'a.activation-action', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    let self = $(this);

    // Disabled request moment resend data
    self.addClass('disabled');

    // Send data to controller
    axios.get(self.attr('href'))
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: dataPostMakeActiveTitleSuccess.innerText,
                    text: dataPostMakeActiveDescriptionSuccess.innerText,
                    timer: 1500,
                });

                // Get post id
                let id = self.attr('href').split('make-active/')[1];

                // Remove item
                $('body').find('.item-card-row[data-item-id="' + id + '"]').remove();

                // Close modal after 2 second
                setTimeout(function () {
                    $('#activationActionPostModalCenter').modal('hide');
                }, 2000);
            } else {
                // Error Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'warning',
                    title: dataPostMakeActiveTitleError.innerText,
                    text: dataPostMakeActiveDescriptionError.innerText,
                    timer: 1800,
                });
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire({
            position: 'center-center',
            icon: 'error',
            title: dataPostMakeActiveTitleError.innerText,
            text: dataPostMakeActiveDescriptionError.innerText,
            timer: 1800,
        });
    });
});

// Get posts
$(document).on('click', '.nav-link.get-posts', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    self = $(this);

    // Get tab type
    let url = self.attr('data-url');

    // Disabled request moment resend data
    self.addClass('disabled');

// Add loading
    $('.load-content').html('\
        <div class="spinner-border mt-5 d-block mx-auto" role="status"> \
            <span class="sr-only">Loading...</span> \
        </div>'
    );

    // Send request
    axios.get(url)
        // Success
        .then(res => {
            // Get currenct url
            const currentUrl = window.location.href;

            // Get url segment
            const urlSegment = self.attr('aria-controls');

            // Check url charecters has <<my-posts>> string
            if (currentUrl.indexOf('my-posts/') > -1) {
                // Push new data to url
                window.history.pushState("", "", urlSegment);
            } else {
                // Push new data to url
                window.history.pushState("", "", 'my-posts/' + urlSegment);
            }

            // Remove active tab
            $('#postsTab .get-posts').removeClass('active').attr('aria-selected', 'false');

            // Add active tab
            self.addClass('active').attr('aria-selected', 'true');

            // Reintializate lazy loading
            $(function () {
                $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0});
            });

            // Remove old posts and push new posts to load content
            $('.load-content').html(res.data);

            // Remove disabled status
            self.removeClass('disabled');
        }).catch(res => { // Failed to load data
        // Content load error response
        alert("Failed to load data :(");
    });
});

// Get settings page
$(document).on('click', '#settingsTab .nav-link', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    self = $(this);

    // Get tab type
    let url = self.attr('data-url');

// Add loading
    $('.load-content').html('\
        <div class="spinner-border mt-5 d-block mx-auto" role="status"> \
            <span class="sr-only">Loading...</span> \
        </div>'
    );

    // Send request
    axios.get(url)
        // Success
        .then(res => {
            // Get currenct url
            const currentUrl = window.location.href;

            // Get url segment
            const urlSegment = self.attr('aria-controls');

            // Check url charecters has <<settings>> string
            if (currentUrl.indexOf('settings/') > -1) {
                // Push new data to url
                window.history.pushState("", "", urlSegment);
            } else {
                // Push new data to url
                window.history.pushState("", "", 'settings/' + urlSegment);
            }

            // Remove active tab
            $('#settingsTab .nav-link').removeClass('active').attr('aria-selected', 'false');

            // Add active tab
            self.addClass('active').attr('aria-selected', 'true');

            // Reintializate lazy loading
            $(function () {
                $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0});
            });

            // Remove old posts and push new posts to load content
            $('.load-content').html(res.data);
        }).catch(res => { // Failed to load data
        // Content load error response
        alert("Failed to load data :(");
    });
});

// Get wallet page
$(document).on('click', '#walletTab .nav-link', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    self = $(this);

    // Get tab type
    let url = self.attr('data-url');

// Add loading
    $('.load-content').html('\
        <div class="spinner-border mt-5 d-block mx-auto" role="status"> \
            <span class="sr-only">Loading...</span> \
        </div>'
    );

    // Send request
    axios.get(url)
        // Success
        .then(res => {
            // Get currenct url
            const currentUrl = window.location.href;

            // Get url segment
            const urlSegment = self.attr('aria-controls');

            // Check url charecters has <<wallet>> string
            if (currentUrl.indexOf('wallet/') > -1) {
                // Push new data to url
                window.history.pushState("", "", urlSegment);
            } else {
                // Push new data to url
                window.history.pushState("", "", 'wallet/' + urlSegment);
            }

            // Remove active tab
            $('#walletTab .nav-link').removeClass('active').attr('aria-selected', 'false');

            // Add active tab
            self.addClass('active').attr('aria-selected', 'true');

            // Reintializate lazy loading
            $(function () {
                $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0});
            });

            // Remove old posts and push new posts to load content
            $('.load-content').html(res.data);
        }).catch(res => { // Failed to load data
        // Content load error response
        alert("Failed to load data :(");
    });
});

// Get wishlist page
$(document).on('click', '#wishlistTab .nav-link', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    self = $(this);

    // Get tab type
    let url = self.attr('data-url');

    // Add loading
    $('.load-content').html('\
        <div class="spinner-border mt-5 d-block mx-auto" role="status"> \
            <span class="sr-only">Loading...</span> \
        </div>'
    );

    // Send request
    axios.get(url)
        // Success
        .then(res => {
            // Get currenct url
            const currentUrl = window.location.href;

            // Get url segment
            const urlSegment = self.attr('aria-controls');

            // Check url charecters has <<wishlist>> string
            if (currentUrl.indexOf('wishlist/') > -1) {
                // Push new data to url
                window.history.pushState("", "", urlSegment);
            } else {
                // Push new data to url
                window.history.pushState("", "", 'wishlist/' + urlSegment);
            }

            // Remove active tab
            $('#wishlistTab .nav-link').removeClass('active').attr('aria-selected', 'false');

            // Add active tab
            self.addClass('active').attr('aria-selected', 'true');

            // Reintializate lazy loading
            $(function () {
                $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0});
            });

            // Remove old posts and push new posts to load content
            $('.load-content').html(res.data);
        }).catch(res => { // Failed to load data
        // Content load error response
        alert("Failed to load data :(");
    });
});

// Change account phone numbers
$(document).on('submit', '#changeUserPhonesForm', function (e) {
    // Diabled all default events
    e.preventDefault();

    // Get form inputs data
    const dataString = new FormData(this);

    // Disabled request moment resend form event
    $('#sendForm').addClass('disabled');

    // Send data to controller
    axios.post(this.getAttribute('action'), dataString)
        .then(res => {
            if (res.data == 1 || res.data == 21 || res.data == 2) { // Request sned and get success
                // Sucees Alert
                Swal.fire(
                    dataAccountPhoneNumbersTitleSuccess.innerText,
                    dataAccountPhoneNumbersDescriptionSuccess.innerText,
                    'success'
                );

                // Active resend form button
                $('#sendForm').removeClass('disabled');
            } else { // Something wwnt wrong
                // Warning Alert
                Swal.fire(
                    dataAccountPhoneNumbersTitleError.innerText,
                    dataAccountPhoneNumbersDescriptionError.innerText,
                    'warning'
                );
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire(
            dataAccountPhoneNumbersTitleError.innerText,
            dataAccountPhoneNumbersDescriptionError.innerText,
            'error'
        );
    });
});

// Change account profile datas
$(document).on('submit', '#profileForm', function (e) {
    // Diabled all default events
    e.preventDefault();

    // Get form inputs data
    const dataString = new FormData(this);

    // Disabled request moment resend form event
    $('#sendForm').addClass('disabled');

    // Send data to controller
    axios.post(this.getAttribute('action'), dataString)
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire(
                    dataAccountProfileDatasTitleSuccess.innerText,
                    dataAccountProfileDatasDescriptionSuccess.innerText,
                    'success'
                );

                // Active resend form button
                $('#sendForm').removeClass('disabled');
            } else { // Something wwnt wrong
                // Warning Alert
                Swal.fire(
                    dataAccountProfileDatasTitleError.innerText,
                    dataAccountProfileDatasDescriptionError.innerText,
                    'warning'
                );
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire(
            dataAccountProfileDatasTitleError.innerText,
            dataAccountProfileDatasDescriptionError.innerText,
            'error'
        );
    });
});

$(document).on('change', '#profileImgForm', function (e) {
    // Diabled all default events
    e.preventDefault();
    let name_changed = $('#first-name').val();
    let last_name_changed = $('#last-name').val();
    let location_changed = $('#location').val();
    $('#profileImgForm').append('<input type="hidden" name="name_changed" value="' + name_changed + '">');
    $('#profileImgForm').append('<input type="hidden" name="last_name_changed" value="' + last_name_changed + '">');
    $('#profileImgForm').append('<input type="hidden" name="location_changed" value="' + location_changed + '">');
    // $('#image-cont_store_back').append('<div class="drop-image_store_back"><img src="' + $src_icon + '"></div>')
    // $('#profileImgForm').append(<input type='hidden' name="name_changed" value={name_changed}/>)
    // $('#profileImgForm').append(<input type='hidden' name="last_name_changed" value={last_name_changed}/>);
    // $('#profileImgForm').append(<input type='hidden' name="location_changed" value={location_changed}/>)
    // Fotm submit
    $(this).submit();
});

// Change account notifications datas
$(document).on('submit', '#userNotificationChangeForm', function (e) {
    // Diabled all default events
    e.preventDefault();

    // Get form inputs data
    const dataString = new FormData(this);

    // Disabled request moment resend form event
    $('#sendForm').addClass('disabled');

    // Send data to controller
    axios.post(this.getAttribute('action'), dataString)
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire(
                    dataAccountProfileDatasTitleSuccess.innerText,
                    dataAccountProfileDatasDescriptionSuccess.innerText,
                    'success'
                );

                // Active resend form button
                $('#sendForm').removeClass('disabled');
            } else { // Something wwnt wrong
                // Warning Alert
                Swal.fire(
                    dataAccountProfileDatasTitleError.innerText,
                    dataAccountProfileDatasDescriptionError.innerText,
                    'warning'
                );
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire(
            dataAccountProfileDatasTitleError.innerText,
            dataAccountProfileDatasDescriptionError.innerText,
            'error'
        );
    });
});


// Blockes User Delete Button Click Event
$(document).on('click', '.action.user-delete', function (e) {
    // Disabled default events
    e.preventDefault();

    // Clear datas
    $('.delete-user-action').attr('href', '');
    $('.delete-user-modal-title').text('');

    // Push new datas
    $('.delete-user-modal-title').text($(this).parents('.item-card-row').find('.card-title').text());
    $('.delete-user-action').attr('href', $('a.delete-user-action').attr('data-href') + '/' + $(this).parents('.item-card-row').attr('data-item-id'));
});

// Delete Post
$(document).on('click', 'a.delete-user-action', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    let self = $(this);

    // Disabled request moment resend data
    self.addClass('disabled');

    // Send data to controller
    axios.get(self.attr('href'))
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: dataDeleteBlockedUsertTitleSuccess.innerText,
                    text: dataDeleteBlockedUsertDescriptionSuccess.innerText,
                    timer: 1500,
                });

                // Get post id
                let id = self.attr('href').split('delete/')[1];

                // Remove item
                $('body').find('.item-card-row[data-item-id="' + id + '"]').remove();

                // Close modal after 2 second
                setTimeout(function () {
                    // Hide modal
                    $('#deletUserModalCenter').modal('hide');

                    // Remove disabled status
                    self.removeClass('disabled');
                }, 2000);
            } else {
                // Error Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'warning',
                    title: dataDeleteBlockedUsertTitleError.innerText,
                    text: dataDeleteBlockedUsertDescriptionError.innerText,
                    timer: 1800,
                });
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire({
            position: 'center-center',
            icon: 'error',
            title: dataDeleteBlockedUsertTitleError.innerText,
            text: dataDeleteBlockedUsertDescriptionError.innerText,
            timer: 1800,
        });
    });
});


// Change Pages With Axios
$(document).on('click', '.account-aside-url', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Remove all active class
    $('.account-aside-url').removeClass('active');

    // This add active class
    self.addClass('active');

    // Get url
    const url = self.attr('href');

    // Add loading
    $('.load-content').html('\
        <div class="spinner-border mt-5 d-block mx-auto" role="status"> \
            <span class="sr-only">Loading...</span> \
        </div>'
    );

    // Send request
    axios.get(url)
        // Success
        .then(res => {
            // Get currenct url
            const currentUrl = window.location.href;

            const segment = self.attr('data-segment');

            const locale = self.parents('ul').attr('data-locale');

            // Push new data to url
            window.history.pushState({}, document.title, "/" + locale + "/account" + '/' + segment);

            // Check messages page
            if (window.location.href.indexOf('messages') > -1) {
                window.location = window.location.href;
            }

            // Reintializate lazy loading
            $(function () {
                $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0});
            });

            // Remove old posts and push new posts to load content
            $('.load-content').html(res.data);

            // Check CKEeditor important
            if ($("textarea").length > 0) {
                setTimeout(function () {
                    CKEDITOR.remove();

                    // Reinitializating
                    CKEDITOR.config.allowedContent = true;
                    $("*[data-description='true']").each(function () {
                        CKEDITOR.replace(this, {
                            height: 100
                        });
                        var self2 = self;
                        $(this).parents('form').submit(function () {
                            self2.html(CKEDITOR.instances[self2.attr('name')].gletData());
                        });
                    });
                }, 2000);
            }
        }).catch(res => { // Failed to load data
        // Content load error response
        alert("Failed to load data :(");
    });
});

// Import Messenger Js
// Check data
if ($('.messages-section').length > 0) {
    // Content Start to End of Page
    $('.messages-section').scrollTop($('.messages-section')[0].scrollHeight);
}

// Select Chat To Start Conversation Event
$(document).on('click', '.chat-user-list a', function (e) {
    // alert();
    // Disabled default events
    e.preventDefault();

    // Remove alerts list container
    $('.alerts-section').hide();

    // Show section
    $('․chat-messenger-section').show();

    // Get this
    let self = $(this);

    // Add loading in contnet
    $('.chat-section').html('<div class="spinner-border mt-5 d-block mx-auto" role="status"></div>');

    // Remove all active classes
    $('.chat-user-list').removeClass('active');

    // This user lisit item add active class
    self.parents('.chat-user-list').addClass('active');

    // Get selected user id
    const userId = self.attr('data-id');
    // $('#sendMessageForm').attr('data-receiver', userId);
    console.log(userId);
    // Send data to controller
    axios.get(self.attr('href'))
        .then(res => {
            if (res.data) { // Request sned and get success
                // Show users list mobiel event
                if (window.innerWidth <= '768') {
                    $('.list-chat-item').stop().slideToggle();

                    // Increment
                    counterUsersList++;

                    // Check data
                    if (counterUsersList % 2 == 0) {
                        // Set this text
                        $('.see-users-list').html($('.see-users-list').attr('data-show'));
                    } else {
                        // Set this text
                        $('.see-users-list').html($('.see-users-list').attr('data-close'));
                    }
                }

                // Push chat to contnet
                $('.chat-section').html(res.data);

                // Content Start to End of Page
                $('.messages-section').scrollTop($('.messages-section')[0].scrollHeight);

                // Get currenct url
                const currentUrl = window.location.href;

                // Check url charecters has <<conversation>> string
                if (currentUrl.indexOf('conversation') > -1) {
                    // Push new data to url
                    window.history.pushState("", "", userId);
                } else {
                    // Push new data to url
                    window.history.pushState("", "", 'messages/conversation/' + userId);
                }

                // Change form action
                const action = $('#sendMessageForm').attr('action');

                // Genereate new url
                const newAction = action.split('/send-message/')[0] + '/send-message/' + userId;

                // Set action
                $('#sendMessageForm').attr('action', newAction);
            } else {
                // Response
                alert('Failed to start conversion');

                // Reload
                location.reload();
            }
        }).catch(res => { // Request error
        // Response
        alert('Failed to send message');

        // Reload
        location.reload();
    });
});

// Firebase Message Send Function
function writeUsermessage(senderId, receiverId, message, rootRef) {
    // setTimeout(function () {


    // return unique_key;
    // }, 200);
    // firebase.database().ref('messages/' + senderId + '_' + receiverId + '_' + dateNow + '-' + Math.floor((Math.random() * 100000) + 1)).set({
    //     senderId: senderId,
    //     receiverId: receiverId,
    //     message: message
    // });
}

// Send Message Event
const auth_id = $('#auth_id').val();
$(document).on('submit', '#sendMessageForm' + auth_id, function (e) {
    // Disabled default events
    console.log('ha ba');
    e.preventDefault();
    // Get this
    let self = $(this);
    // Get form inputs data
    // const dataString = new FormData(this);
    const receiver_id = self.attr('action').substring(self.attr('action').lastIndexOf('/') + 1);
    const sender_id = self.attr('data-id');
    const messaage = $('textarea[form=sendMessageForm' + auth_id + ']').val();
    const dateNow = Date.now();
    console.log(receiver_id);
    console.log(sender_id);
    console.log(messaage);
    var bazm = parseInt(sender_id) * parseInt(receiver_id);
    var gum = parseInt(sender_id) + parseInt(receiver_id);
    var encode_path = bazm - gum;
    var rootRef = firebase.database().ref("messages/" + encode_path);
    // Firebase realtime database chat Logic
    $('.newMessageContnet').html("");
    // var unique_key = writeUsermessage(sender_id, receiver_id, messaage, rootRef)
    var unique_key = rootRef.push().key;
    rootRef.child(unique_key).set({
        "senderId": sender_id,
        "receiverId": receiver_id,
        "message": messaage

    }, function (error) {
        if (error) {
            alert(error);
        } else {

            rootRef.on('child_added', (snapshot) => {
                // starCountRef.orderByKey().limitToLast(1).on('value', (snapshot) => {
                var data = snapshot.val();
                // $('.chat-section').html("");
                console.log(data)
                // console.log(data[unique_key]);
                // updateStarCount(postElement, data);
                // const last_element_name = Object.keys(data)[Object.keys(data).length - 1]
                // const last_element = data[last_element_name];
                // console.log(last_element, 'last');
                // for (const key in data) {
                //
                //     console.log(`${key}: ${data[key]}`);
                // }
                const senderUserId = data.senderId;
                const currentUserId = $('#sendMessageForm' + auth_id).attr('data-id');
                const receiverUserId = data.receiverId;
                const message_text = data.message;
                // console.log(senderUserId, 'sender');
                // console.log(currentUserId, 'sendformuser');
                // const itemId = data.itemId;
                // Get modal url
                // alert(senderUserId)
                // alert(currentUserId)
                //Add it after sendmessage axios in then

                // let modalUrl = $('.more-info-message').attr('data-modal-url').split('/destroy/')[0] + '/destroy/' + itemId;
                //
                // // Get modal url
                // let updateUrl = $('.more-info-message').attr('data-update-url').split('/update/')[0] + '/update/' + itemId;

                // add its in
                // data-item-id="' + itemId + '"
                // <div className="row no-gutters w-100 d-block mt-2 float-right my-4 position-relative m-item m-item-m new-added">

//Add it after sendmessage axios in then
                // I am sended message
                console.log(senderUserId);
                console.log(currentUserId);

                // $('.newMessageContnet').html("");
                if (senderUserId == currentUserId) {
                    // console.log($('.newMessageContnet' + senderUserId));
                    // console.log($('.newMessageContnet' + receiverUserId));
                    // Mesasge append to conversation
                    // alert('steim')
                    $('.newMessageContnet').append(' \
            <!-- Contnet --> \
            <div class="row no-gutters w-100 d-block mt-2 float-right my-4 position-relative m-item m-item-m new-added"> \
                <!-- URL --> \
                <a href="#"> \
                    <!-- My Image --> \
                    <img class="d-inline-block float-right rounded-circle" width="45px" src="' + myImg + '" title="' + fullName + '" alt="' + fullName + '"> \
                </a> \
                <div class="p-2 rounded mr-2 float-right d-inline bg-light w-75"> \
                    <span class="text-message">' + message_text + '</span> \
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
                    ' + message_text + '\
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
                    // alert('ste')
                    // Mesasge append to conversation
                    $('.newMessageContnet').append(' \
            <!-- Contnet --> \
            <div class="row no-gutters w-100 d-block mt-2 float-right my-4 position-relative m-item-m"> \
                <!-- URL --> \
                <a href="' + friendLink + '"> \
                    <!-- My Image --> \
                    <img class="d-inline-block float-left rounded-circle" width="45px" src="' + friendImg + '" title="' + fullName_friend + '" alt="' + fullName_friend + '"> \
                </a> \
                <div class="p-2 rounded mr-2 float-left d-inline bg-light w-75"> \
                    <span class="text-message">' + message_text + '</span> \
                    <div class="w-100 d-block"> \
                        <small class="text-muted float-left"><i class="far fa-clock"></i> ' + $('#dataSendMessageNow').text() + '</small> \
                    </div> \
                </div> \
                <div class="clearfix"></div> \
            </div> ');

                    // Scroll to down
                    $('.messages-section').scrollTop($('.messages-section')[0].scrollHeight);
                }
                $('textarea[form=sendMessageForm' + auth_id + ']').val("");

            });


        }
    });
    console.log(encode_path);
    console.log(unique_key);
    // var starCountRef = firebase.database().ref();


    // var dbRef = firebase.database().ref().child('my_value');
    // dbRef.on('value', snap => console.log(snap.val()));

    // End Firebase Code
// alert(self.attr('action'))
    // Send data to controller
    // axios.post(self.attr('action'), dataString)
    //     .then(res => {
    //         if (res.data) { // Request sned and get success
    //             // Scroll to down
    //             console.log(res.data)
    //             $('.messages-section').scrollTop($('.messages-section')[0].scrollHeight);
    //             console.log($('#sendMessageForm').closest('.chat-messenger-section').prev().find('.chat-row').find('.chat-section').find('.messages-section'));
    //
    //             // Clear text from textarea
    //             $('textarea[form="sendMessageForm"]').val('');
    //             // $('.chat-user-list a').trigger('click');
    //         } else {
    //             // Reload Page
    //             location.reload();
    //         }
    //     }).catch(res => { // Request error
    //     // Reload Page
    //     location.reload();
    // });
});

// Message Actions Button Click Event
$(document).on('click', '.more-info-message', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Clear datas
    $('.message-action.delete').attr('href', '');
    $('.message-content-description-edit').val('');
    $('#editMessageForm').attr('action', '');

    // Push new datas
    $('.message-action.delete').attr('href', self.attr('data-edit-url'));
    $('.message-content-description-edit').val(self.parents('.m-item').find('.text-message').text().trim());
    $('#editMessageForm').attr('action', self.attr('data-update-url'));
});

// Delete Message
$(document).on('click', '.message-action.delete', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    let self = $(this);

    // Disabled request moment resend data
    self.addClass('disabled');

    // Send data to controller
    axios.get(self.attr('href'))
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: dataDeleteMessageTitleSuccess.innerText,
                    text: dataDeleteMessageDescriptionSuccess.innerText,
                    timer: 1500,
                });

                // Get post id
                let id = self.attr('href').split('destroy/')[1];

                // Remove item
                $('body').find('.m-item-m[data-item-id="' + id + '"]').remove();

                // Close modal after 2 second
                setTimeout(function () {
                    // Hide modal
                    $('#exampleMessageActionsModalCenter').modal('hide');

                    // Remove disabled status
                    self.removeClass('disabled');
                }, 2000);
            } else {
                // Error Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'warning',
                    title: dataDeleteMessageTitleError.innerText,
                    text: dataDeleteMessageDescriptionError.innerText,
                    timer: 1800,
                });

                // Reload
                location.reload();
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire({
            position: 'center-center',
            icon: 'error',
            title: dataDeleteMessageTitleError.innerText,
            text: dataDeleteMessageDescriptionError.innerText,
            timer: 1800,
        });

        // Reload
        location.reload();
    });
});

// Update Message
$(document).on('submit', '#editMessageForm', function (e) {
    // Disabled default events
    e.preventDefault();

    // Get this
    let self = $(this);

    // Get form inputs data
    const dataString = new FormData(this);

    // Disabled request moment resend data
    self.find('button').addClass('disabled');

    // Get message content
    const messageContent = self.parents('.modal').find('textarea').val();

    // Send data to controller
    axios.post(self.attr('action'), dataString)
        .then(res => {
            if (res.data == 1) { // Request sned and get success
                // Sucees Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: dataUpdateMessageTitleSuccess.innerText,
                    text: dataUpdateMessageDescriptionSuccess.innerText,
                    timer: 1500,
                });

                // Get post id
                let id = self.attr('action').split('update/')[1];

                // Remove item
                $('body').find('.m-item[data-item-id="' + id + '"]').find('.text-message').text(messageContent);

                // Close modal after 2 second
                setTimeout(function () {
                    // Hide modal
                    $('#exampleMessageActionsModalCenter').modal('hide');

                    // Remove disabled status
                    self.find('button').removeClass('disabled');
                }, 2000);
            } else {
                // Error Alert
                Swal.fire({
                    position: 'center-center',
                    icon: 'warning',
                    title: dataUpdateMessageTitleError.innerText,
                    text: dataUpdateMessageDescriptionError.innerText,
                    timer: 1800,
                });

                // Reload
                location.reload();
            }
        }).catch(res => { // Request error
        // Error Alert
        Swal.fire({
            position: 'center-center',
            icon: 'error',
            title: dataUpdateMessageTitleError.innerText,
            text: dataUpdateMessageDescriptionError.innerText,
            timer: 1800,
        });

        // Reload
        location.reload();
    });
});

// Add new image event
let iamgeCounter = $('input[name="imagesCount"]').val();


// Delete image
$(document).on('click', '.del', function (e) {
    // Disabled all default events
    e.preventDefault();

    // Get this
    var self = $(this);

    // Check axios
    if ($(this).hasClass('axios')) { // Axios
        // Send data to controller
        axios.get($(this).attr('action'))
            .then(res => {
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

$(document).on('change', '.uploadFile', function (e) {
    // Get this
    const uploadFile = $(this);

    // Get files
    var files = !!this.files ? this.files : [];

    // No file selected, or no FileReader support
    if (!files.length || !window.FileReader) return;

    // Validation
    if (/^image/.test(files[0].type)) {
        // Instance of the FileReader
        const reader = new FileReader();

        // Read the local file
        reader.readAsDataURL(files[0]);

        // Set image data as background of div
        reader.onloadend = function () {
            // Upload
            uploadFile.closest(".image-upload-item").css("background-image", "url(" + this.result + ")");

            // Change images count input value
            $('input[name="imagesCount"]').val(parseInt($('input[name="imagesCount"]').val()) + parseInt(1));
        }
    }

});

// Make Users List Counter
let counterUsersList = 0;

// Show users list mobile event
$(document).on('click', '.see-users-list', function () {
    // Show or Hide Section
    $('.list-chat-item').stop().slideToggle()

    // Increment
    counterUsersList++;

    // Check data
    if (counterUsersList % 2 == 0) {
        // Set this text
        $(this).html($(this).attr('data-show'));
    } else {
        // Set this text
        $(this).html($(this).attr('data-close'));
    }
});

// Make Account Aside Counter
let accountAside = 0;

// Show users list mobile event
$(document).on('click', '.show-account-aside-menu', function () {
    // Show or Hide Section
    $('.account-aside').stop().slideToggle()

    // Increment
    accountAside++;

    // Check data
    if (accountAside % 2 == 0) {
        // Set this text
        $(this).html('<i class="fa fa-bars"></i>' + ' ' + $(this).attr('data-show'));
    } else {
        // Set this text
        $(this).html('<i class="fa fa-bars"></i>' + ' ' + $(this).attr('data-hide'));
    }
});

// Moderation posts alert
$(document).on('click', '.moderation-post', function (e) {
    // Disabled all default events
    e.preventDefault();

    // Error Alert
    Swal.fire({
        position: 'center-center',
        icon: 'warning',
        title: moderationPostTitle.innerText,
        text: moderationPostDescription.innerText,
    });
});


// Post Make Top
$(document).on('click', '.makeTop', function (e) {
    // Disabled all default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Change url
    console.log($('.makeTopAction').length)
    $('.makeTopAction').attr('href', self.attr('data-url'));

});

// Post Make Top
$(document).on('click', '.makeTopAction', function (e) {
    // Disabled all default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Get url
    const url = self.attr('href');


    // Get post maked top text
    const postMekedTopText = self.attr('post-maked-top-text');
    console.log(postMekedTopText)

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
                // location.reload();
                self.removeClass('btn-success').addClass('btn-secondary').addClass('disabled');
                self.closest('.show').attr('id', '');
                location.reload();
                // alert('hesaaaa');
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
$(document).on('click', '.makeHurry', function (e) {
    // Disabled all default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Change url
    $('.makeTopAction').attr('href', self.attr('data-url'));

});
// Post Make Primary
$(document).on('click', '.makePrimary', function (e) {

// alert()
//     Disabled all default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Change url
    $('.makeTopAction').attr('href', self.attr('data-url'));
    // console.log($('.makeTopAction').attr('href'));
    // alert($('.makeTopAction'))
})
// Post Make Hurry
$(document).on('click', '.makeHurryAction', function (e) {
    // Disabled all default events
    alert()
    e.preventDefault();

    // Get this
    const self = $(this);

    // Get url
    const url = self.attr('href');

    // Get post maked hurry text
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
                location.reload();
                // alert('hesaaaa');
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

