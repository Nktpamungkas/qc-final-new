<?PHP
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";

mysqli_query($con,"UPDATE tbl_tq_randomtest SET rprt_b1 = '$_POST[value]' where id = '$_POST[pk]'");

echo json_encode('success');
