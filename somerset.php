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

	var outcomeIncrementer=1;
	$(".infoTable").hide();

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

//policy

var policyCounter = parseInt($('#policyGraphCount').html());

	var policyIncrementer=1;
	

	for(var i = 0; i < policyCounter; i++)
	{

		
		if($(document.getElementById("policyGraphType" + policyIncrementer)).html() == 'barGraph')
		{



			$(document.getElementById("policyGraphic" + policyIncrementer)).highcharts
			({
		        chart: {
		            type: 'column'
		        },
		        title: {
		            text: ''
		        },
		        xAxis: {
		            categories: [$(document.getElementById("policyXAxisTitle" + policyIncrementer)).html()]
		        },
		        yAxis: {
		            title: {
		                text: $(document.getElementById("policyYAxisTitle" + policyIncrementer)).html()
		            }
		        },
		        series: [{
		            name: 'Baseline',
		            data: [parseInt($(document.getElementById("policyBaselineValue" + policyIncrementer)).html())]
		        }, {
		            name: 'Follow-Up',
		            data: [parseInt($(document.getElementById("policyFollowupValue" + policyIncrementer)).html())]
		        }]
    		});


		}

		if($(document.getElementById("policyGraphType" + policyIncrementer)).html() == 'speedometer')
		{
				$(document.getElementById("policyGraphic" + policyIncrementer)).speedometer({percentage: parseInt($(document.getElementById("policyChangeNumber"+ policyIncrementer)).html())});
				
		}

		if($(document.getElementById("policyGraphType" + policyIncrementer)).html() == 'lineGraph')
		{

			if(parseInt($(document.getElementById("policyYearCount" + policyIncrementer)).html()) == 3)
			{
					$(document.getElementById("outcomeGraphic" + policyIncrementer)).highcharts
					({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("policyYear" + policyIncrementer + "Results1")).html(), $(document.getElementById("policyYear" + policyIncrementer + "Results2")).html(), $(document.getElementById("policyYear" + policyIncrementer + "Results3")).html() 
		                ]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("policyYAxisTitle" + policyIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data1")).html()), parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data2")).html()), parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data3")).html())]
		            	}]
        		});

			}

			if(parseInt($(document.getElementById("policyYearCount" + policyIncrementer)).html()) == 4)
			{
				$(document.getElementById("policyGraphic" + policyIncrementer)).highcharts
				({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("policyYear" + policyIncrementer + "Results1")).html(), $(document.getElementById("policyYear" + policyIncrementer + "Data2")).html(), $(document.getElementById("policyYear" + policyIncrementer + "Data3")).html(), 
		                $(document.getElementById("policyYear" + policyIncrementer + "Results4")).html()]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("policyYAxisTitle" + policyIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data1")).html()), parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data2")).html()), parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data3")).html()), 
							parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data4")).html())]
		            	}]
        		});

			}
			if(parseInt($(document.getElementById("policyYearCount" + policyIncrementer)).html()) == 5)
			{
				$(document.getElementById("policyGraphic" + policyIncrementer)).highcharts
				({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("policyYear" + policyIncrementer + "Results1")).html(), $(document.getElementById("policyYear" + policyIncrementer + "Results2")).html(), $(document.getElementById("policyYear" + policyIncrementer + "Results3")).html(), 
		                $(document.getElementById("policyYear" + policyIncrementer + "Results4")).html(), $(document.getElementById("policyYear" + policyIncrementer + "Results5")).html()]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("policyYAxisTitle" + policyIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data1")).html()), parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data2")).html()), parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data3")).html()), 
							parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data4")).html()), parseInt($(document.getElementById("policyYear" + policyIncrementer + "Data5")).html())]
		            	}]
        		});
			}


		}


		policyIncrementer++;
		
	}




//reach


