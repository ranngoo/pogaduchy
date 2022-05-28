<?php

//update_last_activity.php

include('database_connection.php');

session_start();

if(isset($_SESSION['login_details_id']))
{
 
$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE login_details_id = '".$_POST['login_details_id']."'
";

$statement = $connect->prepare($query);

$statement->execute();
}
?>
