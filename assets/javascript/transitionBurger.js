$(document).ready(function(){
    $('.bouton-burger').click(function(){
    	$(this).find('.barre').toggleClass('blanc');
        $('.nav').toggleClass('isOpen');
    });
});