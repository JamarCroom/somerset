<h2 id="outcomespot" class="center outcomeClass indicatorTitle">Outcome Indicators</h2>
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
						$nchange=abs($change);
						$changeLanguage="A decrease in ".$nchange." ".$results2['measureUnit']." compared to baseline.";
					}
					else if($change>0)
					{
						$changeLanguage="An increase in ".$change." ".$results2['measureUnit']." compared to baseline.";	
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
					$change=round(($newResult['followupValue']/$results2['targetNumber'])*100);
		
						$changeLanguage=$change."% of target achieved";

				}
				echo "<p> Change: <span id='changeNumber".$counts."'>".$change."</span></p>";
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

		if($results2['graphType']=='arrowUp')
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

		if($results2['graphType']=='arrowDown')
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
		if($results2['graphType']=='barGraph' || $results2['graphType']=='lineGraph')
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
					
					echo"<p>X Axis <span id='xAxisTitle".$counts."'>".$barResults['xAxisTitle']."</span></p>";
					echo"<p>Y Axis <span id='yAxisTitle".$counts."'>".$barResults['yAxisTitle']."</span></p>";
				}
		}
		
		if($results2['graphType'] =='lineGraph')
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
				$loopCount=0;
				foreach($yearResult as $yearResults)
				{
					$loopCount++;
					echo "<p>Year<span id='year".$counts."Results".$loopCount."'>".$yearResults['year']."</span> Data Year<span id='year".$counts."Data".$loopCount."'>".$yearResults['yearData']."</span></p>";
					
				}
				echo"<p>Year count<span id='yearCount".$counts."'>".$loopCount."</span></p>";

		}

	
	echo"</div>";


	//display
		echo"<h3 class='outcomeClass center'>".$results2['indicatorTitle']."</h3>";
	echo"<p class='outcomeClass'><strong>Target:</strong>".$results2['targetLanguage']."</p>";
	if($results2['graphType']=='barGraph')
		echo"<div id='outcomeGraphic".$counts."' class='outcomeGraphic outcomeClass' style='width: 540px; height 300px; margin:20px auto;'></div>";

	if($results2['graphType']=='lineGraph')
		echo"<div id='outcomeGraphic".$counts."' class='outcomeGraphic outcomeClass bottom' style='width: 540px; height 300px; margin:20px auto;'></div>";

	if($results2['graphType']=='speedometer')
		echo"<div id='outcomeGraphic".$counts."' class='outcomeGraphic outcomeClass' style='margin: 0 auto;'></div>";

	if($results2['graphType']=='arrowUp')
		echo"<div  id='outcomeGraphic".$counts."' class='outcomeGraphic outcomeClass' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='".$imagePath."' width='200px' height='200px'/></div>";

	if($results2['graphType']=='arrowDown')
		echo"<div id='outcomeGraphic".$counts."' class='outcomeGraphic outcomeClass' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='".$imagePath."' width='200px' height='200px'/></div>";






	if($results2['graphType']=='speedometer'||$results2['graphType']=='barGraph'||$results2['graphType']=='arrowDown'||$results2['graphType']=='arrowUp')
		echo"<p class='outcomeClass bottom'><strong>Current Progress:</strong>".$changeLanguage."</p>";
	

	
	if ($outcomeCount==$counts)
	{
		echo"<p class='infoTable'>Outcome Graph Count: <span id='outcomeGraphCount'>".$outcomeCount."</span></p>";
		echo"<hr class='outcomeClass bigbottom'/>";	

	}	
	$counts++;
}