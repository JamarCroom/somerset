<h2 id="reachspot" class="center reach indicatorTitle">Program Reach Indicators</h2>
<?php


//render reach
$reachCounts=1;
$totalReachCount = count($result4);
foreach($result4 as $results4)
{
	echo"<div class='infoTable'>
	<p>Graph Type:<span id='reachGraphType".$reachCounts."'>".$results4['graphType']."</span></p>
	
	";
	
	if($results4['graphType']=='speedometer'||$results4['graphType']=='barGraph'||$results4['graphType']=='arrowDown'||$results4['graphType']=='arrowUp')
	{
		try
		{
			$newQuery="SELECT * FROM indicatorSecondaryTable WHERE indicatorId=:indicatorId";
			$statements=$db->prepare($newQuery);
			$statements->bindValue(':indicatorId',$results4['indicatorId']);
			$statements->execute();
			$newResults=$statements->fetchAll();
			$statements->closeCursor();
			foreach($newResults as $newResult)
			{
				echo"<p>Baseline Value <span id='reachBaselineValue".$reachCounts."'>".$newResult['baselineValue']."</span></p>";
				echo"<p>Followup Value <span id='reachFollowupValue".$reachCounts."'>".$newResult['followupValue']."</span></p>";
				if($newResult['changeType']=='absoluteChange')
				{
					$change=round($newResult['followupValue']-$newResult['baselineValue']);
					if($change<0)
					{
						$nchange=abs($change);
						$changeLanguage="A decrease in ".$nchange." ".$results4['measureUnit']." compared to baseline.";
					}
					else if($change>0)
					{
						$changeLanguage="An increase in ".$change." ".$results4['measureUnit']." compared to baseline.";	
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
					$change=round(($newResult['followupValue']/$results4['targetNumber'])*100);
		
						$changeLanguage=$change."% of target achieved";

				}
				echo "<p> Change: <span id='reachChangeNumber".$reachCounts."'>".$change."</span></p>";
				echo"<p>Change Type <span class='changeType".$reachCounts."'>".$changeLanguage."</span></p>";


			}	
		}
		catch(PDOException $e)
		{

		?>
			<p class="error center">There was an error connecting to the database. Please contact the system administrator.<br/> Error code:<?php echo $e->getCode() ;?> Error Message:
						<?php echo $e->getMessage();?></p>
		<?php
		}

		if($results4['graphType']=='arrowUp')
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

		if($results4['graphType']=='arrowDown')
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
		if($results4['graphType']=='barGraph' || $results4['graphType']=='lineGraph')
		{
			
				try
				{
					$barQuery="SELECT * FROM indicatorTertiaryTable WHERE indicatorId=:indicatorId";
					$statement = $db->prepare($barQuery);
					$statement->bindValue(':indicatorId',$results4['indicatorId']);
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
					
					echo"<p>X Axis <span id='reachXAxisTitle".$reachCounts."'>".$barResults['xAxisTitle']."</span></p>";
					echo"<p>Y Axis <span id='reachYAxisTitle".$reachCounts."'>".$barResults['yAxisTitle']."</span></p>";
				}
		}
		
		if($results4['graphType'] =='lineGraph')
		{
			
				try
				{
					$barQuery="SELECT * FROM yearsTable WHERE indicatorId=:indicatorId";
					$statement = $db->prepare($barQuery);
					$statement->bindValue(':indicatorId',$results4['indicatorId']);
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
					echo "<p>Year<span id='reachYear".$reachCounts."Results".$loopCount."'>".$yearResults['year']."</span> Data Year<span id='reachYear".$reachCounts."Data".$loopCount."'>".$yearResults['yearData']."</span></p>";
					
				}
				echo"<p>Year count<span id='reachYearCount".$reachCounts."'>".$loopCount."</span></p>";

		}

	
	echo"</div>";


	//display
		echo"<h3 class='reach center'>".$results4['indicatorTitle']."</h3>";
	echo"<p class='reach'><strong>Target:</strong>".$results4['targetLanguage']."</p>";
	if($results4['graphType']=='barGraph')
		echo"<div id='reachGraphic".$reachCounts."' class='reachGraphic reach' style='width: 540px; height 300px; margin:20px auto;'></div>";

	if($results4['graphType']=='lineGraph')
		echo"<div id='reachGraphic".$reachCounts."' class='reachGraphic reach bottom' style='width: 540px; height 300px; margin:20px auto;'></div>";


	if($results4['graphType']=='speedometer')
		echo"<div id='reachGraphic".$reachCounts."' class='reachGraphic reach' style='margin: 0 auto;'></div>";

	if($results4['graphType']=='arrowUp')
		echo"<div  id='reachGraphic".$reachCounts."' class='reachGraphic reach' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='".$imagePath."' width='200px' height='200px'/></div>";

	if($results4['graphType']=='arrowDown')
		echo"<div id='reachGraphic".$reachCounts."' class='reachGraphic reach' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='".$imagePath."' width='200px' height='200px'/></div>";






	if($results4['graphType']=='speedometer'||$results4['graphType']=='barGraph'||$results4['graphType']=='arrowDown'||$results4['graphType']=='arrowUp')
		echo"<p class='reach bottom'><strong>Current Progress:</strong>".$changeLanguage."</p>";
	

	
	if ($totalReachCount==$reachCounts)
	{
		echo"<p class='infoTable'>reach Graph Count: <span id='reachGraphCount'>".$reachCounts."</span></p>";
		echo"<hr class='reach bigbottom'/>";	

	}	
	$reachCounts++;
}