var reachCounter = parseInt($('#reachGraphCount').html());

	var reachIncrementer=1;


	for(var i = 0; i < reachCounter; i++)
	{

		
		if($(document.getElementById("reachGraphType" + reachIncrementer)).html() == 'barGraph')
		{



			$(document.getElementById("reachGraphic" + reachIncrementer)).highcharts
			({
		        chart: {
		            type: 'column'
		        },
		        title: {
		            text: ''
		        },
		        xAxis: {
		            categories: [$(document.getElementById("reachXAxisTitle" + reachIncrementer)).html()]
		        },
		        yAxis: {
		            title: {
		                text: $(document.getElementById("reachYAxisTitle" + reachIncrementer)).html()
		            }
		        },
		        series: [{
		            name: 'Baseline',
		            data: [parseInt($(document.getElementById("reachBaselineValue" + reachIncrementer)).html())]
		        }, {
		            name: 'Follow-Up',
		            data: [parseInt($(document.getElementById("reachFollowupValue" + reachIncrementer)).html())]
		        }]
    		});


		}

		if($(document.getElementById("reachGraphType" + reachIncrementer)).html() == 'speedometer')
		{
				$(document.getElementById("reachGraphic" + reachIncrementer)).speedometer({percentage: parseInt($(document.getElementById("reachChangeNumber"+reachIncrementer)).html())});
				
		}

		if($(document.getElementById("reachGraphType" + reachIncrementer)).html() == 'lineGraph')
		{

			if(parseInt($(document.getElementById("reachYearCount" + reachIncrementer)).html()) == 3)
			{
					$(document.getElementById("outcomeGraphic" + reachIncrementer)).highcharts
					({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("reachYear" + reachIncrementer + "Results1")).html(), $(document.getElementById("reachYear" + reachIncrementer + "Results2")).html(), $(document.getElementById("reachYear" + reachIncrementer + "Results3")).html() 
		                ]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("reachYAxisTitle" + reachIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data1")).html()), parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data2")).html()), parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data3")).html())]
		            	}]
        		});

			}

			if(parseInt($(document.getElementById("reachYearCount" + reachIncrementer)).html()) == 4)
			{
				$(document.getElementById("reachGraphic" + reachIncrementer)).highcharts
				({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("reachYear" + reachIncrementer + "Results1")).html(), $(document.getElementById("reachYear" + reachIncrementer + "Data2")).html(), $(document.getElementById("reachYear" + reachIncrementer + "Data3")).html(), 
		                $(document.getElementById("reachYear" + reachIncrementer + "Results4")).html()]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("reachYAxisTitle" + reachIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data1")).html()), parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data2")).html()), parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data3")).html()), 
							parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data4")).html())]
		            	}]
        		});

			}
			if(parseInt($(document.getElementById("reachYearCount" + reachIncrementer)).html()) == 5)
			{
				$(document.getElementById("reachGraphic" + reachIncrementer)).highcharts
				({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("reachYear" + reachIncrementer + "Results1")).html(), $(document.getElementById("reachYear" + reachIncrementer + "Results2")).html(), $(document.getElementById("reachYear" + reachIncrementer + "Results3")).html(), 
		                $(document.getElementById("reachYear" + reachIncrementer + "Results4")).html(), $(document.getElementById("reachYear" + reachIncrementer + "Results5")).html()]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("reachYAxisTitle" + reachIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data1")).html()), parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data2")).html()), parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data3")).html()), 
							parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data4")).html()), parseInt($(document.getElementById("reachYear" + reachIncrementer + "Data5")).html())]
		            	}]
        		});
			}


		}


		reachIncrementer++;
		
	}


//environmental



