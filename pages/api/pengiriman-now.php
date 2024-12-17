<?php
include "../../koneksi.php";
// Ambil parameter dari URL atau request body
$tgl_awal = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : '';
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : '';
$PO = isset($_GET['po']) ? $_GET['po'] : '';
$Order = isset($_GET['order']) ? $_GET['order'] : '';
$Pelanggan = isset($_GET['pelanggan']) ? $_GET['pelanggan'] : '';
$Warna = isset($_GET['warna']) ? $_GET['warna'] : '';
$Prodorder = isset($_GET['prodorder']) ? $_GET['prodorder'] : '';

// Membuat kondisi WHERE berdasarkan filter yang diberikan
$where_date = '';
$where_po = '';
$where_order = '';
$where_pelanggan = '';
$where_warna = '';
$where_Prodorder = '';

// Filter untuk tanggal
if (!empty($tgl_akhir) && !empty($tgl_awal)) {
    $where_date = "AND i.GOODSISSUEDATE BETWEEN '$tgl_awal' AND '$tgl_akhir'";
} else if (!empty($tgl_awal) && empty($tgl_akhir)) {
    $where_date = "AND i.GOODSISSUEDATE = '$tgl_awal'";
}

// Filter untuk PO
if (!empty($PO)) {
    $where_po = "AND i.PO_NUMBER LIKE '%$PO%'";
}

// Filter untuk Order
if (!empty($Order)) {
    $where_order = "AND i.DLVSALORDERLINESALESORDERCODE = '$Order'";
}

// Filter untuk Pelanggan
if (!empty($Pelanggan)) {
    $where_pelanggan = "AND i.LEGALNAME1 LIKE '%$Pelanggan%'";
}

// Filter untuk Warna
if (!empty($Warna)) {
    $where_warna = "AND i2.WARNA LIKE '%$Warna%'";
}

// Filter untuk Prodorder
if (!empty($Prodorder)) {
    $where_Prodorder = "AND iasp.LOTCODE LIKE '%$Prodorder%'";
}

