/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    var navHeader = $(".navbar-header");
    $(window).scroll(function () {
        var height = $(this).scrollTop();
        if (height > 200) {
            navHeader.css("margin-left", "0px");
        } else {
            navHeader.css("margin-left", "-80px");

        }
    });

    $('.to-top').click(function () {
        $('html,body').animate({
            'scrollTop': 0
        }, 500);
    });
});