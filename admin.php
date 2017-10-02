<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 7/24/2017
 * Time: 11:29 AM
 */

include("common.php");

?>

<html>

    <head>
        <?php insertCommonHead(); ?>
        <script src="admin.js"></script>
    </head>

    <body>
        <div class="container-fluid">

            <?php insertCommonHeader(); ?>

            <!-- column 1/2 -->
            <div class="row">
                <div class="col-sm-6">
                    <!--key addition form.-->
                    <form class="form-horizontal well" action="addKey.php" role="form" method="post">
                        <fieldset>
                            <legend>key</legend>
                            <?php insertLabelTag('key-form-KeyTypeID-input','key type'); ?>
                            <select class="form-control" name="key-form-KeyTypeID" id="key-form-KeyTypeID-select">
                                <?php fillKeyTypeSelectList() ?> <!-- creates option tags with innerHTML of names and values of IDs. -->
                            </select>
                            <?php insertLabelInputTypePair('key-form-KeySerialMin', 'first key serial number', 'number'); ?>
                            <?php insertLabelInputTypePair('key-form-KeySerialMax', 'last key serial number', 'number'); ?>
                            <?php insertSubmitButton('btn-submit-addkey'); ?>
                        </fieldset>
                    </form>
                    <!-- add employee form.-->
                    <form class="form-horizontal well" action="addEmployee.php" role="form" method="post">
                        <fieldset>
                            <legend>add employee</legend>
                            <?php insertLabelTag('EmployeeUserID-select','user name'); ?>
                            <select class="form-control" name="EmployeeUserID" id="EmployeeUserID-select">
                                <?php fillUserSelectList(); ?>
                            </select>
                            <?php insertSubmitButton('btn-submit-addEmployee'); ?>
                        </fieldset>
                    </form>
                    <!-- add transmittal form.-->
                    <form class="form-horizontal well" action="addTransmittal.php" role="form" method="post">
                        <fieldset>
                            <legend>add transmittal</legend>
                            <?php insertLabelInputTypePair('TransmittalDate', 'date', 'date'); ?>
                            <?php insertLabelInputPair('TransmittalNumber','transmittal number(ex. ST494)'); ?>
                            <?php insertLabelInputTypePair('TransmittalAmount', 'amount', 'number'); ?>
                            <?php insertSubmitButton('btn-submit-addTransmittal'); ?>
                        </fieldset>
                    </form>
                    <!-- populate transmittal form. -->
                    <form class="form-horizontal well" action="populateTransmittal.php" role="form" method="post">
                        <fieldset>
                            <legend>populate transmittal</legend>
                            <?php insertLabelTag('DepositID-select','Deposit'); ?>
                            <select class="form-control" name="DepositID" id="DepositID-select">
                                <?php fillDepositSelectList(); ?>
                            </select>
                            <?php insertLabelTag('TransmittalID-select','transmittal'); ?>
                            <select class="form-control" name="TransmittalID-select" id="TransmittalID=select">
                                <?php fillTransmittalSelectList(); ?>
                            </select>
                            <?php insertSubmitButton('btn-submit-PopulateTransmittal'); ?>
                        </fieldset>
                    </form>
                </div>
                <!-- column 2/2 -->
                <div class="col-sm-6 ">
                    <!-- add door form -->
                    <form class="form-horizontal well" action="addDoor.php" role="form" method="post">
                        <fieldset>
                            <legend>add Door</legend>
                            <?php insertLabelInputPair('DoorNumber','door number'); ?>
                            <?php insertLabelInputPair('DoorNote', 'door note'); ?>
                            <?php insertSubmitButton('btn-submit-addDoor'); ?>
                        </fieldset>
                    </form>
                    <!-- add key type form -->
                    <form class="form-horizontal well" action="addKeyType.php" role="form" method="post">
                        <fieldset>
                            <legend>add Key Type</legend>
                            <?php insertLabelInputPair('KeyTypeName','key type (ex. J25AC5)'); ?>

                            <!-- div to place doors that the key type opens into! -->
                            <br />
                            <div class="well">
                                <div id="keyType-form-door-div">

                                </div>
                                <br />
                                <button class="btn" id="addKeyTagSet-btn" type="button">add slot</button>
                            </div>

                            <?php insertLabelInputPair('KeyTypeNote','key type note (perhaps what the key opens!)'); ?>

                            <?php insertSubmitButton('btn-submit-addKeyType'); ?>
                        </fieldset>
                    </form>
                    <!-- add unlock form -->
                    <form class="form-horizontal well" action="addUnlock.php" role="form" method="post">
                        <fieldset>
                            <legend>add Unlock</legend>
                            <?php insertLabelTag('DoorID-select','door'); ?>
                            <select name="DoorID" id="DoorID-select" class="form-control">
                                <?php fillDoorSelectList(); ?>
                            </select>
                            <?php insertLabelTag('KeyTypeID-select','key type'); ?>
                            <select name="KeyTypeID" id="KeyTypeID-select" class="form-control">
                                <?php fillKeyTypeSelectList(); ?>
                            </select>
                            <?php insertSubmitButton('btn-submit-addUnlock'); ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