var environmentalCounter = parseInt($('#environmentalGraphCount').html());

	var environmentalIncrementer=1;


	for(var i = 0; i < environmentalCounter; i++)
	{

		
		if($(document.getElementById("environmentalGraphType" + environmentalIncrementer)).html() == 'barGraph')
		{



			$(document.getElementById("environmentalGraphic" + environmentalIncrementer)).highcharts
			({
		        chart: {
		            type: 'column'
		        },
		        title: {
		            text: ''
		        },
		        xAxis: {
		            categories: [$(document.getElementById("environmentalXAxisTitle" + environmentalIncrementer)).html()]
		        },
		        yAxis: {
		            title: {
		                text: $(document.getElementById("environmentalYAxisTitle" + environmentalIncrementer)).html()
		            }
		        },
		        series: [{
		            name: 'Baseline',
		            data: [parseInt($(document.getElementById("environmentalBaselineValue" + environmentalIncrementer)).html())]
		        }, {
		            name: 'Follow-Up',
		            data: [parseInt($(document.getElementById("environmentalFollowupValue" + environmentalIncrementer)).html())]
		        }]
    		});


		}

		if($(document.getElementById("environmentalGraphType" + environmentalIncrementer)).html() == 'speedometer')
		{
				$(document.getElementById("environmentalGraphic" + environmentalIncrementer)).speedometer({percentage: parseInt($(document.getElementById("environmentalChangeNumber"+ environmentalIncrementer)).html())});
				
		}

		if($(document.getElementById("environmentalGraphType" + environmentalIncrementer)).html() == 'lineGraph')
		{

			if(parseInt($(document.getElementById("environmentalYearCount" + environmentalIncrementer)).html()) == 3)
			{
					$(document.getElementById("outcomeGraphic" + environmentalIncrementer)).highcharts
					({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("environmentalYear" + environmentalIncrementer + "Results1")).html(), $(document.getElementById("environmentalYear" + environmentalIncrementer + "Results2")).html(), $(document.getElementById("environmentalYear" + environmentalIncrementer + "Results3")).html() 
		                ]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("environmentalYAxisTitle" + environmentalIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data1")).html()), parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data2")).html()), parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data3")).html())]
		            	}]
        		});

			}

			if(parseInt($(document.getElementById("environmentalYearCount" + environmentalIncrementer)).html()) == 4)
			{
				$(document.getElementById("environmentalGraphic" + environmentalIncrementer)).highcharts
				({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("environmentalYear" + environmentalIncrementer + "Results1")).html(), $(document.getElementById("environmentalYear" + environmentalIncrementer + "Data2")).html(), $(document.getElementById("environmentalYear" + environmentalIncrementer + "Data3")).html(), 
		                $(document.getElementById("environmentalYear" + environmentalIncrementer + "Results4")).html()]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("environmentalYAxisTitle" + environmentalIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data1")).html()), parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data2")).html()), parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data3")).html()), 
							parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data4")).html())]
		            	}]
        		});

			}
			if(parseInt($(document.getElementById("environmentalYearCount" + environmentalIncrementer)).html()) == 5)
			{
				$(document.getElementById("environmentalGraphic" + environmentalIncrementer)).highcharts
				({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("environmentalYear" + environmentalIncrementer + "Results1")).html(), $(document.getElementById("environmentalYear" + environmentalIncrementer + "Results2")).html(), $(document.getElementById("environmentalYear" + environmentalIncrementer + "Results3")).html(), 
		                $(document.getElementById("environmentalYear" + environmentalIncrementer + "Results4")).html(), $(document.getElementById("environmentalYear" + environmentalIncrementer + "Results5")).html()]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("environmentalYAxisTitle" + environmentalIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data1")).html()), parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data2")).html()), parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data3")).html()), 
							parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data4")).html()), parseInt($(document.getElementById("environmentalYear" + environmentalIncrementer + "Data5")).html())]
		            	}]
        		});
			}


		}


		environmentalIncrementer++;
		
	}
	

//goal


