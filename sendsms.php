<?php

if (isset($_POST)) {
$username = $_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];
$contact=$_POST['contact'];
$timeregistered=date("Y-m-d H:i:s");
include_once 'DB_Connect.php';
$sql1="SELECT Email FROM Message where Email ='".$email."' and contact='".$contact."' and Message='".$message."'";
$result1=mysqli_query($connect_db,$sql1);
while($row = mysqli_fetch_array($result1)){
$rowresult=$row['Email'];
}
if ($rowresult != $email) 
{
$sql="INSERT into Message(Message,contact,Email,Name,TimeRegistered)VALUES('$message','$contact','$email','$username','$timeregistered')";
$result=mysqli_query($connect_db,$sql);
$response = array();
if ($result) 
{
$messages='Correct Info';
 $response['error'] =$messages;
 $response['created_at'] = $timeregistered;
 echo json_encode($response);
}else{
	$messages='Something Un Expected Happened, Try Again Later';
	$response['error'] =$messages;
   echo json_encode($response);
}
}
else{
$messages='You Already Submitted on this SMS';
$response['error'] =$messages;
 echo json_encode($response);
}
}
?>
