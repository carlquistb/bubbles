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
                                selectToTable("Select * from Rentals
                                              where Rentals.RentalExpectedReturnDate  
                                                < date_add(current_date,interval 15 day)");
                            ?>
                        </div>
                    </div>
                <? /*
                TODO: blocked off because currently, the form factor messes up quite badly. I don't think we want a table here.
                <!--temporary users column -->
                <div class="col-sm-4">
                    <div class="well well-lg">
                        <h2>temporary users</h2>
                        <?php selectToTable("select UserID, UserLastName, UserFirstName from Users where UserIsTemp = 'y'"); ?>
                    </div>
                </div>
                <!-- transmittals and deposits column -->
                <div class="col-sm-4">
                    <div class="well well-lg">
                        <h2>
                            unprocessed transmittals and deposits
                        </h2>
                        <p class="well">
                            ex) Transmittal ___ was for $___, but the total of the deposits associated is not equal!
                        </p>
                        <p class="well">
                            ex) Deposit ___, by ___ has not been included in a cash transmittal yet.
                        </p>
                    </div>
                </div>
                   */?>
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
