<?php

$servername = "localhost";
$user = "root";        
$pass = "root";        
$conn = mysqli_connect($servername, $user, $pass);        
if(!$conn) {
	die("Connection failure: " . mysqli_connect_error());
}

mysqli_query($conn, "use form");

$result = mysqli_query($conn, "select * from form_info");
echo "Name" . $name . "&nbsp&nbsp&nbsp&nbsp";
echo "Age" . $age . "&nbsp&nbsp&nbsp&nbsp";
echo "Favorite team" . $fav_team . "&nbsp&nbsp&nbsp&nbsp" . "<br>";

while($res = mysqli_fetch_assoc($result)) {
	echo $res["name"] . "&nbsp&nbsp&nbsp&nbsp" . $res["age"] . "&nbsp&nbsp&nbsp&nbsp" . $res["fav_team"] . "<br>";
}
?>
<a href="form.php"> Submit another response </a>
