<?php
/**
 * Created by PhpStorm.
 * User: iguest
 * Date: 10/24/17
 * Time: 2:51 PM
 */
include("common.php");

$key_ID = $_POST["keyID"];
echo $key_ID;

?>

<html>
    <head>
        <?php insertCommonHead(); ?>
        <!--<script src="searchKey.js"></script> NOTE: for if we ever need a .js file here.-->
    </head>
    <body>
        <?php insertCommonHeader(); ?>
        <?php selectToTable("select RentalID, RentalDate as 'Rental Date', RentalExpectedReturnDate as 'Expected Return Date', 
                                        RentalReturnDate as 'Recorded Return Date', RentalNote as 'Rental Note', user.UserName as 'User', 
                                        approver.UserName as 'Approver'
                                        from Rentals join vUsers as user on user.UserID = RentalUserID join vUsers as approver on Rentals.RentalApproverUserID = approver.UserID
                                        where RentalKeyID = $key_ID order by RentalReturnDate ASC"); ?>
    </body>
</html>
