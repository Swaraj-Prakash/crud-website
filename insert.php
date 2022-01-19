<?php
include 'connect.php';
extract($_POST);
if (isset($_POST['nameSend']) && isset($_POST['mobileSend']) && isset($_POST['emailSend']) && isset($_POST['placeSend'])) {
    $sql = "insert into crud(name,mobile,email,place) values('$nameSend','$mobileSend','$emailSend','$placeSend')";

    $result = mysqli_query($conn, $sql);
    if (!$result) {

        die(mysqli_error($conn));
    }
}
