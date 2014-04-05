<?php require_once('includes/connection.php'); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
	
<?php
	
	// get posts from database with user info
	$postquery 	= "SELECT * FROM posts ORDER BY postid DESC";
	$postresult = mysql_query($postquery);
	
?>
	
	<section>
		<?php
		
			// run a loop to show post one by one
			while($row = mysql_fetch_array($postresult)) {
				echo "<article>";
				if (!empty($row['userimg'])) {
					echo "<div class='userimg' style='background: url(" . $row['userimg'] . ")'>";
					echo "</div>";
				}
				echo "<h3>" . $row['posttitle'] . "</h3>";
				echo "<p>" . $row['postcontent'] . "</p>";
				echo "<p class='author'>Postet af " . $row['username'] . "</h4>";
				echo "</article>";
			}
			
		?>
		
	</section>
	
<?php include("includes/footer.php"); ?>