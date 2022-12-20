<?php
 //database constants
 include('DB_Connect.php');
 
  //creating a query
 $stmt =$connect_db->prepare("SELECT FullNames,Telephone,ProfilePic,Email FROM Registration order by FullNames ASC");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($FullNames,$Telephone,$ProfilePic,$Email);
 
 $response = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['FullNames'] = $FullNames;
 $temp['Telephone'] = $Telephone; 
 $temp['ProfilePic'] = $ProfilePic; 
 $temp['Email'] = $Email;
 array_push($response, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($response);