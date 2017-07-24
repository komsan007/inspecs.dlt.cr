<?php
  ini_set('display_errors', 1);
  error_reporting(~0);

  function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

  function recordLog($conn, $logTable, $regisId, $action) {

			$record  = "INSERT INTO ".$logTable." (regis_id, action, datetime) VALUES ( ";
			$record .= " '".$regisId."',";
			$record .= " '".$action."',";
			$record .= " NOW()";
			$record .= ")";
			
			if (mysqli_query($conn, $record)) {
				return true;
			} else {
				echo "Error: ". mysqli_error($conn);
				return false;
			}				
}

?>