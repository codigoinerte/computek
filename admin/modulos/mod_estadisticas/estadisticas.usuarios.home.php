<?php
$hours=$weks=$days='';
$data_weeks=$data_month='';
function getUltimoDiaMes($elAnio,$elMes) {
  return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
}

for($a=1;$a<=23;$a++)
{
	$hours.="'".(str_pad($a, 2, "0", STR_PAD_LEFT)).":00',";
}

$fecha = new DateTime();
$fecha->modify('last day of this month');
$day_back = $fecha->format('j');

#echo date("j-n-Y");

$day = date("j")-1;
$month = date("n");
$year = date("Y");
if($day-10<=0)
{
	if($month-1<=0)
	{
		$anio1=$year-1;
	}
	else
	{
		$anio1=$year;
	}
}
else
{
	$anio1=$year;
}
if($day-10<=0)
{
	if($month-1<=0)
	{
		$mes1=12;
	}
	else
	{
		$mes1=$month-1;
	}
}
else
{
	$mes1=$month;
}
if($day-10<=0)
{
	#$fecha = new DateTime();
	#$fecha->modify('last day of this month'); /* corregir*/
	#$dia1= $fecha->format('d');
	$dia1=  getUltimoDiaMes($anio1,$mes1);
	$dia1=$dia1+($day-10);/* corregir*/
}
else
{
	$dia1=$day-10;
}

#echo " &nbsp;  &nbsp; &nbsp;   &nbsp;    ".$dia1."-".$mes1."-".$anio1;

for($d=1;$d<=12;$d++)
{
	#echo "<br> CUENTA=".$d;
	
	#$dia = (date("j")-$d);
	#$mes = (($dia<1)?(date("m")-1):date("m"));
	#$dia = (($dia<1)?($day_back-$d):$dia);
	$last_day_month =  getUltimoDiaMes($anio1,$mes1);
	
	if($dia1<=$last_day_month)
	{
		$anio1=$anio1;
	}
	else
	{
		if($mes1+1<12)
		{
			$anio1=$anio1;
		}
		else
		{
			$anio1=$anio1+1;
		}
	}
	if($dia1<=$last_day_month)
	{
		$mes1=$mes1;
	}
	else
	{
		if($mes1+1<12)
		{
			$mes1=$mes1+1;
		}
		else
		{
			$mes1=1;
		}
	}
	
	$dia1 = ($dia1<=$last_day_month)?$dia1:1;
	
	
	#$mes1 = ($dia1<=$last_day_month)?$mes1:$mes1+1;
	#$anio1 = ($dia1<=$last_day_month)?$mes1:$mes1+1;
	
	$array_resultado = $datos_estadisticas->visitaxdia($dia1,$mes1,$anio1);
	$cantidad = isset($array_resultado[0]["cantidad"])?$array_resultado[0]["cantidad"]:0;

	$data_weeks.="'".$cantidad."',";

	$data_row_week = ucfirst(strftime("%a %e/%b/%y", strtotime("$anio1-$mes1-$dia1")));

	#$weks.="'".$dia1."/".$mes1."/".$anio1."',";	
	$weks.="'$data_row_week',";	
	
	
	$dia1++;
}

for($x=1;$x<=12;$x++)
{
	$array_resultado=$datos_estadisticas->visitaxmes($x,date("Y"));
	$cantidad = isset($array_resultado[0]["cantidad"])?$array_resultado[0]["cantidad"]:0;
	
	$data_month.="'".$cantidad."',";		
}
?>
<script>
	
	if(document.getElementById("chartBig1"))
	{
    var chart_labels = [<?php echo $hours; ?>];
    var chart_labels1 = [<?php echo $days; ?>];
	
    var chart_labels2 = [<?php echo $weks; ?>];
    var chart_labels3 = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'];
	
    var chart_data1 = [100, 70, 90, 70, 85, 60, 75, 60, 90, 80, 110, 100];
	var chart_data2 = [<?php echo $data_weeks; ?>];
 	var chart_data3 = [<?php echo $data_month; ?>];
	
    var ctx = document.getElementById("chartBig1").getContext('2d');
		
	var gradientStroke = ctx.createLinearGradient(0,230,0,50);

	gradientStroke.addColorStop(1, 'rgba(191, 113, 255, 0.57)');
	gradientStroke.addColorStop(0.7, 'rgba(191, 113, 255, 0.27)');
	gradientStroke.addColorStop(0, 'rgba(191, 113, 255, 0.015)'); //purple colors

    var config = {
      type: 'line',
      data: {
        labels: chart_labels2,
        datasets: [{
          label: "Estadisticas de visitas",
          fill: true,
          backgroundColor: gradientStroke,
          borderColor: '#bf71ff',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: '#d346b1',
          pointBorderColor: 'rgba(255,255,255,0)',
          pointHoverBackgroundColor: '#d346b1',
          pointBorderWidth: 20,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
          data: chart_data2,
        }]
      },
      options: gradientChartOptionsConfigurationWithTooltipGreen
    };
    var myChartData = new Chart(ctx, config);
    $("#0").click(function() {
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data1;
      data.labels = chart_labels1;
      myChartData.update();
    });
    $("#1").click(function() {
      
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data2;
      data.labels = chart_labels2;
      myChartData.update();
    });

    $("#2").click(function() {
     
      var data = myChartData.config.data;
      data.datasets[0].data = chart_data3;
      data.labels = chart_labels3;
      myChartData.update();
    });
	}
</script>