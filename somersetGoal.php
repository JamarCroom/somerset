<h2 class="center goalClass indicatorTitle">Program Goal</h2>
<?php


//render goalClass
$goalClassCounts=1;
$totalGoalClassCount = count($result1);
foreach($result1 as $results1)
{
	echo"<div class='infoTable'>
	<p>Graph Type:<span id='goalClassGraphType".$goalClassCounts."'>".$results1['graphType']."</span></p>
	
	";
	
	if($results1['graphType']=='speedometer'||$results1['graphType']=='barGraph'||$results1['graphType']=='arrowDown'||$results1['graphType']=='arrowUp')
	{
		try
		{
			$newQuery="SELECT * FROM indicatorSecondaryTable WHERE indicatorId=:indicatorId";
			$statements=$db->prepare($newQuery);
			$statements->bindValue(':indicatorId',$results1['indicatorId']);
			$statements->execute();
			$newResults=$statements->fetchAll();
			$statements->closeCursor();
			foreach($newResults as $newResult)
			{
				echo"<p>Baseline Value <span id='baselineValue".$goalClassCounts."'>".$newResult['baselineValue']."</span></p>";
				echo"<p>Followup Value <span id='followupValue".$goalClassCounts."'>".$newResult['followupValue']."</span></p>";
				if($newResult['changeType']=='absoluteChange')
				{
					$change=round($newResult['followupValue']-$newResult['baselineValue']);
					if($change<0)
					{
						$nchange=abs($change);
						$changeLanguage="A decrease in ".$nchange." ".$results1['measureUnit']." compared to baseline.";
					}
					else if($change>0)
					{
						$changeLanguage="An increase in ".$change." ".$results1['measureUnit']." compared to baseline.";	
					}
					else
					{
						$changeLanguage ="No change compared to baseline.";
					}
				}
				if($newResult['changeType']=='percentChange')
				{
					$change=round(((($newResult['followupValue']-$newResult['baselineValue'])/$newResult['baselineValue'])*100));
					if($change<0)
					{
						$nchange=abs($change);
						$changeLanguage="A ".$nchange." percent decrease achieved";
					}
					else if ($change>0)
					{
						$changeLanguage="A ".$change." percent increase achieved";	
					}
					else
					{
						$changeLanguage="No change achieved.";
					}
				}
				if($newResult['changeType']=='followUpToTarget')
				{
					$change=round(($newResult['followupValue']/$results1['targetNumber'])*100);
		
						$changeLanguage=$change."% of target achieved";

				}
				echo "<p> Change: <span id='goalChangeNumber".$goalClassCounts."'>".$change."</span></p>";
				echo"<p>Change Type <span class='goalChangeType".$goalClassCounts."'>".$changeLanguage."</span></p>";


			}	
		}
		catch(PDOException $e)
		{

		?>
			<p class="error center">There was an error connecting to the database. Please contact the system administrator.<br/> Error code:<?php echo $e->getCode() ;?> Error Message:
						<?php echo $e->getMessage();?></p>
		<?php
		}

		if($results1['graphType']=='arrowUp')
		{
			if($change>0)
			{
				$imagePath ="image/greenArrowUp.png";
			}
			else if($change<0)
			{
				$imagePath ="image/redArrowDown.png";	
			}
			else
			{
				$imagePath ="image/gold_equal_sign.png";
			}
		}

		if($results1['graphType']=='arrowDown')
		{
			if($change>0)
			{
				$imagePath ="image/redArrowUp.png";
			}
			else if($change<0)
			{
				$imagePath ="image/greenArrowDown.png";	
			}
			else
			{
				$imagePath ="image/gold_equal_sign.png";
			}	
		}

	}
		if($results1['graphType']=='barGraph' || $results1['graphType']=='lineGraph')
		{
			
				try
				{
					$barQuery="SELECT * FROM indicatorTertiaryTable WHERE indicatorId=:indicatorId";
					$statement = $db->prepare($barQuery);
					$statement->bindValue(':indicatorId',$results1['indicatorId']);
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
					
					echo"<p>X Axis <span id='goalXAxisTitle".$goalClassCounts."'>".$barResults['xAxisTitle']."</span></p>";
					echo"<p>Y Axis <span id='goalYAxisTitle".$goalClassCounts."'>".$barResults['yAxisTitle']."</span></p>";
				}
		}
		
		if($results1['graphType'] =='lineGraph')
		{
			
				try
				{
					$barQuery="SELECT * FROM yearsTable WHERE indicatorId=:indicatorId";
					$statement = $db->prepare($barQuery);
					$statement->bindValue(':indicatorId',$results1['indicatorId']);
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
				$loopCount=0;
				foreach($yearResult as $yearResults)
				{
					$loopCount++;
					echo "<p>Year<span id='goalYear".$goalClassCounts."Results".$loopCount."'>".$yearResults['year']."</span> Data Year<span id='goalYear".$goalClassCounts."Data".$loopCount."'>".$yearResults['yearData']."</span></p>";
					
				}
				echo"<p>Year count<span id='goalYearCount".$goalClassCounts."'>".$loopCount."</span></p>";

		}

	
	echo"</div>";


	//display
		echo"<h3 class='goalClass center'>".$results1['indicatorTitle']."</h3>";
	echo"<p class='goalClass'><strong>Target:</strong>".$results1['targetLanguage']."</p>";
	if($results1['graphType']=='barGraph'||$results1['graphType']=='lineGraph')
		echo"<div id='goalClassGraphic".$goalClassCounts."' class='goalClassGraphic goalClass' style='width: 540px; height 300px; margin:20px auto;'></div>";

	if($results1['graphType']=='speedometer')
		echo"<div id='goalClassGraphic".$goalClassCounts."'' class='goalClassGraphic goalClass' style='margin: 0 auto;''></div>";

	if($results1['graphType']=='arrowUp')
		echo"<div  id='goalClassGraphic".$goalClassCounts."' class='goalClassGraphic goalClass' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='".$imagePath."' width='200px' height='200px'/></div>";

	if($results1['graphType']=='arrowDown')
		echo"<div id='goalClassGraphic".$goalClassCounts."' class='goalClassGraphic goalClass' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='".$imagePath."' width='200px' height='200px'/></div>";






	if($results1['graphType']=='speedometer'||$results1['graphType']=='barGraph'||$results1['graphType']=='arrowDown'||$results1['graphType']=='arrowUp')
		echo"<p class='goalClass bottom'><strong>Current Progress:</strong>".$changeLanguage."</p>";
	

	
	if ($totalGoalClassCount==$goalClassCounts)
	{
		echo"<p class='infoTable'>goalClass Graph Count: <span id='goalClassGraphCount'>".$goalClassCounts."</span></p>";
		echo"<hr class='goalClass bigbottom'/>";	

	}	
	$goalClassCounts++;
}