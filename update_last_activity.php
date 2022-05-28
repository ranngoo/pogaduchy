<?php

//update_last_activity.php

include('database_connection.php');

session_start();

$tmp = $_SESSION['login_details_id'];

$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE login_details_id = '".$tmp."'
";

$statement = $connect->prepare($query);

$statement->execute();

?>
