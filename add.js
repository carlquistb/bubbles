/**
 * Created by carlquistb on 7/19/2017.
 */

(function() {
    'use strict';
    var numRentalKeys = 0;

    window.onload = function() {
        setOnClickFunctions();
    };

    function setOnClickFunctions() {
        $("#addKeyTagSet-btn").click(addKeyTagSet);
        $("#RentalUserID-select")[0].onchange = fillApprovalSelectList;
    }

    function fillApprovalSelectList() {
        var select = $("#RentalApprovalID-select")[0];
        //in this context, 'this' is the <select> with #RentalUserID-select.
        var userID = this.value;

        var ajax = new XMLHttpRequest();
        ajax.onload = function() {
            select.innerHTML = this.responseText;
        };
        ajax.open("GET", "options.php?table=Approvals&UserID=" + userID, true);
        ajax.send(null);


    }

    function addKeyTagSet() {
        numRentalKeys++;
        var parent = $("#rental-form-key-div");

        //key type <label>
        var keyTypeLabel = document.createElement("label");
        keyTypeLabel.setAttribute("class","control-label");
        keyTypeLabel.setAttribute("for","RentalKeyType" + numRentalKeys + "-select");
        keyTypeLabel.innerHTML = "key type";
        parent.append(keyTypeLabel);

        //key type <select>
        var keyTypeSelect = document.createElement("select");
        keyTypeSelect.setAttribute("class", "form-control");
        keyTypeSelect.setAttribute("name","RentalKeyType" + numRentalKeys);
        keyTypeSelect.setAttribute("id","RentalKeyType" + numRentalKeys + "-select");
        parent.append(keyTypeSelect);

        //key type <value>s
        var ajax = new XMLHttpRequest();
        ajax.onload = function() {
            keyTypeSelect.innerHTML = this.responseText;
        };
        ajax.open("GET", "options.php?table=KeyTypes", true);
        ajax.send(null);

        //key serial <label>
        var keySerialLabel = document.createElement("label");
        keySerialLabel.setAttribute("class","control-label");
        keySerialLabel.setAttribute("for","RentalKeySerial" + numRentalKeys + "-select");
        keySerialLabel.innerHTML = "key serial";
        parent.append(keySerialLabel);

        //key serial <select>
        var keySerialSelect = document.createElement("select");
        keySerialSelect.setAttribute("class","form-control");
        keySerialSelect.setAttribute("name","RentalKeySerial" + numRentalKeys);
        keySerialSelect.setAttribute("id","RentalKeySerial" + numRentalKeys + "-select");
        parent.append(keySerialSelect);

        //key serial <value>s
        keyTypeSelect.onchange = function() {
            //TODO: create the onchange handler for each of the rentalKeyTypeSelects, that fills RentalKeySerial.
            var KeyTypeID = this.value;
            debugger;
            var ajax = new XMLHttpRequest();
            ajax.onload = function() {
                keySerialSelect.innerHTML = this.responseText;
            };
            ajax.open("GET", "options.php?table=Keys&inUse=0&KeyTypeID=" + KeyTypeID, true);
            ajax.send(null);
        };

        //deposit <label>
        var keyDepositLabel = document.createElement("label");
        keyDepositLabel.setAttribute("class","control-label");
        keyDepositLabel.setAttribute("for","RentalKeyDeposit" + numRentalKeys + "-input");
        keyDepositLabel.innerHTML = "key deposit";
        parent.append(keyDepositLabel);

        //deposit <select>
        var keyDepositInput = document.createElement("input");
        keyDepositInput.setAttribute("class", "form-control");
        keyDepositInput.setAttribute("name","RentalKeyDeposit" + numRentalKeys);
        keyDepositInput.setAttribute("id","RentalKeyDeposit" + numRentalKeys + "-input");
        keyDepositInput.setAttribute("type","number");
        parent.append(keyDepositInput);

    }


}());