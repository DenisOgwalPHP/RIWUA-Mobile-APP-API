<?php
 //database constants
 include('DB_Connect.php');
 
  //creating a query
 $stmt =$connect_db->prepare("SELECT Adviseid,Subject, SentBy, Message,Sent_At FROM Advise order by Adviseid DESC;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($Adviseid,$Subject,$SentBy, $message, $timesent);
 
 $response = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['Adviseid'] = $Adviseid;
 $temp['Subject'] = $Subject; 
 $temp['Sender'] = $SentBy; 
 $temp['Message'] = $message; 
 $temp['Timesent'] = $timesent; 
 array_push($response, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($response);