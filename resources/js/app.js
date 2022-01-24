require('./bootstrap');
// const Cloudinary = require("@cloudinary/url-gen");

const {Cloudinary} = require("@cloudinary/url-gen");
// window.cloudinary = require('@cloudinary/url-gen');
window.cloudinary_obj = new Cloudinary({
    cloud: {
        cloudName: 'yerevan-vip'
    }
});

(function () {
    console.log('here')
})()


// window.cloudinary = require('../../node_modules/@cloudinary/url-gen/instance/Cloudinary.js');
// window.cloud_obj = new window.cloudinary({
//     cloud: {
//         cloudName: 'yerevan-vip'
//     }
// })

// require('../../node_modules/@cloudinary/url-gen');
