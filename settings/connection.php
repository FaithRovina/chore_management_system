<?php
//constants
$SERVER= 'localhost:3306';
$USERNAME= 'root';
$PASSWORD= '@StrateGicPlan20178##';
$DATABASE='chores_mgt';

$con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE) or die("The database was not created");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

echo "Connection was successful";
?>
