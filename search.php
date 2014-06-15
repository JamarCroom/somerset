<?php
session_start();

if(!isset($_SESSION['logged_in']))
{

	include 'include/privilegeError.inc';


}

else
{

	$searchForm=true;
	$toggleTable=false;
	$modifyTable=false;
	$action = $_GET['action'];

	$style="
		table
		{
			width: 70%;
			margin: 60px auto;
		}
	
		thead
		{
			color: white;
			background-color: black;
		}
		th
		{
			margin: 0;
			padding: 0;
		}

		td
		{
			text-align: center;
		}


	";

	include 'include/head.inc';
	if(isset($_POST['submit']))
	{
		require_once 'objects/Validation.php';
		$validate = new Validation();
		$contentArea=$validate->validateInput($_POST['contentAreas'],'Content area');
		$indicatorTypes=$validate->validateInput($_POST['indicatorTypes'],'Indicator Type');

		$errorCount = $validate->getErrorCount();
		if($errorCount>0)
		{
			$validate->printErrorMsgs();
		}
		else
		{

			try
			{
				require_once 'include/dbaseConnect.inc';
				$query = 'SELECT * FROM indicatorMainTable WHERE contentArea = :contentArea AND indicatorType = :indicatorTypes';
				$statement=$db->prepare($query);
				$statement->bindValue(':contentArea',$contentArea);
				$statement->bindValue(':indicatorTypes',$indicatorTypes);
				$statement->execute();
				$result=$statement->fetchAll();
				$statement->closeCursor();
				$searchForm=false;
				if($action=='toggle')
					$toggleTable=true;
				else
					$modifyTable=true;
			}
			catch(PDOException $e)
			{
				include 'include/dbError.inc';
			}
		}


	}
	if($toggleTable)
	{
		if(!empty($result))
		{
?>
			<h2 class="center">Results</h2>
			<table>
				<thead><tr><th>Indicator Title</th><th>Content Area</th><th>Indicator Type</th><th>Indicator State</th><th>Toggle State</th><tr/></thead>
<?php
				foreach($result as $results)
				{
					echo '<tr><td>'.ucwords($results['indicatorTitle']).'</td><td>'.$results['contentArea'].'</td><td>'.$results['graphType'].'</td><td>'.$results['indicatorState'].'</td><td><form action="toggleState.php" method="POST"><input type="hidden" name="indicatorId" value="'.$results['indicatorId'].'"><input type="hidden" name="toggleState" value="'.$results['indicatorState'].'"><input type="submit" name="submit" value="On/Off" /></form></td></tr>';
				}
?>
			</table>
<?php
		}
		else
		{
			echo '<p><strong>There are no results to display.</strong></p>';
		}

	}

	if($modifyTable)
	{
		if(!empty($result))
		{
?>
	<h2 class="center">Results</h2>
			<table>
				<thead><tr><th>Indicator Title</th><th>Content Area</th><th>Indicator Type</th><th>Indicator State</th><th>Modify</th><tr/></thead>
<?php
				foreach($result as $results)
				{
					echo '<tr><td>'.ucwords($results['indicatorTitle']).'</td><td>'.$results['contentArea'].'</td><td>'.$results['graphType'].'</td><td>'.$results['indicatorState'].'</td><td><form action="modify.php" method="POST"><input type="hidden" name="graphType" value="'.$results['graphType'].'"/><input type="hidden" name="indicatorId" value="'.$results['indicatorId'].'"/><input type="submit" name="searchSubmit" value="Modify"/></form></td></tr>';
				}
?>
			</table>
<?php
		}
		else
		{
			echo '<p><strong>There are no results to display.</strong></p>';
		}

	}







	if($searchForm)
	{
		echo"<h2>".ucfirst($action)." An Indicator</h2>";
?>	
		<form action="search.php?action=<?php echo $action;?>" method="POST">
		<p>Select a content area: <select id="contentAreas"  name="contentAreas" >
			<option value=""></option>
		<option value="adultPAN">Adult PAN</option>
		<option value="youthPAN"> Youth PAN</option>
		<option value="adultSubstanceAbuse">Adult Substance Abuse</option>
		<option value="youthSubstanceAbuse">Youth Substance Abuse</option>
		<option value="coalition">Coalition</option>
		</select></p>

		<p>Select an indicator type: <select id="indicatorTypes" name="indicatorTypes">
		<option value=""></option>
		<option value="goal">Program Goal</option>
		<option value="outcome">Outcome</option>
		<option value="policy">Policy</option>
		<option value="environmentalSupports">Environmental Supports</option>
		<option value="programReach">Program Reach</option>
		</select></p>
		<p><input type="submit" name="submit" /></p>
		</form>
<?php
	}
	include 'include/foot.inc';
	
}

?>