// Landing pages 2017 scripts
jQuery(document).ready(function($){

    $('.bxslider').bxSlider();


    // Cookies Info Popup
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    function checkCookie() {
        var accepted = getCookie("cookie-accepted");
        if (accepted != 1) {
            $('#cookies-info').show();
        }
    }
    checkCookie();
    $('#cookies-info .cookies-close').click(function(){
        setCookie('cookie-accepted', 1, 365);
        $('#cookies-info').hide();
    })
    $('#cookies-info .cookies-accept').click(function(){
        setCookie('cookie-accepted', 1, 365);
        $('#cookies-info').hide();
    })
});