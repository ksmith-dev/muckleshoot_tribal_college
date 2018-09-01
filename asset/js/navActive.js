$(function(){
    var $page = window.location.pathname;
    $('li.headTab>a').each(function(){
        var $href = $(this).attr('href');
        if ( ($href == $page) || ($href == '') ) {
            $(this).parent().addClass('navActive');
        } else {
            $(this).removeClass('navbar-default');
        }
    });
    $('li.headTab>ul>li>a').each(function(){
        var $href = $(this).attr('href');
        if ( ($href == $page) || ($href == '') ) {
            $(this).parent().parent().parent().addClass('navActive');
        } else {
            $(this).removeClass('navbar-default');
        }
    });
});