var goalCounter = parseInt($('#goalClassGraphCount').html());

	var goalIncrementer=1;

	for(var i = 0; i < goalCounter; i++)
	{

		if($(document.getElementById("goalClassGraphType" + goalIncrementer)).html() == 'barGraph')
		{
				


			$(document.getElementById("goalClassGraphic" + goalIncrementer)).highcharts
			({
		        chart: {
		            type: 'column'
		        },
		        title: {
		            text: ''
		        },
		        xAxis: {
		            categories: [$(document.getElementById("goalXAxisTitle" + goalIncrementer)).html()]
		        },
		        yAxis: {
		            title: {
		                text: $(document.getElementById("goalYAxisTitle" + goalIncrementer)).html()
		            }
		        },
		        series: [{
		            name: 'Baseline',
		            data: [parseInt($(document.getElementById("goalBaselineValue" + goalIncrementer)).html())]
		        }, {
		            name: 'Follow-Up',
		            data: [parseInt($(document.getElementById("goalFollowupValue" + goalIncrementer)).html())]
		        }]
    		});


		}

		if($(document.getElementById("goalClassGraphType" + goalIncrementer)).html() == 'speedometer')
		{
				$(document.getElementById("goalClassGraphic" + goalIncrementer)).speedometer({percentage: parseInt($(document.getElementById("goalChangeNumber"+goalIncrementer)).html())});
				
		}

		if($(document.getElementById("goalClassGraphType" + goalIncrementer)).html() == 'lineGraph')
		{

			if(parseInt($(document.getElementById("goalYearCount" + goalIncrementer)).html()) == 3)
			{
					$(document.getElementById("goalClassGraphic" + goalIncrementer)).highcharts
					({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("goalYear" + goalIncrementer + "Results1")).html(), $(document.getElementById("goalYear" + goalIncrementer + "Results2")).html(), $(document.getElementById("goalYear" + goalIncrementer + "Results3")).html() 
		                ]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("goalYAxisTitle" + goalIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data1")).html()), parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data2")).html()), parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data3")).html())]
		            	}]
        		});

			}

			if(parseInt($(document.getElementById("goalYearCount" + goalIncrementer)).html()) == 4)
			{
				$(document.getElementById("goalClassGraphic" + goalIncrementer)).highcharts
				({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("goalYear" + goalIncrementer + "Results1")).html(), $(document.getElementById("goalYear" + goalIncrementer + "Data2")).html(), $(document.getElementById("goalYear" + goalIncrementer + "Data3")).html(), 
		                $(document.getElementById("goalYear" + goalIncrementer + "Results4")).html()]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("goalYAxisTitle" + goalIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data1")).html()), parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data2")).html()), parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data3")).html()), 
							parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data4")).html())]
		            	}]
        		});

			}
			if(parseInt($(document.getElementById("goalYearCount" + goalIncrementer)).html()) == 5)
			{
				$(document.getElementById("goalClassGraphic" + goalIncrementer)).highcharts
				({
		            title: {
		                text: ''
		                
		            },
		            subtitle: {
		                text: ''
		               
		            },
		            xAxis: {
		                categories: [$(document.getElementById("goalYear" + goalIncrementer + "Results1")).html(), $(document.getElementById("goalYear" + goalIncrementer + "Results2")).html(), $(document.getElementById("goalYear" + goalIncrementer + "Results3")).html(), 
		                $(document.getElementById("goalYear" + goalIncrementer + "Results4")).html(), $(document.getElementById("goalYear" + goalIncrementer + "Results5")).html()]
		            },
		            yAxis: {
		                title: {
		                    text: $(document.getElementById("goalYAxisTitle" + goalIncrementer)).html()
		                },

		            },

		            series: [{
		               
		                data: [parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data1")).html()), parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data2")).html()), parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data3")).html()), 
							parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data4")).html()), parseInt($(document.getElementById("goalYear" + goalIncrementer + "Data5")).html())]
		            	}]
        		});
			}


		}


		goalIncrementer++;
		
	}

