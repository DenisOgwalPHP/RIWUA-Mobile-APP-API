<?php
 //database constants
 include('DB_Connect.php');
 
  //creating a query
 $stmt =$connect_db->prepare("SELECT Statisticsid,Statistic, Details, PostedBy,Postdate FROM Statistics order by Statisticsid DESC");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($Statisticid,$Statistic,$Details, $postedBy, $postDate);
 
 $response = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['Statisticid'] = $Statisticid;
 $temp['Statistic'] = $Statistic; 
 $temp['Details'] = $Details; 
 $temp['postedBy'] = $postedBy; 
 $temp['postDate'] =$postDate; 
 array_push($response, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($response);