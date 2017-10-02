<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 8/7/2017
 * Time: 1:05 PM
 */

include("common.php");

//stage user input out of the POST array for SQL insertion.
$UserID = $_POST['EmployeeUserID'];
$last_id = executeInsert("INSERT INTO Employees
                  (EmployeeUserID,EmployeeInitDate)
                  VALUES(
                  '$UserID',
                  CURRENT_DATE()
                  )");

?>
<HTML>
    <HEAD>
        <?php insertCommonHead(); ?>
    </HEAD>
    <BODY>
        <?php insertCommonHeader(); ?>
        <?php selectToTable("select EmployeeID, EmployeeNote, UserFirstName, UserLastName, EmployeeInitDate, EmployeeTimeStamp FROM Employees 
                              join Users on Users.UserID = Employees.EmployeeUserID
                              where Employees.EmployeeID = $last_id"); ?>
    </BODY>
</HTML>
