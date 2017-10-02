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
                <div class="col-sm-4">
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
                </div>
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
            </div>

        </div>
    </body>
</HTML>
