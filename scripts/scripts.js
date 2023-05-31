// function scroll() {
//     $(document).scroll(function () {
//     var $nav = $(".navbar-nav");
//     $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
//     console.log("navbar scrolled");
//     });
// }

const navbar = document.querySelector('.navbar-fixed');
window.onscroll = () => {
    if (window.scrollY > 80) {
        console.log("scroll scrolling");
        navbar.classList.add('nav-active');
    } else {
        navbar.classList.remove('nav-active');
    }
};

function myFunction() {
    var x = document.getElementById("myTopNav");
    if (x.className === "container") {
      console.log("adding responsive class");
      x.className += " responsive";
    } else {
      console.log("removing responsive class");  
      x.className = "container";
    }
  }