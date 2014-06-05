<?php
session_start();
/*
if(!isset($_SESSION['logged_in']))
{
	include 'include/privilegeError.inc';
}
else
{
*/
include_once 'include/head.inc';
?>
<h2 class='center'>Admin Menu</h2>
<div id="left">
<form action="somersetAdd.html" method="POST"><button></button></form>
</div>
<div id="right">
	
</div>

<?php
include_once 'include/foot.inc';



/*
}
*/

?>