/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

window.openModal = function(idModal) {
  var modal = document.getElementById(idModal);
  modal.style.display = "block";
} // When the user clicks on <span> (x), close the modal


window.closeModal = function(idModal) {
    var modal = document.getElementById(idModal);
    modal.style.display = "none";
}

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');



