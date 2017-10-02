<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 7/24/2017
 * Time: 9:52 PM
 */
    include("common.php");
?>
<html>
    <head>
        <?php insertCommonHead(); ?>
    </head>
    <body>
        <?php insertCommonHeader(); ?>
        <p class="well">
            The purpose of this page is to take in new information about objects.
            <br><br>This page will ask for only IDs of different object types.
            <br><br> when an ID is provided, it will link to a page that has two columns. In one column, the current information will be shown In the second column, you will be able to put in new data that will replace the old.
        </p>
    </body>
</html>