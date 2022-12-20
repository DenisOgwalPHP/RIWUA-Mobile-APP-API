<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
 $phone=test_input($_GET['phone']); 
 //database constants
 include('DB_Connect.php');
 
  //creating a query
 $stmt =$connect_db->prepare("SELECT Name, Message, TimeRegistered FROM Message,Registration where Registration.Telephone= Message.contact and Message.contact='".$phone."'  order by messageid DESC;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($sender, $message, $timesent);
 
 $response = array(); 
 
 //traversing through all the result 
while ($stmt->fetch()) {
    $temp = array();

    $temp['Sender'] = $sender;
    $temp['Message'] = $message;
    $temp['Timesent'] = $timesent;
    array_push($response, $temp);
}
 
 //displaying the result in json format 
 echo json_encode($response);