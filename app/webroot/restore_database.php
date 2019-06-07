<?php 
echo "restore database";
$date_data = date("Y-m-d-H-i-s");
$report_data = [];

$archivos = [
	'2019-06-06-drop-tables',
	'2019-06-06-create-tables',
	'2019-06-06-inserts-ciudades',
	'2019-06-06-inserts-comercios',
	'2019-06-06-inserts-provincia',
	'2019-06-06-inserts-rubro-comercios',
	'2019-06-06-inserts-rubros',
	'2019-06-06-inserts-users',
	'2019-06-06alters_pkey',
	'2019-06-06-sequence-setvals'
];

$dbh = pg_connect("host=localhost dbname=test_ahora12 user=postgres port=5432 password=postgres");

if (!$dbh) {
	die("Error in connection: " . pg_last_error());
}
echo "<h3>conectado a db" . "</h3>";
echo "<h4>".date("Y-m-d H:i:s") . "</h4>";
$linecount = 0;
foreach ($archivos as $archivo) {
	echo "<p>abro archivo " . $archivo . "</p>";
	$handle = fopen('files/'.$archivo.".sql", "r");

	while (($line = fgets($handle)) !== false) {

		$sql = $line;
			$result = pg_query($dbh, $sql);
			if (!$result) {
				die("Error in SQL query: " . pg_last_error());
			}

		//echo "<p>line count: ".$linecount ."</p>";
		$linecount++;
	}
	fclose($handle);
}

echo "<h2>lineas procesadas: " . $linecount . "</h2>";

pg_close($dbh);


?>