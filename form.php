<!-- form.php 
**** Create a form with 
**** 3 fields - name, age and favorite football teamn 
**** writes to database
**** then redirects to display.php 
--!>

<html>
<body>

<?php
$name_Err = $age_Err = $fav_team_Err = "";
$name = $fav_team = "";
$age = 0;
$err = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST["name"])) {
		$name_Err = "Enter a name";
		$err = 1;
	}
	else {
		$name = $_POST["name"];
		if(!preg_match("/^[a-z]*$/", $name)) {
			$name_Err = "[a-z ]* nothing else";
			$err = 1;
		}
		else {
			if(strlen($name) > 32) {
				$name_Err = "Error : name must be less than or equal to 32 characters";
				$err = 1;	
			}
		}
	}
	if(empty($_POST["age"])) {
		$age_Err = "Come on! Tell us how old you are!!!!";
		$err = 1;
	}
	else {
		$age = $_POST["age"];
		if($age > 18) {
			$age_Err = "The form filler must be max 18 years old!";
			$err = 1;
		}		
	}
	$fav_team = $_POST["fav_team"];
	if(strlen($fav_team) > 16) {
		$fav_team_Err = "Favorite team name max 16 chars....";
		$err = 1;
	}
	#DATABASE CODE HETE

	$servername = "localhost";
	$user = "root";
	$pass = "root";
	$conn = mysqli_connect($servername, $user, $pass);		
	if(!$conn) {
		die("Connection failure: " . mysqli_connect_error());
	}
	$sql = "create database if not exists form";
	if(mysqli_query($conn, $sql) == TRUE) {
		echo "Database created";
	}
	else {
		echo "Error creating database : " . mysqli_connect_error();
	}
	mysqli_query($conn, "use form");
	$tmp = mysqli_query($conn, "select 1 from form_info");	
	if($tmp == FALSE) {
		$tab = "create table form_info (name varchar(32) primary key, 
				   age int, 
					fav_team varchar(16));";
	
		if(mysqli_query($conn, $tab) == TRUE) {
			echo "Tables created succ.";
		}
		if($err == 0) {
			mysqli_query($conn, "insert into form_info values ('$name', '$age', '$fav_team');");
			header('Location: display.php?name=' . $name . '&age=' . $age . '&fav_team=' . $fav_team);
		}	
	}
} ?>

<h1> 111303030 FORM for FOSS endsem lab </h1>
<span class="error">* required field. </span></p>
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
	First Name (no spaces) : <input type="text" name="name" value="<?php echo $name;?>">
	<span class="error">* <?php echo $name_Err;?> </span>
	<br><br>
	Age : <input type="number" name="age" value="<?php echo $age;?>">
	<span class="error">* <?php echo $age_Err;?> </span>
	<br><br>
	Favorite football team : <input type="text" name="fav_team" value="<?php echo $fav_team;?>">
	<span class="error">* <?php echo $fav_team_Err;?> </span>
	<br><br>
	<input type="submit" name="submit" value="Submit">
</form>
</body>
</html>	
