<?php
session_start();
include "../../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

function writeLog($message) {
    $logFile = 'update_log_lapkpeqcf.txt';
    $timestamp = date('Y-m-d H:i:s');
    $formattedMessage = "[$timestamp] " . $message . "\n";
    file_put_contents($logFile, $formattedMessage, FILE_APPEND);
}

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo "❌ Sesi tidak ditemukan. Silakan login ulang.";
    writeLog("Sesi tidak ditemukan");
    exit();
}

$user          = $_SESSION['user_id'];
$today         = date('Y-m-d H:i:s');

$nodemand      = $_POST['no_demand']      ?? '';
$nokk          = $_POST['no_kk']      ?? '';
$personil1     = $_POST['personil1']     ?? '';
$personil2     = $_POST['personil2']     ?? '';
$personil3     = $_POST['personil3']     ?? '';
$personil4     = $_POST['personil4']     ?? '';
$personil5     = $_POST['personil5']     ?? '';
$personil6     = $_POST['personil6']     ?? '';
$shift1        = $_POST['shift1']        ?? '';
$shift2        = $_POST['shift2']        ?? '';
$pejabat       = $_POST['pejabat']       ?? '';
$hitung        = $_POST['hitung']        ?? '';
$status        = $_POST['status']        ?? '';
$analisa       = $_POST['analisis']      ?? '';
$hasil_analisa = $_POST['hasil_analisa'] ?? '';

if ($nodemand == '') {
    echo "❌ 'nodemand' kosong. Tidak bisa lanjut.";
    writeLog("Gagal: nodemand kosong");
    exit();
}

if (!$con) {
    echo "❌ Gagal koneksi DB: " . mysqli_connect_error();
    writeLog("Gagal koneksi DB: " . mysqli_connect_error());
    exit();
}

$sqlCheck = "SELECT no_demand FROM tbl_add_kpe_qcf WHERE no_demand = ?";
$stmtCheck = $con->prepare($sqlCheck);
if (!$stmtCheck) {
    echo "❌ Prepare cek gagal: " . $con->error;
    writeLog("Prepare cek gagal: " . $con->error);
    exit();
}
$stmtCheck->bind_param("s", $nodemand);
$stmtCheck->execute();
$stmtCheck->store_result();
$exists = $stmtCheck->num_rows > 0;
$stmtCheck->close();
writeLog("Cek data untuk '$nodemand': " . ($exists ? "ADA, akan di-UPDATE" : "TIDAK ADA, akan di-INSERT"));

if ($exists) {
    $sql = "UPDATE tbl_add_kpe_qcf SET
            personil1=?, personil2=?, personil3=?, personil4=?, personil5=?, personil6=?,
            shift1=?, shift2=?, pejabat=?, hitung=?, status=?, analisis=?, hasil_analisa=?,
            update_user=?, update_date=?, nokk=?
            WHERE no_demand=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param(
        "sssssssssssssssss",
        $personil1, $personil2, $personil3, $personil4, $personil5, $personil6,
        $shift1, $shift2, $pejabat, $hitung, $status, $analisa, $hasil_analisa,
        $user, $today, $nokk, $nodemand
    );
    $action = "UPDATE";
} else {
    $sql = "INSERT INTO tbl_add_kpe_qcf (
            no_demand, personil1, personil2, personil3, personil4, personil5, personil6,
            shift1, shift2, pejabat, hitung, status, analisis, hasil_analisa, insert_user, insert_date, nokk
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param(
        "sssssssssssssssss",
        $nodemand, $personil1, $personil2, $personil3, $personil4, $personil5, $personil6,
        $shift1, $shift2, $pejabat, $hitung, $status, $analisa, $hasil_analisa, $user, $today, $nokk
    );
    $action = "INSERT";
}

if (!$stmt) {
    echo "❌ Prepare $action gagal: " . $con->error;
    writeLog("Prepare $action gagal: " . $con->error);
    exit();
}

if ($stmt->execute()) {
    echo "✅ Data berhasil di-$action untuk No Demand: $nodemand";
    writeLog("$action berhasil untuk $nodemand");
} else {
    echo "❌ $action gagal: " . $stmt->error;
    writeLog("$action gagal: " . $stmt->error);
}

$stmt->close();
$con->close();
writeLog("=== SELESAI ===\n");
?>