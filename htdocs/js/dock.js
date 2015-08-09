/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    $("head").append("<link href='css/dock.css' type='text/css' rel='stylesheet' />");

    $('.dock li').on('mouseover', function (e) {
        var li = e.currentTarget;
        var prevLi = li.previousElementSibling;
        if (prevLi) {
            $(prevLi).addClass('prev');
        }
    });

    $('.dock li').on('mouseout', function (e) {
        var li = e.currentTarget;
        var prevLi = li.previousElementSibling;
        if (prevLi) {
            $(prevLi).removeClass('prev');
        }
    });
});


