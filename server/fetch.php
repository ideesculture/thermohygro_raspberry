<?php
ini_set("allow_url_fopen",1);

$result = json_decode(file_get_contents("http://192.168.0.29/readsensor/"));
//var_dump($result->temp);
//var_dump($result->hygro);

$mysqli = mysqli_connect("localhost", "root", "fo8xj8qv", "readsensor");

$request = "insert into temperature (station, value) values (1, ".$result->temp.");";
$res = mysqli_query($mysqli, $request);

$request = "insert into hygrometry (station, value) values (1, ".$result->hygro.");";
$res = mysqli_query($mysqli, $request);
?>
<head>
<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {

     $.getJSON("values.php", function (result) {

         var labels = [],data=[];
         for(var item in result){
              labels.push(result[item].slice(0,1).toString());
              data.push(result[item].slice(1,2).toString());
          }

    var tempData = {
        labels : labels,
        datasets : [{
            label: "temperature",
            fillColor: "rgba(172,194,132,0.4)",
            strokeColor : "#ACC26D",
            pointColor : "#fff",
            pointStrokeColor : "#9DB86D",
            data : data
        }]
    };

    var temp = document.getElementById('graph').getContext('2d');
    var lineChart = new Chart(temp, {
	    type: "line",
	    data: tempData,

	});
 });
 });
 </script>
</head>
<body style="width:100%;margin:20px;">
<canvas id="graph" width="600" height="200" style=""></canvas>
<div id="thermometer">
	<div id="demo7"></div>
	<div id="subdemo7"><?php print $result->temp; ?>° C</div>
</div>
<div id="hygrometer">
	<div id="placeholder"></div>
	<div id="hygro-value">
		<?php print $result->hygro; ?>%
	</div>
</div>

<!-- CDN JS -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="http://alexgorbatchev.com/pub/sh/current/scripts/shCore.js" type="text/javascript"></script>
<script src="http://alexgorbatchev.com/pub/sh/current/scripts/shAutoloader.js" type="text/javascript"></script>
<script src="http://code.jquery.com/color/jquery.color-2.1.2.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.1/jquery.flot.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.1/jquery.flot.time.min.js" type="text/javascript"></script>
<!-- Unmanaged JS -->
<script type="text/javascript" src="http://david.dupplaw.me.uk/js/dd.js"></script>
<script type='text/javascript' src='http://david.dupplaw.me.uk/js/jquery.thermometer.js'></script>

<script>
	function updateThermometer7() {
		$('#demo7').thermometer( 'setValue', Math.random()*8 );
		window.setTimeout( updateThermometer7, 2000 );
	}

	$('#demo7').thermometer( {
		pathToSVG: '/svg/thermo-bottom.svg',
		height: 200,
		textColour: 'black',
		tickColour: 'black',
		topText: "26",
		bottomText: "10",
		startValue: <?php print (($result->temp -10)/16*8); ?>
	} );

	// consts
var minCord = {x: -60, y: -57};
var maxCord = {x: 60, y: -60};
var radius = 90;

$(function() {

    // some calculations
    var startAngle = (6.2831 + Math.atan2(minCord.y, minCord.x));
    var endAngle = Math.atan2(maxCord.y, maxCord.x);
    var degreesSweep = (-endAngle) + startAngle;

    var positionOnArc = function(magnitude){
        var numDegrees = degreesSweep * (magnitude/100.0);
        var angle = (startAngle - numDegrees);
        var posX = radius * Math.cos(angle);
        var posY = radius * Math.sin(angle);
        return [posX, posY];
    }

    var options = {
      xaxis: {
          min: -100,
          max: 100,
          show: false
      },
      yaxis: {
          min: -100,
          max: 100,
          show: false
      },
      grid: {
          show: false
      }
    };

    updatePlot = function(){
        //var data = [[0,0],positionOnArc(Math.random() * 100)];
        var data = [[0,0],positionOnArc(<?php print $result->hygro; ?>)];
        $('#placeholder').plot([data], options);
        //setTimeout(updatePlot, 1000);
    }

    updatePlot();
});
</script>
<style type="text/css">
	#thermometer {
		float: left;
		width: 200px;
		border: 1px solid lightgray;
		padding-top:20px;
		padding-bottom:10px;
	}
	#demo7 {
		margin-left: 50px;
	}
	#subdemo7 {
		margin-top: 20px;
		padding:10px 0;
		width:100%;
		text-align: center;
	}
	#graph {
		width:82%;max-width:82%;
		padding-right:6%;
		float:right;
	}
	#placeholder
	{
		background-image:url('/img/gauge-md.png');
		background-size: contain;
		width: 140px;
		height: 140px;
	}
	#hygrometer {
		border: 1px solid lightgray;
		width: 200px;
		display: inline-block;
	}
	#placeholder {
		margin:10px 30px;
		position:relative;
	}
	#hygro-value {
		margin-top: 20px;
		padding:10px 0;
		width:100%;
		text-align: center;

	}
</style>
</body>