// Menyusun query SQL dengan filter yang diberikan
$sqlDB2 = "SELECT
                DISTINCT 
                LISTAGG(DISTINCT TRIM(i.SUBCODE05), ', ') AS NO_WARNA,
                i.PROVISIONALCODE,
                TRIM(i.PRICEUNITOFMEASURECODE) AS PRICEUNITOFMEASURECODE,
                i.DEFINITIVECOUNTERCODE,
                i.DEFINITIVEDOCUMENTDATE,
                i.ORDERPARTNERBRANDCODE,
                TRIM(i.SUBCODE02) AS SUBCODE02,
                TRIM(i.SUBCODE03) AS SUBCODE03,
                TRIM(i.SUBCODE05) AS SUBCODE05,
                i.PO_NUMBER AS PO_NUMBER,
                i.ITEMDESCRIPTION AS JENIS_KAIN,
                LISTAGG(DISTINCT TRIM(iasp.WAREHOUSELOCATIONCODE), ', ') AS LOKASI,
                i.GOODSISSUEDATE,
                i.ORDPRNCUSTOMERSUPPLIERCODE,
                CASE 
                    WHEN i.PAYMENTMETHODCODE <> 'FOC' THEN ''
                    ELSE i.PAYMENTMETHODCODE
                END AS PAYMENTMETHODCODE,
                i.ITEMTYPEAFICODE,
                i.DLVSALORDERLINESALESORDERCODE AS DLVSALORDERLINESALESORDERCODE,
                i.DLVSALESORDERLINEORDERLINE AS DLVSALESORDERLINEORDERLINE,
                LISTAGG(DISTINCT TRIM(iasp.LOTCODE), ', ' ) AS LOTCODE,
                LISTAGG(DISTINCT ''''|| TRIM(iasp.LOTCODE) ||'''', ', ' ) AS LOTCODE2,
                i2.WARNA AS WARNA,
                i.LEGALNAME1,
                i.CODE AS CODE
            FROM
                ITXVIEW_SURATJALAN_PPC_FOR_POSELESAI i
            LEFT JOIN ITXVIEW_ALLOCATION_SURATJALAN_PPC iasp ON
                iasp.CODE = i.CODE
            LEFT JOIN ITXVIEWCOLOR i2 ON
                i2.ITEMTYPECODE = i.ITEMTYPEAFICODE
                AND i2.SUBCODE01 = i.SUBCODE01
                AND i2.SUBCODE02 = i.SUBCODE02
                AND i2.SUBCODE03 = i.SUBCODE03
                AND i2.SUBCODE04 = i.SUBCODE04
                AND i2.SUBCODE05 = i.SUBCODE05
                AND i2.SUBCODE06 = i.SUBCODE06
                AND i2.SUBCODE07 = i.SUBCODE07
                AND i2.SUBCODE08 = i.SUBCODE08
                AND i2.SUBCODE09 = i.SUBCODE09
                AND i2.SUBCODE10 = i.SUBCODE10
            WHERE
                NOT (SUBSTR(i.DLVSALORDERLINESALESORDERCODE, 1,3) = 'CAP' AND (i.ITEMTYPEAFICODE = 'KFF' OR i.ITEMTYPEAFICODE = 'KGF' OR i.ITEMTYPEAFICODE = 'CAP'))
                AND i.DOCUMENTTYPETYPE = 05 
                AND NOT i.CODE IS NULL 
                AND i.PROGRESSSTATUS_SALDOC = 2
                $where_date
                $where_po
                $where_order
                $where_warna
                $where_pelanggan
                $where_Prodorder
            GROUP BY
                i.SUBCODE02,
                i.SUBCODE03,
                i.SUBCODE05,
                i.PROVISIONALCODE,
                i.PRICEUNITOFMEASURECODE,
                i.DEFINITIVEDOCUMENTDATE,
                i.ORDERPARTNERBRANDCODE,
                i.PO_NUMBER,
                i.PROJECTCODE,
                i.GOODSISSUEDATE,
                i.ORDPRNCUSTOMERSUPPLIERCODE,
                i.PAYMENTMETHODCODE,
                i.PO_NUMBER,
                i.ITEMTYPEAFICODE,
                i.DLVSALORDERLINESALESORDERCODE,
                i.DLVSALESORDERLINEORDERLINE,
                i.ITEMDESCRIPTION,
                i.DEFINITIVECOUNTERCODE,
                i2.WARNA,
                i.LEGALNAME1,
                i.CODE
            ORDER BY
                i.PROVISIONALCODE ASC";

// Eksekusi query menggunakan db2 atau koneksi database yang sesuai
$stmt = db2_exec($conn1, $sqlDB2, array('cursor' => DB2_SCROLLABLE));

// Proses dan tampilkan hasil
$result = [];
while ($row1 = db2_fetch_assoc($stmt)) {
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
                                        AND PROVISIONALCODE = '$row1[PROVISIONALCODE]'
                                        AND ALLOCATIONCODE = '$row1[CODE]'
                                    GROUP BY 
                                        KET_YARDMETER,
                                        ALLOCATIONCODE");
    $d_ket_foc = db2_fetch_assoc($q_ket_foc);

    if ($d_ket_foc['ROLL'] > 0 and $d_ket_foc['KG'] > 0 and $d_ket_foc['YARD_MTR'] > 0) {
        if (in_array($row1['DEFINITIVECOUNTERCODE'], array('CESDEF', 'DREDEF', 'DSEDEF', 'EXDPROV', 'EXPPROV', 'GSEPROV', 'CESPROV', 'DREPROV', 'EXDDEF', 'EXPDEF', 'GSEDEF', 'PSEPROV'))) {
            $q_roll = db2_exec($conn1, "SELECT COUNT(ise.COUNTROLL) AS ROLL,
                                            SUM(ise.QTY_KG) AS QTY_SJ_KG,
                                            SUM(ise.QTY_YARDMETER) AS QTY_SJ_YARD,
                                            inpe.PROJECT,
                                            ise.ADDRESSEE,
                                            ise.BRAND_NM,
                                            ise.ALLOCATIONCODE
                                            FROM ITXVIEW_SURATJALAN_EXIM2A ise 
                                            LEFT JOIN ITXVIEW_NO_PROJECTS_EXIM inpe ON inpe.PROVISIONALCODE = ise.PROVISIONALCODE 
                                            WHERE ise.PROVISIONALCODE = '$row1[PROVISIONALCODE]'
                                            AND ise.ALLOCATIONCODE = '$row1[CODE]'
                                            GROUP BY inpe.PROJECT,ise.ADDRESSEE,ise.BRAND_NM,ise.ALLOCATIONCODE");
            $d_roll = db2_fetch_assoc($q_roll);
            $q_rollfoc = db2_exec($conn1, "SELECT COUNT(ise.COUNTROLL) AS ROLL,
                                                SUM(ise.QTY_KG) AS QTY_SJ_KG,
                                                SUM(ise.QTY_YARDMETER) AS QTY_SJ_YARD,
                                                inpe.PROJECT,
                                                ise.ADDRESSEE,
                                                ise.BRAND_NM,
                                                ise.ALLOCATIONCODE
                                            FROM ITXVIEW_SURATJALAN_EXIM2A ise 
                                            LEFT JOIN ITXVIEW_NO_PROJECTS_EXIM inpe ON inpe.PROVISIONALCODE = ise.PROVISIONALCODE 
                                            WHERE ise.PROVISIONALCODE = '$row1[PROVISIONALCODE]'
                                            AND ise.ALLOCATIONCODE = '$row1[CODE]'
                                            AND ise.QUALITYREASONCODE = 'FOC'
                                            GROUP BY inpe.PROJECT,ise.ADDRESSEE,ise.BRAND_NM,ise.ALLOCATIONCODE");
            $d_rollfoc = db2_fetch_assoc($q_rollfoc);
            $roll = $d_roll['ROLL'] - $d_rollfoc['ROLL']; // MENGHITUNG JIKA FOC SEBAGIAN, MAKA ROLL UNTUK FOC TIDAK PERLU DIPISAH DARI KESELURUHAN
        } else {
            $q_roll = db2_exec($conn1, "SELECT COUNT(CODE) AS ROLL,
                                                 SUM(BASEPRIMARYQUANTITY) AS QTY_SJ_KG,
                                                 SUM(BASESECONDARYQUANTITY) AS QTY_SJ_YARD,
                                                 LISTAGG(TRIM(LOTCODE), ', ') AS LOTCODE
                                            FROM ITXVIEWALLOCATION0 
                                            WHERE CODE = '$row1[CODE]' AND LOTCODE IN ($row1[LOTCODE2])");
            $d_roll = db2_fetch_assoc($q_roll);
            $roll = $d_roll['ROLL'];
        }
    } else {
        // Menghitung jika FOC tidak ada
        if (in_array($row1['DEFINITIVECOUNTERCODE'], array('CESDEF', 'DREDEF', 'DSEDEF', 'EXDPROV', 'EXPPROV', 'GSEPROV', 'CESPROV', 'DREPROV', 'EXDDEF', 'EXPDEF', 'GSEDEF', 'PSEPROV'))) {
            $q_roll = db2_exec($conn1, "SELECT COUNT(ise.COUNTROLL) AS ROLL,
                                                 SUM(ise.QTY_KG) AS QTY_SJ_KG,
                                                 SUM(ise.QTY_YARDMETER) AS QTY_SJ_YARD,
                                                 inpe.PROJECT,
                                                 ise.ADDRESSEE,
                                                 ise.BRAND_NM,
                                                 ise.ALLOCATIONCODE
                                            FROM ITXVIEW_SURATJALAN_EXIM2A ise 
                                            LEFT JOIN ITXVIEW_NO_PROJECTS_EXIM inpe ON inpe.PROVISIONALCODE = ise.PROVISIONALCODE 
                                            WHERE ise.PROVISIONALCODE = '$row1[PROVISIONALCODE]'
                                            AND ise.ALLOCATIONCODE = '$row1[CODE]'
                                            GROUP BY inpe.PROJECT,ise.ADDRESSEE,ise.BRAND_NM,ise.ALLOCATIONCODE");
            $d_roll = db2_fetch_assoc($q_roll);
            echo $d_roll['ROLL']; // MENGHITUNG JIKA FOC SEBAGIAN, MAKA ROLL UNTUK FOC TIDAK PERLU DIPISAH DARI KESELURUHAN
        } else {
            $q_roll = db2_exec($conn1, "SELECT COUNT(CODE) AS ROLL,
                                                SUM(BASEPRIMARYQUANTITY) AS QTY_SJ_KG,
                                                SUM(BASESECONDARYQUANTITY) AS QTY_SJ_YARD,
                                                LISTAGG(TRIM(LOTCODE), ', ') AS LOTCODE
                                            FROM ITXVIEWALLOCATION0 
                                            WHERE CODE = '$row1[CODE]' AND LOTCODE IN ($row1[LOTCODE2])");
            $d_roll = db2_fetch_assoc($q_roll);
            echo $d_roll['ROLL'];
        }
    }
    // Menyimpan hasil dalam array result
    $result[] = ['row' => $row1, 'd_roll' => $d_roll];
}

// Kirimkan hasil sebagai JSON
echo json_encode($result);
?>