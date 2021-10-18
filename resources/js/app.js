require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

//navbar index
let h = document.documentElement,
b = document.body,
st = 'scrollTop',
sh = 'scrollHeight',
progress = document.querySelector('#progress'),
scroll;
let scrollpos = window.scrollY;
let header = document.getElementById("header");
let navcontent = document.getElementById("nav-content");
let logo = document.getElementById("logo");

document.addEventListener('scroll', function () { 
scroll = (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
progress.style.setProperty('--scroll', scroll + '%');
scrollpos = window.scrollY;

if (scrollpos > 10) {
    header.classList.add("bg-gray-400");
    header.classList.remove("top-10");
    header.classList.add("top-0", 'opacity-75');
    navcontent.classList.remove("bg-gray-300");
    navcontent.classList.add("bg-gray-400", 'opacity-75');
    logo.classList.add("w-48", 'opacity-50');
} else {
    header.classList.remove("bg-gray-300");
    header.classList.remove("top-0");
    header.classList.add("top-10");
    navcontent.classList.remove("bg-gray-300");
    navcontent.classList.add("bg-gray-400");
}

});

document.getElementById('nav-toggle').onclick = function () {
document.getElementById("nav-content").classList.toggle("hidden");
}
