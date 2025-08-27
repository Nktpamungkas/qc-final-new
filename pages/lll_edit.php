<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
	$id = $_POST['id'];
	$no_item = str_replace("'","''",$_POST['no_item']);
    $material_name = str_replace("'","''",$_POST['material_name']);
    $fiber_content = str_replace("'","''",$_POST['fiber_content']);
    $user = $_SESSION['usrid'];

		$sqlupdate="UPDATE master_matrialname SET 
		item='$no_item',
        matrial_name='$material_name',
        fiber_content='$fiber_content',
		last_update=now(),
		last_update_user ='$user'
		WHERE id='$id'";
		$result = mysqli_query($con,$sqlupdate) or die (mysqli_error());
		if($result){
			echo " <script>window.location='MasterLLL';</script>";
		}else{
			echo "Update Data Gagal";
		}
?>
