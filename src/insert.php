<?php
	// Initiate the autoloader.
	require('\autoload.php');

	$secret = '6LctigQTAAAAADZzWe03cEfLxHDZ9oMvXCCotfw9';

	$recaptcha = new \ReCaptcha\ReCaptcha($secret);
	$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
	if ($resp->isSuccess()) {
    // verified!
		echo "Success";
		$servername = "localhost";
		$username = "user_tuan";
		$password = "tuan123456";
		$dbname = "tuan";

		$name = $_POST['name'];
		$class_data = $_POST['class_data'];
		$email = $_POST['email'];
		$img_link = $_POST['img_link'];

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$stmt = $conn->stmt_init();
		if ($stmt->prepare("INSERT INTO user (name, email, class, img_link) 
			VALUES (?, ?, ?, ?)")) {
		       $stmt->bind_param("ssss", $name, $class_data, $email, $img_link);
		       $stmt->execute();
		       $stmt->close();
		}
		$conn->close();
	} else {
    	$errors = $resp->getErrorCodes();
    	// echo $errors;
	}
?>