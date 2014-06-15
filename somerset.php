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
	//$(".infoTable").hide();

	for(var i = 0; i < outcomeCounter; i++)
	{

		
		if($(document.getElementById("outcomeGraphType" + outcomeIncrementer)).html() == 'barGraph')
		{



			$(document.getElementById("outcomeGraphic" + outcomeIncrementer)).highcharts
			({
		        chart: {
		            type: 'column'
		        },
		        title: {
		            text: ''
		        },
		        xAxis: {
		            categories: [$(document.getElementById("xAxisTitle" + outcomeIncrementer)).html()]
		        },
		        yAxis: {
		            title: {
		                text: $(document.getElementById("yAxisTitle" + outcomeIncrementer)).html()
		            }
		        },
		        series: [{
		            name: 'Baseline',
		            data: [parseInt($(document.getElementById("baselineValue" + outcomeIncrementer)).html())]
		        }, {
		            name: 'Follow-Up',
		            data: [parseInt($(document.getElementById("followupValue" + outcomeIncrementer)).html())]
		        }]
    		});


		}

		if($(document.getElementById("outcomeGraphType" + outcomeIncrementer)).html() == 'speedometer')
		{
				$(document.getElementById("outcomeGraphic" + outcomeIncrementer)).speedometer({percentage: parseInt($(document.getElementById("changeNumber"+outcomeIncrementer)).html())});
				
		}

		if($(document.getElementById("outcomeGraphType" + outcomeIncrementer)).html() == 'lineGraph')
		{

			if(parseInt($(document.getElementById("yearCount" + outcomeIncrementer)).html()) == 3)
			{
					$(document.getElementById("outcomeGraphic" + outcomeIncrementer)).highcharts
					({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("year" + outcomeIncrementer + "Results1")).html(), $(document.getElementById("year" + outcomeIncrementer + "Results2")).html(), $(document.getElementById("year" + outcomeIncrementer + "Results3")).html() 
		                ]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("yAxisTitle" + outcomeIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("year" + outcomeIncrementer + "Data1")).html()), parseInt($(document.getElementById("year" + outcomeIncrementer + "Data2")).html()), parseInt($(document.getElementById("year" + outcomeIncrementer + "Data3")).html())]
		            	}]
        		});

			}

			if(parseInt($(document.getElementById("yearCount" + outcomeIncrementer)).html()) == 4)
			{
				$(document.getElementById("outcomeGraphic" + outcomeIncrementer)).highcharts
				({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("year" + outcomeIncrementer + "Results1")).html(), $(document.getElementById("year" + outcomeIncrementer + "Data2")).html(), $(document.getElementById("year" + outcomeIncrementer + "Data3")).html(), 
		                $(document.getElementById("year" + outcomeIncrementer + "Results4")).html()]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("yAxisTitle" + outcomeIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("year" + outcomeIncrementer + "Data1")).html()), parseInt($(document.getElementById("year" + outcomeIncrementer + "Data2")).html()), parseInt($(document.getElementById("year" + outcomeIncrementer + "Data3")).html()), 
							parseInt($(document.getElementById("year" + outcomeIncrementer + "Data4")).html())]
		            	}]
        		});

			}
			if(parseInt($(document.getElementById("yearCount" + outcomeIncrementer)).html()) == 5)
			{
				$(document.getElementById("outcomeGraphic" + outcomeIncrementer)).highcharts
				({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("year" + outcomeIncrementer + "Results1")).html(), $(document.getElementById("year" + outcomeIncrementer + "Results2")).html(), $(document.getElementById("year" + outcomeIncrementer + "Results3")).html(), 
		                $(document.getElementById("year" + outcomeIncrementer + "Results4")).html(), $(document.getElementById("year" + outcomeIncrementer + "Results5")).html()]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("yAxisTitle" + outcomeIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("year" + outcomeIncrementer + "Data1")).html()), parseInt($(document.getElementById("year" + outcomeIncrementer + "Data2")).html()), parseInt($(document.getElementById("year" + outcomeIncrementer + "Data3")).html()), 
							parseInt($(document.getElementById("year" + outcomeIncrementer + "Data4")).html()), parseInt($(document.getElementById("year" + outcomeIncrementer + "Data5")).html())]
		            	}]
        		});
			}


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
if(!isset($_GET['contentArea']))
{
	$_GET['contentArea']='adultPAN';
}
try
{
	$query1 ="SELECT * FROM indicatorMainTable WHERE indicatorState='on' AND contentArea=:contentArea AND indicatorType='goal'";
	$query2="SELECT * FROM indicatorMainTable WHERE indicatorState='on' AND contentArea=:contentArea AND indicatorType='outcome'";
	$query3="SELECT * FROM indicatorMainTable WHERE indicatorState='on' AND contentArea=:contentArea AND indicatorType='environmentalSupports'";
	$query4="SELECT * FROM indicatorMainTable WHERE indicatorState='on' AND contentArea=:contentArea AND indicatorType='programReach'";
	$query5="SELECT * FROM indicatorMainTable WHERE indicatorState='on' AND contentArea=:contentArea AND indicatorType='policy'";
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

	$statement5=$db->prepare($query5);
	$statement5->bindValue(':contentArea',$_GET['contentArea']);
	$statement5->execute();
	$result5=$statement5->fetchAll();

	$db->commit();

}
catch(PDOException $e)
{
?>
  	<p class="error center">There was an error connecting to the database. Please contact the system administrator.<br/> Error code:<?php echo $e->getCode() ;?> Error Message:
	<?php echo $e->getMessage();?></p>
<?php
}
	if(!empty($result1))
		include 'somersetGoal.php';
	if(!empty($result2))
		include 'somersetOutcome.php';
	
	if(!empty($result5))
		include 'somersetPolicy.php';
	
	if(!empty($result3))
		include 'somersetEnvironmental.php';
	
	if(!empty($result4))
		include 'somersetReach.php';
?>
</body>
</html>