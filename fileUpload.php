<?php
 
// Path to move uploaded files
$target_path = "Uploads/";
include_once 'DB_Connect.php';
// array for final json respone
$response = array();
 
// getting server ip address
$server_ip = gethostbyname(gethostname());
 
// final file url that is being uploaded
$file_upload_url = 'http://' . $server_ip . '/' . 'AndroidFiles' . '/' . $target_path;
$file_upload_url2 = 'http://' .'goodwillwomenspulse.org'. '/' . 'AndroidFiles' . '/' . $target_path;


if (isset($_FILES['image']['name'])) {
    $target_path = $target_path . basename($_FILES['image']['name']);

    // reading other post parameters
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $response['file_name'] = basename($_FILES['image']['name']);
    //$response['email'] = $email;
    //$response['website'] = $website;

    try {
        // Throws exception incase file is not being moved
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            // make error flag true
            $response['error'] = true;
            $response['message'] = 'Could not move the file!';
        }

        // File successfully uploaded
        $response['message'] = 'File uploaded successfully!';
        $response['error'] = false;
        $response['file_path'] = $file_upload_url . basename($_FILES['image']['name']);
        $imageurl = $file_upload_url2 . basename($_FILES['image']['name']);
        $filename = $_FILES['image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if ($ext == 'gif' || $ext == 'png' || $ext == 'jpg') {
            $sql = "UPDATE Story SET ImageURL='" . $imageurl . "' where Location='" . $location . "' and Email='" . $email . "' and Subject='" . $subject . "'";
            mysqli_query($connect_db, $sql);
        } else {
            $sql = "UPDATE Story SET VideoURL='" . $imageurl . "' where Location='" . $location . "' and Email='" . $email . "' and Subject='" . $subject . "'";
            mysqli_query($connect_db, $sql);
        }
    }catch (Exception $e) {
        // Exception occurred. Make error flag true
        $response['error'] = true;
        $response['message'] = $e->getMessage();
    }
} else {
    // File parameter is missing
    $response['error'] = true;
    $response['message'] = 'Not received any file!F';
}
 
// Echo final json response to client
echo json_encode($response);
?>