<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.12/jquery.bxslider.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.12/jquery.bxslider.min.js" crossorigin="anonymous"></script>



<?php
$server = "localhost";
$login = "lasthero";
$password = "";
$db = 'lasthero';

$connection = mysqli_connect($server,$login,$password,$db);

if(!$connection) {
	die("Connection problem: " . mysqli_connect_error());
}

//echo "Connected successfully";


if(isset($_POST['submit']) && !isset($_COOKIE['log_user_id'])){
$username = mysqli_real_escape_string($connection,trim($_POST['username']));
$password = mysqli_real_escape_string($connection,trim($_POST['password']));

$query = "SELECT username FROM likesparcer WHERE username='$username'";
$request = mysqli_query($connection,$query);
if(mysqli_num_rows($request) == 0){
	echo('User not found');
	mysqli_close($connection);
	die;
}

	$query = "SELECT id,username,password FROM likesparcer WHERE username='$username' AND password=SHA('$password')";
	$request = mysqli_query($connection, $query);
	if($request && mysqli_num_rows($request) == 1) {
		echo("Successfully logged in");
		$row = mysqli_fetch_assoc($request);
		setcookie('log_user_id',$row['id']);
		echo("You are logged as" . $row['username']);
	} else {
		echo("Error: " . mysqli_error($connection));
	}

mysqli_close($connection);

}
?>

<div class="d-flex container justify-content-center align-items-center" style="height: 100vh">

<div class="row row-centered">

<div class="col-md-12 col-centered">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
	<div class="form-group input-group">
	<span class="input-group-addon"><i class="fa fa-user"></i></span>
	<input type="text" name="username" style="display:block" class="mx-auto" placeholder="username">
	</div>
	<div class="form-group input-group">
	<span class="input-group-addon"><i class="fa fa-lock"></i></span>
	<input type="text" name="password" style="display:block" class="mx-auto" placeholder="password">
	</div>
	<div class="form-group input-group">
	<button name="submit" class="mx-auto btn btn-def btn-block"  >login</button>
	</div>
</form>
</div>

</div>
</div>



