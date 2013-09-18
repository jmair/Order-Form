<?php
require_once('includes/required.php');
$item = $_POST['item'];


if($_SESSION['quantities'][$item]){
	$_SESSION['quantities'][$item] = $_SESSION['quantities'][$item]+1;
}else
{
	$_SESSION['quantities'][$item] = 1;
}

?>