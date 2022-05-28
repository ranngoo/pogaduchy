<?php

include('database_connection.php');

$_SESSION['user_id'] = $log_id;

if(isset($log_id))
{
 
$que1 = "select login_details_id from login_details 
where user_id =".$log_id;
 $st = $connect->prepare($query);
 
$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE login_details_id = ".$st;

$statement = $connect->prepare($query);
$st->execute();
$statement->execute();
}
?>
