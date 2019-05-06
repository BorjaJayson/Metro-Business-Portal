<?php
	// Authorisation details.
	$username = "infosystemteam1@gmail.com";
	$hash = "176a3140039e1535e3dab3d9a3fc9f4569f4c0970da1a20f8b174e0ccc00482c";

	// Config variables. Consult http://api.txtlocal.com/docs for more info.
	$test = "0";

	// Data for text message. This is the text message data.
	$sender = "API Test"; // This is who the message appears to be from.
	$numbers = "44777000000"; // A single number or a comma-seperated list of numbers
	$message = "This is a test message from the PHP API script.";
	// 612 chars or less
	// A single number or a comma-seperated list of numbers
	$message = urlencode($message);
	$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
	$ch = curl_init('http://api.txtlocal.com/send/?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	curl_close($ch);

?>

<!DOCTYPE html>
<html>
	<head>
		<style></style>
	</head>
	<body>
		<form>
			<input type="text" name="smsn" id="smsn"/>
			<textarea name="smsd" id="smsd"></textarea>

		</form>
	</body>
</html>