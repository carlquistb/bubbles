<?php
/**
 * Created with PhpStorm.
 * User: carlquistb
 */

/***********
 * ABSOLUTE GLOBAL VARIABLES
 ***********/
$GLOBALS['DB'] = 'keys';
$GLOBALS['DB_PASSWORD'] = 'Calendars_5uck';
$GLOBALS['DB_USERNAME'] = 'root';
$GLOBALS['HOST'] = 'ovid.u.washington.edu';
$GLOBALS['PORT'] = '53412';
/**
 *inserts insides of the <head> tag that should be included, such as bootstrap and such.
 */
function insertCommonHead() {
    ?>
        <!-- takes in Bootstrap and JQuery. -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <meta charset="utf-8" />


        <!-- titles the page. -->
        <title>Bubbles</title>

        <!--links css and javascript. -->
        <link rel="stylesheet" href="common.css" />
        <script src="common.js"></script>
    <?php
}

/**
 *inserts the cool jumbo-tron header.
 */
function insertCommonHeader() {
    ?>
    <div class="jumbotron text-center">
        <h1><a href="index.php">Bubbles</a></h1>
        <h2>
            <a href="add.php"><span class="glyphicon glyphicon-plus"></span></a> ||
            <a href="search.php"><span class="glyphicon glyphicon-search"></span></a> ||
            <a href="edit.php"><span class="glyphicon glyphicon-pencil"></span></a> ||
            <a href="admin.php"><span class="glyphicon glyphicon-lock"></span></a>
        </h2>
    </div>
    <?php
}

/**
 * inserts a label and input tag pair
 * @param $for_name_id
 * @param $text
 */
function insertLabelInputPair($for_name_id, $text) {
    insertLabelInputTypePair($for_name_id, $text, "");
}

/**
 * inserts a label and input tag pair, defining <input type="?">
 * @param $for_name_id
 * @param $text
 * @param type
 */
function insertLabelInputTypePair($for_name_id, $text, $type) {
    insertLabelTag($for_name_id, $text);
    ?>
    <input class="form-control" name="<?= $for_name_id ?>" id="<?= $for_name_id ?>-input" type="<?= $type ?>">
    <?php
}

/**
 * inserts a label tag.
 * @param $for
 * @param $text
 */
function insertLabelTag($for, $text) {
    ?>
    <label class="control-label" for="<?= $for ?>-input">
        <?= $text ?>
    </label>
    <?php
}

/**
 * inserts a submit button.
 * @param $id
 */
function insertSubmitButton($id) {
    ?>
    <br>
    <button type="submit" class="btn btn-success" id="<?= $id ?>">Submit</button>
    <?php
}

/**
 * inserts <option> tags with
 * innerHTML=UserName
 * value=UserID
 */
function fillUserSelectList() {
    $results = executeSelect("Select UserFirstName, UserLastName, UserUWID, UserID from Users",
                    "there was an error filling the User select list. \n");

    if($results->num_rows === 0) {
        ?> <option> this list is empty. </option> <?php
    }

    $user = mysqli_fetch_array($results, MYSQLI_NUM);
    while($user != null) {
        /*for each user, add a option tag. */ ?>
        <option value="<?= $user[3] ?>">
            <?php echo $user[0]; ?>  <?php echo $user[1]; ?> <?php echo $user[2]; ?>
        </option>
        <?php
        $user = mysqli_fetch_array($results, MYSQLI_NUM);
    }
}
/**
 * inserts <option> tags with values of UserIDs of eligible people who can approve keys.
 */
function fillApproverSelectList() {
    $results = executeSelect("Select UserFirstName, UserLastName, UserUWID, UserID 
                              from Users
                              where UserType = 'ase' OR UserType = 'staff' OR UserType = 'faculty'",
        "there was an error filling the User select list. \n");

    if($results->num_rows === 0) {
        ?> <option> this list is empty. </option> <?php
    }

    $user = mysqli_fetch_array($results, MYSQLI_NUM);
    while($user != null) {
        /*for each user, add a option tag. */ ?>
        <option value="<?= $user[3] ?>">
            <?php echo $user[0]; ?> <?php echo $user[1]; ?> <?php echo $user[2]; ?>
        </option>
        <?php
        $user = mysqli_fetch_array($results, MYSQLI_NUM);
    }
}

