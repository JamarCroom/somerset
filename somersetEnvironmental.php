<h2 id="environmentalspot" class="center environmental indicatorTitle">Environmental Indicators</h2>
<?php


//render environmental
$environmentalCounts=1;
$totalEnvironmentalCount = count($result3);
foreach($result3 as $results3)
{
	echo"<div class='infoTable'>
	<p>Graph Type:<span id='environmentalGraphType".$environmentalCounts."'>".$results3['graphType']."</span></p>
	
	";
	
	if($results3['graphType']=='speedometer'||$results3['graphType']=='barGraph'||$results3['graphType']=='arrowDown'||$results3['graphType']=='arrowUp')
	{
		try
		{
			$newQuery="SELECT * FROM indicatorSecondaryTable WHERE indicatorId=:indicatorId";
			$statements=$db->prepare($newQuery);
			$statements->bindValue(':indicatorId',$results3['indicatorId']);
			$statements->execute();
			$newResults=$statements->fetchAll();
			$statements->closeCursor();
			foreach($newResults as $newResult)
			{
				echo"<p>Baseline Value <span id='environmentalBaselineValue".$environmentalCounts."'>".$newResult['baselineValue']."</span></p>";
				echo"<p>Followup Value <span id='environmentalFollowupValue".$environmentalCounts."'>".$newResult['followupValue']."</span></p>";
				if($newResult['changeType']=='absoluteChange')
				{
					$change=round($newResult['followupValue']-$newResult['baselineValue']);
					if($change<0)
					{
						$nchange=abs($change);
						$changeLanguage="A decrease in ".$nchange." ".$results3['measureUnit']." compared to baseline.";
					}
					else if($change>0)
					{
						$changeLanguage="An increase in ".$change." ".$results3['measureUnit']." compared to baseline.";	
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
					$change=round(($newResult['followupValue']/$results3['targetNumber'])*100);
		
						$changeLanguage=$change."% of target achieved";

				}
				echo "<p> Change: <span id='environmentalChangeNumber".$environmentalCounts."'>".$change."</span></p>";
				echo"<p>Change Type <span class='changeType".$environmentalCounts."'>".$changeLanguage."</span></p>";


			}	
		}
		catch(PDOException $e)
		{

		?>
			<p class="error center">There was an error connecting to the database. Please contact the system administrator.<br/> Error code:<?php echo $e->getCode() ;?> Error Message:
						<?php echo $e->getMessage();?></p>
		<?php
		}

		if($results3['graphType']=='arrowUp')
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

		if($results3['graphType']=='arrowDown')
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
		if($results3['graphType']=='barGraph' || $results3['graphType']=='lineGraph')
		{
			
				try
				{
					$barQuery="SELECT * FROM indicatorTertiaryTable WHERE indicatorId=:indicatorId";
					$statement = $db->prepare($barQuery);
					$statement->bindValue(':indicatorId',$results3['indicatorId']);
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
					
					echo"<p>X Axis <span id='environmentalXAxisTitle".$environmentalCounts."'>".$barResults['xAxisTitle']."</span></p>";
					echo"<p>Y Axis <span id='environmentalYAxisTitle".$environmentalCounts."'>".$barResults['yAxisTitle']."</span></p>";
				}
		}
		
		if($results3['graphType'] =='lineGraph')
		{
			
				try
				{
					$barQuery="SELECT * FROM yearsTable WHERE indicatorId=:indicatorId";
					$statement = $db->prepare($barQuery);
					$statement->bindValue(':indicatorId',$results3['indicatorId']);
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
					echo "<p>Year<span id='environmentalYear".$environmentalCounts."Results".$loopCount."'>".$yearResults['year']."</span> Data Year<span id='environmentalYear".$environmentalCounts."Data".$loopCount."'>".$yearResults['yearData']."</span></p>";
					
				}
				echo"<p>Year count<span id='environmentalYearCount".$environmentalCounts."'>".$loopCount."</span></p>";

		}

	
	echo"</div>";


	//display
		echo"<h3 class='environmental center'>".$results3['indicatorTitle']."</h3>";
	echo"<p class='environmental'><strong>Target:</strong>".$results3['targetLanguage']."</p>";
	if($results3['graphType']=='barGraph')
		echo"<div id='environmentalGraphic".$environmentalCounts."' class='environmentalGraphic environmental' style='width: 540px; height 300px; margin:20px auto;'></div>";

	if($results3['graphType']=='lineGraph')
		echo"<div id='environmentalGraphic".$environmentalCounts."' class='environmentalGraphic environmental bottom' style='width: 540px; height 300px; margin:20px auto;'></div>";

	if($results3['graphType']=='speedometer')
		echo"<div id='environmentalGraphic".$environmentalCounts."' class='environmentalGraphic environmental' style='margin: 0 auto;'></div>";

	if($results3['graphType']=='arrowUp')
		echo"<div  id='environmentalGraphic".$environmentalCounts."' class='environmentalGraphic environmental' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='".$imagePath."' width='200px' height='200px'/></div>";

	if($results3['graphType']=='arrowDown')
		echo"<div id='environmentalGraphic".$environmentalCounts."' class='environmentalGraphic environmental' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='".$imagePath."' width='200px' height='200px'/></div>";






	if($results3['graphType']=='speedometer'||$results3['graphType']=='barGraph'||$results3['graphType']=='arrowDown'||$results3['graphType']=='arrowUp')
		echo"<p class='environmental bottom'><strong>Current Progress:</strong>".$changeLanguage."</p>";
	

	
	if ($totalEnvironmentalCount==$environmentalCounts)
	{
		echo"<p class='infoTable'>environmental Graph Count: <span id='environmentalGraphCount'>".$environmentalCounts."</span></p>";
		echo"<hr class='environmental bigbottom'/>";	

	}	
	$environmentalCounts++;
}