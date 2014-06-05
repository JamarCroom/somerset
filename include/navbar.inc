<?php
if(isset($_SESSION['logged_in']))
{
?>
		<nav><ul><li><a href="login.php">Log-in</a></li><li><a href="logout.php">Log-out</a></li>
	<li><a href="somersetAdd.php">Add An Indicator</a></li>
	<li><a href="search.php?action=toggle">Add An Indicator</a></li>


	<li><a href="search.php?action=modify">Modify An Indicator</a></li></ul></nav>



<?php
}


?>