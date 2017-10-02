<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 8/7/2017
 * Time: 12:59 PM
 */

include("common.php");

//stage user input out of the POST array for SQL insertion.
$DoorID = $_POST['DoorID'];
$KeyTypeID = $_POST['KeyTypeID'];

executeInsert("INSERT INTO Unlocks
                  (DoorID,KeyTypeID,UnlockInitDate)
              VALUES(
                  '$DoorID',
                  '$KeyTypeID',
                  CURRENT_DATE()
                  )");
?>
<HTML>
    <HEAD>
        <?php insertCommonHead(); ?>
    </HEAD>
    <BODY>
        <?php insertCommonHeader(); ?>
        <?php selectToTable("select * from Unlocks 
                              where DoorID = $DoorID 
                                and KeyTypeID = $KeyTypeID"); ?>

    </BODY>
</HTML>
