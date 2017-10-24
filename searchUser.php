<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 10/14/2017
 * Time: 12:52 AM
 */
include("common.php");

?>

<html>
    <head>
        <?php insertCommonHead(); ?>
    </head>
    <body>
        <?php
            insertCommonHeader();

            if($_GET['searchterm'] == 'firstname') {
                $letter = $_GET['letter'];
                selectToTable("select UserFirstName, UserLastName from Users where UserFirstName like '$letter%'");
            }
            else if($_GET['searchterm'] == 'lastname') {
                $letter = $_GET['letter'];
                selectToTable("select UserFirstName, UserLastName from Users where UserLastName like '$letter%'");
            }
            else if($_GET['searchterm'] == 'keyID') {
                /* search all rentals ever to have that keyID, display in chronological order. */
                //detailed view of current rental.
                ?><h2>current rental</h2><?php
                selectToTable("select * from Rentals where");
                selectToTable("");
            } else {
                ?><h2>error!</h2><?php
            }
        ?>
    </body>
</html>