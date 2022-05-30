<?php

require 'connection.php';
$conn = Connect();

$email=mysqli_real_escape_string($conn,$_GET['email']);
mysqli_query($conn, "UPDATE customer SET status = 1 WHERE email = '$email'");
//mysqli_query($conn,"update customer set status='1' where email='$email'");
echo "Your account verified";
?>
<a href="customerlogin.php"> Click here for Login</a>
