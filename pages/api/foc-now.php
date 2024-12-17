<?php
include "../../koneksi.php";
// Ambil parameter dari URL atau request body
$PROVISIONALCODE = isset($_GET['PROVISIONALCODE']) ? $_GET['PROVISIONALCODE'] : '';
$CODE = isset($_GET['CODE']) ? $_GET['CODE'] : '';

$q_ket_foc = db2_exec($conn1, "SELECT 
                                                      COUNT(QUALITYREASONCODE) AS ROLL,
                                                      SUM(FOC_KG) AS KG,
                                                      SUM(FOC_YARDMETER) AS YARD_MTR,
                                                      KET_YARDMETER,
                                                      ALLOCATIONCODE
                                                  FROM
                                                      ITXVIEW_SURATJALAN_EXIM2A
                                                  WHERE 
                                                      QUALITYREASONCODE = 'FOC'
                                                      AND PROVISIONALCODE = '$PROVISIONALCODE'
                                                      AND ALLOCATIONCODE = '$CODE'
                                                  GROUP BY 
                                                      KET_YARDMETER,
                                                      ALLOCATIONCODE");
    $result = [];
    while ($row1 = db2_fetch_assoc($q_ket_foc)) {
        $result[] = $row1;  // Simpan hasil dalam array
    }

    // Kirimkan hasil ke client (misalnya dalam format JSON)
    echo json_encode($result);

?>
