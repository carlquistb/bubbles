<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 8/8/2017
 * Time: 4:12 PM
 */
include("common.php");

$RentalUserID = $_GET['RentalUserID'];
$RentalEmployeeID = $_GET['RentalEmployeeID'];
$RentalApproverUserID = $_GET['RentalApproverUserID'];
$RentalExpectedReturnDate = $_GET['RentalExpectedReturnDate'];
echo $RentalExpectedReturnDate;
$RentalExpectedReturnDate = strtotime($RentalExpectedReturnDate);
echo $RentalExpectedReturnDate;
$RentalExpectedReturnDate = date("Y-m-d", $RentalExpectedReturnDate);
echo $RentalExpectedReturnDate;
$DepositType = $_GET['DepositType'];
$RentalNote = $_GET['RentalNote'];
//for each key, insert into the Rentals table.
//TODO: Now that we've changed the format of the tables in mySQL, we need to do
//TODO: some fun stuff. Each rental will only have one key:
//TODO: This will lead to redundancy, but I guess that's OK...
$post_keys_array = array_keys($_GET);
$new_rentalIDs_array = array();
for($i = 0; $i < count($_GET); $i++) {
    $key = $post_keys_array[$i];
    $value = $_GET[$post_keys_array[$i]];
    //if the $_GET variable key has 'Serial' in it, then continue!
    if(!strpos($key, 'Serial')===false) {
        //insert keyID as a Rental
        $KeyID = $value;
        $DepositAmount = $_GET[$post_keys_array[$i+1]];
        // first query- insert into the Deposits table
        $DepositID = executeInsert("insert into Deposits(
                              DepositAmount,
                              DepositType,
                              DepositInitDate)
                            values(
                              '$DepositAmount',
                              '$DepositType',
                              CURRENT_DATE)");
        // second query- insert into the Rentals table
        $queryString = "INSERT INTO Rentals(
                              RentalUserID,
                              RentalEmployeeID,
                              RentalApproverUserID,
                              RentalKeyID,
                              RentalDate,
                              RentalExpectedReturnDate,
                              rentalDepositID,
                              RentalNote)
                            VALUES(
                                $RentalUserID,
                                $RentalEmployeeID,
                                $RentalApproverUserID,
                                $KeyID,
                                CURRENT_DATE,
                                $RentalExpectedReturnDate,
                                $DepositID,
                                '$RentalNote')
                            ";
        $new_rentalIDs_array[] = executeInsert($queryString);
        executeUpdate("UPDATE keys.Keys 
                        SET keys.Keys.KeyInUse = 1 
                        WHERE keys.Keys.KeyID = $KeyID");
    }
}
?>
<html>
<head>
    <?php insertCommonHead(); ?>
</head>
<body>
<?php insertCommonHeader(); ?>
<?php
    for($i = 0; $i++;$i < count($new_rentalIDs_array)) {
        selectToTable("select * from vRentalSummary where RentalID=$new_rentalIDs_array[$i]");
    }
?>
</body>
</html>
