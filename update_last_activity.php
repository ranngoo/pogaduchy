<?php

//update_last_activity.php

include('database_connection.php');

session_start();

$_GET['login_details_id'] = $log_id;

if(isset($log_id))
{
 
$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE login_details_id = ".$log_id;

$statement = $connect->prepare($query);

$statement->execute();
}
?>
