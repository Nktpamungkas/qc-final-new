<?PHP
ini_set("error_reporting", 1);
session_start();
include "../../koneksi.php";
$note_qc= str_replace("'","''",$_POST[value]);
mysqli_query($conlab,"UPDATE tbl_test_qc SET `note_qc` = '$note_qc' where id = '$_POST[pk]'");

echo json_encode('success');
