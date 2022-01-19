<?php
include 'connect.php';

if (isset($_POST['updateid'])) {
    $user_id = $_POST['updateid'];

    $sql = "select *from crud where id =$user_id";
    $result = mysqli_query($conn, $sql);
    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $response = $row;
    }
    echo json_encode($response);
} else {
    $response['status'] = 200;
    $response['message'] = "Invalid or data not ";
}
//update query
if (isset($_POST['hiddendata'])) {
    $uniqueid = $_POST['hiddendata'];
    $name = $_POST['updatename'];
    $mobile = $_POST['updatemobile'];
    $email = $_POST['updateemail'];
    $place = $_POST['updateplace'];

    $sql = "update crud set name='$name',mobile='$mobile',email='$email',place='$place' where id=$uniqueid";
    $result = mysqli_query($conn, $sql);
}
