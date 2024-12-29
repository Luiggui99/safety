import './bootstrap';

let banner = document.querySelector('.slider .banner');
let items = document.querySelectorAll('.slider .banner .item');
let dots = document.querySelectorAll('.slider .dots li');

let prev = document.getElementById('prev')
let next = document.getElementById('next')

let active = 0;
let lengthItems = items.length - 1;

next.onclick = function(){
    if(active + 1 > lengthItems) {
        active = 0
    } else {
        active = active + 1;
    }
    reloadSlider();
}

prev.onclick = function(){
    if(active - 1 < 0) {
        active = lengthItems
    } else {
        active = active - 1;
    }
    reloadSlider();
}

// let refreshSlider = setInterval( () => {next.click()}, 3000)

function reloadSlider(){
    let checkLeft = items[active].offsetLeft;
    banner.style.left = -checkLeft + 'px';

    let lastActiveDot = document.querySelector('.slider .dots li.active');
    lastActiveDot.classbanner.remove('active');
    dots[active].classbanner.add('active')
    // clearInterval(refreshSlider)
    // refreshSlider = setInterval( () => {next.click()}, 3000)

}

dots.forEach((banner, key) => {
    banner.addEventbannerener('click', function(){
        active = key;
        reloadSlider()
    })
})
