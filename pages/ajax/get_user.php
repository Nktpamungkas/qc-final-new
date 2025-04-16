<?php
include '../../koneksi.php';

if (isset($_GET['nama_bow'])) {
    $nama_bow = $_GET['nama_bow'];
										
    $query = "SELECT u.nama 
              FROM user_login u 
              WHERE u.id = ?";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $nama_bow);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode(['success' => true, 'nama_user' => $row['nama']]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Parameter tidak lengkap']);
}
?>