function changeLink(changevar, change)
	{
		
		if(changevar=="outcome")
		{
			if (outcome)
			{
				$('.'+change+'').hide();
				outcome = false;
			}
			else
			{
				$('.'+change+'').show();
				outcome = true;
			}
		}

		if(changevar=="policySuccess")
		{


			if (policySuccess)
			{
				$('.'+change+'').hide();
				policySuccess = false;
			}
			else
			{
				$('.'+change+'').show();
				policySuccess = true;
			}
		}

		if(changevar=="environmentalSupports")
		{
			if (environmentalSupports)
			{
				$('.'+change+'').hide();
				environmentalSupports = false;
			}
			else
			{
				$('.'+change+'').show();
				environmentalSupports = true;
			}
		}

		if(changevar=="programReach")
		{
			if (programReach)
			{
				$('.'+change+'').hide();
				programReach = false;
			}
			else
			{
				$('.'+change+'').show();
				programReach = true;
			}
		}

	}

 	function change(changevar, changed, changedImage)
 	{
 		
 		if(changevar=="intermediateTermVar")
 		{
 			if(intermediateTermVar)
	 		{
	 			$('#'+changed+'').hide();
	 			$('#'+changedImage+'').attr("src","image/minus.gif")
	 			intermediateTermVar=false;
	 			
	 		}	
	 		else
	 		{
	 			$('#'+changed+'').show();
	 			$('#'+changedImage+'').attr("src","image/plus.gif")
	 			intermediateTermVar=true;
	 		}
	 	}
	 	else
	 	{
	
	 			if(policiesAndProgramsVar)
		 		{
		 			$('#'+changed+'').hide();
		 			$('#'+changedImage+'').attr("src","image/minus.gif")
		 			policiesAndProgramsVar=false;
		 			
		 		}	
		 		else
		 		{
		 			$('#'+changed+'').show();
		 			$('#'+changedImage+'').attr("src","image/plus.gif")
		 			policiesAndProgramsVar=true;
		 		}
	 	}
 	}
	var	goal = false;
	var outcome = false;
	var policySuccess= false;
	var environmentalSupports= false;
	var  programReach= false;
	var varList=false;

 	$('#goal').bind("click", function()
 	{
 		//alert('hi');
		if(!varList)
		{
			$('#goalImage').attr("src","image/minus.gif");
			$('#listVars').show();
			varList=true;
		}
		else
		{
			$('#goalImage').attr("src","image/plus.gif");
			$('#listVars').hide();
			varList=false;
		}
		if(!goal)
		{
			goal=true;
			$('.goalClass').show();
			$('.instructions').hide();
		
		}
 	});
	 
	 var containerHeight = $('#container').height();
	 var title = containerHeight + 25
	 var section = containerHeight+ $('#title').height() -20;
	 var left =$('section').offset().left;
	 $(window).scroll(function()
	 {
	 	 $('aside').css(
 		{
 			top:200,
			position: "fixed"

		});
	
		$('#container').css(
		{
			top:5,
			position: 'fixed'

		});

		$('section').css(
		{
			
			position: 'absolute',
			top: section,
			zIndex: -1
		});

		$('#title').css(
		{
			position: 'absolute',
			top: title,
			left: left,
			zIndex:-1
		});

	 });

	$('#outcome').bind("click", function()
 	{
 		
 		var topVal = Math.round($('#outcomespot').offset().top);
 		var asideVal=topVal;
 	
 		var topVal2 = (topVal-containerHeight)-5;
 		
 		$('aside').css(
 		{
 			top: asideVal,
			position: "absolute"

		});
	
		$('#container').css(
		{
			top: topVal2,
			position: 'absolute'
		});


 	$('#container')[0].scrollIntoView(true);
});	

	 $('#policySuccess').bind("click", function()
 	{
 		var topVal = Math.round($('#policyspot').offset().top);
 		var asideVal=topVal;
 		var topVal2 = (topVal-containerHeight)-5;
 		
 		$('aside').css(
 		{
 			top: asideVal,
			position: "absolute"

		});
	
		$('#container').css(
		{
			top: topVal2,
			position: 'absolute'
		});


		$('#container')[0].scrollIntoView(true);
 		//changeLink("policySuccess","policy");
 	});
	
	
	$('#environmentalSupports').bind("click", function()
 	{
 		 var topVal = Math.round($('#environmentalspot').offset().top);
 		var asideVal=topVal;
 		var topVal2 = (topVal-containerHeight)-5;
 		
 		$('aside').css(
 		{
 			top: asideVal,
			position: "absolute"

		});
	
		$('#container').css(
		{
			top: topVal2,
			position: 'absolute'
		});


		$('#container')[0].scrollIntoView(true);


 		//changeLink("environmentalSupports","environmental");

 	});
	
	
	$('#programReach').bind("click", function()
 	{
 		var topVal = Math.round($('#reachspot').offset().top);
 		var asideVal=topVal;
 		var topVal2 = (topVal-containerHeight);
 		
 		$('aside').css(
 		{
 			top: asideVal,
			position: "absolute"

		});
	
		$('#container').css(
		{
			top: topVal2,
			position: 'absolute'
		});


		$('#container')[0].scrollIntoView(true);



		//changeLink("programReach","reach");

 	});



});	
</script>

<style type="text/css">
/*
*
{
	margin:0;
	padding:0;
}

*/
.bottom
{
	margin-bottom: 120px;
}

.bigbottom
{
	margin-bottom: 120px;
}

