/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './fontawesome/css/all.css';
import './fontawesome/js/all.js';

// importation de select2
// require('select2');


// affichage et masquage du formulaire
// const btn = $('#selectBtn')
// btn.click(e =>{
//     e.preventDefault();
//     $('#form').toggle(2000);
//     btn.slideUp();
// })

// on selectione tous les select puis on les ajoute le style select2
// $('select').select2()
// start the Stimulus application
import './bootstrap';
