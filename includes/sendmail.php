<?php

class SendMail {

	public static function send_mail($distributor_id) {
		
		if(isset($_SESSION['user_id'])) {
			$user = User::find_by_id($_SESSION['user_id']);
		}elseif(isset($_SESSION['temp_user'])) {
			$user = $_SESSION['temp_user'];
		}else {
			die('Sorry, something went wrong.');
		}


		$subject = "Order from Website";
		$distributor = Distributor::find_by_id($distributor_id);
		$to = $distributor->email;

		$subject_user = "Order Summary";
		$to_user = $user->email;

		$message  = (isset($user->company_name) && $user->company_name != "") ?  "Company Name: ".$user->company_name."\n" : "";
		$message .= (isset($user->name) && $user->name != "") ? "Contact: ".$user->name."\n" : "";
		$message .= (isset($user->email) && $user->email != "") ? "Email: ".$user->email."\n" : "";
		$message .= (isset($user->phone_number) && $user->phone_number != "") ? "Phone Number: ".$user->phone_number."\n" : "";
		$message .= (isset($user->street_address1) && $user->street_address1 != "") ? "Address 1: ".$user->street_address1."\n" : "";
		$message .= (isset($user->street_address2) && $user->street_address2 != "") ? "Address 2: ".$user->street_address2."\n" : "";
		$message .= (isset($user->city) && $user->city != "") ? "City: ".$user->city."\n" : "";
		$message .= (isset($user->state) && $user->state != "") ? "State: ".$user->state."\n" : "";
		$message .= (isset($user->zip) && $user->zip != "") ? "Zip: ".$user->zip."\n\n" : "";
		$message .= (isset($distributor->name) && $distributor->name != "") ? "Distributor: ".$distributor->name : "";
		$message .= (isset($_SESSION['other_details'])) ? ' : '.$_SESSION['other_details']."\n\n\n" : "\n\n\n";

		$message_user = "Thank you for your order, here is a summary:\n\n";

		foreach ($_SESSION['quantities'] as $key => $value) {
			if($value > 0) {
				$message .= $key." - qty:".$value."\n\n";
				$message_user .= $key." - qty:".$value."\n\n";
			}
		}

		$message .= "\nTotal: $".$_SESSION['total'];
		$message_user .= "\nTotal: $".$_SESSION['total'];

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/plain; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Website Order <info@example.com>' . "\r\n";
		$headers .= 'Cc: info <info@example.com>' . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();$headers  = 'MIME-Version: 1.0' . "\r\n";

		$headers_user  = 'MIME-Version: 1.0' . "\r\n";
		$headers_user .= 'Content-type: text/plain; charset=iso-8859-1' . "\r\n";
		$headers_user .= 'From: Company <info@example.com>' . "\r\n";
		$headers_user .= 'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
		mail($to_user, $subject_user, $message_user, $headers_user);
	}

}

?>