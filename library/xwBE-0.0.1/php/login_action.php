<?php
require("../connectDB.php");
require("../all.php");
?>
<?php
@$email = $_POST["email"];
@$password = $_POST["password"];
@login($email,$password);
?>