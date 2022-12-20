<?php

 include('DB_Connect.php');
 
  //creating a query
 $stmt =$connect_db->prepare("SELECT providerid, ProviderName,Contact,Email,ImageURL,TimeRegistered,Services,Description FROM ServiceProviders order by providerid DESC;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($providerid,$providername,$contact,$email, $imageurl, $timeregistered,$services,$description);
 $response = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['providerid'] = $providerid; 
 $temp['providername'] = $providername; 
 $temp['contact'] = $contact; 
 $temp['email'] = $email; 
 $temp['imageurl'] = $imageurl; 
 $temp['timeregistered'] = $timeregistered; 
 $temp['services'] = $services;
 $temp['description'] = $description;
 array_push($response, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($response);