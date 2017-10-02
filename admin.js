/**
 * Created by carlquistb on 8/6/2017.
 */

(function() {
    'use strict';
    var numDoors = 0;

    window.onload = function() {
        setOnClickFunctions();
    };

    function setOnClickFunctions() {
        $("#addKeyTagSet-btn").click(addKeyTagSet);
    }

    function addKeyTagSet() {
        numDoors++;
        var parent = $("#keyType-form-door-div");

        //door <label>
        var DoorLabel = document.createElement("label");
        DoorLabel.setAttribute("class","control-label");
        DoorLabel.setAttribute("for","KeyTypeDoor" + numDoors + "-select");
        DoorLabel.innerHTML = "Door:";
        parent.append(DoorLabel);

        //door <select>
        var DoorSelect = document.createElement("select");
        DoorSelect.setAttribute("class", "form-control");
        DoorSelect.setAttribute("name","KeyTypeDoor" + numDoors);
        DoorSelect.setAttribute("id","KeyTypeDoor" + numDoors + "-select");
            var ajax = new XMLHttpRequest();
            ajax.onload = function() {
                DoorSelect.innerHTML = this.responseText;
            };
            ajax.open("GET", "options.php?table=Doors", true);
            ajax.send(null);
        parent.append(DoorSelect);
    }
}());