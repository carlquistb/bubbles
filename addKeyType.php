<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 8/6/2017
 * Time: 6:54 PM
 */

include("common.php");

$KeyTypeName = $_POST['KeyTypeName'];
$KeyTypeNote = $_POST['KeyTypeNote'];

//TODO: Before we add, we need to check that there is no current keyType that unlocks those rooms.
//TODO: This can't be done in SQL because it would require foreign key constraints... Not happening :(

// first query- insert into the KeyTypes table
$KeyTypeID = executeInsert("INSERT INTO KeyTypes(
                                KeyTypeName, 
                                KeyTypeNote, 
                                KeyTypeInitDate)
                            VALUES(
                                '$KeyTypeName',
                                '$KeyTypeNote',
                                CURRENT_DATE()
                            )");
//for each Unlock, insert into the Unlocks table.
foreach($_POST as $key => $doorID) {
    //if the $_POST variable key has 'Door' in it, than continue!
    if(!strpos($key, 'Door')===false) {
        executeInsert("INSERT INTO Unlocks
                          (DoorID, KeyTypeID, UnlockInitDate)
                      VALUES(
                          '$doorID',
                          '$KeyTypeID',
                          CURRENT_DATE()
                      )");
    }
}
?>
<html>
    <head>
        <?php insertCommonHead(); ?>
    </head>
    <body>
        <?php insertCommonHeader(); ?>
        <?php selectToTable("SELECT KeyTypes.KeyTypeID, 
                                    KeyTypes.KeyTypeName,
                                    KeyTypes.KeyTypeNote,
                                    KeyTypes.KeyTypeInitDate,
                                    Doors.DoorNumber
                                FROM KeyTypes 
                                JOIN Unlocks 
                                  ON KeyTypes.KeyTypeID = Unlocks.KeyTypeID
                                join Doors
                                  on Doors.DoorID = Unlocks.DoorID
                                WHERE KeyTypes.KeyTypeID = $KeyTypeID
                                ");
        ?>
    </body>
</html>
