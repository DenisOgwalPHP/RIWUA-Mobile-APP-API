<?php
 //database constants
 include('DB_Connect.php');
 
  //creating a query
 $stmt =$connect_db->prepare("SELECT Diseaseid,Disease, Description, PostedBy,PostDate FROM Diseases order by Diseaseid DESC");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($diseaseid,$disease,$description, $postedBy, $postDate);
 
 $response = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['diseaseid'] = $diseaseid;
 $temp['disease'] = $disease; 
 $temp['description'] = $description; 
 $temp['postedBy'] = $postedBy; 
 $temp['postDate'] =$postDate; 
 array_push($response, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($response);