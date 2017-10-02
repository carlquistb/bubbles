<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 7/31/2017
 * Time: 5:52 PM
 */
include("common.php");

//stage user input out of the POST array for SQL insertion.
$DoorNumber = $_POST['DoorNumber'];
$DoorNote = $_POST['DoorNote'];

$last_id = executeInsert("INSERT INTO Doors
                  (DoorNumber,DoorNote,DoorInitDate,DoorTimeStamp)
                  VALUES(
                  '$DoorNumber',
                  '$DoorNote',
                  CURRENT_DATE(),
                  CURRENT_TIMESTAMP)");

?>
<HTML>
    <HEAD>
        <?php insertCommonHead(); ?>
    </HEAD>
    <BODY>
        <?php insertCommonHeader(); ?>
        <?php selectToTable("SELECT * FROM Doors where DoorID = $last_id"); ?>
    </BODY>
</HTML>