/*
.ruralActive
{
	display: none;
}
.healthyMachine
{
	display: none;	
}
.schoolWellness
{
	display: none;
}
.healthyPAN
{
	display: none;
}
*/
/*
.outcomeClass
{
	display:none;
}

.policy
{
	display:none;
}

.environmental
{
	display:none;
}

.reach
{
	display:none;
}
*/
ul
{
	list-style-type: none;

}

body
{
	margin: 0;
	padding: 0;
	background-color: #E6E6E6;
		font-family: 'Droid Sans', sans-serif;
}
.center
{
	text-align:center;

}
#wrapper
{
	margin: 0 auto;
	width: 950px;
	height: auto;
}

@font-face
{
	font-family: chunkfive;
	src: url('font/Chunkfive.otf');
} 

#header
{
	margin: 2px 0 10px 0px;
	background-color: #000066;
	border-radius:5px;
	/*position: fixed;*/
	width: 950px;
}
#container
{

	/*position: fixed;*/
}
#nav_bar
{

}

#logoWording
{
	margin-left: 10px;
	font-family: chunkfive,'Paytone One', sans-serif;
	font-size: 1.35em;

	color: white;
}
aside
{
	float: left;
	width: 350px;
	margin-right: 10px;
	background-color: #BCD7F9;
	border-radius: 5px;
	color: white;
	height: 600px;

/*	position: fixed;
/*
	margin-top: 200px;

	position: fixed;
	top: 180px;*/
}
p
{
	margin: 0 15px; 
}
.spots
{
	color: #104583;
}

.spots:visited
{

	color: #104583;
}

.spots:hover
{
	color:white;
}

#outcome:hover
{
	color:white;
}
#policySuccess:hover
{
	color:white;
}
#environmentalSupports:hover
{
	color:white;
}
#programReach:hover
{
	color:white;
}


#title
{
	float: right;
	width: 590px; 
	background-color: #FDFEFE;
	border-radius: 5px;
	height: 50px;
	/*
	margin-top: 200px;
	/*
	position: absolute;
	/*left: 440px;
	top: 180px;
	*/
}
.center
{
	text-align: center;
}
#PANHeadline
{
	margin: 10px 0;

}

section
{
	
	width: 590px; 
	background-color: #FDFEFE;
	border-radius: 5px;
	margin-top: 80px;
	margin-left:360px;
	/*
	position: absolute;
	z-index: -1;
	top: 240px;*/
}
ul li ul li ul li
{
	padding-bottom: 5px;
}


/*
#listVars
{
	display:none;
}

.goalClass
{
	display:none;
}
*/
/*
body
{
	width: auto;

}*/

#mainSelection
{
	margin-top: 20px;
	color: #104583;
	font-weight: bold;

}

.Paytone
{
	font-family: 'Paytone One',sans-serif;
}
.indicatorTitle
{
	color:#104583;
	margin-bottom: 25px;
	font-size: 23px;
}


hr
{
	width: 60%; 
	height: 0.3em; 
	background-color: #6E6E6; 
	color: #6E6E6;
	margin: 0 auto; 
	border-radius: 5px;
}

.smallBottom
{
	margin-bottom: 20px;
}

.spots
{
	text-decoration: none;
}


 nav
 {
 	width: 950px;
 	margin: 15px auto;
 	text-align: center;
 	height: 35px;
 	padding-top:  5px;
 	 background-color: #000066;
 	 border-radius: 5px;

 }
