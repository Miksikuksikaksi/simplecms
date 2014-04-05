<?php session_start(); ?>
<?php require_once('includes/connection.php'); ?>
<?php require_once("includes/functions.php"); ?>
<?php

	$message = "Log ind";	
	// form has been submitted:
	if (isset($_POST['submit'])) { 
		
		// form data
		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = sha1($password);
		
		// databasaquery - remember spaces in query!
		if(!empty($username)) {
			$query  = "SELECT * ";
			$query .= "FROM user ";
			$query .= "WHERE username = '{$username}' " ;
			$query .= "AND password = '{$hashed_password}'";
			$query_result = mysql_query($query);
			
			// If database-connection went wrong
			if (!$query_result) {
				die("Databaseforespørgsel gik ikke så godt: " . mysql_error());
			}
			
			if(mysql_num_rows($query_result) == 1) {
				// all is well and user authenticated
				$message = "Du er inde!";
				$found_user = mysql_fetch_array($query_result);
				// save user info in session
				$_SESSION['userid'] = $found_user['userid'];
				$_SESSION['username'] = $found_user['username'];
				$_SESSION['userimg'] = $found_user['userimg'];
				header("Location: createpost.php");
				exit;
			} else {
				// username & pass combination not found
				$error = "Hmm, du må hellere prøve igen";
			}
		}
		} else {
			if(isset($_GET['logout']) && $_GET['logout'] == 1) {
				$message = "Du er nu logget ud";
			}
			$username = "";
			$password = "";
		}	
?>
<?php include("includes/header.php"); ?>

	<div id="loginform">
	<?php if(isset($error)) { 
		echo "<h2>" . $error . "</h2>";
		} else {
			echo "<h2>" . $message . "</h2>";
		} 
	?>
		<form action="login.php" method="post" id="createuserform">

 			<label for="username">Skriv dit brugernavn herunder:</label>
			<input type="text" name="username">
 			<br>
			<label for="password">Og indtast din adgangskode her:</label>
			<input type="password" name="password" id="password">
			<input type="submit" name="submit" value="Login">

		</form>

<?php include("includes/footer.php"); ?>