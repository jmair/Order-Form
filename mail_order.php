<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('includes/required.php');
$options = Distributor::find_all();

if($_SERVER['REQUEST_METHOD'] == 'POST'):
$hide_order_form_button = true;
require_once('includes/header.php');
	global $db;
	$distributor_id = $db->escape_value($_POST['distributor']);
	
	if(isset($_SESSION['quantities'])) {
		SendMail::send_mail($distributor_id);
		unset($_SESSION['quantities']);
		echo '<h2>Thank you for your order.</h2>';
	}else {
		echo '<h2>Sorry, your cart is empty.</h2><button onclick="window.location=\'/our-products/dental\'; return false;">Keep Shopping</button>';
	}
require_once('includes/footer.php');
else:
require_once('includes/header.php');
?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<h2>Please Select Your Distributor</h2>
		<select name="distributor">
			<?php 
				foreach ($options as $option) {
					echo '<option value="'.$option->id.'">'.$option->name.'</option>'."\n";
				}
			?>
		</select></br></br>
		<input type="submit" onclick="window.location='index.php'; return false;" value="< Back" />
		<input type="submit" value="Submit Order" />
	</form>

<?php 
require_once('includes/footer.php');
endif;
?>