<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
    $no_item = str_replace("'","''",$_POST['no_item']);
    $material_name = str_replace("'","''",$_POST['material_name']);
    $fiber_content = str_replace("'","''",$_POST['fiber_content']);
    $user = $_SESSION['usrid'];
		$sqlinsert="INSERT INTO master_matrialname SET 
		item='$no_item',
        matrial_name='$material_name',
        fiber_content='$fiber_content',
        creation=now(),
		last_update=now(),
		creation_user = '$user',
		last_update_user ='$user'";
		$result = mysqli_query($con,$sqlinsert) or die (mysqli_error());
		if($result){
			echo " <script>window.location='MasterLLL';</script>";
		}else{
			echo "Insert Data Gagal";
		}
?>
