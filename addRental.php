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
        echo $queryString;
        executeInsert($queryString);
        //TODO: make a query that changes the key's status to in use.
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
selectToTable("SELECT Rentals.RentalID,
                      U.UserFirstName as 'User First Name',
                      U.UserLastName as 'User Last Name',
                      UE.UserFirstName as 'Employee First Name',
                      UE.UserLastName as 'Employee Last Name',
                      UA.UserFirstName as 'Approver First Name',
                      UA.UserLastName as 'Approver Last Name',
                      KeyTypes.KeyTypeName,
                      keys.Keys.KeySerial,
                      Rentals.RentalDate,
                      Rentals.RentalExpectedReturnDate,
                      Deposits.DepositAmount,
                      Deposits.DepositType
                FROM Rentals 
                join Users as U on U.UserID = Rentals.RentalUserID
                join keys.Keys on keys.Keys.KeyID = Rentals.RentalKeyID
                join KeyTypes on KeyTypes.KeyTypeID = keys.Keys.KeyTypeID
                join Employees on Employees.EmployeeID = Rentals.RentalEmployeeID
                join Users as UE on Employees.EmployeeUserID = UE.UserID
                join Users as UA on UA.UserID = Rentals.RentalApproverUserID
                join Deposits on Rentals.RentalDepositID = Deposits.DepositID
                ORDER BY Rentals.RentalDate ASC
                ");
?>
</body>
</html>