/**
 * inserts <option> tags with
 * innerHTML=KeyTypeName
 * value=KeyTypeID
 */
function fillKeyTypeSelectList() {
    $results = executeSelect("Select KeyTypeName, KeyTypeID from KeyTypes",
                    "there was an error filling the KeyType select list. \n");

    if($results->num_rows === 0) {
        ?> <option> this list is empty. </option> <?php
    }

    $KeyType = mysqli_fetch_array($results, MYSQLI_NUM);
    while($KeyType != null) {
        /*for each user, add a option tag. */ ?>
        <option value="<?= $KeyType[1] ?>">
            <?php echo $KeyType[0]; ?>
        </option>
        <?php
        $KeyType = mysqli_fetch_array($results, MYSQLI_NUM);
    }
}

/**
 * inserts <option> tags with
 * innerHTML=EmployeeName
 * value=EmployeeID
 */
function fillEmployeeSelectList() {
    $results = executeSelect(
        "Select Users.UserFirstName, Users.UserLastName, EmployeeID from Employees
          join Users on Employees.EmployeeUserID = Users.UserID",
        "there was an error filling the Employee select list. \n"
        );

    if($results->num_rows === 0) {
        ?> <option> this list is empty. </option> <?php
    }

    $employee = mysqli_fetch_array($results, MYSQLI_NUM);
    while($employee != null) {
        /*for each employee, add a option tag. */ ?>
        <option value="<?= $employee[2] ?>">
            <?php echo $employee[0]; ?> <?php echo $employee[1]; ?>
        </option>
        <?php
        $employee = mysqli_fetch_array($results, MYSQLI_NUM);
    }
}

/**
 * inserts <option> tags with
 * innerHTML=DoorName
 * value=DoorID
 */ 
function fillDoorSelectList() {
    $results = executeSelect("Select DoorNumber, DoorID from Doors",
                    "there was an error filling the Door select list. \n");

    if($results->num_rows === 0) {
        ?> <option> this list is empty. </option> <?php
    }

    $Door = mysqli_fetch_array($results, MYSQLI_NUM);
    while($Door != null) {
        /*for each user, add a option tag. */ ?>
        <option value="<?= $Door[1] ?>">
            <?php echo $Door[0]; ?>
        </option>
        <?php
        $Door = mysqli_fetch_array($results, MYSQLI_NUM);
    }
}

/**
 * inserts <option> tags with
 * innerHTML=DepositUserName . DepositAmount . DepositDate
 * value=DepositID
 * this will only take deposits that do not have a transmittal associated yet.
 */
function fillDepositSelectList() {
    //fill the list with deposits that don't have a transmittal ID attached.
    $results = executeSelect(
        "Select Deposits.DepositID, 
                Deposits.DepositAmount, 
                Users.UserFirstName, 
                Users.UserLastName, 
                Deposits.DepositInitDate 
          from Deposits
          join Rentals 
            on Rentals.RentalDepositID = Deposits.DepositID
          join Users 
            on Users.UserID = Rentals.RentalUserID
          where Deposits.DepositTransmittalID = '' 
            or Deposits.DepositTransmittalID is null",
        "there was an error filling the Deposits select list. \n"
    );

    if($results->num_rows === 0) {
        ?> <option> this list is empty. </option> <?php
    }

    $Deposit = mysqli_fetch_array($results, MYSQLI_NUM);
    while($Deposit != null) {
        /*for each employee, add a option tag. */ ?>
        <option value="<?= $Deposit[0] ?>">
            <?php echo "\$" + $Deposit[1] + "from " + $Deposit[2] + " " + $Deposit[3] + "on" + $Deposit[4]; ?>
        </option>
        <?php
        $Deposit = mysqli_fetch_array($results, MYSQLI_NUM);
    }
}

/**
 * inserts <option> tags with
 * innerHTML=TransmittalNumber
 * value=TransmittalID
 * this will only take transmittals that have mismatched associative amounts and total amounts.
 */
