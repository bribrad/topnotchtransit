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