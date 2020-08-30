<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title></title>
        <!-- Load Google chart api -->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load("visualization", "1.1", {packages: ["bar"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([

<?php
echo '[';
echo "'Bulan'";
foreach ($juragan as $key => $value) {
	echo ",'" .$key . "'";
}
echo '],';

$bln = range(1, 12);
foreach ($bln as $data_bulan) {
	echo "[" . $data_bulan;

	if (array_key_exists($data_bulan,$bulan)) {
		foreach ($bulan as $key => $value) {
			foreach ($value as $key1 => $value1) {
				foreach ($value1 as $key2 => $value2) {
					if($key === $data_bulan && array_key_exists($key1,$juragan_id)) {
						echo ',' . $value2['jml'];
					}
					else if( ! array_key_exists($key1,$juragan_id)) {
						echo ', 0';
					}
				}
			}
			
		}
	}
	else {
		foreach ($juragan_id as $key11 => $value11) {
			echo ', 0';
		}
	}
	echo "],";
}



$a = array(
	"satu"	=> "siji",
	"dua" 	=> "loro",
	'tiga'	=> 'telu'
	);

$b = array(
	"satu"	=> "one",
	"dua" 	=> "two"
	);

foreach ($a as $key => $value) {

	if (array_key_exists($key,$b)) {
		// echo $value . '-';
	}
	else if ( ! array_key_exists($key, $b)) {
		// echo 'blah';

		// echo "menampilkan data $key dari $a yang tidak ada pada $b";
	}
}




?>
<?php /*

                    ['Year', 'Sales', 'Expenses', 'Profit'],

foreach ($chart_data as $data) {
    echo '[' . $data->performance_year . ',' . $data->performance_sales . ',' . $data->performance_expense . ',' . $data->performance_profit . '],';
}
*/
?>
                ]);
 
                var options = {
                    chart: {
                        title: 'Company Performance',
                        subtitle: 'Sales, Expenses, and Profit:',
                    }
                };
 
                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
 
                chart.draw(data, options);
            }
        </script>
    </head>
    <body>        
        <div id="columnchart_material" style="width: 900px; height: 500px;"></div>
    </body>
</html>