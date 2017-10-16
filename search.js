/**
 * Created by carlquistb on 10/15/2017.
 */
(function() {
    'use strict';

    window.onload = function() {
        setOnClickFunctions();
    };

    function setOnClickFunctions() {
        $("#keyTypeID-select")[0].onchange = fillKeyIDSelectList;
    }

    function fillKeyIDSelectList() {
        var select = $("#keyID-select");
        //'this' here is the <select> for KeyTypeID.
        // The value parameter is the value of the selected <option>.
        var KeyTypeID = this.value;

        var ajax = new XMLHttpRequest();
        ajax.onload = function() {
            select.innerHTML = this.responseText;
        };
        ajax.open("GET", "options.php?table=Keys&KeyTypeID=" + KeyTypeID, true);
        ajax.send(null);
    }
}());