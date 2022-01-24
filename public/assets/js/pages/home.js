// You can change global variables here:
var autoRotate = true; // auto rotate or not
var rotateSpeed = -60; // unit: seconds/360 degrees

// Responsive
if (window.innerWidth > 992) {
    var radius = 380;
    var imgWidth = 320;
    var imgHeight = 180;
} else if (window.innerWidth < 992 && window.innerWidth >= 768) {
    var radius = 310;
    var imgWidth = 240;
    var imgHeight = 120;
} else if (window.innerWidth < 768 && window.innerWidth > 576) {
    var radius = 280;
    var imgWidth = 220;
    var imgHeight = 100;
} else if (window.innerWidth < 576 && window.innerWidth > 480) {
    var radius = 250;
    var imgWidth = 200;
    var imgHeight = 70;
} else {
    var radius = 150;
    var imgWidth = 180;
    var imgHeight = 50;
}


// ===================== start =======================
// animation start after 1000 miliseconds
setTimeout(init, 1000);

var odrag = document.getElementById('drag-container');
var ospin = document.getElementById('spin-container');
var aImg = ospin.getElementsByClassName('cont');
var aEle = [...aImg];

// Size of images
ospin.style.width = imgWidth + "px";
ospin.style.height = imgHeight + "px";

// Size of ground - depend on radius
var ground = document.getElementById('ground');
ground.style.width = radius * 3 + "px";
ground.style.height = radius * 3 + "px";

function init(delayTime) {
    for (var i = 0; i < aEle.length; i++) {
        aEle[i].style.transform = "rotateY(" + (i * (360 / aEle.length)) + "deg) translateZ(" + radius + "px)";
        aEle[i].style.transition = "transform 1s";
        aEle[i].style.transitionDelay = delayTime || (aEle.length - i) / 4 + "s";
    }
}

function applyTranform(obj) {
    // Constrain the angle of camera (between 0 and 180)
    if (tY > 180) tY = 180;
    if (tY < 0) tY = 0;

    // Apply the angle
    obj.style.transform = "rotateX(" + (-tY) + "deg) rotateY(" + (tX) + "deg)";
}

function playSpin(yes) {
    ospin.style.animationPlayState = (yes ? 'running' : 'paused');
}

var sX, sY, nX, nY, desX = 0,
    desY = 0,
    tX = 0,
    tY = 10;

// auto spin
if (autoRotate) {
    var animationName = (rotateSpeed > 0 ? 'spin' : 'spinRevert');
    ospin.style.animation = `${animationName} ${Math.abs(rotateSpeed)}s infinite linear`;
}

// setup events
document.onpointerdown = function (e) {
    if (e.target.id != 'homeSlider' && e.target.id != 'ground') {
        return;
    }
    clearInterval(odrag.timer);
    e = e || window.event;
    var sX = e.clientX,
        sY = e.clientY;
    this.onpointermove = function (e) {
        e = e || window.event;
        var nX = e.clientX,
            desX = nX - sX;
        tX += desX * 0.1;
        applyTranform(odrag);
        sX = nX;
    };

    this.onpointerup = function (e) {
        odrag.timer = setInterval(function () {
            desX *= 0.95;
            desY *= 0.95;
            tX += desX * 0.1;
            tY += desY * 0.1;
            applyTranform(odrag);
            playSpin(false);
            if (Math.abs(desX) < 0.5 && Math.abs(desY) < 0.5) {
                clearInterval(odrag.timer);
                playSpin(true);
            }
        }, 17);
        this.onpointermove = this.onpointerup = null;
    };
    return false;
}


// document.onmousewheel = function(e) {
//   e = e || window.event;
//   var d = e.wheelDelta / 20 || -e.detail;
//   radius += d;
//   init(1);
// };

// Top categories slider
// $('.custom-slider').slick('unslick');
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
var row_count = $('#top_size').data('row');
var show_count = $('#top_size').data('show');
if ($(window).width() < 1025 && $(window).width() > 768) {

    show_count = 4;

}

// alert(row_count)
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
$('#slick2').slick({
    rows: 2,
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
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

//   list js um chi haskanum nerqevi event@
// $(document).on('submit', '#filteringForm', function(e){
//
//   alert()
// })


const x = document.getElementsByClassName("spare-part-click");
// const BASE_URI = 'http://localhost:8000/hy/';
// const BASE_URI2 = "http://localhost:8000/assets/img/spare-parts/";

const BASE_URI = 'http://dfsddsdfe.us-east-2.elasticbeanstalk.com/hy/';
const BASE_URI2 = "http://dfsddsdfe.us-east-2.elasticbeanstalk.com/assets/img/spare-parts/";

if (x) {
    var myFunction = function () {
        $('#spare-parts-container').removeClass('spare-container-collapsed');

        var attribute = this.getAttribute("data-id");

        const spareListContainer = document.getElementById('spare-parts-container');

        const uri = `${BASE_URI}ss/${attribute}`;

        axios.get(uri)
            .then(res => {
                $('#spare_parts_body').empty();

                res.data.forEach(it => {
                    $("#spare_parts_body").append(`
            <tr>
              <td>
                <img src="${BASE_URI2}${it.img}" style="width:100px;height:auto;" class="d-block mx-auto rounded" />
              </td>
              <td>
                ${it.first_name} ${it.last_name}
              </td>
              <td>
                ${it.location['title_hy']}
              </td>
              <td>
                <a href="tel:${it.phone}">${it.phone}</a>
              </td>
            </tr>
          `);
                });

                $('#spare-parts-container').addClass('spare-container-collapsed');

            })
            .catch(err => {
                console.log('err', err);
            });


    };

    for (var i = 0; i < x.length; i++) {
        x[i].addEventListener('click', myFunction, false);
    }

}
