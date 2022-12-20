<?php

if (isset($_POST)) {
$email=$_POST['email'];
$password=$_POST['password'];
$hashed_password = md5($password);

include_once 'DB_Connect.php';
$sql1="SELECT FullNames,Email,created_at,unique_id,Telephone FROM registration where Email ='".$email."' and Password='".$hashed_password."'";
$result1=mysqli_query($connect_db,$sql1);
if (mysqli_num_rows($result1) > 0)
{
while($row = mysqli_fetch_array($result1)){
$rowresult1=$row['FullNames'];
$rowresult2=$row['Email'];
$rowresult3=$row['created_at'];
$rowresult4=$row['unique_id'];
$rowresult5=$row['Telephone'];
$response = array();
if ($result1) 
{
 $messages='Correct Info';
 $response['error'] =$messages;
 $response['name'] = $rowresult1; 
 $response['uid'] = $rowresult4;
 $response['email'] = $rowresult2; 
 $response['created_at'] = $rowresult3;
 $response['phone'] = $rowresult5;
 echo json_encode($response);
}else{
	$messages='Something Un Expected Happened, Try Again Later';
	$response['error'] =$messages;
   echo json_encode($response);
}
}
}
else{
$messages='Password User Name Do not Match any Account'.$email;
$response['error'] =$messages;
 echo json_encode($response);
}
}
?>
