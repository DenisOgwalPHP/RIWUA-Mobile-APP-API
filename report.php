<?php

if (isset($_POST)) {
$username = $_POST['name'];
$story=$_POST['story'];
$subject=$_POST['subject'];
$location=$_POST['location'];
$timeregistered=date("Y-m-d H:i:s");
$submittedby=$_POST['email'];
include_once 'DB_Connect.php';
$sql1="SELECT Email FROM Story where Email ='".$submittedby."' and Subject='".$subject."' and created_at='".$timeregistered."'";
$result1=mysqli_query($connect_db,$sql1);
while($row = mysqli_fetch_array($result1)){
$rowresult=$row['Email'];
}
if ($rowresult != $submittedby) 
{
$sql="INSERT into Story(Email,Fullnames,Subject,Location,Stories,created_at)VALUES('$submittedby','$username','$subject','$location','$story','$timeregistered')";
$result=mysqli_query($connect_db,$sql);
$response = array();
if ($result) 
{
 $messages='Correct Info';
 $response['error'] =$messages;
 echo json_encode($response);
}else{
	$messages='Something Un Expected Happened, Try Again Later';
	$response['error'] =$messages;
   echo json_encode($response);
}
}
else{
$messages='You Already Submitted on this subject';
$response['error'] =$messages;
 echo json_encode($response);
}
}
?>
