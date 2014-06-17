<h2 id="policyspot" class="center policy indicatorTitle">Policy Success Indicators</h2>
<?php


//render policy
$policyCounts=1;
$totalPolicyCount = count($result5);
foreach($result5 as $results5)
{
	
	echo"<div class='infoTable'>
	<p>Graph Type:<span id='policyGraphType".$policyCounts."'>".$results5['graphType']."</span></p>
	
	";
	
	if($results5['graphType']=='speedometer'||$results5['graphType']=='barGraph'||$results5['graphType']=='arrowDown'||$results5['graphType']=='arrowUp')
	{
		try
		{
			$newQuery="SELECT * FROM indicatorSecondaryTable WHERE indicatorId=:indicatorId";
			$statements=$db->prepare($newQuery);
			$statements->bindValue(':indicatorId',$results5['indicatorId']);
			$statements->execute();
			$newResults=$statements->fetchAll();
			$statements->closeCursor();
			foreach($newResults as $newResult)
			{
				echo"<p>Baseline Value <span id='policyBaselineValue".$policyCounts."'>".$newResult['baselineValue']."</span></p>";
				echo"<p>Followup Value <span id='policyFollowupValue".$policyCounts."'>".$newResult['followupValue']."</span></p>";
				if($newResult['changeType']=='absoluteChange')
				{
					$change=round($newResult['followupValue']-$newResult['baselineValue']);
					if($change<0)
					{
						$nchange=abs($change);
						$changeLanguage="A decrease in ".$nchange." ".$results5['measureUnit']." compared to baseline.";
					}
					else if($change>0)
					{
						$changeLanguage="An increase in ".$change." ".$results5['measureUnit']." compared to baseline.";	
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
					$change=round(($newResult['followupValue']/$results5['targetNumber'])*100);
		
						$changeLanguage=$change."% of target achieved";

				}
				echo "<p> Change: <span id='policyChangeNumber".$policyCounts."'>".$change."</span></p>";
				echo"<p>Change Type <span class='changeType".$policyCounts."'>".$changeLanguage."</span></p>";


			}	
		}
		catch(PDOException $e)
		{

		?>
			<p class="error center">There was an error connecting to the database. Please contact the system administrator.<br/> Error code:<?php echo $e->getCode() ;?> Error Message:
						<?php echo $e->getMessage();?></p>
		<?php
		}

		if($results5['graphType']=='arrowUp')
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

		if($results5['graphType']=='arrowDown')
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
		if($results5['graphType']=='barGraph' || $results5['graphType']=='lineGraph')
		{
			
				try
				{
					$barQuery="SELECT * FROM indicatorTertiaryTable WHERE indicatorId=:indicatorId";
					$statement = $db->prepare($barQuery);
					$statement->bindValue(':indicatorId',$results5['indicatorId']);
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
					
					echo"<p>X Axis <span id='policyXAxisTitle".$policyCounts."'>".$barResults['xAxisTitle']."</span></p>";
					echo"<p>Y Axis <span id='policyYAxisTitle".$policyCounts."'>".$barResults['yAxisTitle']."</span></p>";
				}
		}
		
		if($results5['graphType'] =='lineGraph')
		{
			
				try
				{
					$barQuery="SELECT * FROM yearsTable WHERE indicatorId=:indicatorId";
					$statement = $db->prepare($barQuery);
					$statement->bindValue(':indicatorId',$results5['indicatorId']);
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
					echo "<p>Year<span id='policyYear".$policyCounts."Results".$loopCount."'>".$yearResults['year']."</span> Data Year<span id='policyYear".$policyCounts."Data".$loopCount."'>".$yearResults['yearData']."</span></p>";
					
				}
				echo"<p>Year count<span id='policyYearCount".$policyCounts."'>".$loopCount."</span></p>";

		}

	
	echo"</div>";


	//display
		echo"<h3 class='policy center'>".$results5['indicatorTitle']."</h3>";
	echo"<p class='policy'><strong>Target:</strong>".$results5['targetLanguage']."</p>";
	if($results5['graphType']=='barGraph')
		echo"<div id='policyGraphic".$policyCounts."' class='policyGraphic policy' style='width: 540px; height 300px; margin:20px auto;'></div>";

	if($results5['graphType']=='lineGraph')
		echo"<div id='policyGraphic".$policyCounts."' class='policyGraphic policy bottom' style='width: 540px; height 300px; margin:20px auto;'></div>";

	if($results5['graphType']=='speedometer')
		echo"<div id='policyGraphic".$policyCounts."' class='policyGraphic policy' style='margin: 0 auto;'></div>";

	if($results5['graphType']=='arrowUp')
		echo"<div  id='policyGraphic".$policyCounts."' class='policyGraphic policy' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='".$imagePath."' width='200px' height='200px'/></div>";

	if($results5['graphType']=='arrowDown')
		echo"<div id='policyGraphic".$policyCounts."' class='policyGraphic policy' style ='text-align:center; width: 540px; height: 250px; margin: 0 auto;'><img src='".$imagePath."' width='200px' height='200px'/></div>";






	if($results5['graphType']=='speedometer'||$results5['graphType']=='barGraph'||$results5['graphType']=='arrowDown'||$results5['graphType']=='arrowUp')
		echo"<p class='policy bottom'><strong>Current Progress:</strong>".$changeLanguage."</p>";
	

	
	if ($totalPolicyCount==$policyCounts)
	{
		echo"<p class='infoTable'>Policy Graph Count: <span id='policyGraphCount'>".$policyCounts."</span></p>";
		echo"<hr class='policy bigbottom'/>";	

	}	
	$policyCounts++;
}