.navigation:hover
{
	color: #104583;
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
 	color: white;
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

</style>
</head>
<body>
<script src="http://code.highcharts.com/adapters/standalone-framework.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<div id="wrapper">
<div id="container">
<div id="header"><img src="image/sommerset_logo.png" id="logo" style="vertical-align: middle; border-radius: 5px;"/><span id="logoWording">Somerset Public Health Web Dashboard</span></div>
	<nav id="nav_bar"><ul><li><a class="navigation" href="somerset.php?contentArea=youthPAN">Youth PAN</a></li><li><a class="navigation" href="somerset.php?contentArea=adultPAN">Adult PAN</a></li>
	<li><a class="navigation" href="somerset.php?contentArea=adultSubstanceAbuse">Adult Substance Abuse</a></li>
	<li><a class="navigation" href="somerset.php?contentArea=youthSubstanceAbuse">Youth Substance Abuse</a></li>

	<li><a class="navigation" href="somerset.php?contentArea=coalition">Coalition</a></li></ul></nav>
</div>
<aside>
<ul id = "mainSelection">
	<li> <span id="goal"><img id="goalImage"src="image/plus.gif"/>Program Goal</span>
	<ul id="listVars">
				<li id="outcome">Outcome</li>
				<li id="policySuccess">Policy Success</li>
				<li id="environmentalSupports">Environmental Supports</li>
				<li id="programReach">Program Reach</li>		
	</ul>
	</li>
</ul>
</aside>

<?php
	if(!isset($_GET['contentArea']))
	{
		$_GET['contentArea']='youthPAN';
	}

	switch($_GET['contentArea'])
	{
		case 'adultPAN':
			$content="Adult PAN";
		break;
		
		case 'youthPAN':
			$content="Youth PAN";
		break;
		
		case 'adultSubstanceAbuse':
			$content="Adult Substance Abuse";
		break;

		case 'youthSubstanceAbuse':
			$content="Youth Substance Abuse";
		break;

		case 'coalition':
			$content="Coalition";
		break;
	}

?>

<div id="title">
	<h2 id="PANHeadline" class="center Paytone"><?php echo "$content Indicators"; ?></h2>
</div>
<section>
<?php

	if(!empty($result1)|| !empty($result2)|| !empty($result3) || !empty($result4) || !empty($result5))
	{
	
?>
		<div class="instructions" style="height:500px">	
			<h3 class="center" style="font-size:1.4em">Instructions</h3>
			<p style="font-size:1em">Click on the expandable menu in the left pane to view GSPHC data dashboards.</p>
		</div>
<?php
	}

require_once 'include/dbaseConnect.inc';

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
	if(empty($result1)&& empty($result2)&&empty($result3)&&empty($result4)&&empty($result5))
	{
?>
		<div  style="height:500px">	
		<h3 class="center" style="font-size:1.4em">Results Unavailable</h3>
		<p style="font-size:1em" class="center">There are no indicators available to display for this section.</p>
		</div>
<?php
	}
	else
	{
		if(!empty($result1))
			include 'somersetGoal.php';
		else
		{
?>
			<div  class="goalClassGraphic" style="height:500px">	
			<h3 class="center" style="font-size:1.4em">Results Unavailable</h3>
			<p style="font-size:1em" class="center">There are no program goal data available to display for this section.</p>
			</div>
<?php
		}
		if(!empty($result2))
			include 'somersetOutcome.php';
		else
		{
?>
			<div  id="outcomespot" class="outcomeGraphic outcomeClass" style="height:500px">	
			<h3 class="center" style="font-size:1.4em">Results Unavailable</h3>
			<p style="font-size:1em" class="center">There are no outcome indicator data available to display for this section.</p>
			</div>
<?php
		}
		if(!empty($result5))
			include 'somersetPolicy.php';
		else
		{
?>
			<div  id="policyspot" class="center policyGraphic policy" style="height:500px">	
			<h3  style="font-size:1.4em">Results Unavailable</h3>
			<p style="font-size:1em" class="center">There are no policy indicator data available to display for this section.</p>
			</div>
<?php
		}
		
		if(!empty($result3))
			include 'somersetEnvironmental.php';
		else
		{
?>
			<div  id="environmentalspot" class="center environmentalGraphic environmental" style="height:500px">	
			<h3  style="font-size:1.4em">Results Unavailable</h3>
			<p style="font-size:1em" class="center">There are no environmental indicator data available to display for this section.</p>
			</div>
<?php
		}
		
		if(!empty($result4))
			include 'somersetReach.php';
		else
		{
?>
			<div  id="reachspot" class="reachGraphic reach" style="height:500px">	
			<h3 class="center" style="font-size:1.4em">Results Unavailable</h3>
			<p style="font-size:1em">There are no program reach indicator data available to display for this section.</p>
			</div>
<?php
		}
	}
	
?>
</section>
</div>
</body>
</html>