<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('includes/required.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') : 

global $db;

$username = $db->escape_value(strtolower(trim($_POST['username'])));
$password = $db->escape_value(trim($_POST['password']));
$name = $db->escape_value(trim($_POST['name']));
$email = $db->escape_value(trim($_POST['email']));
$company_name = $db->escape_value(trim($_POST['company_name']));
$phone_number = $db->escape_value(trim($_POST['phone_number']));
$street_address1 = $db->escape_value(trim($_POST['street_address1']));
$street_address2 = $db->escape_value(trim($_POST['street_address2']));
$city = $db->escape_value(trim($_POST['city']));
$state = $db->escape_value(trim($_POST['state']));
$zip = $db->escape_value(trim($_POST['zip']));



if(User::is_unique($username) && isset($password, $name, $email, $phone_number, $street_address1, $city, $state, $zip)) {

	global $db;
	$user = new User();
	$user->username = $username;
	$user->password = $password;
	$user->name = $name;
	$user->email = $email;
	$user->company_name = $company_name;
	$user->phone_number = $phone_number;
	$user->street_address1 = $street_address1;
	$user->street_address2 = $street_address2;
	$user->city = $city;
	$user->state = $state;
	$user->zip = $zip;
	$user->save(); 

	$session->message("Please Login with Your New Username and Password.");
	redirect_to('login.php');

}else {

	$session->message("Please fill out required fields | Username must be unique.");
	redirect_to($_SERVER['PHP_SELF']);
	
}


else:
require_once('includes/header.php');
$username = isset($username) ? $username : "";
$password = isset($password) ? $password : "";
$name = isset($name) ? $name : "";
$email = isset($email) ? $email : "";
$company_name = isset($company_name) ? $company_name : "";
$phone_number = isset($phone_number) ? $phone_number : "";
$street_address1 = isset($street_address1) ? $street_address1 : "";
$street_address2 = isset($street_address2) ? $street_address2 : "";
$city = isset($city) ? $city : "";
$state = isset($state) ? $state : "";
$zip = isset($zip) ? $zip : "";

echo $message;
$message = " ";
$session->message(" ");

?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" summary="Signup Form">
		<table>
			<tr>
				<td class="required">Username:</td>
				<td><input type="text" name="username" value="<?php echo isset($_POST['username']) ? htmlentities($_POST['username']) : ""; ?>"/></td>
			</tr>
			<tr>
				<td class="required">Password:</td>
				<td><input type="password" name="password" value="<?php echo htmlentities($password); ?>"/></td>
			</tr>
			<tr>
				<td class="required">Name:</td>
				<td><input type="text" name="name" value="<?php echo htmlentities($name); ?>"/></td>
			</tr>			<tr>
				<td class="required">Email:</td>
				<td><input type="text" name="email" value="<?php echo htmlentities($email); ?>"/></td>
			</tr>
			<tr>
				<td>Company Name:</td>
				<td><input type="text" name="company_name" value="<?php echo htmlentities($company_name); ?>"/></td>
			</tr>
			<tr>
				<td class="required">Phone Number:</td>
				<td><input type="text" name="phone_number" value="<?php echo htmlentities($phone_number); ?>"/></td>
			</tr>
			<tr>
				<td class="required">Street Address 1:</td>
				<td><input type="text" name="street_address1" value="<?php echo htmlentities($street_address1); ?>"/></td>
			</tr>
			<tr>
				<td>Street Address 2:</td>
				<td><input type="text" name="street_address2" value="<?php echo htmlentities($street_address2); ?>"/></td>
			</tr>
			<tr>
				<td class="required">City:</td>
				<td><input type="text" name="city" value="<?php echo htmlentities($city); ?>"/></td>
			</tr>
			<tr>
				<td class="required">State:</td>
				<td><input type="text" name="state" value="<?php echo htmlentities($state); ?>"/></td>
			</tr>
			<tr>
				<td class="required">Zip:</td>
				<td><input type="text" name="zip" value="<?php echo htmlentities($zip); ?>"/></td>
			</tr>
			<tr>
				<td colspan="2">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td>
					<span class="required">Required = </span>
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<td colspan="2">
					&nbsp;
				</td>
			</tr>
			<tr>
				<td>
					<input class="buttonBlue" type="submit" onclick="window.location='login.php'; return false;" value="Already registered" />
				</td>
				<td style="text-align: right;">
					<input class="buttonOrange" type="submit" value="Submit"/>
				</td>
			</tr>
		</table>
	</form>
<?php 
require_once('includes/footer.php');
endif;
?>
