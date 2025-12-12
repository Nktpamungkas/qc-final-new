<?php
include '../../koneksi.php';

header('Content-Type: application/json');

$data = [];

$sql = mysqli_query(
    $con,
    "SELECT a.no_order,
            a.no_test,
            a.nodemand,
            a.nokk,
            a.jenis_kain,
            a.lot,
            a.no_hanger,
            a.no_item,
            a.warna
     FROM tbl_tq_nokk a
     INNER JOIN tbl_tq_test b ON a.id = b.id_nokk
     WHERE DATE_FORMAT(a.tgl_masuk, '%Y') != '2019'
       AND DATE_FORMAT(a.tgl_masuk, '%Y') != '2020'
       AND DATE_FORMAT(a.tgl_masuk, '%Y') != '2021'
       AND a.nodemand != ''"
);

if ($sql) {
    while ($row = mysqli_fetch_assoc($sql)) {
        $data[] = [
            'no_order'   => $row['no_order'],
            'no_test'    => $row['no_test'],
            'nodemand'   => $row['nodemand'],
            'nokk'       => $row['nokk'],
            'jenis_kain' => $row['jenis_kain'],
            'lot'        => $row['lot'],
            'no_hanger'  => $row['no_hanger'],
            'no_item'    => $row['no_item'],
            'warna'      => $row['warna'],
        ];
    }
}

echo json_encode([
    'success' => true,
    'data'    => $data,
]);
