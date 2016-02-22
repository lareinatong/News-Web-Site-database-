<?php
require 'database.php';

$first = $_POST['first'];
$last = $_POST['last'];
$dept = $_POST['dept'];

$stmt = $mysqli->prepare("insert into employees (first_name, last_name, department) values (?, ?, ?)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('sss', $first, $last, $dept);

$stmt->execute();

$stmt->close();

?>