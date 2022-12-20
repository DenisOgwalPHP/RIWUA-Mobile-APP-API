<?php 
 //database constants
 $email=$_GET['email'];
 include('DB_Connect.php');
 
  //creating a query
 $stmt =$connect_db->prepare("SELECT FullNames, Message, TimeRegistered FROM Message,Registration where Message.Email='".$email."' and Registration.Telephone=Message.contact order by messageid DESC;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($sender, $message, $timesent);
 
 $response = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 
 $temp['Sender'] = $sender; 
 $temp['Message'] = $message; 
 $temp['Timesent'] = $timesent; 
 array_push($response, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($response);