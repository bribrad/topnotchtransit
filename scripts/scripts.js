// function scroll() {
//     $(document).scroll(function () {
//     var $nav = $(".navbar-nav");
//     $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
//     console.log("navbar scrolled");
//     });
// }

const navbar = document.querySelector('.navbar-fixed');
window.onscroll = () => {
    if (window.scrollY > 300) {
        console.log("scroll scrolling");
        navbar.classList.add('nav-active');
    } else {
        navbar.classList.remove('nav-active');
    }
};

function getPics() {} //just for this demo
const imgs = document.querySelectorAll('.isotope img');
const fullPage = document.querySelector('#fullpageimg');
const fullPageBackground = document.querySelector('#fullpage');

window.onload = () => {
    imgs.forEach(img => {
    img.addEventListener('click', function() {
        fullPage.style.backgroundImage = 'url(' + img.src + ')';
        fullPage.style.display = 'block';
        fullPageBackground.style.display = 'block';
        console.log("image clicked");
    });
    });

    fullPage.addEventListener('click', () => {
        fullPageBackground.style.display = 'none';
        fullPage.style.display = 'none';
    });

    fullPageBackground.addEventListener('click', () => {
        fullPageBackground.style.display = 'none';
        fullPage.style.display = 'none';
    });
    console.log('full page loaded');
}

function myFunction() {
    var x = document.getElementById("myTopNav");
    if (x.className === "navbar-fixed") {
      console.log("adding responsive class");
      x.className += " responsive";
    } else {
      console.log("removing responsive class");  
      x.className = "navbar-fixed";
    }
  }