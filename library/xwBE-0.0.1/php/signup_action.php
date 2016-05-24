<?php
require("../connectDB.php");
require("../all.php");
?>
<?php
@$email = $_POST["email"];
@$password = $_POST["password"];
@$gender = $_POST["gender"];
@signup($email,$password,$gender);
?>