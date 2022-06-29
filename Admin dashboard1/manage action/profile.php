<?php
session_start();
//Take the information of session
$con = new mysqli('localhost', 'root', '', 'restaurant_management');
$profile = $_SESSION['email'];
if($_POST['key']== 'getexistingdata'){
$sql = $con->query(query: "SELECT * FROM user WHERE email='$profile'");
$data = $sql->fetch_array();
$jsonArray = array(
    'name' => $data['name'],
    'phone' => $data['phone'],
    'email' => $data['email'],
    'password' => $data['password']
);
 exit( json_encode($jsonArray));
}
$name = $con->real_escape_string($_POST['name']);
$phone = $con->real_escape_string($_POST['phone']);
$email = $con->real_escape_string($_POST['email']);
$password = $con->real_escape_string($_POST['password']);

if ($_POST['key'] == 'edit') {
    $con->query("UPDATE user SET name='$name', phone='$phone', email='$email', password='$password' WHERE email='$profile'");
    exit('edited');
}
