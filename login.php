<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('includes/required.php');
if($session->is_logged_in()){
	redirect_to('index.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'):

	global $db;

	$username = $db->escape_value(strtolower(trim($_POST['username'])));
	$password = $db->escape_value(trim($_POST['password']));

	$found_user = User::authenticate($username, $password);

	if($found_user) {
		$session->message("Login Successful.");
		$session->login($found_user);
		redirect_to("index.php");
	}else {
		$session->message("Username/Password Combination is Incorrect.");
		redirect_to("login.php");
	}

?>
<?php else:
require_once('includes/header.php');
	$username = "";
	$password = "";

	echo $message;
	$message = " ";
	$session->message(" ");
?>
<h2>Login</h2>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="width: 41%; float: left; padding: 0 5%;">
		<table summary="Login Form">
			<tr>
				<td>Username: </td>
				<td><input style="width: 216px;" type="text" value="<?php echo htmlentities($username); ?>" name="username" maxlength="32" /></td>
			</tr>
			<tr>
				<td>Password: </td>
				<td><input style="width: 216px;" type="password" value="<?php echo htmlentities($password); ?>" name="password" maxlength="32" /></td>
			</tr>
		</table>
			<input class="buttonOrange right" type="submit" value="Login" />
	</form>
	<div style="width: 34%; padding: 0 5%; float: left; border-left: 2px solid #bee3e9;">
		<button class="buttonBlue" onclick="window.location = 'signup.php';">Sign Up</button><br />
		<button class="buttonBlue" onclick="window.location = 'no_account.php';">Proceed Without an Account</button>
	</div>
<?php 
require_once('includes/footer.php');
endif;
?>

