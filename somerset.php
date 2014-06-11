<!DOCTYPE html>
<html>
<head>

	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Paytone+One' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="jquery.speedometer.js"></script>
	<script src="jquery.jqcanvas-modified.js"></script>
	<script src="excanvas-modified.js"></script>
<script type="text/javascript">
$(function()
{
	var outcomeCounter = parseInt($('#outcomeGraphCount').html());
	//alert(outcomeCounter);
	var outcomeIncrementer=1;

	for(var i = 0; i < outcomeCounter; i++)
	{

		var graphType = "outcomeGraphType"+outcomeIncrementer;
		graphType = document.getElementById(graphType);
			
		var graphTypeValue = $(graphType).html();
		
		if(graphTypeValue=='barGraph')
		{


			alert('hello');
		}

		outcomeIncrementer++;
		
	}

});	
</script>

<style type="text/css">

</style>
</head>
<body>
<?php
require_once 'include/dbaseConnect.inc';
$_GET['contentArea']='adultPAN';
try
{
	$query1 ="SELECT * FROM indicatorMainTable WHERE indicatorState='on' AND contentArea=:contentArea AND indicatorType='goal'";
	$query2="SELECT * FROM indicatorMainTable WHERE indicatorState='on' AND contentArea=:contentArea AND indicatorType='outcome'";
	$query3="SELECT * FROM indicatorMainTable WHERE indicatorState='on' AND contentArea=:contentArea AND indicatorType='environmentalSupports'";
	$query4="SELECT * FROM indicatorMainTable WHERE indicatorState='on' AND contentArea=:contentArea AND indicatorType='programReach'";
	$db->beginTransaction();
	$statement1=$db->prepare($query1);
	$statement1->bindValue(':contentArea',$_GET['contentArea']);
	$statement1->execute();
	$result1=$statement1->fetchAll();

	$statement2=$db->prepare($query2);
	$statement2->bindValue(':contentArea',$_GET['contentArea']);
	$statement2->execute();
	$result2=$statement2->fetchAll();
	
	$statement3=$db->prepare($query3);
	$statement3->bindValue(':contentArea',$_GET['contentArea']);
	$statement3->execute();
	$result3=$statement3->fetchAll();
	
	$statement4=$db->prepare($query4);
	$statement4->bindValue(':contentArea',$_GET['contentArea']);
	$statement4->execute();
	$result4=$statement4->fetchAll();

	$db->commit();
}
catch(PDOException $e)
{
?>
  	<p class="error center">There was an error connecting to the database. Please contact the system administrator.<br/> Error code:<?php echo $e->getCode() ;?> Error Message:
	<?php echo $e->getMessage();?></p>
<?php
}
?>
<h2 class="center outcomeClass indicatorTitle">Outcome Indicators</h2>
<?php


