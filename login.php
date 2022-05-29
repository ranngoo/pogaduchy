<?php
include('database_connection.php');
session_start();
$message = '';
if(isset($_SESSION['user_id']))
{
header('location:index.php');
}

if(isset($_POST['login']))
{
$query = "
	SELECT * FROM login 
	WHERE username = :username
";
$statement = $connect->prepare($query);
$statement->execute(
	array(
	':username' => $_POST['username']
)
);	
$count = $statement->rowCount();
if($count > 0)
{
	$result = $statement->fetchAll();
	foreach($result as $row)
{
if(password_verify($_POST['password'], $row['password']))
{
$_SESSION['user_id'] = $row['user_id'];
$_SESSION['username'] = $row['username'];
$sub_query = "
INSERT INTO login_details 
(user_id) 
VALUES ('".$row['user_id']."')
";
$statement = $connect->prepare($sub_query);
$statement->execute();
$_SESSION['login_details_id'] = $connect->lastInsertId();
header('location:index.php');
}
else
{
$message = '<label>Zle Haslo</label>';
}
}
}
else
{
$message = '<label>zla nazwa uzytkownika</labe>';
}
}
?>
<html>  
    <head>  
        <title>Czat online</title>  
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body style="background:bcl.jpg;background-position: center;background-size: cover">  
        <div class="container">
			<br />
			
			<h3 align="center">LOGOWANIE </h3><br />
			<br />
			<div class="panel panel-default">
  				<div class="panel-heading">Logowanie</div>
				<div class="panel-body">
					<p class="text-danger"><?php echo $message; ?></p>
<form method="post">
	<div class="form-group">
	<label>Nazwa uzytkownika</label>
	<input type="text" name="username" class="form-control" required />
</div>
<div class="form-group">
	<label>Haslo</label>
	<input type="password" name="password" class="form-control" required />
</div>
<div class="form-group">
	<input type="submit" name="login" class="btn btn-info" value="Login" />
</div>
<div align="center">
<a href="register.php">Rejestracja</a>
</div>
</form>
<br />
<br />
<br />
<br />
</div>
</div>
</div>
</body>  
</html>
