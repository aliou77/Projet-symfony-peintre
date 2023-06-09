/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import './styles/connexion.scss';
import './styles/pagination.scss';
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



// NB: sans ()=>{} this fera reference a l'element clicker
$(document).ready(function () {
    // js de la navbar
    $(".toggle").on("click", function(){
        $(this).toggleClass("active");
        $(".header-content ul").toggleClass("active");
    })
    
})

// for lightbox2 
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true,
    'disableScrolling': true // desactive la scrollbar
})

// for messages flashes
$("#success").fadeIn(1000).fadeOut(8000)

// for form commentaire
const btn = $('#btn-show-hide')
const close = $("#close")
btn.click(function(e){
    e.preventDefault();
    $('#comment form').toggle(1000);
    this.style.display = "none"
    close.slideDown(1000)
})

close.click(function(e){
    e.preventDefault();
    this.style.display = "none"
    document.querySelector('#comment form').style.display = "none"
    btn.toggle(1000)
})

import './bootstrap';
