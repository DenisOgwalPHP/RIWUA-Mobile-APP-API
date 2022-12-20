<?php
 //database constants
 include('DB_Connect.php');
 
  //creating a query
 $stmt =$connect_db->prepare("SELECT Subject, Sender, RealMessage,TimeSent FROM Notifications order by notificationid DESC;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($Subject,$sender, $message, $timesent);
 
 $response = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['Subject'] = $Subject; 
 $temp['Sender'] = $sender; 
 $temp['Message'] = $message; 
 $temp['Timesent'] = $timesent; 
 array_push($response, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($response);