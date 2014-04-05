
		</div>
		<div class="push"></div>
</div><?php // ends wrapper ?>
	
	<footer>
		<div class="footerwrap">
			<h4>&#169; Creative Commons Attribution 3.0 License</h4>
			<p>Hvis du vil vide mere, følg fagets <a href="https://www.facebook.com/pages/Teknisk-Gymnasium-Silkeborg-Kommunikation-It/333381770141208" target="_blank">facebook</a> - eller se med på <a href="https://vimeo.com/user10815733/videos" target="_blank">vimeo</a> ;-)</p>
			<?php
				if(isset($_COOKIE[session_name()])) {
					echo "<p>... <a href='logout.php'>log ud</a>";
				}
			?>
	</footer>
</body>
</html>
<?php
	if(isset($connection)) {
		mysql_close($connection);
	}
?>