<?php
session_start();
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
if(empty($_REQUEST['id']) || empty($_REQUEST['card_id'])) {
		echo "<script>window.location='record.php';</script>";
} else {
	include("conn.php");
	//$sql  = " SELECT * FROM register_data ";
	$sql .= " LEFT JOIN records_status ON records_status.regis_id = register_data.id ";
	$sql .= " WHERE card_id ='".$_REQUEST['card_id']."' ";
	$check_card = mysqli_query($conn, $sql);
	if($check_card) {
        $numRows = mysqli_num_rows($check_card);
	}
	if($numRows > 0) {
        echo "<script>window.location='record.php';</script>";
	} else {

        $_REQUEST['document'] = '1';
        //echo "New register data created successfully";
        $record  = "DELETE FROM records_status WHERE id = '".$_REQUEST['id']."'";
        if (mysqli_query($conn, $record)) {
				//echo "Delete record successfully";
            echo "<script>window.location='record.php'; </script>";
			} else {
				//echo "Error: " . $record . "<br>" . mysqli_error($conn);
            echo "<script>window.location='record.php'; </script>";
			}
	}
	mysqli_close($conn);
}
?>