<?php
session_start();
include 'include/head.inc';

$result=session_destroy();

if($result)
{
?>

	<p class="success">You have been successfully logged out of the portal.</p>

<?php
}

else
{
?>
	<p>Sorry we're unable to log you out of the portal at this time.</p>

<?php
}

include 'include/foot.inc';
?>