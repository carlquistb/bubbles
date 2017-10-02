<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 7/21/2017
 * Time: 1:52 PM
 */
include("common.php");

//stage user input out of the POST array for SQL insertion.
$UserLastName = $_POST['user-form-UserLastName'];
$UserMiddleName = $_POST['user-form-UserMiddleName'];
$UserFirstName = $_POST['user-form-UserFirstName'];
$UserNetID = $_POST['user-form-UserNetID'];
$UserPhoneNumber = $_POST['user-form-UserPhoneNumber'];
$UserType = $_POST['user-form-UserType'];
$UserUWID = $_POST['user-form-UserUWID'];
$UserAlternateID = $_POST['user-form-UserAlternateID'];
$UserEmail = $_POST['user-form-UserEmail'];
$UserStreetAddress = $_POST['user-form-UserStreetAddress'];
$UserCity = $_POST['user-form-UserCity'];
$UserState = $_POST['user-form-UserState'];
$UserZipCode = $_POST['user-form-UserZipCode'];
$UserNote = $_POST['user-form-UserNote'];
$UserIsTemp = $_POST['user-form-UserIsTemp'];

//format input.
$UserFirstName = ucwords(strtolower($UserFirstName));
$UserLastName = ucwords(strtolower($UserLastName));
$UserMiddleName = ucwords(strtolower($UserMiddleName));
$UserPhoneNumber = preg_replace('~[^0-9+]~',"",$UserPhoneNumber);

$UserID = executeInsert("INSERT INTO Users
                                (UserLastName, UserFirstName, UserMiddleName ,UserNetID, UserPhoneNumber, UserType, UserUWID, UserAlternateID, UserEmail, UserStreetAddress, UserCity, UserState, UserZipCode, UserNote, UserIsTemp, UserInitDate, UserTimeStamp)
                          VALUES(
                                '$UserLastName',
                                '$UserFirstName',
                                '$UserMiddleName',
                                '$UserNetID',
                                '$UserPhoneNumber',
                                '$UserType',
                                '$UserUWID',
                                '$UserAlternateID',
                                '$UserEmail',
                                '$UserStreetAddress',
                                '$UserCity',
                                '$UserState',
                                '$UserZipCode',
                                '$UserNote',
                                '$UserIsTemp',
                                CURRENT_DATE(),
                                CURRENT_TIMESTAMP)");
?>
<html>
    <head>
        <?php insertCommonHead(); ?>
    </head>
    <body>
        <?php
            insertCommonHeader();
            selectToTable("select * from keys.Users where Users.UserID = $UserID");
        ?>
    </body>
</html>
