<?php
ini_set("error_reporting", 1);
session_start();

ob_start();
header('Content-Type: application/json; charset=utf-8');

require_once "../../koneksi.php";

$mysqli = null;
foreach (['conn', 'con', 'koneksi', 'mysqli', 'db'] as $v) {
    if (isset($$v) && $$v instanceof mysqli) {
        $mysqli = $$v;
        break;
    }
}
if (!$mysqli && function_exists('mysqli_connect') && isset($koneksi)) {
    if ($koneksi instanceof mysqli)
        $mysqli = $koneksi;
}

if (!$mysqli) {
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => 'Koneksi MySQL (mysqli) tidak ketemu. Cek koneksi.php ($conn/$con/$koneksi).']);
    exit;
}

mysqli_set_charset($mysqli, 'utf8mb4');

// INPUT
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$field = isset($_POST['field']) ? trim($_POST['field']) : '';
$value = isset($_POST['value']) ? (int) $_POST['value'] : null;

// VALIDASI
$allowedValues = [5, 10, 15, 20, 25, 30];

// WAJIB whitelist kolom yang boleh diupdate
$allowedFields = ['pengurangan_poin']; 

if ($id <= 0) {
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
    exit;
}
if (!in_array($value, $allowedValues, true)) {
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => 'Value tidak valid']);
    exit;
}
if (!in_array($field, $allowedFields, true)) {
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => 'Field tidak diizinkan']);
    exit;
}

// UPDATE
$sql = "UPDATE tbl_aftersales_now SET `$field`=? WHERE `id`=?";

$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => 'Prepare gagal: ' . $mysqli->error]);
    exit;
}

$stmt->bind_param("ii", $value, $id);

if (!$stmt->execute()) {
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => 'Execute gagal: ' . $stmt->error]);
    exit;
}

ob_end_clean();
echo json_encode(['status' => 'ok', 'affected' => $stmt->affected_rows]);
