<?php
include '../../koneksi.php';

if (isset($_GET['nodemand'])) {
    $nodemand = mysqli_real_escape_string($con, $_GET['nodemand']); // aman dari SQL Injection

    $sql = "SELECT DISTINCT no_test FROM tbl_tq_nokk WHERE nodemand = '$nodemand' ORDER BY no_test DESC LIMIT 1";
    $query = mysqli_query($con, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        echo json_encode(['no_test' => $row['no_test']]);
    } else {
        echo json_encode(['no_test' => null]);
    }
}
?>
