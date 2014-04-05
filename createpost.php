<?php session_start(); ?>
<?php require_once('includes/connection.php'); ?>
<?php require_once("includes/functions.php"); ?>
<?php // if user is not logged in:
	if(!isset($_SESSION['userid'])) {
		header("Location: login.php");
		exit;
	}
?>
<?php // form processing
	
		$userid = $_SESSION['userid'];
		$username = $_SESSION['username'];
		$userimg = $_SESSION['userimg'];
	
	if (isset($_POST['submit'])) { // Form has been submitted.
		
		// form data
		$title = trim(mysql_prep($_POST['posttitle']));
		$content= trim(mysql_prep($_POST['postcontent']));
		
		if(!empty($username)) {
			$mysql_query = "INSERT INTO posts 
							(id, posttitle, postcontent, username, userimg) 
							VALUES ('{$userid}', 
							'{$title}', '{$content}', '{$username}', '{$userimg}')";
			$result = mysql_query($mysql_query, $connection);
			
			if($result) {
				$message = "<h2>Sådan, din post er lagt i databasen!</h2>";
			} else {
				$message = "<h2>Øv. posten kunne ikke oprettes.";
				$message .= "<br />" . mysql_error() . "</h2>";
			}
		}
		
		} else { // Form has not been submitted.
			$message = "<h2>Hej " . $username . ", skriv en post</h2>";
			$title = "";
			$content = "";
		}
?>
<?php include("includes/header.php"); ?>

	<div id="loginform">
		<?php echo "<h2>" . $message . "</h2>"; ?>
		<form action="createpost.php" method="post" id="createuserform">

 			<label for="posttitle">Skriv titlen på din post:</label>
			<input type="text" name="posttitle" autofocus>
 			<br>
 			<label for="postcontent">Skriv noget spændende tekst:</label>
			<textarea name="postcontent" id="postcontent" rows="4" cols="40"></textarea>
 			<br>
			<input type="submit" name="submit" value="Tilføj din post">

		</form>

<?php include("includes/footer.php"); ?>