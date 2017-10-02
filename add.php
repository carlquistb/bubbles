<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 7/19/2017
 * Time: 3:54 PM
 */

include("common.php");
?>
<html>
    <head>
        <?php insertCommonHead() ?>
        <script src="add.js"></script>
    </head>

    <body>
        <div class="container-fluid">

            <?php insertCommonHeader() ?>

            <div class="row"> <!-- row for both forms -->
                <div class="col-sm-6"> <!-- column for user form -->
                    <div class="well well-lg">
                        <form class="form-horizontal" action="addUser.php" role="form" method="post">
                            <fieldset>
                                <legend>User</legend>
                                <?php insertLabelInputPair('user-form-UserFirstName', 'first name *'); ?>
                                <?php insertLabelInputPair('user-form-UserMiddleName', 'middle name'); ?>
                                <?php insertLabelInputPair('user-form-UserLastName', 'last name *'); ?>
                                <?php insertLabelInputPair('user-form-UserNetID', 'netID'); ?>
                                <?php insertLabelTag('user-form-UserType-select','User type *'); ?>
                                <select class="form-control" name="user-form-UserType" id="user-form-UserType-select">
                                    <option value="student">Student</option>
                                    <option value="ase">ASE</option>
                                    <option value="staff">Staff</option>
                                    <option value="faculty">Faculty</option>
                                    <option value="guest">Guest</option>
                                </select>
                                <?php insertLabelInputPair('user-form-UserUWID', 'UW ID'); ?>
                                <?php insertLabelInputPair('user-form-UserAlternateID', 'alternate ID'); ?>
                                <?php insertLabelInputPair('user-form-UserEmail', 'email *'); ?>
                                <?php insertLabelInputTypePair('user-form-UserPhoneNumber', 'phone number', 'tel'); ?>
                                <?php insertLabelInputPair('user-form-UserStreetAddress', 'street address *'); ?>
                                <?php insertLabelInputPair('user-form-UserCity', 'city *'); ?>
                                <?php insertLabelInputPair('user-form-UserState', 'state *'); ?>
                                <?php insertLabelInputPair('user-form-UserZipCode', 'zipcode *'); ?>
                                <?php insertLabelTag('user-form-UserIsTemp-select','is this a temporary user? *'); ?>
                                <select class="form-control" name="user-form-UserIsTemp" id="user-form-UserIsTemp-select">
                                    <option value="y">yes</option>
                                    <option value="n">no</option>
                                </select>
                                <?php insertLabelInputPair('user-form-UserNote', 'Notes'); ?>
                                <?php insertSubmitButton('btn-submit-add-user'); ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6"> <!-- column for rental form -->
                    <div class="well well-lg">
                        <form class="form-horizontal" action="addRental.php" role="form" method="get">
                            <legend>rentals</legend>
                            <fieldset>
                                <?php insertLabelTag('RentalUserID-select','user'); ?>
                                <select class="form-control" name="RentalUserID" id="RentalUserID-select">
                                    <?php fillUserSelectList() ?>
                                </select>
                                <br />
                                <div class="well">
                                    <div id="rental-form-key-div">

                                    </div>
                                    <br />
                                    <button class="btn" id="addKeyTagSet-btn" type="button">add slot</button>
                                </div>

                                <?php insertLabelTag('RentalApproverUserID','approver'); ?>
                                <select class="form-control" name="RentalApproverUserID"  id="RentalApproverUserID-select">
                                    <?php fillApproverSelectList() ?>
                                </select>

                                <?php insertLabelTag('RentalEmployeeID-select','Employee'); ?>
                                <select class="form-control" name="RentalEmployeeID" id="RentalEmployeeID-select">
                                    <?php fillEmployeeSelectList() ?>
                                </select>

                                <?php insertLabelInputTypePair('RentalExpectedReturnDate', 'expected return date', 'date'); ?>

                                <?php //insertLabelInputTypePair('DepositAmount', 'deposit amount', 'number'); ?>

                                <?php insertLabelTag('DepositType-select','deposit type'); ?>
                                <select name="DepositType" id="DepositType-select" class="form-control">
                                    <option value="cash">
                                        cash
                                    </option>
                                    <option value="check">
                                        check
                                    </option>
                                </select>

                                <?php insertLabelInputPair('RentalNote', 'Notes'); ?>

                                <?php insertSubmitButton('btn-submit-add-rental'); ?>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>