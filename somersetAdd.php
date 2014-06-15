<?php
session_start();
if(!isset($_SESSION['logged_in']))
{
	include 'include/privilegeError.inc';
}

else
{


include 'include/head.inc';

?>
<h2>Add an indicator</h2>
	<form action="somersetAddProcess.php" method="POST">
	<p>Select a content area: <select id="contentAreas"  name="contentArea" >
		<option value=""></option>
	<option value="adultPAN">Adult PAN</option>
	<option value="youthPAN"> Youth PAN</option>
	<option value="adultSubstanceAbuse">Adult Substance Abuse</option>
	<option value="youthSubstanceAbuse">Youth Substance Abuse</option>
	<option value="coalition">Coalition</option>
	</select></p>

	<p>Select an indicator type: <select id="indicatorTypes" name="indicatorType">
	<option value=""></option>
	<option value="goal">Program Goal</option>
	<option value="outcome">Outcome</option>
	<option value="policy">Policy</option>
	<option value="environmentalSupports">Environmental Supports</option>
	<option value="programReach">Program Reach</option>
	</select></p>

	<p>How do you want to visualize your data? Choose an infographic: 
		<select id="graphType" name="graphType">
		<option value=""></option>
		<option value="barGraph">Bar graph</option>
		<option value="speedometer">Speedometer</option>
		<option value="lineGraph">Line Graph</option>
		<option value="arrowUp">Directional Arrow (an increase is good)</option>
		<option value="arrowDown">Directional Arrow (a decrease is good)</option>
	</select></p>

	<p id="indicatorTitle" class="hidden defaultGroup">What is the title of the indicator? <input type="text" class="disabledInput defaultInput" name="indicatorTitle" /></p>

	<p id="targetLanguage" class="hidden defaultGroup">Describe the target for this indicator. <input type="text" class="disabledInput defaultInput" name="targetLanguage" /></p>

	<p id="unitMeasure" class="hidden defaultGroup">Describe the unit of measurement for this indicator (i.e. schools, BMI, students,etc.). <input type="text" class="disabledInput defaultInput" name="measureUnit" /></p>


	<p id="targetLanguageNumber" class="hidden defaultGroup">Please enter the numerical value for the target: <input type="text" class="disabledInput defaultInput" name="targetNumber" /></p>

	<p id="changeType" class="hidden group2">Indicate the type of change that you would like exhibited: <select name="changeType" class="disabledInput disabledGroup2">
		<option value=""></option>
		<option value="absoluteChange">Absolute Change(compare follow-up value to baseline value)</option>
		<option value="percentChange">Percent Change(compare follow-up value as a percentage of baseline value)</option>
	<option value="followUpToTarget">Follow-up vs. Target(compare follow-up to the target value)</option></select></p>

	<p id="baselineValue" class="hidden group2">Please enter the baseline value for this indicator using numbers only: <input type="text" class="disabledInput  disabledGroup2" name="baselineValue" /></p>

	<p id="followupValue" class="hidden group2">Please enter the followup value for this indicator using numbers only: <input type="text" class="disabledInput  disabledGroup2" name="followupValue"/></p>

	<p id="XaxisTitle"class="hidden group3"> Please enter a brief title for the graph&#39;s X-axis<input type="text" class="disabledInput  disabledGroup3" name="xAxis" /></p>
	
	<p id="YaxisTitle" class="hidden group3"> Please enter a brief title for the graph&#39;s Y-axis <input type="text" class="disabledInput  disabledGroup3" name="yAxis" /></p>

	<p id="linegraph" class="hidden uniqueLine">Enter data for the line graph: (A minimum of 3 and a maximum of 5 data points can be used for the graph) <br/>
	<table id="lineGraphData" class="hidden uniqueLine">
	<tr><td>Enter a year:<input type="text" class="disabledInput disabledGroupUnique" name="year[]" /></td><td>Enter data for that year:<input type="text" class="disabledInput  disabledGroupUnique" name="yearData[]"/></td></tr>
	<tr><td>Enter a year:<input type="text" class="disabledInput disabledGroupUnique" name="year[]" /></td><td>Enter data for that year:<input type="text" class="disabledInput disabledGroupUnique" name="yearData[]"/></td></tr>
	<tr><td>Enter a year:<input type="text" class="disabledInput disabledGroupUnique" name="year[]" /></td><td>Enter data for that year:<input type="text" class="disabledInput disabledGroupUnique" name="yearData[]"/></td></tr>
	</table>
		<button id="addYear" class="hidden uniqueLine">Add a Year</button>
		<button id="removeYear" class="hidden uniqueLine">Remove a Year</button>
	</p>



	<p><input type="submit" name="submit" value="Submit" disabled /></p>
</form>
<?php
include 'include/foot.inc';
}
?>