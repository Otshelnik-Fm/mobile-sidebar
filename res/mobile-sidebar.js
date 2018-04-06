(function($){
$(document).ready(function() {

var button = $('#mbs_bttn');
var mbMenu = $('#mbs_menu');

function closeMbMenu(){
    mbMenu.removeClass('mbs_menu_open').addClass('mbs_menu_hidden').css({'max-height':''});
}


button.on('click', function (){
    var mHeight = $(window.top).height() - 36;
    
    if (mbMenu.hasClass('mbs_menu_open')){   // до клика был открыт. Закроем
        closeMbMenu();
    } else {
        mbMenu.removeClass('mbs_menu_hidden').addClass('mbs_menu_open').css({'max-height': mHeight+'px'});;
    }
});


var mobileSidebar = $('#otfm_mobile_sidebar');
var content = mobileSidebar.children();

function sidebarToMenu(){
    $('.mbs_menu_hidden').append(content).addClass('mbs_menu_moved');
    mobileSidebar.hide();
    if($('.mbs_menu_hidden > div').length){
        button.show();
    }
}


var leftMenu = $('.mbs_menu_hidden');

if ($(window).width() <= 768) { // инициализация 768px
    sidebarToMenu();
}
$(window).resize(function() {
    closeMbMenu();
    
    if ($(window).width() <= 768) {
        if (!leftMenu.hasClass('mbs_menu_moved')){
            sidebarToMenu();
        }
    } else {
        mobileSidebar.append(content).addClass('mbs_menu_moved');
        mobileSidebar.show();
        leftMenu.removeClass('mbs_menu_moved');
        button.hide();
    }
});


});
})(jQuery);