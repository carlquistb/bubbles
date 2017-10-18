<?php
/**
 * Created by PhpStorm.
 * User: carlquistb
 * Date: 7/24/2017
 * Time: 9:45 PM
 */

include("common.php");

?>

<html>
    <head>
        <?php insertCommonHead(); ?>
        <script src="search.js"></script>
    </head>
    <body>
        <?php insertCommonHeader(); ?>
        <!-- <p class="well">
            Plans for this page:
            the goal of this page is to put in information about something, and be able to get the rest of the information about it.
            <br><br>Very simply, this page will provide a form for each kind of thing you can look up, and will direct you to "GET" pages that return tables of data.
            <br> using "GET" pages will mean that the URL can be copied and sent, and you can bookmark results and all that.
            <br><br> This will allow people to either get information they need, or get the ID of what they need to change.
        </p>  -->

        <div class="row">
            <div class="col-sm-12">
                <div class="well well-lg">
                    <!-- <form class="form-horizontal" action="searchUser.php" role="form" method="get">
                        <fieldset>

                        </fieldset>
                    </form> -->
                    <h2>search by first initial</h2>
                    <?php $AZ = range('A','Z'); ?>
                    <?php
                        foreach($AZ as $letter) {
                            ?> <a href="searchUser.php?searchterm=firstname&letter=<?php echo $letter; ?>"><?php echo $letter; ?> </a>
                    <?php } ?>
                </div>
                <div class="well well-lg">
                    <h2>search by last initial</h2>
                    <?php $AZ = range('A','Z'); ?>
                    <?php
                    foreach($AZ as $letter) {
                        ?> <a href="searchUser.php?searchterm=lastname&letter=<?php echo $letter; ?>"><?php echo $letter; ?> </a>
                    <?php } ?>
                </div>
                <div class="well well-lg">
                    <form class="form-horizontal" action="searchKey.php"></form>
                    <legend>search by key serial</legend>
                    <fieldset>
                        <?php insertLabelTag('keyTypeID-select','key type');?>
                        <select class="form-control" name="keyTypeID" id="keyTypeID-select">
                            <?php fillKeyTypeSelectList(); ?>
                        </select>
                        <?php insertLabelTag('keyID-select','key serial');?>
                        <select class="form-control" name="keyID" id="keyID-select">
                            <!-- TODO: form javascript to fill this list after event listener. -->
                        </select>
                    </fieldset>

                </div>
            </div>
        </div>
    </body>
</html>
