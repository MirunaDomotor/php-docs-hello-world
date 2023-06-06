<?php

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: *");

    $host = "mysqlserveraal.mysql.database.azure.com";		          // host = localhost because database hosted on the same server where PHP files are hosted
    $dbname = "aal";              		 // Database name
    $username = "mysqlserver";				// Database username
    $password = "server2023*";	   // Database password


// Establish connection to MySQL database

$con = mysqli_init();
mysqli_ssl_set($con,NULL,NULL, "https://github.com/MirunaDomotor/php-docs-hello-world/blob/master/DigiCertGlobalRootCA.crt.pem", NULL, NULL);
//mysqli_ssl_set($con,NULL,NULL, "D:\Downloads\DigiCertGlobalRootCA.crt.pem", NULL, NULL);
//mysqli_real_connect($con, "mysqlserveraal.mysql.database.azure.com", "mysqlserver", "server2023*", "aal", 3306, MYSQLI_CLIENT_SSL);
mysqli_real_connect($con, "mysqlserveraal.mysql.database.azure.com", "mysqlserver", "server2023*", "aal", 3306, MYSQLI_CLIENT_SSL);

// Check if connection established successfully
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
else { echo "Connected to mysql database. "; }

    
// If values send by NodeMCU are not empty then insert into MySQL database table

  if (isset($_POST['val1']) && isset($_POST['val2']) && isset($_POST['val3']) && isset($_POST['val4']) && isset($_POST['val5']) && isset($_POST['val6'])) 
  {
		$val1 = $_POST['val1'];
        $val2 = $_POST['val2'];
		$val3 = $_POST['val3'];
		$val4 = $_POST['val4'];
		$val5 = $_POST['val5'];
		$val6 = $_POST['val6'];
		$id_colectie = $_POST['val7'];
		
		if ($val1 !== '' && $val2 !== '' && $val3 !== '' && $val4 !== '' && $val5 !== '' && $val6 !== '' && $id_colectie !='')
		{
			if($id_colectie > 1)
			{
				$sql = "UPDATE Date_Colectate SET puls=$val1, grad_iluminare=$val2, temp_amb=$val3, saturatie_gaz=$val4, umiditate=$val5, proximitate=$val6 WHERE id_colectie=1";
			}
			else
				$sql = "INSERT INTO Date_Colectate (id_colectie, TA, puls, temp_corp, greutate, glicemie, grad_iluminare, temp_amb, saturatie_gaz, umiditate, proximitate) VALUES (1, 0,'".$val1."',0,0,0,'".$val2."', '".$val3."', '".$val4."', '".$val5."', '".$val6."')"; 
		}
		
		if ($con->query($sql) === TRUE) 
		{
		    echo "Values updated in MySQL database table.";
		} 
		else
		{
		    echo "Error: " . $sql . "<br>" . $con->error;
		}
  }
  
  if (isset($_POST['id_alarma']) && isset($_POST['data_ora']) && isset($_POST['tip_parametru']) && isset($_POST['valoare_masurata'])&& isset($_POST['mesaj']))
  {
		$id_alarma = $_POST['id_alarma'];
		$data_ora = $_POST['data_ora'];
		$tip_parametru = $_POST['tip_parametru'];
		$valoare_masurata = $_POST['valoare_masurata'];
		$mesaj = $_POST['mesaj'];
		
		if ($id_alarma !== '' && $data_ora !== '' && $tip_parametru !== '' && $valoare_masurata !== '' && $mesaj !== '')
		{																						
			if($id_alarma > 1)
			{
				$sql2 = "UPDATE Alarme SET data_ora='$data_ora', tip_parametru='$tip_parametru', valoare_masurata='$valoare_masurata', mesaj='$mesaj' WHERE id_alarma=1";
			}
			else
				$sql2 = "INSERT INTO Alarme (id_alarma, data_ora, tip_parametru, valoare_masurata, mesaj) VALUES (1,'".$data_ora."', '".$tip_parametru."', '".$valoare_masurata."', '".$mesaj."')"; 
			
			if ($con->query($sql2) === TRUE) 
			{
				echo "Values updated in MySQL database table.";
			} 
			else 
			{
				echo "Error: " . $sql2 . "<br>" . $con->error;
			}
		}
 }

// Close MySQL connection
$con->close();
?>
