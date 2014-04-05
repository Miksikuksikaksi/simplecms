<?php require_once('includes/connection.php'); ?>
<?php require_once("includes/functions.php"); ?>
<?php // form processing
	
	if (isset($_POST['submit'])) { // Form has been submitted.
		
		// form data
		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = sha1($password);
		$priv = trim(mysql_prep($_POST['priv']));
		
		if(!empty($username)) {
			$mysql_query = "INSERT INTO user 
							(username, password, priv) 
							VALUES ('{$username}', 
							'{$hashed_password}', '{$priv}')";
			$result = mysql_query($mysql_query, $connection);
			
			if($result) {
				$message = "<h2>Sådan, en ny bruger er føjet til databasen!</h2>";
			} else {
				$message = "<h2>Øv. Brugeren kunne ikke oprettes.";
				$message .= "<br />" . mysql_error() . "</h2>";
			}
		}
		
		} else { // Form has not been submitted.
			$message = "Opret ny bruger";
			$username = "";
			$password = "";
		}
?>
<?php include("includes/header.php"); ?>

	<div id="loginform">
		<?php echo "<h2>" . $message . "</h2>"; ?>
		<form action="createuser.php" method="post" id="createuserform">

 			<label for="name">Skriv brugerens eget navn herunder:</label>
			<input type="text" name="name" autofocus>
 			<br>
 			<label for="username">Skriv et brugernavn herunder:</label>
			<input type="text" name="username">
 			<br>
 			<input type="radio" name="priv" id="priv1" value="1" checked>Bruger<br>
 			<input type="radio" name="priv" id="priv2" value="2">Admin
 			<br>
			<label for="password">Og indtast din adgangskode her:</label>
			<input type="password" name="password" id="password">
			<input type="submit" name="submit" value="Opret bruger">

		</form>

<?php include("includes/footer.php"); ?>