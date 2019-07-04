<?php
	session_start();
	$errors = array();
	$username = "";
	$db = mysqli_connect('localhost', 'root', '', 'lsd');

if (isset($_POST['login_'])) {
		$email = mysqli_real_escape_string($db, $_POST['email_']);
		$password = mysqli_real_escape_string($db, $_POST['password_']);

		if (empty($email)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$passwordenc = md5($password);
			$query = "SELECT * FROM user WHERE Email_id='$email' AND passwrd='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['Email_id'] = $email;
				$sql = "SELECT Username,ID FROM user where Email_id = '$email'";
				$_SESSION['username'] = $sql;
				$resultsuser = mysqli_query($db, $sql);
				if (mysqli_num_rows($resultsuser) > 0) {
					while($row = mysqli_fetch_assoc($resultsuser)) {
						$_SESSION['username'] = $row["Username"];
						$_SESSION['uid'] = $row["ID"];
					}
				 header('location: profile.php');
				}
			}
		}
			else {
				echo "Wrong username/password combination";
				array_push($errors, "Wrong username/password combination");
			}
		}
?>