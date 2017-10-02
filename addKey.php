<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 8/7/2017
 * Time: 4:58 PM
 */

include("common.php");

$KeySerialMin = $_POST['key-form-KeySerialMin'];
$KeySerialMax = $_POST['key-form-KeySerialMax'];
$KeyTypeID = $_POST['key-form-KeyTypeID'];
//check that the keys don't already exist:
$keysAlreadyExist = false;
for($i=$KeySerialMin; $i <= $KeySerialMax; $i++) {
    //if there are results, trip the wire.
    $results = executeSelect("select * from keys.Keys where keyTypeID = $KeyTypeID and KeySerial = $i");
    if(!($results->num_rows === 0)) {
        $keysAlreadyExist = true;
    }
}

if(!$keysAlreadyExist) {
    for($i=$KeySerialMin; $i <= $KeySerialMax; $i++) {
    executeInsert("INSERT INTO keys.Keys
                          (KeyTypeID, KeySerial, KeyInitDate)
                          VALUES(
                          '$KeyTypeID',
                          '$i',
                          CURRENT_DATE
                          )");
    }
}

?>
<HTML>
    <HEAD>
        <?php insertCommonHead(); ?>
    </HEAD>
    <BODY>
        <?php insertCommonHeader(); ?>

        <?php
            if(!$keysAlreadyExist) {
                selectToTable("select * from keys.Keys where KeyTypeID = $KeyTypeID");
            }
            else {
            ?> <p> I'm sorry, but at least one of those keys has already been entered. </p>
            <?php
        }?>

    </BODY>
</HTML>