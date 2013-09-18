<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('../includes/required.php');

if($_SERVER['REQUEST_METHOD'] == "POST"):

	$name = $db->escape_value(trim($_POST['name']));
	$description = $db->escape_value(trim($_POST['description']));
	$price = $db->escape_value(trim($_POST['price']));
	$oz = $db->escape_value(trim($_POST['oz']));
if(Item::is_unique($name)) {
	$item = new Item();

	$item->name = $name;
	$item->price = $price;
	$item->oz = $oz;
	$item->save();

	$session->message("Item Added.");
	redirect_to($_SERVER['PHP_SELF']);
}else {
	$session->message("Name needs to be unique.");
	redirect_to($_SERVER['PHP_SELF']);
}

else:
	echo $message;
	$message = " ";
	$session->message(" ");
?>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
		<table summary="Add Item" >
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" /></td>
			</tr>
			<tr>
				<td>description</td>
				<td><input type="text" name="description" /></td>
			</tr>
			<tr>
				<td>Price</td>
				<td><input type="text" name="price" /></td>
			</tr>
			<tr>
				<td>Oz</td>
				<td><input type="text" name="oz" /></td>
			</tr>
		</table>
		<input type="submit" value="Add Item" />
	</form>

<?php endif; ?>