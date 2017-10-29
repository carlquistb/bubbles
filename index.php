<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 6/30/2017
 * Time: 1:28 PM
 */

include("common.php");
?>




<HTML>

    <head>
        <?php insertCommonHead() ?>
        <script src="index.js"></script>
    </head>

    <body>

        <P>
            <?php
                if($keys_connection->connect_error) {
                    echo "Not connected. Error: " . $keys_connection->connect_error;
                }
                else {
                    echo "Connected to the mySQL server.";
                }
            ?>
        </P>

        <div class="container-fluid">

            <?php insertCommonHeader() ?>

            <div class="row">
                <!-- overdue rentals column -->
                    <div class="well well-lg">
                        <h2>overdue rentals</h2>
                        <div id="overdueTableContainer">
                            <?php
                                selectToTable("Select RentalID, RentalExpectedReturnDate, UserFirstName,UserLastName from Rentals
                                              join Users on Users.UserID = Rentals.RentalUserID
                                              where Rentals.RentalExpectedReturnDate  
                                                < date_add(current_date,interval 15 day)");
                            ?>
                        </div>
                    </div>
            </div>
            <div class="row well well-lg">
                <h2>
                    unprocessed deposits
                </h2>
                <?php selectToTable(    "select 
                                                      Deposits.DepositID, 
                                                      Deposits.DepositAmount,
                                                      Rentals.RentalDate,
                                                      concat(Users.UserFirstName, ' ' ,Users.UserLastName) as 'user name',
                                                      concat(KeyTypes.KeyTypeName, ' (',  k.KeySerial, ')') as 'key'
                                                    from Deposits 
                                                    join Rentals on 
                                                      Rentals.RentalDepositID=Deposits.DepositID
                                                    join Users on
                                                      Users.UserID = Rentals.RentalUserID
                                                    join keys.Keys as k on 
                                                      k.KeyID = Rentals.RentalKeyID
                                                    join KeyTypes 
                                                      on k.KeyTypeID = KeyTypes.KeyTypeID
                                                    where DepositTransmittalID is null"); ?>
            </div>

        </div>
    </body>
</HTML>
