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