//render outcome
$counts=1;
$outcomeCount = count($result2);
foreach($result2 as $results2)
{
	echo"<div class='infoTable'>
	<p>Graph Type:<span id='outcomeGraphType".$counts."'>".$results2['graphType']."</span></p>
	
	";
	
	if($results2['graphType']=='speedometer'||$results2['graphType']=='barGraph'||$results2['graphType']=='arrowDown'||$results2['graphType']=='arrowUp')
	{
		try
		{
			$newQuery="SELECT * FROM indicatorSecondaryTable WHERE indicatorId=:indicatorId";
			$statements=$db->prepare($newQuery);
			$statements->bindValue(':indicatorId',$results2['indicatorId']);
			$statements->execute();
			$newResults=$statements->fetchAll();
			$statements->closeCursor();
			foreach($newResults as $newResult)
			{
				echo"<p>Baseline Value <span id='baselineValue".$counts."'>".$newResult['baselineValue']."</span></p>";
				echo"<p>Followup Value <span id='followupValue".$counts."'>".$newResult['followupValue']."</span></p>";
				if($newResult['changeType']=='absoluteChange')
				{
					$change=round($newResult['followupValue']-$newResult['baselineValue']);
					if($change<0)
					{
						$change=abs($change);
						$changeLanguage="A decrease in ".$change." ".$results2['measureUnit']." compared to baseline.";
					}
					else
					{
						$changeLanguage="An increase in ".$change." ".$results2['measureUnit']." compared to baseline.";	
					}
				}
				if($newResult['changeType']=='percent')
				{
					$change=round(((($newResult['followupValue']-$newResult['baselineValue'])/$newResult['baseline'])*100));
					if($change<0)
					{
						$change=abs($change);
						$changeLanguage="A ".$change." percent decrease achieved";
					}
					else
					{
						$changeLanguage="A ".$change." percent increase achieved";	
					}
				}
				if($newResult['changeType']=='followUpToTarget')
				{
					$change=round(($newResult['followupValue']/$results2['targetNumber'])*100);
		
						$changeLanguage=$change."% of target achieved";

				}
				echo"<p>Change Type <span class='changeType".$counts."'>".$changeLanguage."</span></p>";


			}	
		}
		catch(PDOException $e)
		{

		?>
			<p class="error center">There was an error connecting to the database. Please contact the system administrator.<br/> Error code:<?php echo $e->getCode() ;?> Error Message:
						<?php echo $e->getMessage();?></p>
		<?php
		}
		if($results2['graphType']=='barGraph'||$results2['graphType']=='lineGraph')
		{
			
				try
				{
					$barQuery="SELECT * FROM indicatorTertiaryTable WHERE indicatorId=:indicatorId";
					$statement = $db->prepare($barQuery);
					$statement->bindValue(':indicatorId',$results2['indicatorId']);
					$statement->execute();
					$barResult=$statement->fetchAll();
					$statement->closeCursor();

				}
				catch(PDOException $e)
				{

				?>
					  <p class="error center">There was an error connecting to the database. Please contact the system administrator.<br/> Error code:<?php echo $e->getCode() ;?> Error Message:
						<?php echo $e->getMessage();?></p>
				<?php
				}

				foreach($barResult as $barResults)
				{
					
					echo"<p>X Axis<span class='xAxisTitle".$counts."'>".$barResults['xAxisTitle']."</span></p>";
					echo"<p>Y Axis<span class='yAxisTitle".$counts."'>".$barResults['yAxisTitle']."</span></p>";
				}
		}
		
		if($results2['graphType']=='lineGraph')
		{
				try
				{
					$barQuery="SELECT * FROM yearsTable WHERE indicatorId=:indicatorId";
					$statement = $db->prepare($barQuery);
					$statement->bindValue(':indicatorId',$results2['indicatorId']);
					$statement->execute();
					$yearResult=$statement->fetchAll();
					$statement->closeCursor();

				}
				catch(PDOException $e)
				{
				?>
					 <p class="error center">There was an error connecting to the database. Please contact the system administrator.<br/> Error code:<?php echo $e->getCode() ;?> Error Message:
						<?php echo $e->getMessage();?></p>
				<?php
				}
				$loopCount=1;
				foreach($yearResult as $yearResults)
				{

					echo "<p>Year<span class='year".$counts."Results".$loopCount."'>".$yearResults['year']."</span> Data Year<span class='year".$counts."Data".$loopCount."'>".$yearResults['yearData']."</span></p>";
					$loopCount++;
				}
				echo"<p>Year count<span class='yearCount".$counts."'>".$loopCount."</span></p>";

		}

	}
	echo"</div>";


	//display
		echo"<h3 class='outcomeClass center'>".$results2['indicatorTitle']."</h3>";
	echo"<p class='outcomeClass'><strong>Target:</strong>".$results2['targetLanguage']."</p>";
	if($results2['graphType']=='barGraph'||$results2['graphType']=='lineGraph')
		echo"<div id='outcomeGraphic".$counts."' class='outcomeGraphic outcomeClass' style='width: 540px; height 300px; margin:20px auto;'></div>";

	if($results2['graphType']=='speedometer')
		echo'<div id="outcomeGraphic"'.$counts.'" class="outcomeGraphic outcomeClass"style="margin: 0 auto;"></div>';

	if($results2['graphType']=='arrowUp')
		echo"<div  id='outcomeGraphic".$counts."' class='outcomeGraphic outcome' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='green_arrow.png' width='200px' height='200px'/></div>";

	if($results2['graphType']=='arrowDown')
		echo"<div id='outcomeGraphic".$counts."' class='outcomeGraphic outcome' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='green_arrow.png' width='200px' height='200px'/></div>";






	if($results2['graphType']=='speedometer'||$results2['graphType']=='barGraph'||$results2['graphType']=='arrowDown'||$results2['graphType']=='arrowUp')
		echo"<p class='outcomeClass bottom'><strong>Current Progress:</strong>".$changeLanguage."</p>";
	

	
	if ($outcomeCount==$counts)
	{
		echo"<p class='infoTable'>Outcome Graph Count: <span id='outcomeGraphCount'>".$outcomeCount."</span></p>";
		echo"<hr class='outcomeClass bigbottom'/>";	

	}	
	$counts++;
}
?>
</body>
</html>