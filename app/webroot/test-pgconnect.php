<?php 

$dbh = pg_connect("host=localhost dbname=test_ahora12 user=postgres port=5432 password=postgres");

if (!$dbh) {
	die("Error in connection: " . pg_last_error());
}
echo "connected";
pg_close($dbh);


?>