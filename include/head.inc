<!DOCTYPE html>
<html>
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Paytone+One' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">

	$(function()
	{
			var yearNumber = 3;

			$('.hidden').hide();
			$('#addYear').on('click', function()
			{
				if(yearNumber>=5)
				{
					alert('Note: You have entered the maximum number of data points allowed');

				}
				else
				{
					$('#lineGraphData tr:last').after("<tr><td>Enter a year:<input type='text' class='disabledInput disabledGroupUnique' name='year[]' /></td><td>Enter data for that year:<input type='text' class='disabledInput disabledGroupUnique' name='yearData[]'/></td></tr>");
					yearNumber ++;
				}
				return false;
			});


			$('#removeYear').on('click',function()
			{
				if(yearNumber>3)
				{
					$('#lineGraphData tr:last').remove();
					yearNumber --;
				}
				else
				{
					alert('Note: A minimum of 3 data points are required.');

				}
				return false;

			});

<?php
if(isset($modifiable))
	if($modifiable)
	{
{

?>


			$('#contentAreas').on('change',function()
			{
				var value = $('#graphType').val();
				var content = $('#contentAreas').val();
				var indicatorType = $('#indicatorTypes').val();
				if(value !=''&&content!=''&&indicatorType!='')
					$(':submit').removeProp('disabled');
				
				else
					$(':submit').prop('disabled');	
			});

			$('#indicatorTypes').on('change',function()
			{
				var value = $('#graphType').val();
				var content = $('#contentAreas').val();
				var indicatorType = $('#indicatorTypes').val();
				
				if(value !=''&&content!=''&&indicatorType!='')
					$(':submit').removeProp('disabled');
				
				else
					$(':submit').prop('disabled');	
			});

			$('#graphType').on('change',function()
			{
				var value = $('#graphType').val();
				var content = $('#contentAreas').val();
				var indicatorType = $('#indicatorTypes').val();
				
				if(value !=''&&content!=''&&indicatorType!='')
				{
					$(':submit').removeProp('disabled');
					$('.defaultGroup').show();
					$('.defaultInput').removeProp('disabled');
					
					switch(value)
					{

						case 'barGraph':
							$('.group2').show();
							$('.disabledGroup2').removeProp('disabled');
							$('.group3').show();
							$('.disabledGroup3').removeProp('disabled');

							$('.uniqueLine').hide();
							$('disabledGroupUnique').prop('disabled');
						break;

						case 'speedometer':
							$('.group2').show();
							$('.disabledGroup2').removeProp('disabled');
							$('.group3').hide();
							$('.disabledGroup3').prop('disabled');

							$('.uniqueLine').hide();
							$('disabledGroupUnique').prop('disabled');				
						break;

						case 'lineGraph':
							$('.uniqueLine').show();
							$('disabledGroupUnique').removeProp('disabled');
							$('.group3').show();
							$('.disabledGroup3').removeProp('disabled');

							$('.group2').hide();
							$('.disabledGroup2').prop('disabled');
						break;

						case 'arrowUp':
							$('.group2').show();
							$('.disabledGroup2').removeProp('disabled');
							$('.group3').hide();

							$('.disabledGroup3').prop('disabled');
							$('.uniqueLine').hide();
							$('disabledGroupUnique').prop('disabled');
						break;

						case 'arrowDown':
							$('.group2').show();
							$('.disabledGroup2').removeProp('disabled');
							$('.group3').hide();

							$('.disabledGroup3').prop('disabled');
							$('.uniqueLine').hide();
							$('disabledGroupUnique').prop('disabled');
						break;
					}
				}
				else
				{
					$('.hidden').hide();
					$('.disabledInput').prop('disabled');
					$(':submit').prop('disabled');
				}
				
<?php
	}
}
?>
				
			});





<?php
	if(isset($script))
	{
		echo $script;
	}
?>
});
</script>	

<style type="text/css">
<?php
	if (isset($style)) 
	{
		echo $style;
	}
?>



.center
{
	text-align:center;
	font-weight: bold;

}

 nav
 {
 	width: 95%;
 	margin: 15px auto;
 	text-align: center;
 	height: 35px;
 	padding-top:  5px;
 	 background-color: #000066;
 	 border-radius: 5px;
 }

 nav ul li a
 {
 	width: 100%;
 	height: 100%;
 	text-decoration: none;
 	font-weight: bold;
 	background-color: #000066;
 	color:white;
 	padding: 0;
 	margin-right: 15px;
 	

 	font-size: 1.1em;

 }
 h2
 {
	text-align:center;

 }

 nav ul li a:active
 {
 	color: #cedce7;
 }
  nav ul li a:hover
 {
 	color: #cedce7;
 }
 nav ul
 {
 	
 	padding: 0;
 	margin: 0;
 	list-style-type: none;

 }
 nav ul li
 {
 	padding: 0;
 	margin: 0;
  	display: inline;	
 }





html,body
{
	height:100%;
	background-color: #2D2D2D;
	margin: 0px;
	padding: 0px;
	 font-family: 'Droid Sans', Arial,sans-serif;

}
h3,p, #lineGraphData
{
	font-family: 'Droid Sans',Arial, sans-serif;
}

p,#lineGraphData
{
	padding-left: 20px;
}

.errors,.error,#errors,#error
{
	color: red;
}

#wrapper
{
	margin: 0 auto;
	width: 950px;
	min-height: 100%;
	background-color:#CEDCE7;
	border-radius: 3px;
}

#logoWording
{
	margin-left: 10px;
	font-family: chunkfive,'Paytone One', sans-serif;
	font-size: 1.35em;
	color: white;
}

#header
{
	margin: 0px 0px 10px 0px;
	background-color: #000066;
	border-radius:5px;	
}


</style>




</head>
<body>
<div id="wrapper">

<div id="header"><img src="image/sommerset_logo.png" id="logo" style="vertical-align: middle; border-radius: 5px;"/><span id="logoWording">Somerset Public Health Web Dashboard</span></div>
<?php
include 'include/navbar.inc';

?>