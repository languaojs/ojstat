$(document).ready(function () {
    $('.flash').slideDown(800);
    $('.flash').click(function(){
        $(this).slideUp(700).fadeOut();
    });
    $('[data-toggle="popover"]').popover();    
});