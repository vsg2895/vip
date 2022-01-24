// const {Cloudinary} = require("@cloudinary/url-gen");
window._ = require('lodash');

// console.log('there')
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';
//
// window.Pusher = require('pusher-js');
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: '2613f9e3161869dd2b76',
//     cluster: 'ap2',
//     forceTLS: true
// });

/**
 * Firebase Initialization
 */

var firebaseConfig = {
    apiKey: "AIzaSyB2F0JXi2fG2MW4yQXm-7QIpUirBIKQeQE",
    authDomain: "erevanvip-cf4d7.firebaseapp.com",
    // databaseURL: "https://erevanvip-cf4d7.firebaseio.com",
    databaseURL: "https://erevanvip-cf4d7-default-rtdb.firebaseio.com",
    projectId: "erevanvip-cf4d7",
    storageBucket: "erevanvip-cf4d7.appspot.com",
    messagingSenderId: "1062240295341",
    appId: "1:1062240295341:web:3b513d4f0846329a5b6924"
};
firebase.initializeApp(firebaseConfig);