function fillTransmittalSelectList() {
//TODO
    //fill the list with deposits that don't have a transmittal ID attached.
    $results = executeSelect(
        "Select Transmittals.TransmittalNumber, Transmittals.TransmittalID
          from Transmittals
          join Deposits 
            on Deposits.DepositTransmittalID = Transmittals.TransmittalID",
        "there was an error filling the Deposits select list. \n"
    );

    if($results->num_rows === 0) {
        ?> <option> this list is empty. </option> <?php
    }

    $transmittals = mysqli_fetch_array($results, MYSQLI_NUM);
    while($transmittals != null) {
        /*for each employee, add a option tag. */ ?>
        <option value="<?= $transmittals[1] ?>">
            <?php echo $transmittals[0]; ?>
        </option>
        <?php
        $Deposit = mysqli_fetch_array($results, MYSQLI_NUM);
    }
}

/**
 * function that showcases a common alert div.
 * @param $alert
 */
function insertAlert($alert) {
    ?>
    <div class="well">
        <span class="glyphicon glyphicon-warning-sign"></span>
        <p>
            <?= $alert ?>
        </p>
    </div>
    <?php
}

function executeInsert($queryString, $errorMessage = "Sorry, this form is experiencing problems.") {
    $connection = new MySQLi($GLOBALS['HOST'], $GLOBALS['DB_USERNAME'], $GLOBALS['DB_PASSWORD'],$GLOBALS['DB'],$GLOBALS['PORT']);
    if(!$results = $connection->query($queryString)) {
        echo $errorMessage;
        echo "Error: our query failed to execute, and here is why: \n";
        echo "Query: " . $queryString . '\n';
        echo "Errno: " . $connection->errno . '\n';
        echo "Error: " . $connection->error . '\n';
        exit;
    }

    return $connection->insert_id;
}

function executeSelect($queryString, $errorMessage = "Sorry, this form is experiencing problems.") {
    $connection = new MySQLi($GLOBALS['HOST'], $GLOBALS['DB_USERNAME'], $GLOBALS['DB_PASSWORD'],$GLOBALS['DB'],$GLOBALS['PORT']);
    if(!$results = $connection->query($queryString)) {
        echo $errorMessage;
        echo "Error: our query failed to execute, and here is why: \n";
        echo "Query: " . $queryString . "\n";
        echo "Errno: " . $connection->errno . "\n";
        echo "Error: " . $connection->error . "\n";
        exit;
    }

    return $results;
}

function executeUpdate($queryString, $errorMessage = "Sorry, this form is experiencing problems.") {

    $connection = new MySQLi($GLOBALS['HOST'], $GLOBALS['DB_USERNAME'], $GLOBALS['DB_PASSWORD'],$GLOBALS['DB'],$GLOBALS['PORT']);
    if(!$results = $connection->query($queryString)) {
        echo $errorMessage;
        echo "Error: our query failed to execute, and here is why: \n";
        echo "Query: " . $queryString . '\n';
        echo "Errno: " . $connection->errno . '\n';
        echo "Error: " . $connection->error . '\n';
        exit;
    }
}
/**
 * generic query return to table.
 * @param $queryString
 * give me a query, and I will return aa nice table!!
 */
function selectToTable($queryString) {
    $results = executeSelect($queryString);

    if(!($results->num_rows === 0)) {

        ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <?php
                    $result = $results->fetch_assoc();
                    $columns = array_keys($result);
                    for ($i = 0; $i < count($columns); $i++) {
                        ?>
                        <th>
                            <?= $columns[$i] ?>
                        </th>
                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                //for each record, make a row
                while ($result != null) {
                    ?>
                    <tr>
                        <?php
                        //for each column, make a cell
                        for ($j = 0; $j < count($columns); $j++) {
                            ?>
                            <td>
                                <!-- fill the cell with the result from the $result array. -->
                                <?= $result[$columns[$j]]; ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                    $result = $results->fetch_assoc();
                }
                ?>
            </tbody>
        </table>
        <?php
    }
}
