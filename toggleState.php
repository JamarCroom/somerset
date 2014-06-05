<?php
session_start();
/*
if(!isset($_SESSION[logged_in]))
{
		include 'include/privilegeError.inc';
}
else
{
*/
	include 'include/head.inc';
	if(isset($_POST['submit']))
	{
		$toggleState = ($_POST['toggleState']=='off'? $toggleState='on':$toggleState='off');
		$indicatorId = $_POST['indicatorId'];
		try
		{
			$query= 'UPDATE indicatorMainTable SET indicatorState=:toggleState WHERE indicatorId = :indicatorId'; 
			require_once 'includes/dBaseConnect.inc';
			$statement=$db->prepare($query);
			$statement->bindValue(':toggleState',$toggleState);
			$statement->bindValue(':indicatorId',$indicatorId);
			$statement->execute();
			echo "<p>You have successfully turned $toggleState the indicator.</p>";
		}

		catch(PDOException $e)
		{
			require_once 'include/dbError.inc';
		}


	}
/*	
}
*/
?>