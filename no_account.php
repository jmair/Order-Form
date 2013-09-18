<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('includes/required.php');

if($_SERVER['REQUEST_METHOD'] == "POST"):

global $db;

$name = $db->escape_value(trim($_POST['name']));
$email = $db->escape_value(trim($_POST['email']));
$company_name = $db->escape_value(trim($_POST['company_name']));
$phone_number = $db->escape_value(trim($_POST['phone_number']));
$street_address1 = $db->escape_value(trim($_POST['street_address1']));
$street_address2 = $db->escape_value(trim($_POST['street_address2']));
$city = $db->escape_value(trim($_POST['city']));
$state = $db->escape_value(trim($_POST['state']));
$zip = $db->escape_value(trim($_POST['zip']));

	
$user = new User();
$user->name = $name;
$user->email = $email;
$user->company_name = $company_name;
$user->phone_number = $phone_number;
$user->street_address1 = $street_address1;
$user->street_address2 = $street_address2;
$user->city = $city;
$user->state = $state;
$user->zip = $zip;

$_SESSION['temp_user'] = $user;

require_once('includes/header.php');
			
$distributor_id = ($_SESSION['distributor']);

	if(!empty($name) && !empty($email) && !empty($phone_number) && !empty($street_address1) && !empty($city) && !empty($state) && !empty($zip)) {
		if(isset($_SESSION['quantities'])) {
			SendMail::send_mail($distributor_id);
			unset($_SESSION['quantities']);
			echo '<h2>Thank you for your order.</h2>';
		}else {
			echo '<h2>Sorry, your cart is empty.</h2><button class="buttonBlue" onclick="window.location=\'/our-products/dental\'; return false;">Products</button>';
		}
		require_once('includes/footer.php');
	}else {
		$session->message('Please Fill Out All Required Fields.');
		echo '<script>window.location = "'.$_SERVER['PHP_SELF'].'";</script>';
	}

else:
require_once('includes/header.php');

echo $message;
$message = " ";
$session->message(" ");
?>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" summary="No Account Form">
		<table>
			<tr>
				<td class="required">Name:</td>
				<td><input type="text" name="name" /></td>
			</tr>			<tr>
				<td class="required">Email:</td>
				<td><input type="text" name="email" /></td>
			</tr>
			<tr>
				<td>Company Name:</td>
				<td><input type="text" name="company_name" /></td>
			</tr>
			<tr>
				<td class="required">Phone Number:</td>
				<td><input type="text" name="phone_number" /></td>
			</tr>
			<tr>
				<td class="required">Street Address 1:</td>
				<td><input type="text" name="street_address1" /></td>
			</tr>
			<tr>
				<td>Street Address 2:</td>
				<td><input type="text" name="street_address2" /></td>
			</tr>
			<tr>
				<td class="required">City:</td>
				<td><input type="text" name="city" /></td>
			</tr>
			<tr>
				<td class="required">State:</td>
				<td><input type="text" name="state" /></td>
			</tr>
			<tr>
				<td class="required">Zip:</td>
				<td><input type="text" name="zip" /></td>
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
				<td style="text-align: right;">
					<input class="buttonOrange" type="submit" value="Submit Order"/>
				</td>
			</tr>
		</table>
	</form>

<?php 
require_once('includes/footer.php');
endif;
?>