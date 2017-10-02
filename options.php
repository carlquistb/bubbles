<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 8/7/2017
 * Time: 9:57 AM
 */

if(!isset($_GET)) {
    echo("ERROR: the options.php page is being called without a GET prerogative.");
    exit;
}

if(!isset($_GET['table'])) {
    echo("ERROR: the table parameter was not passed.");
    exit;
}

include("common.php");

//if it is KeySerial options that we are looking for-
if($_GET['table'] == 'Keys') {
    if(!isset($_GET['KeyTypeID'])) {
        echo("ERROR: the KeyTypeID parameter was not passed.");
        exit;
    }
    $KeyTypeID = $_GET['KeyTypeID'];
    $results = executeSelect("Select KeySerial, KeyID
                      from keys.Keys
                      where KeyTypeID = $KeyTypeID
                      AND keys.Keys.KeyInUse = 0",
                  "there was an error filling the Keys select list. \n");

    if($results->num_rows === 0) {
        echo "there were zero returned rows!";
        exit;
    }

    $Key = mysqli_fetch_array($results, MYSQLI_NUM);
    while($Key!= null) {
        /*for each door, add a option tag. */ ?>
        <option value="<?= $Key[1] ?>">
            <?php echo $Key[0]; ?>
        </option>
        <?php
        $Key= mysqli_fetch_array($results, MYSQLI_NUM);
    }
}

//if it is KeyTypes options that we are looking for-
if($_GET['table'] == 'KeyTypes') {
    $results = executeSelect("Select KeyTypeName, KeyTypeID
                      from KeyTypes",
                  "there was an error filling the Approval select list. \n");

    if($results->num_rows === 0) {
        echo "there were zero returned rows!";
        exit;
    }

    $KeyType = mysqli_fetch_array($results, MYSQLI_NUM);
    while($KeyType!= null) {
        /*for each door, add a option tag. */ ?>
        <option value="<?= $KeyType[1] ?>">
            <?php echo $KeyType[0]; ?>
        </option>
        <?php
        $KeyType= mysqli_fetch_array($results, MYSQLI_NUM);
    }
}

//if it is Approvals options we are looking for-
if($_GET['table'] == 'Approvals') {
    if(!isset($_GET['UserID'])) {
        echo("ERROR: the UserID parameter was not passed.");
        exit;
    }
    $UserID = $_GET['UserID'];

    $results = executeSelect("Select 
                                  Users.UserFirstName, 
                                  Users.UserLastName, 
                                  Approvals.ApprovalFaculty, 
                                  KeyTypes.KeyTypeName, 
                                  Approvals.ApprovalID
                              from Approvals 
                                  join Users on Approvals.ApprovalUserID = Users.UserID
                                  join KeyTypes on KeyTypes.KeyTypeID = Approvals.ApprovalKeyTypeID
                              where Approvals.ApprovalUserID = $UserID",
                              "there was an error filling the Approval select list. \n");

    if($results->num_rows === 0) {
        echo "there were zero returned rows!";
        exit;
    }

    $Approval = mysqli_fetch_array($results, MYSQLI_NUM);
    while($Approval != null) {
        /*for each door, add a option tag. */ ?>
        <option value="<?= $Approval[4] ?>">
            <?php echo $Approval[0]; ?>, <?php echo $Approval[1]; ?>,  <?php echo $Approval[2]; ?>, <?php echo $Approval[3]; ?>
        </option>
        <?php
        $Approval = mysqli_fetch_array($results, MYSQLI_NUM);
    }
}

//if it is table options we are looking for-
if($_GET['table'] == 'Doors') {
    $results = executeSelect("Select DoorNumber, DoorID from Doors",
                  "there was an error filling the Doors select list. \n");

    if($results->num_rows === 0) {
        echo "there were zero returned rows!";
        exit;
    }

    $door = mysqli_fetch_array($results, MYSQLI_NUM);
    while($door != null) {
        /*for each door, add a option tag. */ ?>
        <option value="<?= $door[1] ?>">
            <?php echo $door[0]; ?>
        </option>
        <?php
        $door = mysqli_fetch_array($results, MYSQLI_NUM);
    }
}
