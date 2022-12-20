<?php
$biocontrolld=$_GET['adviseid'];
 //database constants
 include('DB_Connect.php');
 
  //creating a query
 $stmt =$connect_db->prepare("SELECT Biocontrolid,BioAgent, Postedby, Details,Posted_at, Attachment FROM BiocontrolAgents where Biocontrolid='".$biocontrolld."'  order by Biocontrolid DESC");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($Adviseid,$Subject,$SentBy, $message, $timesent,$attachment);
 
 $response = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['Adviseid'] = $Adviseid;
 $temp['Subject'] = $Subject; 
 $temp['Sender'] = $SentBy; 
 $temp['Message'] = $message; 
 $temp['Timesent'] = $timesent; 
 $temp['Attachment'] =$attachment; 
 array_push($response, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($response);