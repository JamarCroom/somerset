<?php
session_start();

include_once 'include/head.inc';
/*
if(!isset($_SESSION['logged_in']))
{

	include 'include/privilegeError.inc';

}

else
{
*/
	if(isset($_POST['submit']))
	{
		$buildForm=true;
		require_once 'objects/Validation.php';
		$validate = new Validation();
		$contentArea=$validate->validateInput($_POST['contentArea'],'Content Area');
		$indicatorType=$validate->validateInput($_POST['indicatorType'],'Indicator Type');
		//echo $_POST['graphType'];
		$graphType=$validate->validateInput($_POST['graphType'],'Visualize your data');

		$indicatorTitle=$validate->validAlphaNum($_POST['indicatorTitle'],'Indicator Title');
		$targetLanguage = $validate->validAlphaNum($_POST['targetLanguage'],'Target language');
		$targetNumber = $validate->validAlphaNum($_POST['targetNumber'],'Target number');
		$measureUnit = $validate->validAlpha($_POST['measureUnit'],'Unit of measure');
		if($graphType=='speedometer'||$graphType=='barGraph'||$graphType=='arrowDown'||$graphType=='arrowUp')
		{
			$changeType=$validate->validateInput($_POST['changeType'],'Change Type');
			$baselineValue=$validate->validNum($_POST['baselineValue'],'Baseline Value');
			$followupValue=$validate->validNum($_POST['followupValue'],'Followup Value');
		}
		if($graphType=='barGraph'||$graphType=='lineGraph')
		{
			$xAxisTitle=$validate->validAlphaNum($_POST['xAxis'],'X-axis Title');
			$yAxisTitle=$validate->validAlphaNum($_POST['yAxis'],'Y-axis Title');
		}
		if($graphType=='lineGraph')
		{
			$years=$_POST['year'];
			$yearData=$_POST['yearData'];

			foreach ($years as $key=>$value) 
			{
				$years[$key]=$validate->validNum($years[$key],'Enter a year');
				$yearData[$key]=$validate->validNum($yearData[$key],'Enter data for that year');
			}
		}	

		$errors=$validate->getErrorCount();

		if($errors>0)
		{
			$validate->printErrorMsgs();
		}
		else
		{
			try
			{
					require_once 'include/dbaseConnect.inc';
					$currentDate = date('Y-m-d');
					$db->beginTransaction();
			if($graphType=='barGraph')
			{
				$query="INSERT INTO indicatorMainTable(indicatorState, dateCreated,contentArea, indicatorType, graphType, indicatorTitle, measureUnit, targetLanguage, targetNumber) 
				VALUES( :indicatorState, :dateCreated,:contentArea, :indicatorType, :graphType, :indicatorTitle, :measureUnit, :targetLanguage, :targetNumber)";
				
				$statement=$db->prepare($query);
				$statement->bindValue(':indicatorState','off');
				$statement->bindValue(':dateCreated',$currentDate);
				$statement->bindValue(':contentArea',$contentArea);
				$statement->bindValue(':indicatorType',$indicatorType);
				$statement->bindValue(':graphType',$graphType);
				$statement->bindValue(':indicatorTitle',$indicatorTitle);
				$statement->bindValue(':measureUnit',$measureUnit);
				$statement->bindValue(':targetLanguage',$targetLanguage);
				$statement->bindValue(':targetNumber',$targetNumber);
				$statement->execute();
				$indicatorId=$db->lastInsertId();
				

				$query2="INSERT INTO indicatorSecondaryTable(indicatorId, changeType, baselineValue, followupValue)VALUES(:indicatorId, :changeType, :baselineValue, :followupValue)";
				$statement=$db->prepare($query2);
				$statement->bindValue(':changeType',$changeType);
				$statement->bindValue(':baselineValue',$baselineValue);
				$statement->bindValue(':followupValue',$followupValue);
				$statement->bindValue(':indicatorId',$indicatorId);
				$statement->execute();



				$query3="INSERT INTO indicatorTertiaryTable(indicatorId, xAxisTitle, yAxisTitle)VALUES(:indicatorId, :xAxisTitle, :yAxisTitle)";
				$statement=$db->prepare($query3);
				$statement->bindValue(':xAxisTitle',$xAxisTitle);
				$statement->bindValue(':yAxisTitle',$yAxisTitle);
				$statement->bindValue(':indicatorId',$indicatorId);
				$statement->execute();

			}

			if($graphType=='lineGraph')
			{
				$query="INSERT INTO indicatorMainTable(indicatorState, dateCreated,contentArea, indicatorType, graphType, indicatorTitle, measureUnit, targetLanguage, targetNumber) 
				VALUES( :indicatorState, :dateCreated,:contentArea, :indicatorType, :graphType, :indicatorTitle, :measureUnit, :targetLanguage, :targetNumber)";
				
				$statement=$db->prepare($query);
				$statement->bindValue(':indicatorState','off');
				$statement->bindValue(':dateCreated',$currentDate);
				$statement->bindValue(':contentArea',$contentArea);
				$statement->bindValue(':indicatorType',$indicatorType);
				$statement->bindValue(':graphType',$graphType);
				$statement->bindValue(':indicatorTitle',$indicatorTitle);
				$statement->bindValue(':measureUnit',$measureUnit);
				$statement->bindValue(':targetLanguage',$targetLanguage);
				$statement->bindValue(':targetNumber',$targetNumber);
				$statement->execute();
				$indicatorId=$db->lastInsertId();
				

				$query3="INSERT INTO indicatorTertiaryTable(indicatorId, xAxisTitle, yAxisTitle)VALUES(:indicatorId, :xAxisTitle, :yAxisTitle)";
				$statement=$db->prepare($query3);
				$statement->bindValue(':xAxisTitle',$xAxisTitle);
				$statement->bindValue(':yAxisTitle',$yAxisTitle);
				$statement->bindValue(':indicatorId',$indicatorId);
				$statement->execute();

				$query2= "INSERT INTO yearsTable(year, yearData, indicatorId) VALUES(:year,:yearData, :indicatorId)";
				$statement=$db->prepare($query2);
				foreach($years as $key=>$value)
				{
					$statement->bindValue(':year',$years[$key]);
					$statement->bindValue(':yearData',$yearData[$key]);
					$statement->bindValue(':indicatorId',$indicatorId);
					$statement->execute();
				}

			}


			if($graphType=='speedometer'||$graphType=='arrowDown'||$graphType=='arrowUp')
			{
				$query="INSERT INTO indicatorMainTable(indicatorState, dateCreated,contentArea, indicatorType, graphType, indicatorTitle, measureUnit, targetLanguage, targetNumber) 
				VALUES(:indicatorState, :dateCreated,:contentArea, :indicatorType, :graphType, :indicatorTitle, :measureUnit, :targetLanguage, :targetNumber)";
				
				$statement=$db->prepare($query);
				$statement->bindValue(':indicatorState','off');
				$statement->bindValue(':dateCreated',$currentDate);
				$statement->bindValue(':contentArea',$contentArea);
				$statement->bindValue(':indicatorType',$indicatorType);
				$statement->bindValue(':graphType',$graphType);
				$statement->bindValue(':indicatorTitle',$indicatorTitle);
				$statement->bindValue(':measureUnit',$measureUnit);
				$statement->bindValue(':targetLanguage',$targetLanguage);
				$statement->bindValue(':targetNumber',$targetNumber);
				$statement->execute();
				$indicatorId=$db->lastInsertId();
				

				$query2="INSERT INTO indicatorSecondaryTable(indicatorId, changeType, baselineValue, followupValue)VALUES(:indicatorId, :changeType, :baselineValue, :followupValue)";
				$statement=$db->prepare($query2);
				$statement->bindValue(':changeType',$changeType);
				$statement->bindValue(':baselineValue',$baselineValue);
				$statement->bindValue(':indicatorId',$indicatorId);
				$statement->bindValue(':followupValue',$followupValue);
				$statement->execute();
			
			}
			$db->commit();
			$buildForm = false;
			echo '<p>You have successfully added an indicator to the database</p>';

		}
			catch(PDOException $e)
			{
			?>
			<p class="error center">There was an error connecting to the database. Please contact the system administrator.<br/> Error code:<?php echo $e->getCode() ;?> Error Message:
			<?php echo $e->getMessage();?></p>
		<?php
			}

		}
		if($buildForm)
		{
?>
			<form action="somersetAddProcess.php" method="POST">
			<p>Select a content area: <select id="contentAreas"  name="contentArea" >
				<option value=""<?php if($contentArea=='') echo 'selected'; ?>></option>
			<option value="adultPAN" <?php if($contentArea=='adultPAN') echo 'selected'; ?> >Adult PAN</option>
			<option value="youthPAN" <?php if($contentArea=='youthPAN') echo 'selected'; ?>> Youth PAN</option>
			<option value="adultSubstanceAbuse" <?php if($contentArea=='adultSubstanceAbuse') echo 'selected'; ?>>Adult Substance Abuse</option>
			<option value="youthSubstanceAbuse" <?php if($contentArea=='youthSubstanceAbuse') echo 'selected'; ?>>Youth Substance Abuse</option>
			<option value="coalition" <?php if($contentArea=='coalition') echo 'selected'; ?>>Coalition</option>
			</select></p>

			<p>Select an indicator type: <select id="indicatorTypes" name="indicatorType">
			<option value="" <?php if($indicatorType=='') echo 'selected'; ?>></option>
			<option value="goal" <?php if($indicatorType=='goal') echo 'selected'; ?>>Program Goal</option>
			<option value="outcome" <?php if($indicatorType=='outcome') echo 'selected'; ?>>Outcome</option>
			<option value="policy" <?php if($indicatorType=='policy') echo 'selected'; ?>>Policy</option>
			<option value="environmentalSupports" <?php if($indicatorType=='environmentalSupports') echo 'selected'; ?>>Environmental Supports</option>
			<option value="programReach" <?php if($indicatorType=='programReach') echo 'selected'; ?>>Program Reach</option>
			</select></p>

			<p>How do you want to visualize your data? Choose an infographic: <select id="graphType" name="graphType">
				<option value=<?php echo"'$graphType'";?>><?php echo $graphType;?></option>
			</select></p>

			<p id="indicatorTitle" class="hidden defaultGroup">What is the title of the indicator? <input type="text" class="disabledInput defaultInput" name="indicatorTitle" value=<?php echo "'$indicatorTitle'"?>/></p>

			<p id="targetLanguage" class="hidden defaultGroup">Describe the target for this indicator. <input type="text" class="disabledInput defaultInput" name="targetLanguage" value =<?php echo "'$targetLanguage'"?>/></p>

			<p id="unitMeasure" class="hidden defaultGroup">Describe the unit of measurement for this indicator (i.e. schools, BMI, students,etc.). <input type="text" class="disabledInput defaultInput" name="measureUnit" value=<?php echo "'$measureUnit'"?>/></p>


			<p id="targetLanguageNumber" class="hidden defaultGroup">Please enter the numerical value for the target: <input type="text" class="disabledInput defaultInput" name="targetNumber" value=<?php echo "'$targetNumber'"?>/></p>
<?php
		if($graphType=='speedometer'||$graphType=='barGraph'||$graphType=='arrowDown'||$graphType=='arrowUp')
		{
?>

			<p id="changeType" class="hidden group2">Indicate the type of change that you would like exhibited: <select name="changeType" class="disabledInput disabledGroup2">
			<option value="" <?php if($changeType=='') echo "selected" ?> ></option>
			<option value="absoluteChange" <?php if($changeType=='absoluteChange') echo "selected" ?>>Absolute Change(compare follow-up value to baseline value)</option>
			<option value="percentChange" <?php if($changeType=='percentChange') echo "selected" ?> >Percent Change(compare follow-up value as a percentage of baseline value)</option>
			<option value="followUpToTarget" <?php if($changeType=='followUpToTarget') echo "selected" ?>>Follow-up vs. Target(compare follow-up to the target value)</option></select></p>




			<p id="baselineValue" class="hidden group2">Please enter the baseline value for this indicator using numbers only: <input type="text" class="disabledInput  disabledGroup2" name="baselineValue" value=<?php echo"'$baselineValue'"?>/></p>

			<p id="followupValue" class="hidden group2">Please enter the followup value for this indicator using numbers only: <input type="text" class="disabledInput  disabledGroup2" name="followupValue" value=<?php echo"'$followupValue'"?>/></p>
<?php
		}
		if($graphType=='barGraph'||$graphType=='lineGraph')
		{
?>
	

			<p id="XaxisTitle"class="hidden group3"> Please enter a brief title for the graph&#39;s X-axis<input type="text" class="disabledInput  disabledGroup3" name="xAxis" value=<?php echo"'$xAxisTitle'"?> /></p>
	
			<p id="YaxisTitle" class="hidden group3"> Please enter a brief title for the graph&#39;s Y-axis <input type="text" class="disabledInput  disabledGroup3" name="yAxis" value=<?php echo"'$yAxisTitle'"?> /></p>


<?php
		}
		if($graphType=='lineGraph')
		{
?>
		
				<p id="linegraph" class="hidden uniqueLine">Enter data for the line graph: (A minimum of 3 and a maximum of 5 data points can be used for the graph) <br/>
				<table id="lineGraphData" class="hidden uniqueLine">
<?php
				$tableDataCount = 1;
				foreach($years as $key=>$value)
				{
					echo'<tr><td>Enter a year:<input type="text" class="disabledInput disabledGroupUnique" name="year[]" value="'.$years[$key].'"/></td><td>Enter data for that year:<input type="text" class="disabledInput  disabledGroupUnique" name="yearData[]" value="'.$yearData[$key].'"/></td></tr>';
					$tableDataCount++;						
				}
?>
			</table>
				<button id="addYear" class="hidden uniqueLine">Add a Year</button>
				<button id="removeYear" class="hidden uniqueLine">Remove a Year</button>
			</p>
			<span style="display:none;"><?php echo $tableDataCount;?></span>

			
<?php
		}	
?>
			<input type="submit" name="submit" value="Submit" />

	</form>
<?php
		}

	}
	else
	{




	}

/*
}
*/
include 'include/foot.inc';
?>
