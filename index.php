<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('includes/required.php');

if(!$session->is_logged_in()) { redirect_to('login.php'); }
if($_SERVER['REQUEST_METHOD'] == 'POST'):

	if(isset($_POST['update'])) {
		$user = new User;
		if($session->is_logged_in()) {$user->id = $_SESSION['user_id'];};
		$user->username = $db->escape_value(strtolower(trim($_POST['username'])));
		$user->password = $db->escape_value(trim($_POST['password']));
		$user->company_name = $db->escape_value(trim($_POST['company_name']));
		$user->name = $db->escape_value(trim($_POST['name']));
		$user->email = $db->escape_value(trim($_POST['email']));
		$user->phone_number = $db->escape_value(trim($_POST['phone_number']));
		$user->street_address1 = $db->escape_value(trim($_POST['street_address1']));
		$user->street_address2 = $db->escape_value(trim($_POST['street_address2']));
		$user->city = $db->escape_value(trim($_POST['city']));
		$user->state = $db->escape_value(trim($_POST['state']));
		$user->zip = $db->escape_value(trim($_POST['zip']));
		$user->save();
		$session->message('Update Successful.');
		redirect_to($_SERVER['PHP_SELF']);
	}elseif (isset($_POST['logout'])){
		$session->logout();
		redirect_to('login.php');
	}else {
		require_once('includes/header.php');
		global $db;
		$distributor_id = ($_SESSION['distributor']);
		
		if(isset($_SESSION['quantities'])) {
			SendMail::send_mail($distributor_id);
			unset($_SESSION['quantities']);
			echo '<h2>Thank you for your order.</h2>';
		}else {
			echo '<h2>Sorry, your cart is empty.</h2><button class="buttonBlue" onclick="window.location=\'/our-products/dental\'; return false;">Keep Shopping</button>';
		}
		require_once('includes/footer.php');
	}

else:
require_once('includes/header.php');
echo $message."<br />";
$message = " ";
$session->message(" ");

$user = User::find_by_id($session->user_id);

?>
<h2>Account Information</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
	<table summary="Update Account Info">
		<tr>
			<td class="required">Username</td>
			<td><input type="text" name="username" value="<?php echo $user->username ?>" /></td>
		</tr>
		<tr>
			<td class="required">Password</td>
			<td><input type="password" name="password" value="<?php echo $user->password ?>" /></td>
		</tr><tr>
			<td class="required">Name</td>
			<td><input type="name" name="name" value="<?php echo $user->name ?>" /></td>
		</tr><tr>
			<td class="required">Email</td>
			<td><input type="email" name="email" value="<?php echo $user->email ?>" /></td>
		</tr>
		<tr>
			<td>Company Name</td>
			<td><input type="text" name="company_name" value="<?php echo $user->company_name ?>" /></td>
		</tr>
		<tr>
			<td class="required">Phone Number</td>
			<td><input type="text" name="phone_number" value="<?php echo $user->phone_number ?>" /></td>
		</tr>
		<tr>
			<td class="required">Street Address 1</td>
			<td><input type="text" name="street_address1" value="<?php echo $user->street_address1 ?>" /></td>
		</tr>
		<tr>
			<td>Street Address 2</td>
			<td><input type="text" name="street_address2" value="<?php echo $user->street_address2 ?>" /></td>
		</tr>
		<tr>
			<td class="required">City</td>
			<td><input type="text" name="city" value="<?php echo $user->city ?>" /></td>
		</tr>
		<tr>
			<td class="required">State</td>
			<td><input type="text" name="state" value="<?php echo $user->state ?>" /></td>
		</tr>		
		<tr>
			<td class="required">Zip</td>
			<td><input type="text" name="zip" value="<?php echo $user->zip ?>" /></td>
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
	</table>
	<br />
	<input class="buttonBlue" type="submit" value="Save Changes" name="update" />
	<input class="buttonBlue" type="submit" value="Log Out" name="logout" />
	<input class="buttonOrange" type="submit" value="Submit Order" />
</form>
<?php 
require_once('includes/footer.php'); 
endif;
?>

