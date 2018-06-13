<?
 function create_graph($array_values){
	# ------- The graph values in the form of associative array
	/*$values=array(
		"Jan" => 110,
		"Feb" => 130,
		"Mar" => 215,
		"Apr" => 81,
		"May" => 310,
		"Jun" => 110,
		"Jul" => 190,
		"Aug" => 175,
		"Sep" => 390,
		"Oct" => 286,
		"Nov" => 150,
		"Dec" => 196
	);
       */
    $values=$array_values;

	$img_width=450;
	$img_height=300;
	$margins=20;


	# ---- Find the size of graph by substracting the size of borders
	$graph_width=$img_width - $margins * 2;
	$graph_height=$img_height - $margins * 2;
	$img=imagecreate($img_width,$img_height);


	$bar_width=20;
	$total_bars=count($values);
	$gap= ($graph_width- $total_bars * $bar_width ) / ($total_bars +1);


	# -------  Define Colors ----------------
	$bar_color=imagecolorallocate($img,0,64,128);
	$background_color=imagecolorallocate($img,240,240,255);
	$border_color=imagecolorallocate($img,200,200,200);
	$line_color=imagecolorallocate($img,220,220,220);

	# ------ Create the border around the graph ------

	imagefilledrectangle($img,1,1,$img_width-2,$img_height-2,$border_color);
	imagefilledrectangle($img,$margins,$margins,$img_width-1-$margins,$img_height-1-$margins,$background_color);


	# ------- Max value is required to adjust the scale	-------
	$max_value=max($values);
	$ratio= $graph_height/$max_value;


	# -------- Create scale and draw horizontal lines  --------
	$horizontal_lines=20;
	$horizontal_gap=$graph_height/$horizontal_lines;

	for($i=1;$i<=$horizontal_lines;$i++){
		$y=$img_height - $margins - $horizontal_gap * $i ;
		imageline($img,$margins,$y,$img_width-$margins,$y,$line_color);
		$v=intval($horizontal_gap * $i /$ratio);
		imagestring($img,0,5,$y-5,$v,$bar_color);

	}


	# ----------- Draw the bars here ------
	for($i=0;$i< $total_bars; $i++){
		# ------ Extract key and value pair from the current pointer position
		list($key,$value)=each($values);
		$x1= $margins + $gap + $i * ($gap+$bar_width) ;
		$x2= $x1 + $bar_width;
		$y1=$margins +$graph_height- intval($value * $ratio) ;
		$y2=$img_height-$margins;
		imagestring($img,0,$x1+3,$y1-10,$value,$bar_color);
		imagestring($img,0,$x1+3,$img_height-15,$key,$bar_color);
		imagefilledrectangle($img,$x1,$y1,$x2,$y2,$bar_color);
	}
	header("Content-type:image/png");
	imagepng($img);
 }

 function create_chart($array, $title, $subtitle, $total){
 	?>
		<!--//<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>//-->
		<script type="text/javascript">
		$(function () {
		    var chart;
		    $(document).ready(function() {
		        chart = new Highcharts.Chart({
		            chart: {
		                renderTo: 'container',
		                type: 'bar'
		            },
		            title: {
		                text: '<?=$title?>'
		            },
		            subtitle: {
		                text: '<?=$subtitle?>'
		            },
		            xAxis: {
		                categories: [<?
		                $x=0; $cuenta=count($array);
		                foreach($array as $k=>$v){
		                $x++;
		                echo "'".$k."'";
		                if($x<$cuenta){ echo ', ';}
		                }
		                ?>],
		                title: {
		                    text: null
		                }
		            },
		            yAxis: {
		                min: 0,
		                title: {
		                    text: '<?=$total?>',
		                    align: 'high'
		                },
		                labels: {
		                    overflow: 'justify'
		                }
		            },
		            tooltip: {
		                formatter: function() {
		                    return ''+
		                        this.series.name +': '+ this.y +' complaints';
		                }
		            },
		            plotOptions: {
		                bar: {
		                    dataLabels: {
		                        enabled: true
		                    }
		                }
		            },
		            legend: {
		                layout: 'vertical',
		                align: 'right',
		                verticalAlign: 'top',
		                x: -100,
		                y: 100,
		                floating: true,
		                borderWidth: 1,
		                backgroundColor: '#FFFFFF',
		                shadow: true
		            },
		            credits: {
		                enabled: false
		            },
		            series: [{
		                name: 'Quantity of Complaints',
		                data: [<?
		                $x=0; $cuenta=count($array);
		                foreach($array as $k=>$v){
		                $x++;
		                echo $v;
		                if($x<$cuenta){ echo ', ';}
		                }
		                ?>]
		            }]
		        });
		    });

		});
				</script>

		<script src="graph/highcharts.js"></script>
		<script src="graph/modules/exporting.js"></script>

		<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
      <?
 }


?>

