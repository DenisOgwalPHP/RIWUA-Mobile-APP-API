<?php
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if (isset($_POST)) {
	$username = test_input($_POST['name']);
	$email = test_input($_POST['email']);
	$password = test_input($_POST['password']);
	$telephone = test_input($_POST['telephone']);
	$address = test_input($_POST['address']);
	$hashed_password = md5($password);
	$token = md5(uniqid(rand(), true));
	$timeregistered = date("Y-m-d H:i:s");
	include_once 'DB_Connect.php';
	$sql1 = "SELECT Email FROM Registration where Email ='" . $email . "'";
	$result1 = mysqli_query($connect_db, $sql1);
	while ($row = mysqli_fetch_array($result1)) {
		$rowresult = $row['Email'];
	}
	if ($rowresult != $email) {
		$sql = "INSERT into Registration(unique_id,Fullnames,Email,Password,Telephone,Address,created_at)VALUES('$token','$username','$email','$hashed_password','$telephone','$address','$timeregistered')";
		$result = mysqli_query($connect_db, $sql);
		$response = array();
		if ($result) {
			$messages = 'Correct Info';
			$response['error'] = $messages;
			$response['uid'] = $token;
			$response['name'] = $username;
			$response['email'] = $email;
			$response['created_at'] = $timeregistered;
			$response['phone'] = $telephone;
			echo json_encode($response);
		} else {
			$messages = 'Something Un Expected Happened, Try Again Later';
			$response['error'] = $messages;
			echo json_encode($response);
		}
	} else {
		$messages = 'Email already Exists';
		$response['error'] = $messages;
		echo json_encode($response);
	}
}
?>
