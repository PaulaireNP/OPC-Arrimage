//import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import '../styles/app.sass'

console.log('This log comes from assets/main.js - welcome to AssetMapper! 🎉')

const scrollContainer = document.querySelector('#scrollContainer');

scrollContainer.addEventListener('mouseover', () => {
    scrollContainer.style.animationPlayState = 'paused';
});

scrollContainer.addEventListener('mouseout', () => {
    scrollContainer.style.animationPlayState = 'running';
});