<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('includes/required.php');
if($_SERVER['REQUEST_METHOD'] == "POST"):

$_SESSION['quantities'] = $_POST['quantity'];

if(isset($_POST['distributor'])) {
 $_SESSION['distributor'] = $_POST['distributor'];
}

if(isset($_POST['other_details'])) {
	$_SESSION['other_details'] = $_POST['other_details'];
}

redirect_to($_SERVER['PHP_SELF']);

else:
$distributor_options = Distributor::find_all();
$items = Item::find_all();
$total = 0;
require_once('includes/header.php');
?>
<h2>Form Contents</h2>
<form id="order_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table id="cart" summary="Shopping Cart">
		<tr>
			<td colspan="4">
				<strong>DISTRIBUTOR: &nbsp;</strong> &nbsp;&nbsp;&nbsp;<select id="distributor" name="distributor">
					<?php 
						foreach ($distributor_options as $option) {
							$selected = '';
							if(isset($_SESSION['distributor'])) {
								if($option->id == $_SESSION['distributor']) {
									$selected = 'selected'; 
								}
							}
							echo '<option value="'.$option->id.'"'.$selected.'>'.$option->name.'</option>'."\n";
						}
					?>
				</select>
				&nbsp;<input style="display: none;" id="other_details" type="text" maxlength="32" name="other_details" placeholder="Please Specify" />
			</td>
		<tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<th style="width: 80px;">QTY</th>
			<th style="width: 523px;">PRODUCT</th>
			<th style="width: 100px; text-align: center;">UNIT PRICE</th>
			<th style="width: 100px; text-align: center;">SUBTOTAL</th>
		<?php 
			foreach($items as $current) {
				if(isset($_SESSION["quantities"][$current->name]))
				{
					$value = $_SESSION["quantities"][$current->name];
					$total = $total + $current->price * $_SESSION["quantities"][$current->name];

				}else {
					$value = 0;
				}
				
				echo '<tr>
					<td style="width: 40px;"><input class="quantities" type="text" value="'.$value.'" name="quantity['.$current->name.']"/></td>
					<td>'.$current->description.'</td>
					<td style="text-align: right;">'.$current->price.'</td>
					<td class="blue" style="text-align: right;">&#36;'.number_format($value * $current->price, 2).'</td>
					</tr>';
			}
		?>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td style="text-align: right;" class="orange">Total:</td>
			<td class="orange" style="text-align: right;">&#36;<?php $_SESSION['total'] = $total; echo number_format($total, 2); ?></td>
		</tr>
	</table>
	<input style="display: none;" class="buttonOrange" type="submit" id="update_form" value="Update Form" />
	<input class="buttonBlue" type="submit" onclick="clearCart();" value="Clear Form" />
	<input class="buttonOrange right" type="submit" onclick="window.location='login.php'; return false;" value="Next >" />
</form>
<script>
	function clearCart() {
		var elements = document.getElementsByClassName('quantities');
		
		for(var i=0; i < elements.length; i++) {
			elements[i].value = 0;
		}
	}
</script>
<?php 
require_once('includes/footer.php'); 
endif; 
?>